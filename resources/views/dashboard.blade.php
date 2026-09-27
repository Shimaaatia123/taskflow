<x-app-layout>
    @php
        $locale = app()->getLocale();
        $isArabic = $locale === 'ar';

        $completionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        $todoTasks = max($totalTasks - $inProgressTasks - $completedTasks, 0);

        $user = auth()->user();

        $canCreateProjects = in_array($user->role, ['admin', 'manager']);

       $canCreateTasks = $user->role === 'admin' || $user->role === 'manager';
    @endphp

    <div class="taskflow-dashboard">

        {{-- HERO --}}
        <section class="taskflow-dashboard-hero">
            <div class="taskflow-dashboard-orb taskflow-dashboard-orb-one"></div>
            <div class="taskflow-dashboard-orb taskflow-dashboard-orb-two"></div>

            <div class="taskflow-dashboard-hero-content">
                <div>
                    <span class="taskflow-dashboard-eyebrow">
                        <i class="bi bi-stars"></i>
                        {{ $isArabic ? 'مساحة العمل الخاصة بك' : 'Your workspace' }}
                    </span>

                    <h1>
                        {{ $isArabic ? 'مرحبًا بعودتك' : 'Welcome back' }},
                        <span>{{ auth()->user()->name }}</span>
                        👋
                    </h1>

                    <p>
                        {{ $isArabic
                            ? 'كل ما تحتاجه لمتابعة مشروعاتك ومهامك موجود أمامك في مكان واحد.'
                            : 'Everything you need to track your projects and tasks, all in one place.' }}
                    </p>
                </div>

                <div class="taskflow-dashboard-hero-actions">

                    {{-- New Project --}}
                    @if ($canCreateProjects)
                        <a href="{{ route('projects.create') }}" class="taskflow-dashboard-primary-btn">
                            <i class="bi bi-plus-lg"></i>
                            {{ $isArabic ? 'مشروع جديد' : 'New Project' }}
                        </a>
                    @endif

                    {{-- New Task --}}
                    @if ($canCreateTasks)
                        <a href="{{ route('tasks.create') }}" class="taskflow-dashboard-secondary-btn">
                            <i class="bi bi-check2-square"></i>
                            {{ $isArabic ? 'مهمة جديدة' : 'New Task' }}
                        </a>
                    @endif

                </div>
            </div>
        </section>


        {{-- STATS --}}
        <section class="taskflow-dashboard-stats">

            <div class="taskflow-stat-card">
                <div class="taskflow-stat-top">
                    <span class="taskflow-stat-icon taskflow-stat-blue">
                        <i class="bi bi-kanban-fill"></i>
                    </span>

                    <span class="taskflow-stat-label">
                        {{ $isArabic ? 'المشروعات' : 'Projects' }}
                    </span>
                </div>

                <div class="taskflow-stat-value">
                    {{ $totalProjects }}
                </div>

                <div class="taskflow-stat-footer">
                    <span>
                        {{ $isArabic ? 'إجمالي المشروعات المتاحة لك' : 'Total projects available to you' }}
                    </span>
                </div>
            </div>


            <div class="taskflow-stat-card">
                <div class="taskflow-stat-top">
                    <span class="taskflow-stat-icon taskflow-stat-cyan">
                        <i class="bi bi-list-check"></i>
                    </span>

                    <span class="taskflow-stat-label">
                        {{ $isArabic ? 'إجمالي المهام' : 'Total Tasks' }}
                    </span>
                </div>

                <div class="taskflow-stat-value">
                    {{ $totalTasks }}
                </div>

                <div class="taskflow-stat-footer">
                    <span>
                        {{ $isArabic ? 'كل المهام المرتبطة بمساحتك' : 'All tasks across your workspace' }}
                    </span>
                </div>
            </div>


            <div class="taskflow-stat-card">
                <div class="taskflow-stat-top">
                    <span class="taskflow-stat-icon taskflow-stat-purple">
                        <i class="bi bi-hourglass-split"></i>
                    </span>

                    <span class="taskflow-stat-label">
                        {{ $isArabic ? 'قيد التنفيذ' : 'In Progress' }}
                    </span>
                </div>

                <div class="taskflow-stat-value">
                    {{ $inProgressTasks }}
                </div>

                <div class="taskflow-stat-footer">
                    <span>
                        {{ $isArabic ? 'مهام تحتاج متابعة الآن' : 'Tasks currently in progress' }}
                    </span>
                </div>
            </div>


            <div class="taskflow-stat-card">
                <div class="taskflow-stat-top">
                    <span class="taskflow-stat-icon taskflow-stat-green">
                        <i class="bi bi-check-circle-fill"></i>
                    </span>

                    <span class="taskflow-stat-label">
                        {{ $isArabic ? 'مكتملة' : 'Completed' }}
                    </span>
                </div>

                <div class="taskflow-stat-value">
                    {{ $completedTasks }}
                </div>

                <div class="taskflow-stat-footer">
                    <span>
                        {{ $isArabic ? 'مهام تم إنجازها بنجاح' : 'Tasks completed successfully' }}
                    </span>
                </div>
            </div>

        </section>


        {{-- OVERVIEW --}}
        <section class="taskflow-dashboard-grid">

            <div class="taskflow-dashboard-card taskflow-overview-card">

                <div class="taskflow-card-heading">
                    <div>
                        <span class="taskflow-card-kicker">
                            {{ $isArabic ? 'نظرة عامة' : 'Overview' }}
                        </span>

                        <h2>
                            {{ $isArabic ? 'حالة مساحة العمل' : 'Workspace pulse' }}
                        </h2>
                    </div>

                    <span class="taskflow-card-heading-icon">
                        <i class="bi bi-activity"></i>
                    </span>
                </div>


                <div class="taskflow-progress-row">
                    <div>
                        <span class="taskflow-progress-title">
                            {{ $isArabic ? 'نسبة إنجاز المهام' : 'Task completion rate' }}
                        </span>

                        <strong>{{ $completionRate }}%</strong>
                    </div>

                    <div class="taskflow-progress-track">
                        <div class="taskflow-progress-fill" style="width: {{ $completionRate }}%;"></div>
                    </div>
                </div>


                <div class="taskflow-pipeline">

                    <div class="taskflow-pipeline-item">
                        <span class="taskflow-pipeline-dot taskflow-dot-todo"></span>

                        <div>
                            <strong>{{ $todoTasks }}</strong>
                            <small>{{ $isArabic ? 'قيد الانتظار' : 'To Do' }}</small>
                        </div>
                    </div>

                    <div class="taskflow-pipeline-item">
                        <span class="taskflow-pipeline-dot taskflow-dot-progress"></span>

                        <div>
                            <strong>{{ $inProgressTasks }}</strong>
                            <small>{{ $isArabic ? 'قيد التنفيذ' : 'In Progress' }}</small>
                        </div>
                    </div>

                    <div class="taskflow-pipeline-item">
                        <span class="taskflow-pipeline-dot taskflow-dot-completed"></span>

                        <div>
                            <strong>{{ $completedTasks }}</strong>
                            <small>{{ $isArabic ? 'مكتملة' : 'Completed' }}</small>
                        </div>
                    </div>

                </div>

            </div>


            <div class="taskflow-dashboard-card taskflow-quick-card">

                <div class="taskflow-card-heading">
                    <div>
                        <span class="taskflow-card-kicker">
                            {{ $isArabic ? 'الوصول السريع' : 'Quick actions' }}
                        </span>

                        <h2>
                            {{ $isArabic ? 'ابدأ من هنا' : 'Start here' }}
                        </h2>
                    </div>

                    <span class="taskflow-card-heading-icon">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </span>
                </div>


                <div class="taskflow-action-list">

                    <a href="{{ route('projects.index') }}" class="taskflow-action-item">
                        <span class="taskflow-action-icon taskflow-action-blue">
                            <i class="bi bi-kanban"></i>
                        </span>

                        <div>
                            <strong>{{ $isArabic ? 'إدارة المشروعات' : 'Manage Projects' }}</strong>
                            <small>
                                {{ $isArabic
                                    ? 'عرض وتنظيم كل مشروعاتك'
                                    : 'View and organize your projects' }}
                            </small>
                        </div>

                        <i class="bi bi-arrow-up-right taskflow-action-arrow"></i>
                    </a>


                    <a href="{{ route('tasks.index') }}" class="taskflow-action-item">
                        <span class="taskflow-action-icon taskflow-action-cyan">
                            <i class="bi bi-check2-square"></i>
                        </span>

                        <div>
                            <strong>{{ $isArabic ? 'إدارة المهام' : 'Manage Tasks' }}</strong>
                            <small>
                                {{ $isArabic
                                    ? 'تابع الحالة والأولوية والاستحقاق'
                                    : 'Track status, priority and deadlines' }}
                            </small>
                        </div>

                        <i class="bi bi-arrow-up-right taskflow-action-arrow"></i>
                    </a>


                    <a href="{{ route('profile.edit') }}" class="taskflow-action-item">
                        <span class="taskflow-action-icon taskflow-action-purple">
                            <i class="bi bi-person-circle"></i>
                        </span>

                        <div>
                            <strong>{{ $isArabic ? 'ملفك الشخصي' : 'Your Profile' }}</strong>
                            <small>
                                {{ $isArabic
                                    ? 'راجع بيانات حسابك وإعداداتك'
                                    : 'Review your account details and settings' }}
                            </small>
                        </div>

                        <i class="bi bi-arrow-up-right taskflow-action-arrow"></i>
                    </a>

                </div>

            </div>

        </section>


        {{-- RECENT CONTENT --}}
        <section class="taskflow-dashboard-grid taskflow-dashboard-grid-bottom">

            <div class="taskflow-dashboard-card">

                <div class="taskflow-card-heading">
                    <div>
                        <span class="taskflow-card-kicker">
                            {{ $isArabic ? 'المشروعات' : 'Projects' }}
                        </span>

                        <h2>
                            {{ $isArabic ? 'أحدث المشروعات' : 'Recent Projects' }}
                        </h2>
                    </div>

                    <a href="{{ route('projects.index') }}" class="taskflow-view-all">
                        {{ $isArabic ? 'عرض الكل' : 'View all' }}
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>


                <div class="taskflow-list">

                    @forelse($recentProjects as $project)

                        @php
                            $projectDescription = $isArabic
                                ? ($project->description_ar ?: $project->description_en)
                                : ($project->description_en ?: $project->description_ar);
                        @endphp

                        <a href="{{ route('projects.show', $project->id) }}"
                            class="taskflow-list-item">

                            <span class="taskflow-list-icon">
                                <i class="bi bi-kanban-fill"></i>
                            </span>

                            <div class="taskflow-list-content">

                                <div class="taskflow-list-title-row">
                                    <strong>{{ $project->name }}</strong>

                                    <span class="taskflow-mini-badge">
                                        {{ $isArabic ? 'نشط' : 'Active' }}
                                    </span>
                                </div>

                                <p>
                                    {{ $projectDescription
                                        ?: ($isArabic
                                            ? 'لا يوجد وصف للمشروع.'
                                            : 'No project description.') }}
                                </p>

                                <small>
                                    <i class="bi bi-calendar3"></i>
                                    {{ $project->created_at?->format('d M Y') }}
                                </small>

                            </div>

                            <i class="bi bi-chevron-{{ $isArabic ? 'left' : 'right' }} taskflow-list-arrow"></i>

                        </a>

                    @empty

                        <div class="taskflow-empty-state">

                            <span>
                                <i class="bi bi-kanban"></i>
                            </span>

                            <strong>
                                {{ $isArabic ? 'لا توجد مشروعات حتى الآن' : 'No projects yet' }}
                            </strong>

                            <p>
                                {{ $canCreateProjects
                                    ? ($isArabic
                                        ? 'ابدأ بإنشاء أول مشروع لك.'
                                        : 'Create your first project to get started.')
                                    : ($isArabic
                                        ? 'لا توجد مشروعات متاحة لك حاليًا.'
                                        : 'No projects are currently available to you.') }}
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>


            <div class="taskflow-dashboard-card">

                <div class="taskflow-card-heading">

                    <div>
                        <span class="taskflow-card-kicker">
                            {{ $isArabic ? 'المهام' : 'Tasks' }}
                        </span>

                        <h2>
                            {{ $isArabic ? 'أحدث المهام' : 'Recent Tasks' }}
                        </h2>
                    </div>

                    <a href="{{ route('tasks.index') }}" class="taskflow-view-all">
                        {{ $isArabic ? 'عرض الكل' : 'View all' }}
                        <i class="bi bi-arrow-up-right"></i>
                    </a>

                </div>


                <div class="taskflow-list">

                    @forelse($recentTasks as $task)

                        @php
                            $taskTitle = $isArabic
                                ? ($task->title_ar ?: $task->title_en)
                                : ($task->title_en ?: $task->title_ar);

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
                        @endphp

                        <a href="{{ route('tasks.show', $task->id) }}"
                            class="taskflow-list-item">

                            <span class="taskflow-list-icon taskflow-task-icon">
                                <i class="bi bi-check2-square"></i>
                            </span>

                            <div class="taskflow-list-content">

                                <div class="taskflow-list-title-row">
                                    <strong>{{ $taskTitle }}</strong>

                                    <span class="taskflow-status taskflow-status-{{ $task->status }}">
                                        {{ $statusLabel }}
                                    </span>
                                </div>

                                <p>
                                    {{ $priorityLabel }}

                                    <span class="taskflow-dot-separator">•</span>

                                    {{ $task->due_date
                                        ? ($isArabic ? 'استحقاق: ' : 'Due: ') . $task->due_date->format('d M Y')
                                        : ($isArabic
                                            ? 'بدون موعد استحقاق'
                                            : 'No due date') }}
                                </p>

                                <small>
                                    <i class="bi bi-flag-fill"></i>
                                    {{ $priorityLabel }}
                                </small>

                            </div>

                            <i class="bi bi-chevron-{{ $isArabic ? 'left' : 'right' }} taskflow-list-arrow"></i>

                        </a>

                    @empty

                        <div class="taskflow-empty-state">

                            <span>
                                <i class="bi bi-check2-square"></i>
                            </span>

                            <strong>
                                {{ $isArabic ? 'لا توجد مهام حتى الآن' : 'No tasks yet' }}
                            </strong>

                            <p>
                                {{ $canCreateTasks
                                    ? ($isArabic
                                        ? 'ابدأ بإنشاء أول مهمة لك.'
                                        : 'Create your first task to get started.')
                                    : ($isArabic
                                        ? 'لا توجد مهام متاحة لك حاليًا.'
                                        : 'No tasks are currently available to you.') }}
                            </p>

                        </div>

                    @endforelse

                </div>

            </div>

        </section>

    </div>


    <style>
        .taskflow-dashboard {
            position: relative;
            padding: 28px;
            overflow: hidden;
        }

        .taskflow-dashboard-hero {
            position: relative;
            overflow: hidden;
            margin-bottom: 24px;
            padding: 34px;
            border: 1px solid rgba(148, 163, 184, .16);
            border-radius: 28px;
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, .18), transparent 28%),
                radial-gradient(circle at bottom left, rgba(168, 85, 247, .16), transparent 28%),
                linear-gradient(135deg, #0f172a 0%, #111c35 48%, #101827 100%);
            box-shadow: 0 28px 70px rgba(15, 23, 42, .24);
        }

        .taskflow-dashboard-orb {
            position: absolute;
            border-radius: 999px;
            filter: blur(4px);
            opacity: .4;
            pointer-events: none;
        }

        .taskflow-dashboard-orb-one {
            width: 180px;
            height: 180px;
            top: -90px;
            right: 8%;
            background: rgba(34, 211, 238, .2);
        }

        .taskflow-dashboard-orb-two {
            width: 150px;
            height: 150px;
            bottom: -80px;
            left: 12%;
            background: rgba(168, 85, 247, .18);
        }

        .taskflow-dashboard-hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 28px;
        }

        .taskflow-dashboard-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
            padding: 7px 12px;
            border: 1px solid rgba(125, 211, 252, .22);
            border-radius: 999px;
            background: rgba(14, 165, 233, .08);
            color: #7dd3fc;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .taskflow-dashboard-hero h1 {
            margin: 0;
            color: #f8fafc;
            font-size: clamp(28px, 4vw, 44px);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -.04em;
        }

        .taskflow-dashboard-hero h1 span {
            background: linear-gradient(90deg, #67e8f9, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .taskflow-dashboard-hero p {
            max-width: 680px;
            margin: 14px 0 0;
            color: #94a3b8;
            font-size: 15px;
            line-height: 1.8;
        }

        .taskflow-dashboard-hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            flex-shrink: 0;
        }

        .taskflow-dashboard-primary-btn,
        .taskflow-dashboard-secondary-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            padding: 0 18px;
            border-radius: 14px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: .25s ease;
        }

        .taskflow-dashboard-primary-btn {
            border: 1px solid rgba(96, 165, 250, .35);
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: #fff;
            box-shadow: 0 12px 28px rgba(37, 99, 235, .25);
        }

        .taskflow-dashboard-secondary-btn {
            border: 1px solid rgba(148, 163, 184, .18);
            background: rgba(255, 255, 255, .05);
            color: #e2e8f0;
        }

        .taskflow-dashboard-primary-btn:hover,
        .taskflow-dashboard-secondary-btn:hover {
            transform: translateY(-2px);
            color: #fff;
        }

        .taskflow-dashboard-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 24px;
        }

        .taskflow-stat-card {
            position: relative;
            padding: 22px;
            border: 1px solid rgba(148, 163, 184, .16);
            border-radius: 22px;
            background: rgba(255, 255, 255, .72);
            box-shadow: 0 16px 40px rgba(15, 23, 42, .08);
            backdrop-filter: blur(18px);
        }

        .taskflow-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .taskflow-stat-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 14px;
            font-size: 18px;
        }

        .taskflow-stat-blue {
            background: rgba(59, 130, 246, .12);
            color: #2563eb;
        }

        .taskflow-stat-cyan {
            background: rgba(6, 182, 212, .12);
            color: #0891b2;
        }

        .taskflow-stat-purple {
            background: rgba(139, 92, 246, .12);
            color: #7c3aed;
        }

        .taskflow-stat-green {
            background: rgba(34, 197, 94, .12);
            color: #16a34a;
        }

        .taskflow-stat-label {
            color: #64748b;
            font-size: 13px;
            font-weight: 700;
        }

        .taskflow-stat-value {
            margin-top: 18px;
            color: #0f172a;
            font-size: 34px;
            font-weight: 800;
            line-height: 1;
        }

        .taskflow-stat-footer {
            margin-top: 12px;
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.6;
        }

        .taskflow-dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.25fr) minmax(320px, .75fr);
            gap: 18px;
            margin-bottom: 18px;
        }

        .taskflow-dashboard-grid-bottom {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .taskflow-dashboard-card {
            padding: 24px;
            border: 1px solid rgba(148, 163, 184, .15);
            border-radius: 22px;
            background: rgba(255, 255, 255, .76);
            box-shadow: 0 18px 44px rgba(15, 23, 42, .08);
            backdrop-filter: blur(16px);
        }

        .taskflow-card-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 22px;
        }

        .taskflow-card-kicker {
            display: block;
            margin-bottom: 5px;
            color: #94a3b8;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .taskflow-card-heading h2 {
            margin: 0;
            color: #0f172a;
            font-size: 21px;
            font-weight: 800;
        }

        .taskflow-card-heading-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 1px solid rgba(59, 130, 246, .14);
            border-radius: 13px;
            background: rgba(59, 130, 246, .08);
            color: #2563eb;
        }

        .taskflow-progress-row>div:first-child {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 10px;
        }

        .taskflow-progress-title {
            color: #475569;
            font-size: 14px;
            font-weight: 700;
        }

        .taskflow-progress-row strong {
            color: #0f172a;
            font-size: 18px;
            font-weight: 800;
        }

        .taskflow-progress-track {
            height: 10px;
            overflow: hidden;
            border-radius: 999px;
            background: #e2e8f0;
        }

        .taskflow-progress-fill {
            height: 100%;
            border-radius: inherit;
            background: linear-gradient(90deg, #2563eb, #06b6d4, #8b5cf6);
            transition: width .4s ease;
        }

        .taskflow-pipeline {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 24px;
        }

        .taskflow-pipeline-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background: #f8fafc;
        }

        .taskflow-pipeline-item strong {
            display: block;
            color: #0f172a;
            font-size: 18px;
            font-weight: 800;
        }

        .taskflow-pipeline-item small {
            color: #64748b;
            font-size: 11px;
        }

        .taskflow-pipeline-dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            flex-shrink: 0;
        }

        .taskflow-dot-todo {
            background: #94a3b8;
        }

        .taskflow-dot-progress {
            background: #f59e0b;
        }

        .taskflow-dot-completed {
            background: #22c55e;
        }

        .taskflow-action-list {
            display: grid;
            gap: 10px;
        }

        .taskflow-action-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            background: #f8fafc;
            text-decoration: none;
            transition: .22s ease;
        }

        .taskflow-action-item:hover {
            transform: translateY(-2px);
            border-color: rgba(59, 130, 246, .2);
            background: #fff;
        }

        .taskflow-action-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            flex-shrink: 0;
        }

        .taskflow-action-blue {
            background: rgba(59, 130, 246, .11);
            color: #2563eb;
        }

        .taskflow-action-cyan {
            background: rgba(6, 182, 212, .11);
            color: #0891b2;
        }

        .taskflow-action-purple {
            background: rgba(139, 92, 246, .11);
            color: #7c3aed;
        }

        .taskflow-action-item strong {
            display: block;
            color: #0f172a;
            font-size: 13px;
            font-weight: 800;
        }

        .taskflow-action-item small {
            display: block;
            margin-top: 3px;
            color: #94a3b8;
            font-size: 11px;
        }

        .taskflow-action-arrow {
            margin-inline-start: auto;
            color: #94a3b8;
            font-size: 14px;
        }

        .taskflow-view-all {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #2563eb;
            font-size: 12px;
            font-weight: 800;
            text-decoration: none;
        }

        .taskflow-list {
            display: grid;
            gap: 10px;
        }

        .taskflow-list-item {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 14px;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            background: #f8fafc;
            text-decoration: none;
            transition: .22s ease;
        }

        .taskflow-list-item:hover {
            transform: translateX(-2px);
            border-color: rgba(59, 130, 246, .18);
            background: #fff;
        }

        .taskflow-list-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 13px;
            background: rgba(59, 130, 246, .11);
            color: #2563eb;
            flex-shrink: 0;
        }

        .taskflow-task-icon {
            background: rgba(139, 92, 246, .11);
            color: #7c3aed;
        }

        .taskflow-list-content {
            min-width: 0;
            flex: 1;
        }

        .taskflow-list-title-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .taskflow-list-title-row strong {
            overflow: hidden;
            color: #0f172a;
            font-size: 13px;
            font-weight: 800;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .taskflow-list-content p {
            margin: 5px 0;
            overflow: hidden;
            color: #64748b;
            font-size: 11px;
            line-height: 1.6;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .taskflow-list-content small {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #94a3b8;
            font-size: 10px;
        }

        .taskflow-list-arrow {
            color: #94a3b8;
            font-size: 13px;
            flex-shrink: 0;
        }

        .taskflow-mini-badge,
        .taskflow-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 5px 8px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: 800;
            white-space: nowrap;
        }

        .taskflow-mini-badge {
            background: rgba(34, 197, 94, .1);
            color: #15803d;
        }

        .taskflow-status-todo {
            background: rgba(148, 163, 184, .14);
            color: #475569;
        }

        .taskflow-status-in_progress {
            background: rgba(245, 158, 11, .13);
            color: #b45309;
        }

        .taskflow-status-completed {
            background: rgba(34, 197, 94, .11);
            color: #15803d;
        }

        .taskflow-dot-separator {
            margin: 0 4px;
            color: #cbd5e1;
        }

        .taskflow-empty-state {
            padding: 34px 20px;
            text-align: center;
        }

        .taskflow-empty-state>span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 54px;
            height: 54px;
            margin-bottom: 12px;
            border-radius: 17px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 20px;
        }

        .taskflow-empty-state strong {
            display: block;
            color: #0f172a;
            font-size: 14px;
            font-weight: 800;
        }

        .taskflow-empty-state p {
            margin: 5px 0 0;
            color: #94a3b8;
            font-size: 11px;
        }

        @media (max-width: 1100px) {
            .taskflow-dashboard-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .taskflow-dashboard-grid,
            .taskflow-dashboard-grid-bottom {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .taskflow-dashboard {
                padding: 18px;
            }

            .taskflow-dashboard-hero {
                padding: 24px;
                border-radius: 22px;
            }

            .taskflow-dashboard-hero-content {
                align-items: flex-start;
                flex-direction: column;
            }

            .taskflow-dashboard-hero-actions {
                width: 100%;
            }

            .taskflow-dashboard-primary-btn,
            .taskflow-dashboard-secondary-btn {
                flex: 1;
            }

            .taskflow-pipeline {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .taskflow-dashboard-stats {
                grid-template-columns: 1fr;
            }

            .taskflow-dashboard-card {
                padding: 18px;
            }

            .taskflow-list-item {
                align-items: flex-start;
            }

            .taskflow-list-title-row {
                align-items: flex-start;
                flex-direction: column;
                gap: 5px;
            }

            .taskflow-status,
            .taskflow-mini-badge {
                align-self: flex-start;
            }
        }
    </style>
</x-app-layout>