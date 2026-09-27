<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

        $tasks = $user->role === 'admin'
            ? Task::latest()->get()
            : Task::whereHas('project', function ($query) use ($user) {
            $query->where('owner_id', $user->id)
                ->orWhereHas('users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                });
        })
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = auth()->user();
        abort_unless(
            $user->role === 'admin' || $user->ownedProjects()->exists(),
            403,
            'Only admins and project owners can create tasks.'
        );

        $selectedProject = $request->query('project_id');

        $projects = $user->role === 'admin'
            ? \App\Models\Project::latest()->get()
            : $user->ownedProjects()->latest()->get();

        $users = collect();

        if ($selectedProject) {
            $project = \App\Models\Project::with('users')->findOrFail($selectedProject);

            abort_unless(
                $user->role === 'admin' ||
                $project->owner_id === auth()->id(),
                403,
                'Only admins and project owners can create tasks.'
            );

            $users = $project->users->push($project->owner);
        }

        return view('tasks.create', compact('projects', 'users', 'selectedProject'));
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

        abort_unless(
            auth()->user()->role === 'admin' ||
            $project->owner_id === auth()->id(),
            403,
            'Only admins and project owners can create tasks.'
        );

        if ($validated['assigned_to']) {
            abort_unless(
                $validated['assigned_to'] == $project->owner_id ||
                $project->users()->where('users.id', $validated['assigned_to'])->exists(),
                403
            );
        }

        Task::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {

        abort_unless(
            auth()->user()->role === 'admin' ||
            $task->project->owner_id === auth()->id() ||
            $task->project->users()->where('users.id', auth()->id())->exists(),
            403
        );

        $task->load(['project', 'assignee']);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {

        abort_unless(
            auth()->user()->role === 'admin' ||
            $task->project->owner_id === auth()->id(),
            403,
            'Only admins and project owners can edit tasks.'
        );

        $user = auth()->user();

        $projects = $user->role === 'admin'
            ? \App\Models\Project::latest()->get()
            : $user->ownedProjects()->latest()->get();

        $project = $task->project;

        $users = $project->users->push($project->owner);

        return view('tasks.edit', compact('task', 'projects', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {

        abort_unless(
            auth()->user()->role === 'admin' ||
            $task->project->owner_id === auth()->id(),
            403,
            'Only admins and project owners can update tasks.'
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
            $project->owner_id === auth()->id() ||
            $project->users()->where('users.id', auth()->id())->exists(),
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

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {

        abort_unless(
            auth()->user()->role === 'admin' ||
            $task->project->owner_id === auth()->id(),
            403,
            'Only admins and project owners can delete tasks.'
        );

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }

}
