<x-app-layout>

    <div class="taskflow-user-create-page">

        {{-- Header --}}
        <div class="taskflow-user-create-header">

            <div>
                <a href="{{ route('users.index') }}" class="taskflow-user-back">
                    <i class="bi bi-arrow-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}"></i>
                    {{ app()->getLocale() === 'ar' ? 'العودة للمستخدمين' : 'Back to Users' }}
                </a>

                <div class="taskflow-user-create-eyebrow">
                    <i class="bi bi-person-plus-fill"></i>
                    {{ app()->getLocale() === 'ar' ? 'إدارة المستخدمين' : 'User Management' }}
                </div>

                <h1>
                    {{ app()->getLocale() === 'ar' ? 'إضافة مستخدم جديد' : 'Create New User' }}
                </h1>

                <p>
                    {{ app()->getLocale() === 'ar'
                        ? 'أنشئ حساب مستخدم جديد وحدد دوره وحالته داخل النظام.'
                        : 'Create a new user account and define their role and status.' }}
                </p>
            </div>

        </div>

        {{-- Form Card --}}
        <div class="taskflow-user-create-card">

            <div class="taskflow-user-create-card-head">
                <div class="taskflow-create-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div>
                    <h2>
                        {{ app()->getLocale() === 'ar' ? 'بيانات المستخدم' : 'User Information' }}
                    </h2>

                    <span>
                        {{ app()->getLocale() === 'ar' ? 'أدخل البيانات الأساسية للحساب.' : 'Enter the basic account information.' }}
                    </span>
                </div>
            </div>

            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="taskflow-user-form-grid">

                    {{-- Name --}}
                    <div class="taskflow-user-field">
                        <label for="name">
                            <i class="bi bi-person"></i>
                            {{ app()->getLocale() === 'ar' ? 'الاسم' : 'Full Name' }}
                        </label>

                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل اسم المستخدم' : 'Enter user name' }}"
                            required>

                        @error('name')
                            <div class="taskflow-user-error">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="taskflow-user-field">
                        <label for="email">
                            <i class="bi bi-envelope"></i>
                            {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }}
                        </label>

                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="{{ app()->getLocale() === 'ar' ? 'example@email.com' : 'example@email.com' }}"
                            required>

                        @error('email')
                            <div class="taskflow-user-error">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="taskflow-user-field">
                        <label for="password">
                            <i class="bi bi-lock"></i>
                            {{ app()->getLocale() === 'ar' ? 'كلمة المرور' : 'Password' }}
                        </label>

                        <input type="password" id="password" name="password"
                            placeholder="{{ app()->getLocale() === 'ar' ? 'أدخل كلمة مرور قوية' : 'Enter a strong password' }}"
                            required>

                        @error('password')
                            <div class="taskflow-user-error">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="taskflow-user-field">
                        <label for="password_confirmation">
                            <i class="bi bi-shield-lock"></i>
                            {{ app()->getLocale() === 'ar' ? 'تأكيد كلمة المرور' : 'Confirm Password' }}
                        </label>

                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="{{ app()->getLocale() === 'ar' ? 'أعد كتابة كلمة المرور' : 'Repeat the password' }}"
                            required>
                    </div>

                    {{-- Role --}}
                    <div class="taskflow-user-field">
                        <label for="role">
                            <i class="bi bi-shield-check"></i>
                            {{ app()->getLocale() === 'ar' ? 'الدور' : 'Role' }}
                        </label>

                        <select id="role" name="role" required>
                            <option value="">
                                {{ app()->getLocale() === 'ar' ? 'اختر الدور' : 'Select a role' }}
                            </option>

                            <option value="admin" @selected(old('role') === 'admin')>
                                {{ app()->getLocale() === 'ar' ? 'مدير النظام' : 'Admin' }}
                            </option>

                            <option value="manager" @selected(old('role') === 'manager')>
                                {{ app()->getLocale() === 'ar' ? 'مدير' : 'Manager' }}
                            </option>

                            <option value="user" @selected(old('role') === 'user')>
                                {{ app()->getLocale() === 'ar' ? 'مستخدم' : 'User' }}
                            </option>
                        </select>

                        @error('role')
                            <div class="taskflow-user-error">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="taskflow-user-field">
                        <label for="status">
                            <i class="bi bi-activity"></i>
                            {{ app()->getLocale() === 'ar' ? 'الحالة' : 'Status' }}
                        </label>

                        <select id="status" name="status" required>
                            <option value="active" @selected(old('status', 'active') === 'active')>
                                {{ app()->getLocale() === 'ar' ? 'نشط' : 'Active' }}
                            </option>

                            <option value="inactive" @selected(old('status') === 'inactive')>
                                {{ app()->getLocale() === 'ar' ? 'غير نشط' : 'Inactive' }}
                            </option>

                            <option value="suspended" @selected(old('status') === 'suspended')>
                                {{ app()->getLocale() === 'ar' ? 'موقوف' : 'Suspended' }}
                            </option>
                        </select>

                        @error('status')
                            <div class="taskflow-user-error">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                {{-- Footer --}}
                <div class="taskflow-user-form-footer">

                    <a href="{{ route('users.index') }}" class="taskflow-user-cancel">
                        {{ app()->getLocale() === 'ar' ? 'إلغاء' : 'Cancel' }}
                    </a>

                    <button type="submit" class="taskflow-user-submit">
                        <i class="bi bi-person-plus-fill"></i>
                        {{ app()->getLocale() === 'ar' ? 'إنشاء المستخدم' : 'Create User' }}
                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>


