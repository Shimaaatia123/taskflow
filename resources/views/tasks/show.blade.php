<x-app-layout>

    <div class="taskflow-task-show">

        {{-- Header --}}
        <div class="taskflow-task-show-header">

            <div class="taskflow-task-show-heading">

                <a href="{{ route('tasks.index') }}" class="taskflow-task-back">
                    <i class="bi bi-arrow-left"></i>
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'العودة إلى المهام' : 'Back to Tasks' }}
                    </span>
                </a>

                <div class="taskflow-task-show-title-row">

                    <div class="taskflow-task-show-icon">
                        <i class="bi bi-check2-square"></i>
                    </div>

                    <div>
                        <div class="taskflow-task-show-eyebrow">
                            {{ app()->getLocale() === 'ar' ? 'تفاصيل المهمة' : 'TASK DETAILS' }}
                        </div>

                        <h1>
                            {{ app()->getLocale() === 'ar' ? $task->title_ar : $task->title_en }}
                        </h1>
                    </div>

                </div>

            </div>

            <div class="taskflow-task-show-actions">

                @if (auth()->user()->role === 'admin' || $task->project->owner_id === auth()->id())
                    <a href="{{ route('tasks.edit', $task) }}" class="taskflow-task-action-btn">
                        <i class="bi bi-pencil-square"></i>
                        <span>
                            {{ app()->getLocale() === 'ar' ? 'تعديل' : 'Edit' }}
                        </span>
                    </a>

                    <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                        onsubmit="return confirm(
                  '{{ app()->getLocale() === 'ar'
                      ? 'هل أنتِ متأكدة من حذف هذه المهمة؟'
                      : 'Are you sure you want to delete this task?' }}'
              )">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="taskflow-task-action-btn taskflow-task-delete-btn">
                            <i class="bi bi-trash3"></i>
                            <span>
                                {{ app()->getLocale() === 'ar' ? 'حذف' : 'Delete' }}
                            </span>
                        </button>
                    </form>
                @endif

            </div>

        </div>

        {{-- Quick Stats --}}
        <div class="taskflow-task-stats">

            <div class="taskflow-task-stat-card">
                <div class="taskflow-task-stat-icon blue">
                    <i class="bi bi-kanban"></i>
                </div>

                <div>
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'المشروع' : 'Project' }}
                    </span>

                    <strong>{{ $task->project->name }}</strong>
                </div>
            </div>

            <div class="taskflow-task-stat-card">
                <div class="taskflow-task-stat-icon purple">
                    <i class="bi bi-person"></i>
                </div>

                <div>
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'المكلّف' : 'Assigned To' }}
                    </span>

                    <strong>
                        {{ $task->assignee?->name ?? (app()->getLocale() === 'ar' ? 'غير معيّن' : 'Unassigned') }}
                    </strong>
                </div>
            </div>

            <div class="taskflow-task-stat-card">
                <div class="taskflow-task-stat-icon orange">
                    <i class="bi bi-calendar3"></i>
                </div>

                <div>
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'موعد التسليم' : 'Due Date' }}
                    </span>

                    <strong>
                        {{ $task->due_date
                            ? $task->due_date->format('M d, Y')
                            : (app()->getLocale() === 'ar'
                                ? 'بدون موعد'
                                : 'No due date') }}
                    </strong>
                </div>
            </div>

            <div class="taskflow-task-stat-card">
                <div class="taskflow-task-stat-icon green">
                    <i class="bi bi-clock-history"></i>
                </div>

                <div>
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'تاريخ الإنشاء' : 'Created' }}
                    </span>

                    <strong>{{ $task->created_at->format('M d, Y') }}</strong>
                </div>
            </div>

        </div>

        {{-- Main Content --}}
        <div class="taskflow-task-show-grid">

            {{-- Description --}}
            <div class="taskflow-task-show-panel">

                <div class="taskflow-task-panel-header">
                    <div class="taskflow-task-panel-icon">
                        <i class="bi bi-file-text"></i>
                    </div>

                    <div>
                        <h2>
                            {{ app()->getLocale() === 'ar' ? 'وصف المهمة' : 'Task Description' }}
                        </h2>

                        <p>
                            {{ app()->getLocale() === 'ar' ? 'تفاصيل ومعلومات المهمة.' : 'Details and information about this task.' }}
                        </p>
                    </div>
                </div>

                <div class="taskflow-task-description" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
                    {{ app()->getLocale() === 'ar'
                        ? ($task->description_ar ?:
                            'لا يوجد وصف لهذه المهمة.')
                        : ($task->description_en ?:
                            'No description for this task.') }}
                </div>

            </div>

            {{-- Status & Priority --}}
            <div class="taskflow-task-show-panel">

                <div class="taskflow-task-panel-header">
                    <div class="taskflow-task-panel-icon">
                        <i class="bi bi-sliders"></i>
                    </div>

                    <div>
                        <h2>
                            {{ app()->getLocale() === 'ar' ? 'حالة المهمة' : 'Task Status' }}
                        </h2>

                        <p>
                            {{ app()->getLocale() === 'ar' ? 'الحالة والأولوية الحالية.' : 'Current status and priority.' }}
                        </p>
                    </div>
                </div>

                <div class="taskflow-task-details-list">

                    <div>
                        <span>
                            {{ app()->getLocale() === 'ar' ? 'الحالة' : 'Status' }}
                        </span>

                        <strong class="taskflow-task-status-badge">
                            {{ str_replace('_', ' ', ucfirst($task->status)) }}
                        </strong>
                    </div>

                    <div>
                        <span>
                            {{ app()->getLocale() === 'ar' ? 'الأولوية' : 'Priority' }}
                        </span>

                        <strong class="taskflow-task-priority-badge">
                            {{ ucfirst($task->priority) }}
                        </strong>
                    </div>

                </div>

            </div>

            {{-- Project --}}
            <div class="taskflow-task-show-panel taskflow-task-show-full">

                <div class="taskflow-task-panel-header">

                    <div class="taskflow-task-panel-icon">
                        <i class="bi bi-folder2-open"></i>
                    </div>

                    <div>
                        <h2>
                            {{ app()->getLocale() === 'ar' ? 'المشروع المرتبط' : 'Related Project' }}
                        </h2>

                        <p>
                            {{ app()->getLocale() === 'ar' ? 'المشروع الذي تنتمي إليه هذه المهمة.' : 'The project this task belongs to.' }}
                        </p>
                    </div>

                </div>

                <a href="{{ route('projects.show', $task->project) }}" class="taskflow-task-project-link">

                    <div class="taskflow-task-project-icon">
                        <i class="bi bi-kanban-fill"></i>
                    </div>

                    <div>
                        <strong>{{ $task->project->name }}</strong>

                        <span>
                            {{ app()->getLocale() === 'ar' ? 'عرض تفاصيل المشروع' : 'View project details' }}
                        </span>
                    </div>

                    <i class="bi bi-arrow-right"></i>

                </a>

            </div>

        </div>

    </div>

</x-app-layout>
