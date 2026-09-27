<!-- =========================================================
     TaskFlow Sidebar
     ========================================================= -->

<aside class="taskflow-sidebar" id="taskflowSidebar">


    <!-- Brand -->
    <div class="taskflow-sidebar-brand">

        <a href="{{ LaravelLocalization::localizeUrl('/dashboard') }}" class="taskflow-brand-link">

            <span class="taskflow-brand-icon">
                <i class="bi bi-check2-square"></i>
            </span>

            <span class="taskflow-brand-name">
                Task<span>Flow</span>
            </span>

        </a>

    </div>


    <!-- Navigation -->
    <div class="taskflow-sidebar-content">

        <div class="taskflow-nav-section">

            <div class="taskflow-nav-title">
                {{ app()->getLocale() === 'ar' ? 'الرئيسية' : 'MAIN' }}
            </div>

            <!-- Dashboard -->
            <a href="{{ LaravelLocalization::localizeUrl('/dashboard') }}"
                class="taskflow-sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="taskflow-sidebar-icon">
                    <i class="bi bi-grid-1x2-fill"></i>
                </span>

                <span>
                    {{ app()->getLocale() === 'ar' ? 'لوحة التحكم' : 'Dashboard' }}
                </span>
            </a>


            <!-- Projects -->
            <span class="taskflow-sidebar-link disabled">

                <span class="taskflow-sidebar-icon">
                    <i class="bi bi-kanban-fill"></i>
                </span>

                <span>
                    {{ app()->getLocale() === 'ar' ? 'المشروعات' : 'Projects' }}
                </span>

            </span>


            <!-- Tasks -->
            <span class="taskflow-sidebar-link disabled">

                <span class="taskflow-sidebar-icon">
                    <i class="bi bi-list-check"></i>
                </span>

                <span>
                    {{ app()->getLocale() === 'ar' ? 'المهام' : 'Tasks' }}
                </span>

            </span>

        </div>


        <!-- Account -->
        <div class="taskflow-nav-section taskflow-account-section">

            <div class="taskflow-nav-title">
                {{ app()->getLocale() === 'ar' ? 'الحساب' : 'ACCOUNT' }}
            </div>

            <!-- Profile -->
            @auth
                <a href="{{ LaravelLocalization::localizeUrl('/profile') }}" class="taskflow-sidebar-link">
                    <span class="taskflow-sidebar-icon">
                        <i class="bi bi-person-circle"></i>
                    </span>

                    <span>
                        {{ app()->getLocale() === 'ar' ? 'الملف الشخصي' : 'Profile' }}
                    </span>
                </a>
            @endauth

        </div>

    </div>


    <!-- Sidebar Footer -->
    @auth
        <div class="taskflow-sidebar-footer">

            <div class="taskflow-sidebar-user">

                <span class="taskflow-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </span>

                <div class="taskflow-sidebar-user-info">

                    <strong>
                        {{ Auth::user()->name }}
                    </strong>

                    <small>
                        {{ Auth::user()->email }}
                    </small>

                </div>

            </div>


            <!-- Logout -->
            <form method="POST" action="{{ LaravelLocalization::localizeUrl('/logout') }}" class="mt-2">
                @csrf

                <button type="submit" class="taskflow-sidebar-logout">
                    <i class="bi bi-box-arrow-right"></i>

                    <span>
                        {{ app()->getLocale() === 'ar' ? 'تسجيل الخروج' : 'Log Out' }}
                    </span>
                </button>

            </form>

        </div>
    @endauth


</aside>

<!-- =========================================================
     TaskFlow Topbar
     ========================================================= -->