<style>
    .taskflow-user-create-page {
        max-width: 1050px;
        margin: 0 auto;
        padding: 6px 28px 30px;
    }

    .taskflow-user-create-header {
        margin-bottom: 2px;
    }

    .taskflow-user-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 22px;
        color: #94a3b8;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: color .2s ease;
    }

    .taskflow-user-back:hover {
        color: #38bdf8;
    }

    .taskflow-user-create-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 3px;
        color: #38bdf8;
        font-size: 13px;
        font-weight: 700;
    }

    .taskflow-user-create-header h1 {
        margin: 0;
        position: relative;
        top: -10px;
        color: #f8fafc;
        font-size: 34px;
        font-weight: 800;
        letter-spacing: -.03em;
    }

    .taskflow-user-create-header p {
        margin: 9px 0 0;
        position: relative;
        top: -10px;
        color: #94a3b8;
        font-size: 14px;
    }

    .taskflow-user-create-card {
        overflow: hidden;
        border: 1px solid rgba(148, 163, 184, .13);
        border-radius: 22px;
        background:
            linear-gradient(145deg, rgba(30, 41, 59, .9), rgba(15, 23, 42, .94));
        box-shadow: 0 24px 60px rgba(2, 6, 23, .28);
    }

    .taskflow-user-create-card-head {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 25px 28px;
        border-bottom: 1px solid rgba(148, 163, 184, .1);
        background: rgba(15, 23, 42, .28);
    }

    .taskflow-create-avatar {
        width: 52px;
        height: 52px;
        display: grid;
        place-items: center;
        border-radius: 15px;
        color: #fff;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        font-size: 21px;
        box-shadow: 0 10px 25px rgba(37, 99, 235, .25);
    }

    .taskflow-user-create-card-head h2 {
        margin: 0 0 4px;
        color: #f8fafc;
        font-size: 17px;
        font-weight: 750;
    }

    .taskflow-user-create-card-head span {
        color: #64748b;
        font-size: 12px;
    }

    .taskflow-user-create-card form {
        padding: 10px 28px;

    }

    .taskflow-user-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
    }

    .taskflow-user-field label {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 9px;
        color: #cbd5e1;
        font-size: 13px;
        font-weight: 700;
    }

    .taskflow-user-field label i {
        color: #38bdf8;
    }

    .taskflow-user-field input,
    .taskflow-user-field select {
        width: 100%;
        min-height: 48px;
        padding: 11px 14px;
        border: 1px solid rgba(148, 163, 184, .16);
        border-radius: 12px;
        outline: none;
        color: #f8fafc;
        background: rgba(15, 23, 42, .75);
        font-size: 13px;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .taskflow-user-field input::placeholder {
        color: #64748b;
    }

    .taskflow-user-field input:focus,
    .taskflow-user-field select:focus {
        border-color: rgba(56, 189, 248, .55);
        box-shadow: 0 0 0 3px rgba(56, 189, 248, .08);
    }

    .taskflow-user-field select option {
        color: #0f172a;
        background: #fff;
    }

    .taskflow-user-error {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 7px;
        color: #fca5a5;
        font-size: 11px;
    }

    .taskflow-user-form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 11px;
        margin-top: 30px;
        padding-top: 22px;
        border-top: 1px solid rgba(148, 163, 184, .1);
    }

    .taskflow-user-cancel,
    .taskflow-user-submit {
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 18px;
        border-radius: 11px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .taskflow-user-cancel {
        color: #cbd5e1;
        border: 1px solid rgba(148, 163, 184, .15);
        background: rgba(148, 163, 184, .06);
    }

    .taskflow-user-cancel:hover {
        color: #fff;
        background: rgba(148, 163, 184, .1);
    }

    .taskflow-user-submit {
        border: 0;
        color: #fff;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        box-shadow: 0 10px 25px rgba(37, 99, 235, .22);
    }

    .taskflow-user-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(37, 99, 235, .32);
    }

    @media (max-width: 700px) {
        .taskflow-user-create-page {
            padding: 24px 16px 45px;
        }

        .taskflow-user-create-header h1 {
            font-size: 28px;
        }

        .taskflow-user-form-grid {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .taskflow-user-create-card-head,
        .taskflow-user-create-card form {
            padding: 20px;
        }

        .taskflow-user-form-footer {
            flex-direction: column-reverse;
        }

        .taskflow-user-cancel,
        .taskflow-user-submit {
            width: 100%;
        }
    }

    .taskflow-user-create-header h1,
    .taskflow-user-create-header p,
    .taskflow-user-create-card {
        position: relative;
        top: -34px;
    }

    /* =========================================
   User Create - Light Mode
   ========================================= */

    html[data-theme="light"] .taskflow-user-back {
        color: #64748b;
    }

    html[data-theme="light"] .taskflow-user-back:hover {
        color: #2563eb;
    }

    html[data-theme="light"] .taskflow-user-create-header h1 {
        color: #0f172a;
    }

    html[data-theme="light"] .taskflow-user-create-header p {
        color: #64748b;
    }

    html[data-theme="light"] .taskflow-user-create-card {
        border-color: #e2e8f0;
        background: rgba(255, 255, 255, .88);
        box-shadow: 0 24px 60px rgba(15, 23, 42, .10);
    }

    html[data-theme="light"] .taskflow-user-create-card-head {
        border-bottom-color: #edf2f7;
        background: rgba(248, 250, 252, .72);
    }

    html[data-theme="light"] .taskflow-user-create-card-head h2 {
        color: #0f172a;
    }

    html[data-theme="light"] .taskflow-user-create-card-head span {
        color: #64748b;
    }

    html[data-theme="light"] .taskflow-user-field label {
        color: #334155;
    }

    html[data-theme="light"] .taskflow-user-field input,
    html[data-theme="light"] .taskflow-user-field select {
        color: #0f172a;
        background: #f8fafc;
        border-color: #e2e8f0;
    }

    html[data-theme="light"] .taskflow-user-field input::placeholder {
        color: #94a3b8;
    }

    html[data-theme="light"] .taskflow-user-field input:focus,
    html[data-theme="light"] .taskflow-user-field select:focus {
        background: #fff;
        border-color: rgba(37, 99, 235, .45);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
    }

    html[data-theme="light"] .taskflow-user-field select option {
        color: #0f172a;
        background: #fff;
    }

    html[data-theme="light"] .taskflow-user-form-footer {
        border-top-color: #edf2f7;
    }

    html[data-theme="light"] .taskflow-user-cancel {
        color: #475569;
        border-color: #e2e8f0;
        background: #f8fafc;
    }

    html[data-theme="light"] .taskflow-user-cancel:hover {
        color: #0f172a;
        background: #f1f5f9;
    }

    html[data-theme="light"] .taskflow-user-error {
        color: #dc2626;
    }
</style>
