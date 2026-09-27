<x-app-layout>

    <div class="taskflow-users-page">

        @if (session('success'))
            <div class="taskflow-alert taskflow-alert-success">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="taskflow-alert taskflow-alert-error">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ session('error') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="taskflow-users-header">
            <div>
                <div class="taskflow-users-eyebrow">
                    <i class="bi bi-people-fill"></i>
                    {{ app()->getLocale() === 'ar' ? 'إدارة المستخدمين' : 'User Management' }}
                </div>

                <h1>
                    {{ app()->getLocale() === 'ar' ? 'المستخدمون' : 'Users' }}
                </h1>

                <p>
                    {{ app()->getLocale() === 'ar'
                        ? 'إدارة حسابات المستخدمين والصلاحيات والحالات من مكان واحد.'
                        : 'Manage user accounts, roles and statuses from one place.' }}
                </p>
            </div>

            <a href="{{ route('users.create') }}" class="taskflow-users-add-btn">
                <i class="bi bi-person-plus-fill"></i>
                {{ app()->getLocale() === 'ar' ? 'إضافة مستخدم' : 'Add User' }}
            </a>
        </div>

        {{-- Stats --}}
        <div class="taskflow-users-stats">

            <div class="taskflow-user-stat">
                <div class="taskflow-user-stat-icon">
                    <i class="bi bi-people-fill"></i>
                </div>

                <div>
                    <span>{{ app()->getLocale() === 'ar' ? 'إجمالي المستخدمين' : 'Total Users' }}</span>
                    <strong>{{ $users->count() }}</strong>
                </div>
            </div>

            <div class="taskflow-user-stat">
                <div class="taskflow-user-stat-icon">
                    <i class="bi bi-person-check-fill"></i>
                </div>

                <div>
                    <span>{{ app()->getLocale() === 'ar' ? 'المستخدمون النشطون' : 'Active Users' }}</span>
                    <strong>{{ $users->where('status', 'active')->count() }}</strong>
                </div>
            </div>

            <div class="taskflow-user-stat">
                <div class="taskflow-user-stat-icon">
                    <i class="bi bi-person-badge-fill"></i>
                </div>

                <div>
                    <span>{{ app()->getLocale() === 'ar' ? 'المديرون' : 'Admins' }}</span>
                    <strong>{{ $users->where('role', 'admin')->count() }}</strong>
                </div>
            </div>

        </div>

        {{-- Users Grid --}}
        <div class="taskflow-users-grid">

            @forelse ($users as $user)
                <div class="taskflow-user-card">

                    <div class="taskflow-user-card-top">

                        <div class="taskflow-user-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div class="taskflow-user-actions">
                            <a href="{{ route('users.show', $user) }}"
                                title="{{ app()->getLocale() === 'ar' ? 'عرض' : 'View' }}">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('users.edit', $user) }}"
                                title="{{ app()->getLocale() === 'ar' ? 'تعديل' : 'Edit' }}">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                onsubmit="return confirm('{{ app()->getLocale() === 'ar' ? 'هل أنت متأكد من حذف هذا المستخدم؟' : 'Are you sure you want to delete this user?' }}');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="taskflow-user-action taskflow-user-delete"
                                    title="{{ app()->getLocale() === 'ar' ? 'حذف' : 'Delete' }}">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>

                    </div>

                    <div class="taskflow-user-info">

                        <h3>{{ $user->name }}</h3>

                        <p>
                            <i class="bi bi-envelope"></i>
                            {{ $user->email }}
                        </p>

                    </div>

                    <div class="taskflow-user-meta">

                        <span class="taskflow-role-badge taskflow-role-{{ $user->role }}">
                            <i class="bi bi-shield-check"></i>
                            {{ ucfirst($user->role) }}
                        </span>

                        <span class="taskflow-status-badge taskflow-status-{{ $user->status }}">
                            <span></span>
                            {{ ucfirst($user->status) }}
                        </span>

                    </div>

                </div>

            @empty

                <div class="taskflow-users-empty">
                    <i class="bi bi-people"></i>

                    <h3>
                        {{ app()->getLocale() === 'ar' ? 'لا يوجد مستخدمون حتى الآن' : 'No users yet' }}
                    </h3>
                </div>
            @endforelse

        </div>

    </div>

</x-app-layout>


