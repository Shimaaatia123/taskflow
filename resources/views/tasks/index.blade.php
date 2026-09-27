<x-app-layout>

    @php
        $locale = app()->getLocale();
        $isArabic = $locale === 'ar';

        $totalTasks = $tasks->count();

        $completedCount = $tasks->where('status', 'completed')->count();
        $inProgressCount = $tasks->where('status', 'in_progress')->count();
        $highPriorityCount = $tasks->where('priority', 'high')->count();

        $canCreateTasks =
            auth()->user()->role === 'admin' ||
            $tasks->contains(function ($task) {
                return $task->project?->owner_id === auth()->id();
            });
    @endphp


    <div class="taskflow-tasks-page">



        {{-- ================= ALERT ================= --}}

        @if (session('success'))
            <div class="taskflow-alert taskflow-alert-success">

                <i class="bi bi-check-circle-fill"></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>
        @endif


        @if (session('error'))
            <div class="taskflow-alert taskflow-alert-error">

                <i class="bi bi-exclamation-triangle-fill"></i>

                <span>
                    {{ session('error') }}
                </span>

            </div>
        @endif

        {{-- ================= HEADER ================= --}}
        <section class="taskflow-tasks-hero">

            <div class="taskflow-tasks-hero-glow taskflow-tasks-glow-one"></div>
            <div class="taskflow-tasks-hero-glow taskflow-tasks-glow-two"></div>

            <div class="taskflow-tasks-hero-content">

                <div>

                    <span class="taskflow-tasks-eyebrow">
                        <i class="bi bi-check2-square"></i>

                        {{ $isArabic ? 'إدارة المهام' : 'TASK MANAGEMENT' }}
                    </span>

                    <h1>
                        {{ $isArabic ? 'كل مهامك في مكان واحد.' : 'All your tasks. One powerful workspace.' }}
                    </h1>

                    <p>
                        {{ $isArabic
                            ? 'تابعي التقدم، الأولوية، مواعيد التسليم، والمسؤول عن كل مهمة بسهولة.'
                            : 'Track progress, priorities, deadlines and assignees from one powerful workspace.' }}
                    </p>

                </div>


                @if ($canCreateTasks)
                    <a href="{{ route('tasks.create') }}" class="taskflow-tasks-create-btn">

                        <i class="bi bi-plus-lg"></i>

                        <span>
                            {{ $isArabic ? 'مهمة جديدة' : 'New Task' }}
                        </span>

                    </a>
                @endif

            </div>

        </section>



        {{-- ================= STATS ================= --}}
        <section class="taskflow-task-stats-grid">

            <div class="taskflow-task-stat-card">

                <div class="taskflow-task-stat-icon taskflow-stat-blue">
                    <i class="bi bi-layers-fill"></i>
                </div>

                <div class="taskflow-task-stat-info">

                    <span>
                        {{ $isArabic ? 'إجمالي المهام' : 'Total Tasks' }}
                    </span>

                    <strong>
                        {{ $totalTasks }}
                    </strong>

                </div>

            </div>


            <div class="taskflow-task-stat-card">

                <div class="taskflow-task-stat-icon taskflow-stat-purple">
                    <i class="bi bi-arrow-repeat"></i>
                </div>

                <div class="taskflow-task-stat-info">

                    <span>
                        {{ $isArabic ? 'قيد التنفيذ' : 'In Progress' }}
                    </span>

                    <strong>
                        {{ $inProgressCount }}
                    </strong>

                </div>

            </div>


            <div class="taskflow-task-stat-card">

                <div class="taskflow-task-stat-icon taskflow-stat-green">
                    <i class="bi bi-check-circle-fill"></i>
                </div>

                <div class="taskflow-task-stat-info">

                    <span>
                        {{ $isArabic ? 'مكتملة' : 'Completed' }}
                    </span>

                    <strong>
                        {{ $completedCount }}
                    </strong>

                </div>

            </div>


            <div class="taskflow-task-stat-card">

                <div class="taskflow-task-stat-icon taskflow-stat-orange">
                    <i class="bi bi-fire"></i>
                </div>

                <div class="taskflow-task-stat-info">

                    <span>
                        {{ $isArabic ? 'أولوية عالية' : 'High Priority' }}
                    </span>

                    <strong>
                        {{ $highPriorityCount }}
                    </strong>

                </div>

            </div>

        </section>


        {{-- ================= TOOLBAR ================= --}}
        @if ($totalTasks)
            <section class="taskflow-tasks-toolbar">

                <div class="taskflow-tasks-search">

                    <i class="bi bi-search"></i>

                    <input type="search" id="taskSearch"
                        placeholder="{{ $isArabic ? 'ابحثي عن مهمة أو مشروع...' : 'Search tasks or projects...' }}">

                </div>


                <div class="taskflow-tasks-filters">

                    <button type="button" class="taskflow-filter-btn active" data-filter="all">

                        {{ $isArabic ? 'الكل' : 'All' }}

                    </button>


                    <button type="button" class="taskflow-filter-btn" data-filter="todo">

                        {{ $isArabic ? 'قيد الانتظار' : 'To Do' }}

                    </button>


                    <button type="button" class="taskflow-filter-btn" data-filter="in_progress">

                        {{ $isArabic ? 'قيد التنفيذ' : 'In Progress' }}

                    </button>


                    <button type="button" class="taskflow-filter-btn" data-filter="completed">

                        {{ $isArabic ? 'مكتملة' : 'Completed' }}

                    </button>

                </div>

            </section>
        @endif


        {{-- ================= TASKS ================= --}}
        @if ($totalTasks)

            <section class="taskflow-tasks-grid" id="tasksGrid">

                @foreach ($tasks as $task)
                    @php

                        $isTaskOwner = $task->project?->owner_id === auth()->id();

                        $canManageTask = auth()->user()->role === 'admin' || $isTaskOwner;

                        $title = $isArabic
                            ? ($task->title_ar ?:
                            $task->title_en)
                            : ($task->title_en ?:
                            $task->title_ar);

                        $description = $isArabic
                            ? ($task->description_ar ?:
                            $task->description_en)
                            : ($task->description_en ?:
                            $task->description_ar);

                        $statusLabel = match ($task->status) {
                            'todo' => $isArabic ? 'قيد الانتظار' : 'To Do',
                            'in_progress' => $isArabic ? 'قيد التنفيذ' : 'In Progress',
                            'completed' => $isArabic ? 'مكتملة' : 'Completed',
                            default => $task->status,
                        };

                        $priorityLabel = match ($task->priority) {
                            'low' => $isArabic ? 'منخفضة' : 'Low',
                            'medium' => $isArabic ? 'متوسطة' : 'Medium',
                            'high' => $isArabic ? 'عالية' : 'High',
                            default => $task->priority,
                        };

                        $dueLabel = $task->due_date
                            ? $task->due_date->format('M d, Y')
                            : ($isArabic
                                ? 'بدون موعد'
                                : 'No due date');

                    @endphp


                    <article class="taskflow-task-card" data-status="{{ $task->status }}"
                        data-priority="{{ $task->priority }}"
                        data-search="{{ strtolower(
                            $title .
                                ' ' .
                                ($task->project?->name ?? '') .
                                ' ' .
                                ($task->description_ar ?? '') .
                                ' ' .
                                ($task->description_en ?? '') .
                                ' ' .
                                $statusLabel .
                                ' ' .
                                $priorityLabel,
                        ) }}">

                        {{-- TOP --}}
                        <div class="taskflow-task-card-top">

                            <div class="taskflow-task-card-category">

                                <div class="taskflow-task-icon">

                                    <i class="bi bi-check2-square"></i>

                                </div>

                                <span>
                                    {{ $task->project?->name }}
                                </span>

                            </div>


                            <span class="taskflow-task-priority taskflow-priority-{{ $task->priority }}">

                                <i class="bi bi-flag-fill"></i>

                                {{ $priorityLabel }}

                            </span>

                        </div>


                        {{-- TITLE --}}
                        <div class="taskflow-task-card-content">

                            <h2>
                                {{ $title }}
                            </h2>

                            <p>
                                {{ $description ?: ($isArabic ? 'لا يوجد وصف لهذه المهمة.' : 'No task description.') }}
                            </p>

                        </div>


                        {{-- META --}}
                        <div class="taskflow-task-meta">

                            <div class="taskflow-task-meta-item">

                                <i class="bi bi-calendar3"></i>

                                <div>

                                    <span>
                                        {{ $isArabic ? 'موعد التسليم' : 'Due date' }}
                                    </span>

                                    <strong>
                                        {{ $dueLabel }}
                                    </strong>

                                </div>

                            </div>


                            <div class="taskflow-task-meta-item">

                                <i class="bi bi-person-circle"></i>

                                <div>

                                    <span>
                                        {{ $isArabic ? 'المكلّف' : 'Assigned to' }}
                                    </span>

                                    <strong>
                                        {{ $task->assignee?->name ?? ($isArabic ? 'غير معيّن' : 'Unassigned') }}
                                    </strong>

                                </div>

                            </div>

                        </div>


                        {{-- FOOTER --}}
                        <div class="taskflow-task-card-footer">

                            <span class="taskflow-task-status taskflow-status-{{ $task->status }}">

                                <span></span>

                                {{ $statusLabel }}

                            </span>


                            <div class="taskflow-task-card-actions">

                                <a href="{{ route('tasks.show', $task) }}" class="taskflow-task-view-btn">

                                    <span>
                                        {{ $isArabic ? 'عرض' : 'View' }}
                                    </span>

                                    <i class="bi bi-arrow-{{ $isArabic ? 'left' : 'right' }}"></i>

                                </a>


                                @if ($canManageTask)
                                    <a href="{{ route('tasks.edit', $task) }}" class="taskflow-task-icon-btn"
                                        title="{{ $isArabic ? 'تعديل' : 'Edit' }}">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>


                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                                        onsubmit="return confirm(
                                              '{{ $isArabic ? 'هل أنتِ متأكدة من حذف هذه المهمة؟' : 'Are you sure you want to delete this task?' }}'
                                          )">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="taskflow-task-icon-btn taskflow-task-delete-btn"
                                            title="{{ $isArabic ? 'حذف' : 'Delete' }}">

                                            <i class="bi bi-trash3"></i>

                                        </button>

                                    </form>
                                @endif

                            </div>

                        </div>

                    </article>
                @endforeach


                {{-- NO FILTER RESULTS --}}
                <div class="taskflow-no-filter-results" id="noFilterResults">

                    <div class="taskflow-no-filter-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <strong>
                        {{ $isArabic ? 'لا توجد نتائج' : 'No matching tasks' }}
                    </strong>

                    <p>
                        {{ $isArabic ? 'جربي تغيير كلمة البحث أو الفلتر.' : 'Try another search term or filter.' }}
                    </p>

                </div>

            </section>
        @else
            {{-- ================= EMPTY STATE ================= --}}
            <section class="taskflow-tasks-empty">

                <div class="taskflow-tasks-empty-glow"></div>

                <div class="taskflow-tasks-empty-icon">
                    <i class="bi bi-check2-square"></i>
                </div>

                <span class="taskflow-tasks-empty-kicker">
                    {{ $isArabic ? 'مساحة عمل جديدة' : 'Fresh workspace' }}
                </span>

                <h2>
                    {{ $isArabic ? 'جاهزة لإنجاز أول مهمة؟' : 'Ready for your first task?' }}
                </h2>

                <p>
                    {{ $isArabic
                        ? 'ابدئي بمهمة جديدة وحوّلي خطتك إلى إنجازات واضحة يمكن متابعتها.'
                        : 'Create a new task and turn your plan into clear, trackable progress.' }}
                </p>


                @if ($canCreateTasks)
                    <a href="{{ route('tasks.create') }}" class="taskflow-tasks-empty-btn">

                        <i class="bi bi-plus-lg"></i>

                        {{ $isArabic ? 'إنشاء أول مهمة' : 'Create First Task' }}

                    </a>
                @endif

            </section>

        @endif

    </div>


    <style>
        .taskflow-tasks-page {
            padding: 28px;
            position: relative;
        }


        /* HERO */

        .taskflow-tasks-hero {
            position: relative;
            overflow: hidden;
            margin-bottom: 22px;
            padding: 32px;
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, .15);
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, .20), transparent 28%),
                radial-gradient(circle at bottom left, rgba(168, 85, 247, .16), transparent 28%),
                linear-gradient(135deg, #0f172a 0%, #111c35 50%, #101827 100%);
            box-shadow: 0 28px 70px rgba(15, 23, 42, .20);
        }


        .taskflow-tasks-hero-glow {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(8px);
            opacity: .35;
        }


        .taskflow-tasks-glow-one {
            width: 190px;
            height: 190px;
            top: -100px;
            right: 12%;
            background: rgba(34, 211, 238, .22);
        }


        .taskflow-tasks-glow-two {
            width: 160px;
            height: 160px;
            bottom: -100px;
            left: 10%;
            background: rgba(139, 92, 246, .20);
        }


        .taskflow-tasks-hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 24px;
        }


        .taskflow-tasks-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
            padding: 7px 12px;
            border: 1px solid rgba(125, 211, 252, .20);
            border-radius: 999px;
            background: rgba(14, 165, 233, .08);
            color: #7dd3fc;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .08em;
        }


        .taskflow-tasks-hero h1 {
            max-width: 780px;
            margin: 0;
            color: #f8fafc;
            font-size: clamp(28px, 4vw, 44px);
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -.04em;
        }


        .taskflow-tasks-hero p {
            max-width: 700px;
            margin: 14px 0 0;
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.8;
        }


        .taskflow-tasks-create-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            padding: 0 18px;
            border-radius: 14px;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            border: 1px solid rgba(96, 165, 250, .35);
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
            box-shadow: 0 15px 30px rgba(37, 99, 235, .22);
            transition: .25s ease;
            flex-shrink: 0;
        }


        .taskflow-tasks-create-btn:hover {
            transform: translateY(-2px);
            color: #fff;
        }


        /* STATS */

        .taskflow-task-stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }


        .taskflow-task-stat-card {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 18px;
            border-radius: 20px;
            border: 1px solid rgba(148, 163, 184, .15);
            background: rgba(255, 255, 255, .78);
            box-shadow: 0 14px 38px rgba(15, 23, 42, .07);
            backdrop-filter: blur(16px);
        }


        .taskflow-task-stat-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 14px;
            font-size: 18px;
            flex-shrink: 0;
        }


        .taskflow-stat-blue {
            background: rgba(59, 130, 246, .11);
            color: #2563eb;
        }


        .taskflow-stat-purple {
            background: rgba(139, 92, 246, .11);
            color: #7c3aed;
        }


        .taskflow-stat-green {
            background: rgba(34, 197, 94, .11);
            color: #16a34a;
        }


        .taskflow-stat-orange {
            background: rgba(245, 158, 11, .12);
            color: #d97706;
        }


        .taskflow-task-stat-info span {
            display: block;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
        }


        .taskflow-task-stat-info strong {
            display: block;
            margin-top: 4px;
            color: #0f172a;
            font-size: 24px;
            font-weight: 800;
            line-height: 1;
        }


        /* TOOLBAR */

        .taskflow-tasks-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 20px;
            padding: 14px;
            border: 1px solid rgba(148, 163, 184, .14);
            border-radius: 18px;
            background: rgba(255, 255, 255, .72);
            box-shadow: 0 10px 26px rgba(15, 23, 42, .05);
        }


        .taskflow-tasks-search {
            position: relative;
            flex: 1;
            max-width: 420px;
        }


        .taskflow-tasks-search i {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }


        html[dir="rtl"] .taskflow-tasks-search i {
            left: auto;
            right: 14px;
        }


        .taskflow-tasks-search input {
            width: 100%;
            height: 44px;
            padding: 0 14px 0 40px;
            border: 1px solid #e2e8f0;
            border-radius: 13px;
            outline: none;
            background: #f8fafc;
            color: #0f172a;
            font-size: 12px;
        }


        html[dir="rtl"] .taskflow-tasks-search input {
            padding: 0 40px 0 14px;
        }


        .taskflow-tasks-search input:focus {
            border-color: rgba(59, 130, 246, .35);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .07);
        }


        .taskflow-tasks-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }


        .taskflow-filter-btn {
            min-height: 38px;
            padding: 0 13px;
            border: 1px solid #e2e8f0;
            border-radius: 11px;
            background: #fff;
            color: #64748b;
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }


        .taskflow-filter-btn:hover,
        .taskflow-filter-btn.active {
            border-color: rgba(59, 130, 246, .18);
            background: #eff6ff;
            color: #2563eb;
        }


        /* GRID */

        .taskflow-tasks-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }


        .taskflow-task-card {
            display: flex;
            flex-direction: column;
            min-width: 0;
            padding: 20px;
            border: 1px solid rgba(148, 163, 184, .15);
            border-radius: 22px;
            background: rgba(255, 255, 255, .82);
            box-shadow: 0 17px 45px rgba(15, 23, 42, .07);
            transition: .25s ease;
        }


        .taskflow-task-card:hover {
            transform: translateY(-4px);
            border-color: rgba(59, 130, 246, .18);
            box-shadow: 0 24px 55px rgba(15, 23, 42, .11);
        }


        .taskflow-task-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }


        .taskflow-task-card-category {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 0;
        }


        .taskflow-task-card-category>span {
            overflow: hidden;
            color: #64748b;
            font-size: 10px;
            font-weight: 800;
            text-overflow: ellipsis;
            white-space: nowrap;
        }


        .taskflow-task-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 13px;
            background: linear-gradient(135deg, rgba(59, 130, 246, .13), rgba(139, 92, 246, .11));
            color: #2563eb;
            flex-shrink: 0;
        }


        .taskflow-task-priority {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 9px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: 800;
            white-space: nowrap;
        }


        .taskflow-priority-low {
            background: rgba(148, 163, 184, .14);
            color: #475569;
        }


        .taskflow-priority-medium {
            background: rgba(59, 130, 246, .10);
            color: #2563eb;
        }


        .taskflow-priority-high {
            background: rgba(239, 68, 68, .10);
            color: #dc2626;
        }


        .taskflow-task-card-content {
            margin-top: 18px;
        }


        .taskflow-task-card-content h2 {
            margin: 0;
            color: #0f172a;
            font-size: 17px;
            font-weight: 800;
            line-height: 1.35;
        }


        .taskflow-task-card-content p {
            display: -webkit-box;
            margin: 8px 0 0;
            overflow: hidden;
            color: #64748b;
            font-size: 11px;
            line-height: 1.7;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }


        /* META */

        .taskflow-task-meta {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin-top: 18px;
            padding: 12px;
            border-radius: 15px;
            background: #f8fafc;
            border: 1px solid #edf2f7;
        }


        .taskflow-task-meta-item {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            min-width: 0;
        }


        .taskflow-task-meta-item>i {
            margin-top: 2px;
            color: #64748b;
            font-size: 12px;
        }


        .taskflow-task-meta-item span {
            display: block;
            color: #94a3b8;
            font-size: 8px;
            font-weight: 700;
        }


        .taskflow-task-meta-item strong {
            display: block;
            margin-top: 3px;
            overflow: hidden;
            color: #334155;
            font-size: 10px;
            font-weight: 800;
            text-overflow: ellipsis;
            white-space: nowrap;
        }


        /* FOOTER */

        .taskflow-task-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 18px;
        }


        .taskflow-task-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: 800;
            white-space: nowrap;
        }


        .taskflow-task-status>span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }


        .taskflow-status-todo {
            background: rgba(148, 163, 184, .12);
            color: #475569;
        }


        .taskflow-status-todo>span {
            background: #94a3b8;
        }


        .taskflow-status-in_progress {
            background: rgba(245, 158, 11, .11);
            color: #b45309;
        }


        .taskflow-status-in_progress>span {
            background: #f59e0b;
        }


        .taskflow-status-completed {
            background: rgba(34, 197, 94, .11);
            color: #15803d;
        }


        .taskflow-status-completed>span {
            background: #22c55e;
        }


        .taskflow-task-card-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }


        .taskflow-task-view-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            min-height: 34px;
            padding: 0 10px;
            border: 1px solid rgba(59, 130, 246, .14);
            border-radius: 10px;
            background: #eff6ff;
            color: #2563eb;
            text-decoration: none;
            font-size: 10px;
            font-weight: 800;
            transition: .2s ease;
        }


        .taskflow-task-view-btn:hover {
            background: #dbeafe;
            color: #1d4ed8;
        }


        .taskflow-task-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: #64748b;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }


        .taskflow-task-icon-btn:hover {
            border-color: rgba(59, 130, 246, .22);
            background: #eff6ff;
            color: #2563eb;
        }


        .taskflow-task-delete-btn:hover {
            border-color: rgba(239, 68, 68, .18);
            background: rgba(239, 68, 68, .06);
            color: #dc2626;
        }


        /* FILTER EMPTY */

        .taskflow-no-filter-results {
            display: none;
            grid-column: 1 / -1;
            padding: 45px 20px;
            text-align: center;
        }


        .taskflow-no-filter-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            margin-bottom: 12px;
            border-radius: 17px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 21px;
        }


        .taskflow-no-filter-results strong {
            display: block;
            color: #0f172a;
            font-size: 14px;
            font-weight: 800;
        }


        .taskflow-no-filter-results p {
            margin: 6px 0 0;
            color: #94a3b8;
            font-size: 11px;
        }


        /* EMPTY */

        .taskflow-tasks-empty {
            position: relative;
            overflow: hidden;
            padding: 70px 25px;
            border: 1px solid rgba(148, 163, 184, .15);
            border-radius: 28px;
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, .08), transparent 28%),
                linear-gradient(145deg, #ffffff, #f8fafc);
            text-align: center;
            box-shadow: 0 20px 50px rgba(15, 23, 42, .07);
        }


        .taskflow-tasks-empty-glow {
            position: absolute;
            width: 220px;
            height: 220px;
            top: -110px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 50%;
            background: rgba(59, 130, 246, .08);
            filter: blur(10px);
        }


        .taskflow-tasks-empty-icon {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 72px;
            height: 72px;
            margin-bottom: 16px;
            border-radius: 22px;
            background: linear-gradient(135deg, #eff6ff, #f5f3ff);
            color: #2563eb;
            font-size: 28px;
            box-shadow: 0 14px 30px rgba(59, 130, 246, .09);
        }


        .taskflow-tasks-empty-kicker {
            position: relative;
            display: block;
            margin-bottom: 8px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .1em;
            text-transform: uppercase;
        }


        .taskflow-tasks-empty h2 {
            position: relative;
            margin: 0;
            color: #0f172a;
            font-size: 25px;
            font-weight: 800;
        }


        .taskflow-tasks-empty p {
            position: relative;
            max-width: 520px;
            margin: 10px auto 22px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.8;
        }


        .taskflow-tasks-empty-btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 44px;
            padding: 0 17px;
            border-radius: 13px;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: #fff;
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            box-shadow: 0 12px 28px rgba(37, 99, 235, .20);
        }


        .taskflow-tasks-empty-btn:hover {
            color: #fff;
        }


        /* RESPONSIVE */

        @media (max-width: 1100px) {

            .taskflow-tasks-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .taskflow-task-stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 760px) {

            .taskflow-tasks-page {
                padding: 18px;
            }


            .taskflow-tasks-hero {
                padding: 24px;
                border-radius: 22px;
            }


            .taskflow-tasks-hero-content {
                align-items: flex-start;
                flex-direction: column;
            }


            .taskflow-tasks-create-btn {
                width: 100%;
            }


            .taskflow-tasks-toolbar {
                align-items: stretch;
                flex-direction: column;
            }


            .taskflow-tasks-search {
                max-width: none;
            }


            .taskflow-tasks-filters {
                overflow-x: auto;
                flex-wrap: nowrap;
                padding-bottom: 2px;
            }


            .taskflow-filter-btn {
                flex-shrink: 0;
            }


            .taskflow-tasks-grid {
                grid-template-columns: 1fr;
            }

        }


        @media (max-width: 520px) {

            .taskflow-task-stats-grid {
                grid-template-columns: 1fr;
            }


            .taskflow-task-meta {
                grid-template-columns: 1fr;
            }


            .taskflow-task-card {
                padding: 17px;
            }

        }

        /* ALERT */

        .taskflow-alert {
            display: flex;
            align-items: center;
            gap: 10px;
            width: fit-content;
            max-width: min(520px, calc(100% - 32px));
            margin: 0 auto 20px;
            padding: 12px 16px;
            border: 1px solid #b7e4c7;
            border-radius: 12px;
            background: #f0fdf4;
            color: #166534;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .08);
            font-size: 14px;
            font-weight: 600;
            overflow: hidden;
            animation: taskflow-alert-hide 6s ease forwards;
        }

        .taskflow-alert i {
            flex-shrink: 0;
            font-size: 18px;
        }

        .taskflow-alert-success {
            border-color: #b7e4c7;
            background: #f0fdf4;
            color: #166534;
        }

        .taskflow-alert-error {
            border-color: rgba(239, 68, 68, .25);
            background: rgba(239, 68, 68, .08);
            color: #b91c1c;
        }

        @keyframes taskflow-alert-hide {

            0% {
                opacity: 1;
                transform: translateY(0);
                max-height: 80px;
                margin-top: 0;
                margin-bottom: 20px;
                padding-top: 12px;
                padding-bottom: 12px;
            }

            55% {
                opacity: 1;
                transform: translateY(0);
                max-height: 80px;
                margin-bottom: 20px;
                padding-top: 12px;
                padding-bottom: 12px;
            }

            72% {
                opacity: .75;
                transform: translateY(-3px);
                max-height: 60px;
                margin-bottom: 14px;
                padding-top: 9px;
                padding-bottom: 9px;
            }

            86% {
                opacity: .35;
                transform: translateY(-7px);
                max-height: 30px;
                margin-bottom: 7px;
                padding-top: 4px;
                padding-bottom: 4px;
            }

            100% {
                opacity: 0;
                transform: translateY(-10px);
                max-height: 0;
                margin-top: 0;
                margin-bottom: 0;
                padding-top: 0;
                padding-bottom: 0;
                border-width: 0;
            }
        }
    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const searchInput = document.getElementById('taskSearch');
            const filterButtons = document.querySelectorAll('.taskflow-filter-btn');
            const taskCards = document.querySelectorAll('.taskflow-task-card');
            const noResults = document.getElementById('noFilterResults');

            let activeFilter = 'all';


            function applyFilters() {

                const searchValue = searchInput ?
                    searchInput.value.trim().toLowerCase() :
                    '';

                let visibleCount = 0;


                taskCards.forEach(function(card) {

                    const status = card.dataset.status;
                    const searchText = card.dataset.search || '';

                    const matchesFilter =
                        activeFilter === 'all' ||
                        status === activeFilter;

                    const matchesSearch = !searchValue ||
                        searchText.includes(searchValue);


                    const visible =
                        matchesFilter &&
                        matchesSearch;


                    card.style.display = visible ?
                        '' :
                        'none';


                    if (visible) {
                        visibleCount++;
                    }

                });


                if (noResults) {

                    noResults.style.display =
                        visibleCount === 0 ?
                        'block' :
                        'none';

                }

            }


            if (searchInput) {

                searchInput.addEventListener(
                    'input',
                    applyFilters
                );

            }


            filterButtons.forEach(function(button) {

                button.addEventListener('click', function() {

                    filterButtons.forEach(function(item) {
                        item.classList.remove('active');
                    });


                    this.classList.add('active');

                    activeFilter =
                        this.dataset.filter;


                    applyFilters();

                });

            });


        });
    </script>

</x-app-layout>