<header class="taskflow-topbar">


    <div class="taskflow-topbar-left">

        <!-- Mobile Sidebar Toggle -->
        <button type="button" class="taskflow-sidebar-toggle" id="taskflowSidebarToggle" aria-label="Toggle sidebar">
            <i class="bi bi-list"></i>
        </button>

        <!-- Page Area -->
        <div class="taskflow-topbar-title">

            <i class="bi bi-grid-1x2-fill"></i>

            <span>
                {{ app()->getLocale() === 'ar' ? 'لوحة التحكم' : 'Dashboard' }}
            </span>

        </div>

    </div>


    <!-- Topbar Right -->
    <div class="taskflow-topbar-right">

        <!-- Theme Toggle -->
        <button type="button" class="taskflow-theme-toggle" id="taskflowThemeToggle" aria-label="Toggle dark mode"
            title="Toggle dark mode">

            <i class="bi bi-moon-stars-fill" id="taskflowThemeIcon"></i>

            <span class="d-none d-lg-inline" id="taskflowThemeText">
                Dark Mode
            </span>

        </button>

        <!-- Language -->
        <div class="dropdown">

            <button class="taskflow-topbar-btn dropdown-toggle" type="button" id="taskflowLanguageDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-translate"></i>

                <span class="d-none d-sm-inline">
                    {{ app()->getLocale() === 'ar' ? 'العربية' : 'English' }}
                </span>
            </button>


            <ul class="dropdown-menu dropdown-menu-end taskflow-dropdown" aria-labelledby="taskflowLanguageDropdown">

                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>

                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                            class="dropdown-item {{ app()->getLocale() === $localeCode ? 'active' : '' }}">

                            <i class="bi bi-{{ $localeCode === 'ar' ? 'translate' : 'globe2' }} me-2"></i>

                            {{ $properties['native'] }}

                        </a>

                    </li>
                @endforeach

            </ul>

        </div>


        <!-- User -->
        @auth

            <div class="dropdown">

                <button class="taskflow-topbar-user dropdown-toggle" type="button" id="taskflowUserDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">

                    <span class="taskflow-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>

                    <span class="d-none d-md-inline">
                        {{ Auth::user()->name }}
                    </span>

                </button>


                <ul class="dropdown-menu dropdown-menu-end taskflow-dropdown" aria-labelledby="taskflowUserDropdown">

                    <li>

                        <div class="taskflow-user-info">

                            <strong>
                                {{ Auth::user()->name }}
                            </strong>

                            <small>
                                {{ Auth::user()->email }}
                            </small>

                        </div>

                    </li>


                    <li>
                        <hr class="dropdown-divider">
                    </li>


                    <li>

                        <a href="{{ LaravelLocalization::localizeUrl('/profile') }}" class="dropdown-item">
                            <i class="bi bi-person-circle me-2"></i>

                            {{ app()->getLocale() === 'ar' ? 'الملف الشخصي' : 'Profile' }}

                        </a>

                    </li>


                    <li>

                        <form method="POST" action="{{ LaravelLocalization::localizeUrl('/logout') }}">
                            @csrf

                            <button type="submit" class="dropdown-item taskflow-logout">

                                <i class="bi bi-box-arrow-right me-2"></i>

                                {{ app()->getLocale() === 'ar' ? 'تسجيل الخروج' : 'Log Out' }}

                            </button>

                        </form>

                    </li>

                </ul>

            </div>

        @endauth

    </div>


</header>

<!-- =========================================================
     Mobile Sidebar Overlay
     ========================================================= -->

<div class="taskflow-sidebar-overlay" id="taskflowSidebarOverlay"></div>

<!-- =========================================================
     Sidebar Toggle Script
     ========================================================= -->


<script>
    document.addEventListener('DOMContentLoaded', function() {

        /* =====================================================
           Sidebar
           ===================================================== */

        const sidebar = document.getElementById('taskflowSidebar');
        const toggle = document.getElementById('taskflowSidebarToggle');
        const overlay = document.getElementById('taskflowSidebarOverlay');

        if (sidebar && toggle && overlay) {

            toggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            });

            overlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
        }


        /* =====================================================
           Theme Toggle
           ===================================================== */

        const themeToggle = document.getElementById('taskflowThemeToggle');
        const themeIcon = document.getElementById('taskflowThemeIcon');
        const themeText = document.getElementById('taskflowThemeText');

        if (!themeToggle || !themeIcon) {
            return;
        }

        function applyTheme(theme) {

            document.documentElement.setAttribute('data-theme', theme);

            const isDark = theme === 'dark';

            themeIcon.className = isDark ?
                'bi bi-sun-fill' :
                'bi bi-moon-stars-fill';

            const isArabic = document.documentElement.lang === 'ar';

            themeToggle.setAttribute(
                'aria-label',
                isArabic ?
                (isDark ? 'التبديل إلى الوضع الفاتح' : 'التبديل إلى الوضع الداكن') :
                (isDark ? 'Switch to light mode' : 'Switch to dark mode')
            );

            themeToggle.setAttribute(
                'title',
                isArabic ?
                (isDark ? 'التبديل إلى الوضع الفاتح' : 'التبديل إلى الوضع الداكن') :
                (isDark ? 'Switch to light mode' : 'Switch to dark mode')
            );

            if (themeText) {
                themeText.textContent = isArabic ?
                    (isDark ? 'الوضع الفاتح' : 'الوضع الداكن') :
                    (isDark ? 'Light Mode' : 'Dark Mode');
            }
        }


        const savedTheme = localStorage.getItem('taskflow-theme');

        const initialTheme =
            savedTheme === 'dark' ? 'dark' : 'light';

        applyTheme(initialTheme);


        themeToggle.addEventListener('click', function() {

            const currentTheme =
                document.documentElement.getAttribute('data-theme');

            const newTheme =
                currentTheme === 'dark' ? 'light' : 'dark';

            localStorage.setItem('taskflow-theme', newTheme);

            applyTheme(newTheme);
        });

    });
</script>
