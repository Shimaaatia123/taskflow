<x-app-layout>

    <div class="taskflow-project-show">

        {{-- Header --}}
        <div class="taskflow-project-show-header">

            <div class="taskflow-project-show-heading">

                <a href="{{ route('projects.index') }}" class="taskflow-project-back">
                    <i class="bi bi-arrow-left"></i>
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'المشروعات' : 'Projects' }}
                    </span>
                </a>

                <div class="taskflow-project-title-row">

                    <div class="taskflow-project-show-icon">
                        <i class="bi bi-kanban-fill"></i>
                    </div>

                    <div>
                        <div class="taskflow-project-show-eyebrow">
                            {{ app()->getLocale() === 'ar' ? 'تفاصيل المشروع' : 'PROJECT DETAILS' }}
                        </div>

                        <h1>{{ $project->name }}</h1>

                        <p>
                            {{ app()->getLocale() === 'ar'
                                ? 'نظرة عامة على المشروع ومتابعة سير العمل.'
                                : 'Project overview and work progress at a glance.' }}
                        </p>
                    </div>

                </div>

            </div>


            <div class="taskflow-project-show-actions">

                <span class="taskflow-project-show-status">
                    <span></span>
                    {{ app()->getLocale() === 'ar' ? 'نشط' : 'Active' }}
                </span>

                {{-- Edit + Delete --}}
                @if (auth()->user()->role === 'admin' || $project->owner_id === auth()->id())
                    <a href="{{ route('projects.edit', $project) }}" class="taskflow-project-action-btn">
                        <i class="bi bi-pencil-square"></i>
                        <span>
                            {{ app()->getLocale() === 'ar' ? 'تعديل' : 'Edit' }}
                        </span>
                    </a>

                    <form method="POST" action="{{ route('projects.destroy', $project) }}"
                        onsubmit="return confirm(
                            '{{ app()->getLocale() === 'ar'
                                ? 'هل أنتِ متأكدة من حذف هذا المشروع؟'
                                : 'Are you sure you want to delete this project?' }}'
                        )">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="taskflow-project-action-btn taskflow-project-delete-btn">

                            <i class="bi bi-trash3"></i>

                            <span>
                                {{ app()->getLocale() === 'ar' ? 'حذف' : 'Delete' }}
                            </span>

                        </button>
                    </form>
                @endif

            </div>

        </div>


        {{-- Overview Stats --}}
        <div class="taskflow-project-stats">

            <div class="taskflow-project-stat">

                <div class="taskflow-project-stat-icon blue">
                    <i class="bi bi-list-check"></i>
                </div>

                <div>
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'إجمالي المهام' : 'Total Tasks' }}
                    </span>

                    <strong>
                        {{ $project->tasks->count() }}
                    </strong>
                </div>

            </div>


            <div class="taskflow-project-stat">

                <div class="taskflow-project-stat-icon orange">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <div>
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'قيد التنفيذ' : 'In Progress' }}
                    </span>

                    <strong>
                        {{ $project->tasks->where('status', 'in_progress')->count() }}
                    </strong>
                </div>

            </div>


            <div class="taskflow-project-stat">

                <div class="taskflow-project-stat-icon green">
                    <i class="bi bi-check2-circle"></i>
                </div>

                <div>
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'مكتملة' : 'Completed' }}
                    </span>

                    <strong>
                        {{ $project->tasks->where('status', 'completed')->count() }}
                    </strong>
                </div>

            </div>


            <div class="taskflow-project-stat">

                <div class="taskflow-project-stat-icon purple">
                    <i class="bi bi-people"></i>
                </div>

                <div>
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'أعضاء المشروع' : 'Members' }}
                    </span>

                    <strong>
                        {{ $project->users->count() + 1 }}
                    </strong>
                </div>

            </div>

        </div>


        {{-- Main Content --}}
        <div class="taskflow-project-show-grid">


            {{-- Project Information --}}
            <section class="taskflow-project-panel">

                <div class="taskflow-project-panel-header">

                    <div class="taskflow-project-panel-title">

                        <div class="taskflow-project-panel-icon">
                            <i class="bi bi-folder2-open"></i>
                        </div>

                        <div>

                            <h2>
                                {{ app()->getLocale() === 'ar' ? 'معلومات المشروع' : 'Project Information' }}
                            </h2>

                            <p>
                                {{ app()->getLocale() === 'ar' ? 'البيانات الأساسية للمشروع.' : 'Basic project information.' }}
                            </p>

                        </div>

                    </div>

                </div>


                <div class="taskflow-project-info">

                    <div class="taskflow-project-info-item">

                        <span>
                            <i class="bi bi-folder"></i>
                            {{ app()->getLocale() === 'ar' ? 'اسم المشروع' : 'Project Name' }}
                        </span>

                        <strong>
                            {{ $project->name }}
                        </strong>

                    </div>


                    <div class="taskflow-project-info-item">

                        <span>
                            <i class="bi bi-calendar3"></i>
                            {{ app()->getLocale() === 'ar' ? 'تاريخ الإنشاء' : 'Created At' }}
                        </span>

                        <strong>
                            {{ $project->created_at->format('M d, Y') }}
                        </strong>

                    </div>


                    <div class="taskflow-project-info-item">

                        <span>
                            <i class="bi bi-circle-fill"></i>
                            {{ app()->getLocale() === 'ar' ? 'الحالة' : 'Status' }}
                        </span>

                        <strong class="text-success">
                            {{ app()->getLocale() === 'ar' ? 'نشط' : 'Active' }}
                        </strong>

                    </div>

                </div>

            </section>


            {{-- Description --}}
            <section class="taskflow-project-panel">

                <div class="taskflow-project-panel-header">

                    <div class="taskflow-project-panel-title">

                        <div class="taskflow-project-panel-icon">
                            <i class="bi bi-file-text"></i>
                        </div>

                        <div>

                            <h2>
                                {{ app()->getLocale() === 'ar' ? 'وصف المشروع' : 'Project Description' }}
                            </h2>

                            <p>
                                {{ app()->getLocale() === 'ar' ? 'نبذة عن المشروع.' : 'Project overview.' }}
                            </p>

                        </div>

                    </div>

                </div>


                <div class="taskflow-project-description">

                    @if (app()->getLocale() === 'ar')
                        <p dir="rtl">
                            {{ $project->description_ar ?: 'لا يوجد وصف باللغة العربية.' }}
                        </p>
                    @else
                        <p dir="ltr">
                            {{ $project->description_en ?: 'No English description available.' }}
                        </p>
                    @endif

                </div>

            </section>


            {{-- Tasks --}}
            <section class="taskflow-project-panel taskflow-project-full">

                <div class="taskflow-project-panel-header">

                    <div class="taskflow-project-panel-title">

                        <div class="taskflow-project-panel-icon">
                            <i class="bi bi-list-check"></i>
                        </div>

                        <div>

                            <h2>
                                {{ app()->getLocale() === 'ar' ? 'مهام المشروع' : 'Project Tasks' }}
                            </h2>

                            <p>
                                {{ app()->getLocale() === 'ar' ? 'تابعي المهام وحالة التنفيذ.' : 'Track tasks and work progress.' }}
                            </p>

                        </div>

                    </div>


                    {{-- New Task --}}
                    @if (auth()->user()->role === 'admin' || $project->owner_id === auth()->id())
                        <a href="{{ route('tasks.create') }}?project_id={{ $project->id }}"
                            class="taskflow-project-outline-btn">

                            <i class="bi bi-plus-lg"></i>

                            {{ app()->getLocale() === 'ar' ? 'مهمة جديدة' : 'New Task' }}

                        </a>
                    @endif

                </div>


                <div class="taskflow-project-empty">

                    <div class="taskflow-project-empty-icon">
                        <i class="bi bi-check2-square"></i>
                    </div>

                    <h3>
                        {{ app()->getLocale() === 'ar' ? 'لا توجد مهام بعد' : 'No tasks yet' }}
                    </h3>

                    <p>
                        {{ app()->getLocale() === 'ar'
                            ? 'ابدئي بإضافة أول مهمة لهذا المشروع.'
                            : 'Start by adding the first task to this project.' }}
                    </p>

                </div>

            </section>


            {{-- Members --}}
            <section class="taskflow-project-panel taskflow-project-full">

                <div class="taskflow-project-panel-header">

                    <div class="taskflow-project-panel-title">

                        <div class="taskflow-project-panel-icon">
                            <i class="bi bi-people"></i>
                        </div>

                        <div>

                            <h2>
                                {{ app()->getLocale() === 'ar' ? 'أعضاء المشروع' : 'Project Members' }}
                            </h2>

                            <p>
                                {{ app()->getLocale() === 'ar' ? 'الأشخاص المشاركون في المشروع.' : 'People working on this project.' }}
                            </p>

                        </div>

                    </div>


                    {{-- Add Member --}}
                    @if (auth()->user()->role === 'admin' || $project->owner_id === auth()->id())

                        <form method="POST" action="{{ route('projects.members.add', $project) }}"
                            class="taskflow-project-member-form">

                            @csrf

                            <select name="user_id" required>

                                <option value="">
                                    {{ app()->getLocale() === 'ar' ? 'اختاري عضوًا' : 'Select a member' }}
                                </option>

                                @foreach ($users as $user)
                                    @if ($user->id !== $project->owner_id)
                                        <option value="{{ $user->id }}">
                                            {{ $user->name }}
                                        </option>
                                    @endif
                                @endforeach

                            </select>


                            <button type="submit" class="taskflow-project-outline-btn">

                                <i class="bi bi-person-plus"></i>

                                {{ app()->getLocale() === 'ar' ? 'إضافة عضو' : 'Add Member' }}

                            </button>

                        </form>

                    @endif

                </div>


                <div class="taskflow-project-members">


                    {{-- Project Owner --}}
                    <div class="taskflow-project-member">

                        <div class="taskflow-project-member-avatar">
                            {{ strtoupper(substr($project->owner->name, 0, 1)) }}
                        </div>

                        <div>

                            <strong>
                                {{ $project->owner->name }}
                            </strong>

                            <span>
                                {{ app()->getLocale() === 'ar' ? 'مالك المشروع' : 'Project Owner' }}
                            </span>

                        </div>

                    </div>


                    {{-- Project Members --}}
                    @foreach ($project->users as $user)
                        <div class="taskflow-project-member">

                            <div class="taskflow-project-member-avatar">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>

                            <div>

                                <strong>
                                    {{ $user->name }}
                                </strong>

                                <span>
                                    {{ app()->getLocale() === 'ar' ? 'عضو بالمشروع' : 'Project Member' }}
                                </span>

                            </div>


                            {{-- Remove Member --}}
                            @if (auth()->user()->role === 'admin' || $project->owner_id === auth()->id())
                                <form method="POST" action="{{ route('projects.members.remove', [$project, $user]) }}"
                                    onsubmit="return confirm(
                                        '{{ app()->getLocale() === 'ar'
                                            ? 'هل أنتِ متأكدة من إزالة هذا العضو؟'
                                            : 'Are you sure you want to remove this member?' }}'
                                    )">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="taskflow-project-member-remove"
                                        title="{{ app()->getLocale() === 'ar' ? 'إزالة العضو' : 'Remove member' }}">

                                        <i class="bi bi-person-dash"></i>

                                    </button>

                                </form>
                            @endif

                        </div>
                    @endforeach

                </div>

            </section>

        </div>

    </div>

</x-app-layout>
