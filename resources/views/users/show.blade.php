<x-app-layout>


    <div class="taskflow-user-show-page">

        {{-- Back --}}
        <a href="{{ route('users.index') }}" class="taskflow-user-show-back">
            <i class="bi bi-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}"></i>
            {{ app()->getLocale() === 'ar' ? 'العودة للمستخدمين' : 'Back to Users' }}
        </a>

        {{-- Hero --}}
        <div class="taskflow-user-show-hero">

            <div class="taskflow-user-show-profile">

                <div class="taskflow-user-show-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div class="taskflow-user-show-identity">

                    <div class="taskflow-user-show-eyebrow">
                        <i class="bi bi-person-badge-fill"></i>
                        {{ app()->getLocale() === 'ar' ? 'ملف المستخدم' : 'User Profile' }}
                    </div>

                    <h1>{{ $user->name }}</h1>

                    <p>
                        <i class="bi bi-envelope"></i>
                        {{ $user->email }}
                    </p>

                </div>

            </div>

            <div class="taskflow-user-show-actions">

                <a href="{{ route('users.edit', $user) }}" class="taskflow-user-show-edit">
                    <i class="bi bi-pencil-square"></i>
                    {{ app()->getLocale() === 'ar' ? 'تعديل المستخدم' : 'Edit User' }}
                </a>

            </div>

        </div>

        {{-- Status Cards --}}
        <div class="taskflow-user-show-stats">

            <div class="taskflow-user-show-stat">
                <div class="taskflow-user-show-stat-icon">
                    <i class="bi bi-shield-check"></i>
                </div>

                <div>
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'الدور' : 'Role' }}
                    </span>

                    <strong>
                        {{ ucfirst($user->role) }}
                    </strong>
                </div>
            </div>

            <div class="taskflow-user-show-stat">
                <div class="taskflow-user-show-stat-icon">
                    <i class="bi bi-activity"></i>
                </div>

                <div>
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'الحالة' : 'Status' }}
                    </span>

                    <strong>
                        {{ ucfirst($user->status) }}
                    </strong>
                </div>
            </div>

            <div class="taskflow-user-show-stat">
                <div class="taskflow-user-show-stat-icon">
                    <i class="bi bi-calendar-check"></i>
                </div>

                <div>
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'تاريخ الانضمام' : 'Joined' }}
                    </span>

                    <strong>
                        {{ $user->created_at->format('M d, Y') }}
                    </strong>
                </div>
            </div>

        </div>

        {{-- Information Card --}}
        <div class="taskflow-user-show-card">

            <div class="taskflow-user-show-card-head">

                <div class="taskflow-user-show-card-icon">
                    <i class="bi bi-person-vcard-fill"></i>
                </div>

                <div>
                    <h2>
                        {{ app()->getLocale() === 'ar' ? 'معلومات الحساب' : 'Account Information' }}
                    </h2>

                    <p>
                        {{ app()->getLocale() === 'ar'
                            ? 'تفاصيل الحساب الأساسية والصلاحيات.'
                            : 'Basic account details and access information.' }}
                    </p>
                </div>

            </div>

            <div class="taskflow-user-show-details">

                <div class="taskflow-user-show-detail">

                    <span>
                        <i class="bi bi-person"></i>
                        {{ app()->getLocale() === 'ar' ? 'الاسم' : 'Full Name' }}
                    </span>

                    <strong>{{ $user->name }}</strong>

                </div>

                <div class="taskflow-user-show-detail">

                    <span>
                        <i class="bi bi-envelope"></i>
                        {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }}
                    </span>

                    <strong>{{ $user->email }}</strong>

                </div>

                <div class="taskflow-user-show-detail">

                    <span>
                        <i class="bi bi-shield-fill-check"></i>
                        {{ app()->getLocale() === 'ar' ? 'الدور' : 'Role' }}
                    </span>

                    <strong class="taskflow-user-role">
                        {{ ucfirst($user->role) }}
                    </strong>

                </div>

                <div class="taskflow-user-show-detail">

                    <span>
                        <i class="bi bi-circle-fill"></i>
                        {{ app()->getLocale() === 'ar' ? 'حالة الحساب' : 'Account Status' }}
                    </span>

                    <strong class="taskflow-user-status taskflow-show-status-{{ $user->status }}">
                        <span></span>
                        {{ ucfirst($user->status) }}
                    </strong>

                </div>

                <div class="taskflow-user-show-detail">

                    <span>
                        <i class="bi bi-calendar-plus"></i>
                        {{ app()->getLocale() === 'ar' ? 'تاريخ الإنشاء' : 'Created At' }}
                    </span>

                    <strong>
                        {{ $user->created_at->format('M d, Y - h:i A') }}
                    </strong>

                </div>

                <div class="taskflow-user-show-detail">

                    <span>
                        <i class="bi bi-clock-history"></i>
                        {{ app()->getLocale() === 'ar' ? 'آخر تحديث' : 'Last Updated' }}
                    </span>

                    <strong>
                        {{ $user->updated_at->format('M d, Y - h:i A') }}
                    </strong>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>


