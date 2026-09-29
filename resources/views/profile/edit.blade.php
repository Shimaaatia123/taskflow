<x-app-layout>
    <div class="taskflow-profile-page">

        <!-- Profile Hero -->
        <section class="taskflow-profile-hero">
            <div class="taskflow-profile-hero-glow taskflow-profile-hero-glow-one"></div>
            <div class="taskflow-profile-hero-glow taskflow-profile-hero-glow-two"></div>

            <div class="taskflow-profile-hero-content">
                <div class="taskflow-profile-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div class="taskflow-profile-hero-info">
                    <span class="taskflow-profile-eyebrow">
                        <i class="bi bi-person-badge-fill"></i>
                        {{ app()->getLocale() === 'ar' ? 'الحساب الشخصي' : 'PERSONAL ACCOUNT' }}
                    </span>

                    <h1>{{ Auth::user()->name }}</h1>

                    <p>
                        {{ Auth::user()->email }}
                    </p>
                </div>

                <div class="taskflow-profile-hero-status">
                    <span class="taskflow-profile-status-dot"></span>
                    <span>
                        {{ app()->getLocale() === 'ar' ? 'الحساب نشط' : 'Account Active' }}
                    </span>
                </div>
            </div>
        </section>

        <!-- Profile Sections -->
        <div class="taskflow-profile-sections">

            <!-- Profile Information -->
            <section class="taskflow-profile-card">
                <div class="taskflow-profile-card-accent"></div>

                <div class="taskflow-profile-section-heading">
                    <div class="taskflow-profile-section-icon profile-icon">
                        <i class="bi bi-person-vcard-fill"></i>
                    </div>

                    <div>
                        <span class="taskflow-profile-section-label">
                            {{ app()->getLocale() === 'ar' ? 'المعلومات الشخصية' : 'PERSONAL DETAILS' }}
                        </span>

                        <h2>
                            {{ __('Profile Information') }}
                        </h2>

                        <p>
                            {{ app()->getLocale() === 'ar'
                                ? 'حدّث اسمك وبريدك الإلكتروني المرتبط بحسابك.'
                                : 'Update your name and email address associated with your account.' }}
                        </p>
                    </div>
                </div>

                <div class="taskflow-profile-card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </section>

            <!-- Password -->
            <section class="taskflow-profile-card">
                <div class="taskflow-profile-card-accent password-accent"></div>

                <div class="taskflow-profile-section-heading">
                    <div class="taskflow-profile-section-icon password-icon">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>

                    <div>
                        <span class="taskflow-profile-section-label">
                            {{ app()->getLocale() === 'ar' ? 'الأمان' : 'SECURITY' }}
                        </span>

                        <h2>
                            {{ __('Update Password') }}
                        </h2>

                        <p>
                            {{ app()->getLocale() === 'ar'
                                ? 'حافظي على أمان حسابك باستخدام كلمة مرور قوية وفريدة.'
                                : 'Keep your account secure with a strong and unique password.' }}
                        </p>
                    </div>
                </div>

                <div class="taskflow-profile-card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </section>

            <!-- Delete Account -->
            <section class="taskflow-profile-card taskflow-profile-danger-card">
                <div class="taskflow-profile-card-accent danger-accent"></div>

                <div class="taskflow-profile-section-heading">
                    <div class="taskflow-profile-section-icon danger-icon">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>

                    <div>
                        <span class="taskflow-profile-section-label">
                            {{ app()->getLocale() === 'ar' ? 'منطقة حساسة' : 'DANGER ZONE' }}
                        </span>

                        <h2>
                            {{ __('Delete Account') }}
                        </h2>

                        <p>
                            {{ app()->getLocale() === 'ar'
                                ? 'حذف الحساب إجراء نهائي ولا يمكن التراجع عنه.'
                                : 'Account deletion is permanent and cannot be undone.' }}
                        </p>
                    </div>
                </div>

                <div class="taskflow-profile-card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </section>

        </div>

    </div>
</x-app-layout>