<style>
    .taskflow-users-page {
        padding: 34px 28px 50px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .taskflow-users-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 28px;
    }

    .taskflow-users-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
        color: #38bdf8;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: .04em;
    }

    .taskflow-users-header h1 {
        margin: 0;
        color: #f8fafc;
        font-size: 34px;
        font-weight: 800;
        letter-spacing: -.03em;
    }

    .taskflow-users-header p {
        margin: 9px 0 0;
        color: #94a3b8;
        font-size: 14px;
    }

    .taskflow-users-add-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 12px 18px;
        border-radius: 12px;
        color: #fff;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 10px 28px rgba(37, 99, 235, .25);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .taskflow-users-add-btn:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 14px 32px rgba(37, 99, 235, .35);
    }

    .taskflow-users-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    .taskflow-user-stat {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 18px;
        border: 1px solid rgba(148, 163, 184, .12);
        border-radius: 16px;
        background: rgba(15, 23, 42, .72);
        box-shadow: 0 12px 30px rgba(2, 6, 23, .16);
    }

    .taskflow-user-stat-icon {
        width: 46px;
        height: 46px;
        display: grid;
        place-items: center;
        border-radius: 13px;
        color: #38bdf8;
        background: rgba(56, 189, 248, .1);
        font-size: 20px;
    }

    .taskflow-user-stat span {
        display: block;
        margin-bottom: 4px;
        color: #94a3b8;
        font-size: 12px;
    }

    .taskflow-user-stat strong {
        color: #f8fafc;
        font-size: 23px;
    }

    .taskflow-users-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .taskflow-user-card {
        padding: 20px;
        border: 1px solid rgba(148, 163, 184, .12);
        border-radius: 18px;
        background:
            linear-gradient(145deg, rgba(30, 41, 59, .82), rgba(15, 23, 42, .88));
        box-shadow: 0 16px 38px rgba(2, 6, 23, .18);
        transition: transform .22s ease, border-color .22s ease, box-shadow .22s ease;
    }

    .taskflow-user-card:hover {
        transform: translateY(-4px);
        border-color: rgba(56, 189, 248, .25);
        box-shadow: 0 20px 42px rgba(2, 6, 23, .28);
    }

    .taskflow-user-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .taskflow-user-avatar {
        width: 52px;
        height: 52px;
        display: grid;
        place-items: center;
        border-radius: 15px;
        color: #fff;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        font-size: 20px;
        font-weight: 800;
        box-shadow: 0 8px 20px rgba(37, 99, 235, .24);
    }

    .taskflow-user-actions {
        display: flex;
        gap: 7px;
    }

    .taskflow-user-actions a {
        width: 34px;
        height: 34px;
        display: grid;
        place-items: center;
        border-radius: 9px;
        color: #94a3b8;
        background: rgba(148, 163, 184, .08);
        text-decoration: none;
        transition: .2s ease;
    }

    .taskflow-user-actions a:hover {
        color: #fff;
        background: rgba(56, 189, 248, .14);
    }

    .taskflow-user-actions form {
        margin: 0;
    }

    .taskflow-user-actions button {
        width: 34px;
        height: 34px;
        display: grid;
        place-items: center;
        padding: 0;
        border: 0;
        border-radius: 9px;
        color: #94a3b8;
        background: rgba(148, 163, 184, .08);
        cursor: pointer;
        transition: .2s ease;
    }

    .taskflow-user-actions button:hover {
        color: #fca5a5;
        background: rgba(239, 68, 68, .14);
    }

    .taskflow-user-info {
        margin-top: 18px;
    }

    .taskflow-user-info h3 {
        margin: 0 0 7px;
        color: #f8fafc;
        font-size: 17px;
        font-weight: 750;
    }

    .taskflow-user-info p {
        display: flex;
        align-items: center;
        gap: 7px;
        margin: 0;
        color: #94a3b8;
        font-size: 13px;
        word-break: break-word;
    }

    .taskflow-user-info p i {
        color: #64748b;
    }

    .taskflow-user-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid rgba(148, 163, 184, .1);
    }

    .taskflow-role-badge,
    .taskflow-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 9px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
    }

    .taskflow-role-badge {
        color: #c4b5fd;
        background: rgba(124, 58, 237, .12);
    }

    .taskflow-status-badge {
        color: #86efac;
        background: rgba(34, 197, 94, .1);
    }

    .taskflow-status-badge span {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .taskflow-status-inactive {
        color: #fcd34d;
        background: rgba(234, 179, 8, .1);
    }

    .taskflow-status-suspended {
        color: #fca5a5;
        background: rgba(239, 68, 68, .1);
    }

    .taskflow-users-empty {
        grid-column: 1 / -1;
        padding: 70px 20px;
        text-align: center;
        border: 1px dashed rgba(148, 163, 184, .2);
        border-radius: 18px;
        color: #94a3b8;
    }

    .taskflow-users-empty i {
        display: block;
        margin-bottom: 14px;
        font-size: 42px;
    }

    .taskflow-users-empty h3 {
        margin: 0;
        color: #cbd5e1;
        font-size: 16px;
    }

    @media (max-width: 1100px) {
        .taskflow-users-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 760px) {
        .taskflow-users-page {
            padding: 24px 16px 40px;
        }

        .taskflow-users-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .taskflow-users-header h1 {
            font-size: 28px;
        }

        .taskflow-users-add-btn {
            width: 100%;
            justify-content: center;
        }

        .taskflow-users-stats {
            grid-template-columns: 1fr;
        }

        .taskflow-users-grid {
            grid-template-columns: 1fr;
        }
    }

    .taskflow-alert-success {
        animation: taskflow-alert-hide 5s ease forwards;
    }

    .taskflow-alert-error {
        border-color: rgba(239, 68, 68, .25);
        background: rgba(239, 68, 68, .08);
        color: #fca5a5;
        animation: taskflow-alert-hide 5s ease forwards;
    }

    @keyframes taskflow-alert-hide {

        0%,
        75% {
            opacity: 1;
            transform: translateY(0);
            max-height: 60px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        100% {
            opacity: 0;
            transform: translateY(-8px);
            max-height: 0;
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 0;
            padding-bottom: 0;
            border-width: 0;
            overflow: hidden;
        }
    }

    /* =========================================
   Users - Light Mode
   ========================================= */

    html[data-theme="light"] .taskflow-users-header h1 {
        color: #0f172a;
    }

    html[data-theme="light"] .taskflow-users-header p {
        color: #64748b;
    }

    html[data-theme="light"] .taskflow-user-stat {
        background: rgba(255, 255, 255, .82);
        border-color: #e2e8f0;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .08);
    }

    html[data-theme="light"] .taskflow-user-stat span {
        color: #64748b;
    }

    html[data-theme="light"] .taskflow-user-stat strong {
        color: #0f172a;
    }

    html[data-theme="light"] .taskflow-user-card {
        background: rgba(255, 255, 255, .82);
        border-color: #e2e8f0;
        box-shadow: 0 16px 38px rgba(15, 23, 42, .08);
    }

    html[data-theme="light"] .taskflow-user-card:hover {
        border-color: rgba(37, 99, 235, .25);
        box-shadow: 0 20px 42px rgba(15, 23, 42, .12);
    }

    html[data-theme="light"] .taskflow-user-actions a,
    html[data-theme="light"] .taskflow-user-actions button {
        color: #64748b;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }

    html[data-theme="light"] .taskflow-user-actions a:hover {
        color: #2563eb;
        background: #eff6ff;
        border-color: #dbeafe;
    }

    html[data-theme="light"] .taskflow-user-actions button:hover {
        color: #dc2626;
        background: #fef2f2;
        border-color: #fecaca;
    }

    html[data-theme="light"] .taskflow-user-info h3 {
        color: #0f172a;
    }

    html[data-theme="light"] .taskflow-user-info p {
        color: #64748b;
    }

    html[data-theme="light"] .taskflow-user-info p i {
        color: #94a3b8;
    }

    html[data-theme="light"] .taskflow-user-meta {
        border-top-color: #edf2f7;
    }

    html[data-theme="light"] .taskflow-role-badge {
        color: #6d28d9;
        background: #f5f3ff;
    }

    html[data-theme="light"] .taskflow-status-badge {
        color: #16a34a;
        background: #f0fdf4;
    }

    html[data-theme="light"] .taskflow-status-inactive {
        color: #ca8a04;
        background: #fefce8;
    }

    html[data-theme="light"] .taskflow-status-suspended {
        color: #dc2626;
        background: #fef2f2;
    }

    html[data-theme="light"] .taskflow-users-empty {
        border-color: #cbd5e1;
        color: #64748b;
        background: rgba(255, 255, 255, .55);
    }

    html[data-theme="light"] .taskflow-users-empty h3 {
        color: #334155;
    }
</style>
