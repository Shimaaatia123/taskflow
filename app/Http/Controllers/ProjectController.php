<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $projects = $user->role === 'admin'
            ? Project::latest()->get()
            : Project::where('owner_id', $user->id)
            ->orWhereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(
            auth()->user()->role === 'admin' ||
            auth()->user()->role === 'manager',
            403,
            'Only admins and managers can create projects.'
        );

        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(
            auth()->user()->role === 'admin' ||
            auth()->user()->role === 'manager',
            403,
            'Only admins and managers can create projects.'
        );

        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
        ]);

        $validated['owner_id'] = auth()->id();

        Project::create($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        abort_unless(
            auth()->user()->role === 'admin' ||
            $project->owner_id === auth()->id() ||
            $project->users()->where('users.id', auth()->id())->exists(),
            403
        );
        $project->load(['owner', 'users', 'tasks']);

        $users = \App\Models\User::orderBy('name')->get();

        return view('projects.show', compact('project', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        abort_unless(
            auth()->user()->role === 'admin' ||
            $project->owner_id === auth()->id(),
            403
        );
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        abort_unless(
            auth()->user()->role === 'admin' ||
            $project->owner_id === auth()->id(),
            403
        );
        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
        ]);

        $project->update($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        abort_unless(
            auth()->user()->role === 'admin' ||
            $project->owner_id === auth()->id(),
            403
        );
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function addMember(Request $request, Project $project)
    {
        abort_unless(
            auth()->user()->role === 'admin' ||
            $project->owner_id === auth()->id(),
            403
        );
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $project->users()->syncWithoutDetaching([
            $validated['user_id'],
        ]);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Member added successfully.');
    }

    public function removeMember(Project $project, \App\Models\User $user)
    {
        abort_unless(
            auth()->user()->role === 'admin' ||
            $project->owner_id === auth()->id(),
            403
        );
        $project->users()->detach($user->id);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Member removed successfully.');
    }

    public function members(Project $project)
    {
        abort_unless(
            auth()->user()->role === 'admin' ||
            $project->owner_id === auth()->id() ||
            $project->users()->where('users.id', auth()->id())->exists(),
            403
        );

        $project->load('users');

        $users = $project->users
            ->push($project->owner)
            ->map(function ($user) {
                return [
                    'id'   => $user->id,
                    'name' => $user->name,
                ];
            });

        return response()->json($users);
    }
}
