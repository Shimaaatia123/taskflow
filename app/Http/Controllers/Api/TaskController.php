<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        $tasks = Task::with(['project', 'assignee'])
            ->whereHas('project', function ($query) use ($user) {
                $query->where('owner_id', $user->id)
                    ->orWhereHas('users', function ($query) use ($user) {
                        $query->where('users.id', $user->id);
                    });
            })
            ->latest()
            ->paginate(10);

        return TaskResource::collection($tasks)->additional([
            'msg'    => 'Tasks retrieved successfully.',
            'status' => true,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id'     => ['required', 'exists:projects,id'],
            'assigned_to'    => ['nullable', 'exists:users,id'],
            'title_ar'       => ['required', 'string', 'max:255'],
            'title_en'       => ['required', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'priority'       => ['required', 'in:low,medium,high'],
            'due_date'       => ['nullable', 'date'],
        ]);
        $project = \App\Models\Project::findOrFail($validated['project_id']);

        $user = auth()->user();

        abort_unless(
            $project->owner_id === $user->id ||
            $project->users()->where('users.id', $user->id)->exists(),
            403
        );
        if ($validated['assigned_to']) {
            abort_unless(
                $validated['assigned_to'] == $project->owner_id ||
                $project->users()->where('users.id', $validated['assigned_to'])->exists(),
                403
            );
        }
        $task = Task::create($validated);
        $task->load(['project', 'assignee']);
        return (new TaskResource($task))
            ->additional([
                'msg'    => 'Task created successfully.',
                'status' => true,
            ])
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::with(['project', 'assignee'])->findOrFail($id);
        $user = auth()->user();

        abort_unless(
            $task->project->owner_id === $user->id ||
            $task->project->users()->where('users.id', $user->id)->exists(),
            403
        );
        return (new TaskResource($task))->additional([
            'msg'    => 'Task retrieved successfully.',
            'status' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);
        $user = auth()->user();

        abort_unless(
            $task->project->owner_id === $user->id ||
            $task->project->users()->where('users.id', $user->id)->exists(),
            403
        );
        $validated = $request->validate([
            'project_id'     => ['required', 'exists:projects,id'],
            'assigned_to'    => ['nullable', 'exists:users,id'],
            'title_ar'       => ['required', 'string', 'max:255'],
            'title_en'       => ['required', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_en' => ['nullable', 'string'],
            'priority'       => ['required', 'in:low,medium,high'],
            'status'         => ['required', 'in:todo,in_progress,completed'],
            'due_date'       => ['nullable', 'date'],
        ]);
        $project = \App\Models\Project::findOrFail($validated['project_id']);

        abort_unless(
            $project->owner_id === $user->id ||
            $project->users()->where('users.id', $user->id)->exists(),
            403
        );
        if ($validated['assigned_to']) {
            abort_unless(
                $validated['assigned_to'] == $project->owner_id ||
                $project->users()->where('users.id', $validated['assigned_to'])->exists(),
                403
            );
        }
        $task->update($validated);
        $task->load(['project', 'assignee']);
        return (new TaskResource($task))->additional([
            'msg'    => 'Task updated successfully.',
            'status' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $user = auth()->user();

        abort_unless(
            $task->project->owner_id === $user->id ||
            $task->project->users()->where('users.id', $user->id)->exists(),
            403
        );
        $task->delete();
        return response()->json([
            'msg'    => 'Task deleted successfully.',
            'status' => true,
        ]);
    }
}