<style>
    .taskflow-user-show-page {
        max-width: 1180px;
        margin: 0 auto;
        padding: 24px 28px 45px;
    }

    .taskflow-user-show-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        color: #94a3b8;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: color .2s ease;
    }

    .taskflow-user-show-back:hover {
        color: #38bdf8;
    }


    /* Hero */

    .taskflow-user-show-hero {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        padding: 26px 28px;
        border: 1px solid rgba(148, 163, 184, .13);
        border-radius: 22px;
        background:
            linear-gradient(135deg,
                rgba(30, 41, 59, .92),
                rgba(15, 23, 42, .96));
        box-shadow: 0 20px 50px rgba(2, 6, 23, .25);
    }

    .taskflow-user-show-profile {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .taskflow-user-show-avatar {
        width: 76px;
        height: 76px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
        border-radius: 22px;
        color: #fff;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        font-size: 29px;
        font-weight: 800;
        box-shadow: 0 14px 32px rgba(37, 99, 235, .28);
    }

    .taskflow-user-show-eyebrow {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 5px;
        color: #38bdf8;
        font-size: 12px;
        font-weight: 700;
    }

    .taskflow-user-show-identity h1 {
        margin: 0 0 7px;
        color: #f8fafc;
        font-size: 30px;
        font-weight: 800;
        letter-spacing: -.03em;
    }

    .taskflow-user-show-identity p {
        display: flex;
        align-items: center;
        gap: 7px;
        margin: 0;
        color: #94a3b8;
        font-size: 13px;
    }

    .taskflow-user-show-identity p i {
        color: #64748b;
    }

    .taskflow-user-show-actions {
        flex-shrink: 0;
    }

    .taskflow-user-show-edit {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 17px;
        border-radius: 11px;
        color: #fff;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        box-shadow: 0 10px 25px rgba(37, 99, 235, .22);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .taskflow-user-show-edit:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(37, 99, 235, .32);
    }


    /* Stats */

    .taskflow-user-show-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-top: 18px;
    }

    .taskflow-user-show-stat {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 17px 18px;
        border: 1px solid rgba(148, 163, 184, .12);
        border-radius: 16px;
        background: rgba(15, 23, 42, .76);
        box-shadow: 0 12px 30px rgba(2, 6, 23, .16);
    }

    .taskflow-user-show-stat-icon {
        width: 44px;
        height: 44px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
        border-radius: 12px;
        color: #38bdf8;
        background: rgba(56, 189, 248, .1);
        font-size: 19px;
    }

    .taskflow-user-show-stat span {
        display: block;
        margin-bottom: 4px;
        color: #64748b;
        font-size: 11px;
    }

    .taskflow-user-show-stat strong {
        color: #f8fafc;
        font-size: 15px;
        font-weight: 750;
    }


    /* Main Card */

    .taskflow-user-show-card {
        margin-top: 18px;
        overflow: hidden;
        border: 1px solid rgba(148, 163, 184, .13);
        border-radius: 22px;
        background:
            linear-gradient(145deg,
                rgba(30, 41, 59, .9),
                rgba(15, 23, 42, .95));
        box-shadow: 0 20px 50px rgba(2, 6, 23, .22);
    }

    .taskflow-user-show-card-head {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 22px 26px;
        border-bottom: 1px solid rgba(148, 163, 184, .1);
    }

    .taskflow-user-show-card-icon {
        width: 45px;
        height: 45px;
        display: grid;
        place-items: center;
        border-radius: 13px;
        color: #fff;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        font-size: 18px;
    }

    .taskflow-user-show-card-head h2 {
        margin: 0 0 3px;
        color: #f8fafc;
        font-size: 17px;
        font-weight: 750;
    }

    .taskflow-user-show-card-head p {
        margin: 0;
        color: #64748b;
        font-size: 12px;
    }


    /* Details */

    .taskflow-user-show-details {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .taskflow-user-show-detail {
        padding: 20px 26px;
        border-bottom: 1px solid rgba(148, 163, 184, .08);
    }

    .taskflow-user-show-detail:nth-child(odd) {
        border-right: 1px solid rgba(148, 163, 184, .08);
    }

    .taskflow-user-show-detail span {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 8px;
        color: #64748b;
        font-size: 11px;
        font-weight: 650;
        text-transform: uppercase;
        letter-spacing: .03em;
    }

    .taskflow-user-show-detail span i {
        color: #38bdf8;
    }

    .taskflow-user-show-detail strong {
        display: block;
        color: #e2e8f0;
        font-size: 14px;
        font-weight: 650;
        word-break: break-word;
    }

    .taskflow-user-role {
        color: #c4b5fd !important;
    }

    .taskflow-user-status {
        display: inline-flex !important;
        align-items: center;
        gap: 7px;
    }

    .taskflow-user-status span {
        width: 7px;
        height: 7px;
        margin: 0;
        border-radius: 50%;
        background: currentColor;
    }

    .taskflow-show-status-active {
        color: #86efac !important;
    }

    .taskflow-show-status-inactive {
        color: #fcd34d !important;
    }

    .taskflow-show-status-suspended {
        color: #fca5a5 !important;
    }


    /* Responsive */

    @media (max-width: 800px) {

        .taskflow-user-show-page {
            padding: 20px 16px 35px;
        }

        .taskflow-user-show-hero {
            align-items: flex-start;
            flex-direction: column;
        }

        .taskflow-user-show-actions {
            width: 100%;
        }

        .taskflow-user-show-edit {
            width: 100%;
            justify-content: center;
        }

        .taskflow-user-show-stats {
            grid-template-columns: 1fr;
        }

        .taskflow-user-show-details {
            grid-template-columns: 1fr;
        }

        .taskflow-user-show-detail:nth-child(odd) {
            border-right: 0;
        }
    }

    @media (max-width: 520px) {

        .taskflow-user-show-profile {
            align-items: flex-start;
        }

        .taskflow-user-show-avatar {
            width: 60px;
            height: 60px;
            border-radius: 17px;
            font-size: 23px;
        }

        .taskflow-user-show-identity h1 {
            font-size: 24px;
        }

        .taskflow-user-show-hero {
            padding: 20px;
        }

        .taskflow-user-show-card-head,
        .taskflow-user-show-detail {
            padding-left: 20px;
            padding-right: 20px;
        }
    }

    /* =========================================
    User Show - Light Mode
    ========================================= */

    html[data-theme="light"] .taskflow-user-show-back {
        color: #64748b;
    }

    html[data-theme="light"] .taskflow-user-show-back:hover {
        color: #2563eb;
    }

    /* Hero stays intentionally dark for visual consistency */

    html[data-theme="light"] .taskflow-user-show-stats {
        /* layout only */
    }

    html[data-theme="light"] .taskflow-user-show-stat {
        background: rgba(255, 255, 255, .82);
        border-color: #e2e8f0;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
    }

    html[data-theme="light"] .taskflow-user-show-stat span {
        color: #64748b;
    }

    html[data-theme="light"] .taskflow-user-show-stat strong {
        color: #0f172a;
    }

    html[data-theme="light"] .taskflow-user-show-card {
        background: rgba(255, 255, 255, .88);
        border-color: #e2e8f0;
        box-shadow: 0 20px 50px rgba(15, 23, 42, .10);
    }

    html[data-theme="light"] .taskflow-user-show-card-head {
        border-bottom-color: #edf2f7;
        background: rgba(248, 250, 252, .55);
    }

    html[data-theme="light"] .taskflow-user-show-card-head h2 {
        color: #0f172a;
    }

    html[data-theme="light"] .taskflow-user-show-card-head p {
        color: #64748b;
    }

    html[data-theme="light"] .taskflow-user-show-detail {
        border-bottom-color: #edf2f7;
    }

    html[data-theme="light"] .taskflow-user-show-detail:nth-child(odd) {
        border-right-color: #edf2f7;
    }

    html[data-theme="light"] .taskflow-user-show-detail span {
        color: #64748b;
    }

    html[data-theme="light"] .taskflow-user-show-detail strong {
        color: #334155;
    }

    html[data-theme="light"] .taskflow-user-role {
        color: #6d28d9 !important;
    }

    html[data-theme="light"] .taskflow-show-status-active {
        color: #16a34a !important;
    }

    html[data-theme="light"] .taskflow-show-status-inactive {
        color: #ca8a04 !important;
    }

    html[data-theme="light"] .taskflow-show-status-suspended {
        color: #dc2626 !important;
    }
</style>
