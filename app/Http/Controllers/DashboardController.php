<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalProjects = Project::where('owner_id', $user->id)
            ->orWhereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->count();

        $totalTasks = Task::whereHas('project', function ($query) use ($user) {
            $query->where('owner_id', $user->id)
                ->orWhereHas('users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                });
        })->count();

        $inProgressTasks = Task::where('status', 'in_progress')
            ->whereHas('project', function ($query) use ($user) {
                $query->where('owner_id', $user->id)
                    ->orWhereHas('users', function ($query) use ($user) {
                        $query->where('users.id', $user->id);
                    });
            })
            ->count();

        $completedTasks = Task::where('status', 'completed')
            ->whereHas('project', function ($query) use ($user) {
                $query->where('owner_id', $user->id)
                    ->orWhereHas('users', function ($query) use ($user) {
                        $query->where('users.id', $user->id);
                    });
            })
            ->count();

        $recentProjects = Project::where('owner_id', $user->id)
            ->orWhereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->latest()
            ->take(5)
            ->get();

        $recentTasks = Task::whereHas('project', function ($query) use ($user) {
            $query->where('owner_id', $user->id)
                ->orWhereHas('users', function ($query) use ($user) {
                    $query->where('users.id', $user->id);
                });
        })
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProjects',
            'totalTasks',
            'inProgressTasks',
            'completedTasks',
            'recentProjects',
            'recentTasks'
        ));
    }
}
