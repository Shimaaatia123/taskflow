<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $projects = \App\Models\Project::with(['owner', 'users'])
            ->where('owner_id', $user->id)
            ->orWhereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->latest()
            ->paginate(10);

        return ProjectResource::collection($projects)->additional([
            'msg'    => 'Projects retrieved successfully.',
            'status' => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
        ]);

        $project = \App\Models\Project::create([
            'owner_id'       => auth()->id(),
            'name'           => $validated['name'],
            'description_ar' => $validated['description_ar'] ?? null,
            'description_en' => $validated['description_en'] ?? null,
        ]);

        return (new ProjectResource($project))
            ->additional([
                'msg'    => 'Project created successfully.',
                'status' => true,
            ])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Project $project)
    {
        $user = auth()->user();

        abort_unless(
            $project->owner_id === $user->id ||
            $project->users()->where('users.id', $user->id)->exists(),
            403
        );
        $project->load(['owner', 'users']);
        return (new ProjectResource($project))->additional([
            'msg'    => 'Project retrieved successfully.',
            'status' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = \App\Models\Project::findOrFail($id);
        abort_unless(
            $project->owner_id === auth()->id(),
            403
        );
        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
        ]);

        return (new ProjectResource($project))->additional([
            'msg'    => 'Project updated successfully.',
            'status' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = \App\Models\Project::findOrFail($id);
        abort_unless(
            $project->owner_id === auth()->id(),
            403
        );
        $project->delete();
        return response()->json([
            'msg'    => 'Project deleted successfully.',
            'status' => true,
        ]);
    }
}
