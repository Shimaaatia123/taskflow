<x-app-layout>

    @php
        $locale = app()->getLocale();
        $isArabic = $locale === 'ar';
        $currentUser = auth()->user();

        $totalProjects = $projects->count();

        $ownedProjects = $projects
            ->filter(function ($project) use ($currentUser) {
                return $project->owner_id === $currentUser->id;
            })
            ->count();

        $sharedProjects = $projects
            ->filter(function ($project) use ($currentUser) {
                return $project->owner_id !== $currentUser->id;
            })
            ->count();

        $activeProjects = $projects->where('status', 'active')->count();
    @endphp


    <div class="taskflow-projects-page">

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

        {{-- ================= HERO ================= --}}
        <section class="taskflow-projects-hero">

            <div class="taskflow-projects-glow taskflow-projects-glow-one"></div>
            <div class="taskflow-projects-glow taskflow-projects-glow-two"></div>

            <div class="taskflow-projects-hero-content">

                <div>

                    <span class="taskflow-projects-eyebrow">
                        <i class="bi bi-kanban-fill"></i>
                        {{ $isArabic ? 'مساحة المشروعات' : 'PROJECT WORKSPACE' }}
                    </span>

                    <h1>
                        {{ $isArabic ? 'حوّلي أفكارك إلى مشروعات واضحة.' : 'Turn ideas into organized projects.' }}
                    </h1>

                    <p>
                        {{ $isArabic
                            ? 'أنشئي مشروعاتك، تابعي المشروعات المشتركة معك، وأديري كل شيء من مساحة عمل واحدة.'
                            : 'Create your projects, follow shared workspaces, and manage everything from one place.' }}
                    </p>

                </div>


                <a href="{{ route('projects.create') }}" class="taskflow-projects-create-btn">

                    <i class="bi bi-plus-lg"></i>

                    <span>
                        {{ $isArabic ? 'مشروع جديد' : 'New Project' }}
                    </span>

                </a>

            </div>

        </section>



        {{-- ================= STATS ================= --}}
        <section class="taskflow-projects-stats">

            <div class="taskflow-project-stat">

                <span class="taskflow-project-stat-icon blue">
                    <i class="bi bi-kanban-fill"></i>
                </span>

                <div>
                    <span>
                        {{ $isArabic ? 'كل المشروعات' : 'All Projects' }}
                    </span>

                    <strong>{{ $totalProjects }}</strong>
                </div>

            </div>


            <div class="taskflow-project-stat">

                <span class="taskflow-project-stat-icon purple">
                    <i class="bi bi-person-workspace"></i>
                </span>

                <div>
                    <span>
                        {{ $isArabic ? 'مشروعاتي' : 'My Projects' }}
                    </span>

                    <strong>{{ $ownedProjects }}</strong>
                </div>

            </div>


            <div class="taskflow-project-stat">

                <span class="taskflow-project-stat-icon cyan">
                    <i class="bi bi-people-fill"></i>
                </span>

                <div>
                    <span>
                        {{ $isArabic ? 'مشروعات مشتركة' : 'Shared Projects' }}
                    </span>

                    <strong>{{ $sharedProjects }}</strong>
                </div>

            </div>


            <div class="taskflow-project-stat">

                <span class="taskflow-project-stat-icon green">
                    <i class="bi bi-lightning-charge-fill"></i>
                </span>

                <div>
                    <span>
                        {{ $isArabic ? 'مشروعات نشطة' : 'Active Projects' }}
                    </span>

                    <strong>{{ $activeProjects }}</strong>
                </div>

            </div>

        </section>


        {{-- ================= TOOLBAR ================= --}}
        @if ($totalProjects)
            <section class="taskflow-projects-toolbar">

                <div class="taskflow-project-search">

                    <i class="bi bi-search"></i>

                    <input type="search" id="projectSearch"
                        placeholder="{{ $isArabic ? 'ابحثي عن مشروع أو وصف...' : 'Search projects or descriptions...' }}">

                </div>


                <div class="taskflow-project-filters">

                    <button type="button" class="taskflow-project-filter active" data-filter="all">

                        {{ $isArabic ? 'الكل' : 'All' }}

                    </button>


                    <button type="button" class="taskflow-project-filter" data-filter="mine">

                        {{ $isArabic ? 'مشروعاتي' : 'My Projects' }}

                    </button>


                    <button type="button" class="taskflow-project-filter" data-filter="shared">

                        {{ $isArabic ? 'مشتركة معي' : 'Shared With Me' }}

                    </button>

                </div>

            </section>
        @endif


        {{-- ================= PROJECTS ================= --}}
        @if ($totalProjects)

            <section class="taskflow-projects-grid" id="projectsGrid">

                @foreach ($projects as $project)
                    @php
                        $isOwner = $project->owner_id === $currentUser->id;

                        $canManage = $currentUser->role === 'admin' || $isOwner;

                        $scope = $isOwner ? 'mine' : 'shared';

                        $description = $isArabic
                            ? ($project->description_ar ?:
                            $project->description_en)
                            : ($project->description_en ?:
                            $project->description_ar);

                        $scopeLabel = $isOwner
                            ? ($isArabic
                                ? 'مشروعي'
                                : 'My Project')
                            : ($isArabic
                                ? 'مشترك معي'
                                : 'Shared With Me');

                        $statusLabel =
                            $project->status === 'active' ? ($isArabic ? 'نشط' : 'Active') : ucfirst($project->status);
                    @endphp


                    <article class="taskflow-project-card" data-scope="{{ $scope }}"
                        data-search="{{ strtolower(
                            $project->name .
                                ' ' .
                                ($project->description_ar ?? '') .
                                ' ' .
                                ($project->description_en ?? '') .
                                ' ' .
                                $statusLabel .
                                ' ' .
                                $scopeLabel,
                        ) }}">

                        <div class="taskflow-project-card-glow"></div>


                        {{-- TOP --}}
                        <div class="taskflow-project-card-top">

                            <div class="taskflow-project-card-icon">
                                <i class="bi bi-kanban-fill"></i>
                            </div>


                            <div class="taskflow-project-badges">

                                <span class="taskflow-project-scope">
                                    {{ $scopeLabel }}
                                </span>

                                <span class="taskflow-project-status">
                                    <span></span>
                                    {{ $statusLabel }}
                                </span>

                            </div>

                        </div>


                        {{-- CONTENT --}}
                        <div class="taskflow-project-card-content">

                            <div class="taskflow-project-card-number">
                                PROJECT #{{ $project->id }}
                            </div>

                            <h2>
                                {{ $project->name }}
                            </h2>

                            <p>
                                {{ $description ?: ($isArabic ? 'لا يوجد وصف لهذا المشروع.' : 'No description for this project.') }}
                            </p>

                        </div>


                        {{-- META --}}
                        <div class="taskflow-project-meta">

                            <div>

                                <span>
                                    <i class="bi bi-calendar3"></i>
                                    {{ $isArabic ? 'تم الإنشاء' : 'Created' }}
                                </span>

                                <strong>
                                    {{ $project->created_at?->format('M d, Y') }}
                                </strong>

                            </div>


                            <div>

                                <span>
                                    <i class="bi bi-arrow-clockwise"></i>
                                    {{ $isArabic ? 'آخر تحديث' : 'Updated' }}
                                </span>

                                <strong>
                                    {{ $project->updated_at?->format('M d, Y') }}
                                </strong>

                            </div>

                        </div>


                        {{-- ACTIONS --}}
                        <div class="taskflow-project-card-footer">

                            <a href="{{ route('projects.show', $project) }}" class="taskflow-project-view-btn">

                                <span>
                                    {{ $isArabic ? 'عرض المشروع' : 'View Project' }}
                                </span>

                                <i class="bi bi-arrow-{{ $isArabic ? 'left' : 'right' }}"></i>

                            </a>


                            @if ($canManage)
                                <div class="taskflow-project-manage-actions">

                                    <a href="{{ route('projects.edit', $project) }}" class="taskflow-project-icon-btn"
                                        title="{{ $isArabic ? 'تعديل' : 'Edit' }}">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>


                                    <form method="POST" action="{{ route('projects.destroy', $project) }}"
                                        onsubmit="return confirm(
                                              '{{ $isArabic ? 'هل أنتِ متأكدة من حذف هذا المشروع؟' : 'Are you sure you want to delete this project?' }}'
                                          )">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="taskflow-project-icon-btn taskflow-project-delete-btn"
                                            title="{{ $isArabic ? 'حذف' : 'Delete' }}">

                                            <i class="bi bi-trash3"></i>

                                        </button>

                                    </form>

                                </div>
                            @endif

                        </div>

                    </article>
                @endforeach


                {{-- NO RESULTS --}}
                <div class="taskflow-projects-no-results" id="noProjectResults">

                    <div class="taskflow-projects-no-results-icon">
                        <i class="bi bi-search"></i>
                    </div>

                    <strong>
                        {{ $isArabic ? 'لا توجد نتائج' : 'No matching projects' }}
                    </strong>

                    <p>
                        {{ $isArabic ? 'جربي تغيير كلمة البحث أو نوع المشروعات.' : 'Try another search term or project type.' }}
                    </p>

                </div>

            </section>
        @else
            {{-- ================= EMPTY STATE ================= --}}
            <section class="taskflow-projects-empty">

                <div class="taskflow-projects-empty-glow"></div>

                <div class="taskflow-projects-empty-icon">
                    <i class="bi bi-kanban"></i>
                </div>

                <span>
                    {{ $isArabic ? 'مساحة عمل جديدة' : 'Fresh workspace' }}
                </span>

                <h2>
                    {{ $isArabic ? 'مشروعك الأول يبدأ من هنا.' : 'Your first project starts here.' }}
                </h2>

                <p>
                    {{ $isArabic
                        ? 'أنشئي مشروعًا جديدًا وابدئي في تنظيم المهام ومتابعة التقدم بطريقة واضحة.'
                        : 'Create a new project and start organizing work with clear, trackable progress.' }}
                </p>

                <a href="{{ route('projects.create') }}" class="taskflow-projects-empty-btn">

                    <i class="bi bi-plus-lg"></i>

                    {{ $isArabic ? 'إنشاء أول مشروع' : 'Create First Project' }}

                </a>

            </section>

        @endif

    </div>


    <style>
        .taskflow-projects-page {
            padding: 28px;
            position: relative;
        }


        /* HERO */

        .taskflow-projects-hero {
            position: relative;
            overflow: hidden;
            margin-bottom: 22px;
            padding: 34px;
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, .15);
            background:
                radial-gradient(circle at top right, rgba(59, 130, 246, .20), transparent 28%),
                radial-gradient(circle at bottom left, rgba(168, 85, 247, .16), transparent 28%),
                linear-gradient(135deg, #0f172a 0%, #111c35 52%, #101827 100%);
            box-shadow: 0 28px 70px rgba(15, 23, 42, .20);
        }


        .taskflow-projects-glow {
            position: absolute;
            border-radius: 50%;
            filter: blur(8px);
            opacity: .35;
            pointer-events: none;
        }


        .taskflow-projects-glow-one {
            width: 190px;
            height: 190px;
            top: -100px;
            right: 10%;
            background: rgba(34, 211, 238, .20);
        }


        .taskflow-projects-glow-two {
            width: 160px;
            height: 160px;
            bottom: -90px;
            left: 12%;
            background: rgba(139, 92, 246, .20);
        }


        .taskflow-projects-hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
        }


        .taskflow-projects-eyebrow {
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


        .taskflow-projects-hero h1 {
            max-width: 820px;
            margin: 0;
            color: #f8fafc;
            font-size: clamp(28px, 4vw, 45px);
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -.04em;
        }


        .taskflow-projects-hero p {
            max-width: 720px;
            margin: 14px 0 0;
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.8;
        }


        .taskflow-projects-create-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 46px;
            padding: 0 18px;
            border: 1px solid rgba(96, 165, 250, .35);
            border-radius: 14px;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
            box-shadow: 0 15px 30px rgba(37, 99, 235, .22);
            transition: .25s ease;
            flex-shrink: 0;
        }


        .taskflow-projects-create-btn:hover {
            transform: translateY(-2px);
            color: #fff;
        }


        /* STATS */

        .taskflow-projects-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }


        .taskflow-project-stat {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 18px;
            border: 1px solid rgba(148, 163, 184, .15);
            border-radius: 20px;
            background: rgba(255, 255, 255, .78);
            box-shadow: 0 14px 38px rgba(15, 23, 42, .07);
            backdrop-filter: blur(16px);
        }


        .taskflow-project-stat-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 14px;
            font-size: 18px;
            flex-shrink: 0;
        }


        .taskflow-project-stat-icon.blue {
            background: rgba(59, 130, 246, .11);
            color: #2563eb;
        }


        .taskflow-project-stat-icon.purple {
            background: rgba(139, 92, 246, .11);
            color: #7c3aed;
        }


        .taskflow-project-stat-icon.cyan {
            background: rgba(6, 182, 212, .11);
            color: #0891b2;
        }


        .taskflow-project-stat-icon.green {
            background: rgba(34, 197, 94, .11);
            color: #16a34a;
        }


        .taskflow-project-stat div span {
            display: block;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
        }


        .taskflow-project-stat strong {
            display: block;
            margin-top: 4px;
            color: #0f172a;
            font-size: 24px;
            font-weight: 800;
            line-height: 1;
        }


        /* TOOLBAR */

        .taskflow-projects-toolbar {
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


        .taskflow-project-search {
            position: relative;
            flex: 1;
            max-width: 430px;
        }


        .taskflow-project-search i {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }


        html[dir="rtl"] .taskflow-project-search i {
            left: auto;
            right: 14px;
        }


        .taskflow-project-search input {
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


        html[dir="rtl"] .taskflow-project-search input {
            padding: 0 40px 0 14px;
        }


        .taskflow-project-search input:focus {
            border-color: rgba(59, 130, 246, .35);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .07);
        }


        .taskflow-project-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }


        .taskflow-project-filter {
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


        .taskflow-project-filter:hover,
        .taskflow-project-filter.active {
            border-color: rgba(59, 130, 246, .18);
            background: #eff6ff;
            color: #2563eb;
        }


        /* GRID */

        .taskflow-projects-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }


        .taskflow-project-card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            overflow: hidden;
            padding: 21px;
            border: 1px solid rgba(148, 163, 184, .15);
            border-radius: 22px;
            background: rgba(255, 255, 255, .82);
            box-shadow: 0 17px 45px rgba(15, 23, 42, .07);
            transition: .25s ease;
        }


        .taskflow-project-card:hover {
            transform: translateY(-4px);
            border-color: rgba(59, 130, 246, .18);
            box-shadow: 0 24px 55px rgba(15, 23, 42, .11);
        }


        .taskflow-project-card-glow {
            position: absolute;
            width: 130px;
            height: 130px;
            top: -75px;
            right: -55px;
            border-radius: 50%;
            background: rgba(59, 130, 246, .07);
            filter: blur(5px);
            pointer-events: none;
        }


        .taskflow-project-card-top {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }


        .taskflow-project-card-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(59, 130, 246, .13), rgba(139, 92, 246, .11));
            color: #2563eb;
            font-size: 17px;
        }


        .taskflow-project-badges {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 6px;
        }


        .taskflow-project-scope,
        .taskflow-project-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 8px;
            border-radius: 999px;
            font-size: 8px;
            font-weight: 800;
            white-space: nowrap;
        }


        .taskflow-project-scope {
            background: rgba(59, 130, 246, .08);
            color: #2563eb;
        }


        .taskflow-project-status {
            background: rgba(34, 197, 94, .10);
            color: #15803d;
        }


        .taskflow-project-status span {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: #22c55e;
        }


        .taskflow-project-card-content {
            position: relative;
            z-index: 1;
            margin-top: 20px;
        }


        .taskflow-project-card-number {
            margin-bottom: 5px;
            color: #94a3b8;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .08em;
        }


        .taskflow-project-card-content h2 {
            margin: 0;
            color: #0f172a;
            font-size: 18px;
            font-weight: 800;
            line-height: 1.35;
        }


        .taskflow-project-card-content p {
            display: -webkit-box;
            min-height: 38px;
            margin: 8px 0 0;
            overflow: hidden;
            color: #64748b;
            font-size: 11px;
            line-height: 1.7;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }


        /* META */

        .taskflow-project-meta {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin-top: 18px;
            padding: 12px;
            border: 1px solid #edf2f7;
            border-radius: 15px;
            background: #f8fafc;
        }


        .taskflow-project-meta span {
            display: block;
            color: #94a3b8;
            font-size: 8px;
            font-weight: 700;
        }


        .taskflow-project-meta span i {
            margin-inline-end: 4px;
        }


        .taskflow-project-meta strong {
            display: block;
            margin-top: 4px;
            color: #334155;
            font-size: 10px;
            font-weight: 800;
        }


        /* FOOTER */

        .taskflow-project-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 18px;
        }


        .taskflow-project-view-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            min-height: 35px;
            padding: 0 11px;
            border: 1px solid rgba(59, 130, 246, .14);
            border-radius: 10px;
            background: #eff6ff;
            color: #2563eb;
            text-decoration: none;
            font-size: 10px;
            font-weight: 800;
            transition: .2s ease;
        }


        .taskflow-project-view-btn:hover {
            background: #dbeafe;
            color: #1d4ed8;
        }


        .taskflow-project-manage-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }


        .taskflow-project-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: #64748b;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }


        .taskflow-project-icon-btn:hover {
            border-color: rgba(59, 130, 246, .22);
            background: #eff6ff;
            color: #2563eb;
        }


        .taskflow-project-delete-btn:hover {
            border-color: rgba(239, 68, 68, .18);
            background: rgba(239, 68, 68, .06);
            color: #dc2626;
        }


        /* NO RESULTS */

        .taskflow-projects-no-results {
            display: none;
            grid-column: 1 / -1;
            padding: 50px 20px;
            text-align: center;
        }


        .taskflow-projects-no-results-icon {
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


        .taskflow-projects-no-results strong {
            display: block;
            color: #0f172a;
            font-size: 14px;
            font-weight: 800;
        }


        .taskflow-projects-no-results p {
            margin: 6px 0 0;
            color: #94a3b8;
            font-size: 11px;
        }


        /* EMPTY */

        .taskflow-projects-empty {
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


        .taskflow-projects-empty-glow {
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


        .taskflow-projects-empty-icon {
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


        .taskflow-projects-empty>span {
            position: relative;
            display: block;
            margin-bottom: 8px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .1em;
            text-transform: uppercase;
        }


        .taskflow-projects-empty h2 {
            position: relative;
            margin: 0;
            color: #0f172a;
            font-size: 25px;
            font-weight: 800;
        }


        .taskflow-projects-empty p {
            position: relative;
            max-width: 520px;
            margin: 10px auto 22px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.8;
        }


        .taskflow-projects-empty-btn {
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


        .taskflow-projects-empty-btn:hover {
            color: #fff;
        }


        /* RESPONSIVE */

        @media (max-width: 1100px) {

            .taskflow-projects-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .taskflow-projects-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

        }


        @media (max-width: 760px) {

            .taskflow-projects-page {
                padding: 18px;
            }

            .taskflow-projects-hero {
                padding: 24px;
                border-radius: 22px;
            }

            .taskflow-projects-hero-content {
                align-items: flex-start;
                flex-direction: column;
            }

            .taskflow-projects-create-btn {
                width: 100%;
            }

            .taskflow-projects-toolbar {
                align-items: stretch;
                flex-direction: column;
            }

            .taskflow-project-search {
                max-width: none;
            }

            .taskflow-project-filters {
                overflow-x: auto;
                flex-wrap: nowrap;
            }

            .taskflow-project-filter {
                flex-shrink: 0;
            }

            .taskflow-projects-grid {
                grid-template-columns: 1fr;
            }

        }


        @media (max-width: 520px) {

            .taskflow-projects-stats {
                grid-template-columns: 1fr;
            }

            .taskflow-project-meta {
                grid-template-columns: 1fr;
            }

            .taskflow-project-badges {
                align-items: flex-end;
                flex-direction: column;
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

            const searchInput = document.getElementById('projectSearch');
            const filterButtons = document.querySelectorAll('.taskflow-project-filter');
            const projectCards = document.querySelectorAll('.taskflow-project-card');
            const noResults = document.getElementById('noProjectResults');

            let activeFilter = 'all';


            function applyFilters() {

                const searchValue = searchInput ?
                    searchInput.value.trim().toLowerCase() :
                    '';

                let visibleCount = 0;


                projectCards.forEach(function(card) {

                    const scope = card.dataset.scope;
                    const searchText = card.dataset.search || '';

                    const matchesFilter =
                        activeFilter === 'all' ||
                        scope === activeFilter;

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
