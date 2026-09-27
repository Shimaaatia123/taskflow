<x-app-layout>

    <div class="taskflow-user-edit-page">

        <a href="{{ route('users.show', $user->id) }}" class="taskflow-user-edit-back">
            <i class="bi bi-arrow-left"></i>
            {{ app()->getLocale() === 'ar' ? 'العودة إلى المستخدم' : 'Back to User' }}
        </a>

        <div class="taskflow-user-edit-header">
            <div class="taskflow-user-edit-icon">
                <i class="bi bi-person-gear"></i>
            </div>

            <div>
                <span class="taskflow-user-edit-eyebrow">
                    {{ app()->getLocale() === 'ar' ? 'إدارة المستخدم' : 'USER MANAGEMENT' }}
                </span>

                <h1>
                    {{ app()->getLocale() === 'ar' ? 'تعديل المستخدم' : 'Edit User' }}
                </h1>

                <p>
                    {{ app()->getLocale() === 'ar'
                        ? 'تحديث بيانات وصلاحيات المستخدم'
                        : 'Update user information and account permissions.' }}
                </p>
            </div>
        </div>

        <div class="taskflow-user-edit-card">

            <div class="taskflow-user-edit-profile">
                <div class="taskflow-user-edit-avatar">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                <div>
                    <h2>{{ $user->name }}</h2>
                    <span>{{ $user->email }}</span>
                </div>
            </div>

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="taskflow-user-edit-section">

                    <div class="taskflow-user-edit-section-title">
                        <i class="bi bi-person"></i>
                        {{ app()->getLocale() === 'ar' ? 'المعلومات الأساسية' : 'Basic Information' }}
                    </div>

                    <div class="taskflow-user-edit-grid">

                        <div class="taskflow-user-edit-group">
                            <label for="name">
                                {{ app()->getLocale() === 'ar' ? 'الاسم' : 'Name' }}
                            </label>

                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                required>

                            @error('name')
                                <div class="taskflow-user-edit-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="taskflow-user-edit-group">
                            <label for="email">
                                {{ app()->getLocale() === 'ar' ? 'البريد الإلكتروني' : 'Email Address' }}
                            </label>

                            <input type="email" id="email" name="email"
                                value="{{ old('email', $user->email) }}" required>

                            @error('email')
                                <div class="taskflow-user-edit-error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="taskflow-user-edit-section">

                    <div class="taskflow-user-edit-section-title">
                        <i class="bi bi-shield-lock"></i>
                        {{ app()->getLocale() === 'ar' ? 'الصلاحيات والحالة' : 'Permissions & Status' }}
                    </div>

                    <div class="taskflow-user-edit-grid">

                        <div class="taskflow-user-edit-group">
                            <label for="role">
                                {{ app()->getLocale() === 'ar' ? 'الدور' : 'Role' }}
                            </label>

                            <select id="role" name="role" required>
                                <option value="admin" @selected(old('role', $user->role) === 'admin')>
                                    Admin
                                </option>

                                <option value="manager" @selected(old('role', $user->role) === 'manager')>
                                    Manager
                                </option>

                                <option value="user" @selected(old('role', $user->role) === 'user')>
                                    User
                                </option>
                            </select>

                            @error('role')
                                <div class="taskflow-user-edit-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="taskflow-user-edit-group">
                            <label for="status">
                                {{ app()->getLocale() === 'ar' ? 'حالة الحساب' : 'Account Status' }}
                            </label>

                            <select id="status" name="status" required>
                                <option value="active" @selected(old('status', $user->status) === 'active')>
                                    Active
                                </option>

                                <option value="inactive" @selected(old('status', $user->status) === 'inactive')>
                                    Inactive
                                </option>

                                <option value="suspended" @selected(old('status', $user->status) === 'suspended')>
                                    Suspended
                                </option>
                            </select>

                            @error('status')
                                <div class="taskflow-user-edit-error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="taskflow-user-edit-section">

                    <div class="taskflow-user-edit-section-title">
                        <i class="bi bi-key"></i>
                        {{ app()->getLocale() === 'ar' ? 'تغيير كلمة المرور' : 'Change Password' }}
                    </div>

                    <p class="taskflow-user-edit-password-note">
                        {{ app()->getLocale() === 'ar'
                            ? 'اتركي الحقول فارغة إذا كنتِ لا تريدين تغيير كلمة المرور.'
                            : 'Leave these fields empty if you do not want to change the password.' }}
                    </p>

                    <div class="taskflow-user-edit-grid">

                        <div class="taskflow-user-edit-group">
                            <label for="password">
                                {{ app()->getLocale() === 'ar' ? 'كلمة المرور الجديدة' : 'New Password' }}
                            </label>

                            <input type="password" id="password" name="password">

                            @error('password')
                                <div class="taskflow-user-edit-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="taskflow-user-edit-group">
                            <label for="password_confirmation">
                                {{ app()->getLocale() === 'ar' ? 'تأكيد كلمة المرور' : 'Confirm Password' }}
                            </label>

                            <input type="password" id="password_confirmation" name="password_confirmation">
                        </div>

                    </div>
                </div>

                <div class="taskflow-user-edit-actions">

                    <a href="{{ route('users.show', $user->id) }}" class="taskflow-user-edit-cancel">
                        {{ app()->getLocale() === 'ar' ? 'إلغاء' : 'Cancel' }}
                    </a>

                    <button type="submit" class="taskflow-user-edit-submit">
                        <i class="bi bi-check2-circle"></i>
                        {{ app()->getLocale() === 'ar' ? 'حفظ التعديلات' : 'Save Changes' }}
                    </button>

                </div>

            </form>
        </div>
    </div>

    <style>
        .taskflow-user-edit-page {
            max-width: 1050px;
            margin: 0 auto;
            padding: 28px 28px 50px;
        }

        .taskflow-user-edit-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 22px;
            transition: .2s ease;
        }

        .taskflow-user-edit-back:hover {
            color: #2563eb;
        }

        .taskflow-user-edit-header {
            display: flex;
            align-items: center;
            gap: 18px;
            margin-bottom: 24px;
        }

        .taskflow-user-edit-icon {
            width: 58px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: white;
            font-size: 25px;
            box-shadow: 0 12px 30px rgba(37, 99, 235, .22);
            flex-shrink: 0;
        }

        .taskflow-user-edit-eyebrow {
            color: #6366f1;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .taskflow-user-edit-header h1 {
            margin: 3px 0 4px;
            color: #0f172a;
            font-size: 30px;
            font-weight: 800;
        }

        .taskflow-user-edit-header p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }

        .taskflow-user-edit-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 22px;
            background: rgba(255, 255, 255, .96);
            box-shadow: 0 18px 50px rgba(15, 23, 42, .08);
        }

        .taskflow-user-edit-profile {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 22px 28px;
            border-bottom: 1px solid #e2e8f0;
            background: linear-gradient(135deg, #f8fafc, #eef2ff);
        }

        .taskflow-user-edit-avatar {
            width: 54px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(135deg, #2563eb, #7c3aed);
            color: white;
            font-size: 21px;
            font-weight: 800;
        }

        .taskflow-user-edit-profile h2 {
            margin: 0 0 3px;
            color: #0f172a;
            font-size: 18px;
            font-weight: 800;
        }

        .taskflow-user-edit-profile span {
            color: #64748b;
            font-size: 13px;
        }

        .taskflow-user-edit-card form {
            padding: 26px 28px;
        }

        .taskflow-user-edit-section {
            margin-bottom: 25px;
        }

        .taskflow-user-edit-section-title {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
            color: #1e293b;
            font-size: 15px;
            font-weight: 800;
        }

        .taskflow-user-edit-section-title i {
            color: #6366f1;
            font-size: 17px;
        }

        .taskflow-user-edit-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .taskflow-user-edit-group label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
        }

        .taskflow-user-edit-group input,
        .taskflow-user-edit-group select {
            width: 100%;
            min-height: 46px;
            padding: 10px 13px;
            border: 1px solid #cbd5e1;
            border-radius: 11px;
            background: #fff;
            color: #0f172a;
            font-size: 14px;
            outline: none;
            transition: .2s ease;
        }

        .taskflow-user-edit-group input:focus,
        .taskflow-user-edit-group select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, .10);
        }

        .taskflow-user-edit-error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
            font-weight: 600;
        }

        .taskflow-user-edit-password-note {
            margin: -5px 0 14px;
            color: #64748b;
            font-size: 12px;
        }

        .taskflow-user-edit-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            padding-top: 6px;
            border-top: 1px solid #e2e8f0;
        }

        .taskflow-user-edit-cancel,
        .taskflow-user-edit-submit {
            min-height: 44px;
            padding: 10px 18px;
            border-radius: 11px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .taskflow-user-edit-cancel {
            border: 1px solid #cbd5e1;
            color: #475569;
            background: white;
        }

        .taskflow-user-edit-cancel:hover {
            background: #f8fafc;
            color: #0f172a;
        }

        .taskflow-user-edit-submit {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            border: 0;
            background: linear-gradient(135deg, #2563eb, #6366f1);
            color: white;
            box-shadow: 0 10px 22px rgba(37, 99, 235, .20);
        }

        .taskflow-user-edit-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 13px 26px rgba(37, 99, 235, .26);
        }

        @media (max-width: 700px) {
            .taskflow-user-edit-page {
                padding: 20px 16px 35px;
            }

            .taskflow-user-edit-header {
                align-items: flex-start;
            }

            .taskflow-user-edit-header h1 {
                font-size: 25px;
            }

            .taskflow-user-edit-grid {
                grid-template-columns: 1fr;
            }

            .taskflow-user-edit-card form {
                padding: 22px 18px;
            }

            .taskflow-user-edit-profile {
                padding: 18px;
            }

            .taskflow-user-edit-actions {
                flex-direction: column-reverse;
            }

            .taskflow-user-edit-cancel,
            .taskflow-user-edit-submit {
                width: 100%;
                justify-content: center;
                text-align: center;
            }
        }

        .taskflow-user-edit-page {
            padding-top: 15px;
            padding-bottom: 30px;
        }

        .taskflow-user-edit-back {
            margin-bottom: 12px;
        }

        .taskflow-user-edit-header {
            margin-bottom: 15px;
        }

        .taskflow-user-edit-icon {
            width: 50px;
            height: 50px;
            font-size: 21px;
        }

        .taskflow-user-edit-profile {
            padding: 14px 24px;
        }

        .taskflow-user-edit-avatar {
            width: 46px;
            height: 46px;
            font-size: 18px;
        }

        .taskflow-user-edit-card form {
            padding: 18px 24px;
        }

        .taskflow-user-edit-section {
            margin-bottom: 17px;
        }

        .taskflow-user-edit-section-title {
            margin-bottom: 9px;
        }

        .taskflow-user-edit-grid {
            gap: 12px 18px;
        }

        .taskflow-user-edit-group label {
            margin-bottom: 5px;
        }

        .taskflow-user-edit-group input,
        .taskflow-user-edit-group select {
            min-height: 42px;
            padding: 8px 12px;
        }

        .taskflow-user-edit-password-note {
            margin-bottom: 9px;
        }
    </style>

</x-app-layout>
