<x-guest-layout>

    <div
        class="relative flex h-dvh w-full overflow-hidden bg-[#020617] text-white
               pb-[env(safe-area-inset-bottom)] pt-[env(safe-area-inset-top)]"
        dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
    >

        {{-- =========================================================
            LEFT SHOWCASE PANEL (desktop / large screens only)
        ========================================================== --}}

        <div
            class="relative hidden min-h-0 w-1/2 shrink-0 flex-col justify-between
                   gap-10 overflow-y-auto border-e border-white/[0.06]
                   bg-gradient-to-br from-[#050914] via-[#070c1c] to-[#020617]
                   px-14 py-12 lg:flex xl:px-20"
        >

            {{-- Ambient glows --}}
            <div class="pointer-events-none absolute inset-0 overflow-hidden">

                <div class="absolute -left-32 -top-32 h-[28rem] w-[28rem] rounded-full bg-indigo-600/[0.16] blur-[110px]"></div>
                <div class="absolute -bottom-40 -right-20 h-[26rem] w-[26rem] rounded-full bg-cyan-500/[0.10] blur-[110px]"></div>
                <div class="absolute right-1/3 top-1/4 h-64 w-64 rounded-full bg-purple-600/[0.10] blur-[100px]"></div>

                {{-- Grid --}}
                <div
                    class="absolute inset-0 opacity-[0.03]"
                    style="
                        background-image:
                            linear-gradient(rgba(255,255,255,.8) 1px, transparent 1px),
                            linear-gradient(90deg, rgba(255,255,255,.8) 1px, transparent 1px);
                        background-size: 48px 48px;
                    "
                ></div>

                {{-- Stars --}}
                <span class="absolute left-[15%] top-[18%] h-1 w-1 rounded-full bg-white/60 shadow-[0_0_10px_2px_rgba(255,255,255,.35)] motion-safe:animate-pulse"></span>
                <span class="absolute left-[35%] top-[12%] h-0.5 w-0.5 rounded-full bg-cyan-300/80 shadow-[0_0_8px_2px_rgba(103,232,249,.45)] motion-safe:animate-pulse"></span>
                <span class="absolute left-[60%] top-[22%] h-1 w-1 rounded-full bg-indigo-300/70 shadow-[0_0_12px_2px_rgba(165,180,252,.4)] motion-safe:animate-pulse"></span>
                <span class="absolute left-[20%] top-[70%] h-0.5 w-0.5 rounded-full bg-white/60 shadow-[0_0_8px_2px_rgba(255,255,255,.4)] motion-safe:animate-pulse"></span>
                <span class="absolute left-[75%] top-[65%] h-1 w-1 rounded-full bg-purple-300/60 shadow-[0_0_10px_2px_rgba(216,180,254,.35)] motion-safe:animate-pulse"></span>
                <span class="absolute left-[45%] top-[80%] h-0.5 w-0.5 rounded-full bg-cyan-300/70 shadow-[0_0_8px_2px_rgba(103,232,249,.4)] motion-safe:animate-pulse"></span>

                {{-- Sparkles --}}
                <svg class="absolute left-[70%] top-[15%] h-4 w-4 text-cyan-300 opacity-60 motion-safe:animate-pulse" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2L13.5 9.5L21 12L13.5 14.5L12 22L10.5 14.5L3 12L10.5 9.5L12 2Z" fill="currentColor" />
                </svg>
                <svg class="absolute left-[25%] top-[55%] h-3 w-3 text-indigo-300 opacity-50 motion-safe:animate-pulse" viewBox="0 0 24 24" fill="none">
                    <path d="M12 2L13.5 9.5L21 12L13.5 14.5L12 22L10.5 14.5L3 12L10.5 9.5L12 2Z" fill="currentColor" />
                </svg>
            </div>

            {{-- Brand --}}
            <a href="{{ url('/') }}" class="group relative z-10 inline-flex shrink-0 items-center gap-3" aria-label="TaskFlow Home">

                <span
                    class="relative flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden
                           rounded-2xl border border-white/10 bg-white/[0.055]
                           shadow-[0_0_30px_rgba(99,102,241,.20)] backdrop-blur-xl
                           transition duration-300 group-hover:scale-105 group-hover:border-cyan-400/30"
                >
                    <span class="absolute inset-0 bg-gradient-to-br from-indigo-500/20 via-cyan-400/10 to-purple-500/20"></span>
                    <svg class="relative h-6 w-6 text-cyan-300" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M5 12.5L9.2 16.5L19 6.5" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4 5.5H10" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" opacity=".45" />
                    </svg>
                </span>

                <span class="text-left">
                    <span class="block text-lg font-bold tracking-tight text-white">
                        Task<span class="text-cyan-300">Flow</span>
                    </span>
                    <span class="block text-[9px] font-medium uppercase tracking-[0.26em] text-slate-500">
                        Work. Organize. Deliver.
                    </span>
                </span>

            </a>

            {{-- Headline + reassurance points --}}
            <div class="relative z-10 shrink-0">

                <span
                    class="mb-5 inline-flex items-center gap-2 rounded-full border border-cyan-400/20
                           bg-cyan-400/[0.06] px-3 py-1.5 text-[10px] font-semibold uppercase
                           tracking-[0.14em] text-cyan-300"
                >
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <rect x="5" y="10" width="14" height="10" rx="2" stroke="currentColor" stroke-width="1.7" />
                        <path d="M8 10V7.5a4 4 0 0 1 8 0V10" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                    </svg>
                    {{ __('Account security') }}
                </span>

                <h2 class="max-w-md text-2xl font-bold leading-tight tracking-tight text-white xl:text-4xl">
                    {{ __('Set a new password for your workspace.') }}
                </h2>

                <p class="mt-3 max-w-sm text-sm text-slate-400">
                    {{ __('Choose a strong password you don\'t use anywhere else. You\'ll be signed back in right after.') }}
                </p>

                <ul class="mt-6 space-y-3 xl:mt-8 xl:space-y-4">

                    @foreach ([
                        __('This reset link is single-use and time-limited'),
                        __('Your new password is encrypted end-to-end'),
                        __('You\'ll stay signed in on this device'),
                    ] as $point)
                        <li class="flex items-center gap-3 text-sm text-slate-300">
                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full border border-cyan-400/30 bg-cyan-400/10">
                                <svg class="h-3.5 w-3.5 text-cyan-300" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M5 12.5L9.2 16.5L19 6.5" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            {{ $point }}
                        </li>
                    @endforeach

                </ul>

            </div>

            {{-- Footer --}}
            <p class="relative z-10 shrink-0 text-[11px] text-slate-600">
                © {{ date('Y') }} TaskFlow. {{ __('Built for focused work and better teamwork.') }}
            </p>

        </div>


        {{-- =========================================================
            RIGHT — FORM PANEL (always visible, full width on mobile)
        ========================================================== --}}

        <div class="relative flex min-h-0 w-full flex-1 items-center justify-center overflow-y-auto px-5 py-5 sm:px-8 lg:w-1/2 lg:px-10">

            {{-- Background glow --}}
            <div class="pointer-events-none absolute inset-0 overflow-hidden">
                <div class="absolute left-1/2 top-[-10rem] h-[26rem] w-[26rem] -translate-x-1/2 rounded-full bg-indigo-600/[0.10] blur-[100px]"></div>
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_20%,rgba(2,6,23,.4)_75%,rgba(2,6,23,.9)_100%)]"></div>
            </div>

            <div class="relative z-10 w-full max-w-sm py-2 md:max-w-md lg:max-w-sm">

                {{-- Mobile-only brand --}}
                <div class="mb-6 text-center lg:hidden">

                    <a href="{{ url('/') }}" class="group inline-flex items-center gap-3" aria-label="TaskFlow Home">

                        <span
                            class="relative flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden
                                   rounded-2xl border border-white/10 bg-white/[0.055]
                                   shadow-[0_0_30px_rgba(99,102,241,.20)] backdrop-blur-xl
                                   transition duration-300 group-hover:scale-105 group-hover:border-cyan-400/30"
                        >
                            <span class="absolute inset-0 bg-gradient-to-br from-indigo-500/20 via-cyan-400/10 to-purple-500/20"></span>
                            <svg class="relative h-5 w-5 text-cyan-300" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M5 12.5L9.2 16.5L19 6.5" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4 5.5H10" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" opacity=".45" />
                            </svg>
                        </span>

                        <span class="text-left">
                            <span class="block text-base font-bold tracking-tight text-white">
                                Task<span class="text-cyan-300">Flow</span>
                            </span>
                        </span>

                    </a>

                </div>

                {{-- Icon badge (desktop, above heading — mirrors the lock icon feel of the left panel) --}}
                <div class="mb-4 hidden justify-start lg:flex">
                    <span class="flex h-12 w-12 items-center justify-center rounded-2xl border border-cyan-400/20 bg-cyan-400/[0.06] text-cyan-300">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <rect x="5" y="10" width="14" height="10" rx="2" stroke="currentColor" stroke-width="1.7" />
                            <path d="M8 10V7.5a4 4 0 0 1 8 0V10" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                        </svg>
                    </span>
                </div>

                <div class="mb-5 text-center lg:text-start">
                    <h1 class="text-2xl font-bold tracking-tight text-white sm:text-[26px]">
                        {{ __('Reset your password') }}
                    </h1>
                    <p class="mt-1 text-sm text-slate-400">
                        {{ __('Create a new password to secure your account.') }}
                    </p>
                </div>

                {{-- Session status --}}
                <x-auth-session-status class="mb-3" :status="session('status')" />

                {{-- =================================================
                    FORM
                ================================================== --}}

                <form method="POST" action="{{ route('password.store') }}" id="resetPasswordForm">
                    @csrf

                    {{-- Password Reset Token --}}
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    {{-- Email --}}
                    <div>

                        <x-input-label
                            for="email"
                            :value="__('Email')"
                            class="mb-1.5 !text-sm !font-medium !text-slate-300"
                        />

                        <div class="group relative">

                            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
                                <svg class="h-[18px] w-[18px] text-slate-500 transition duration-200 group-focus-within:text-cyan-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M4 6.5A2.5 2.5 0 0 1 6.5 4h11A2.5 2.5 0 0 1 20 6.5v11a2.5 2.5 0 0 1-2.5 2.5h-11A2.5 2.5 0 0 1 4 17.5v-11Z" stroke="currentColor" stroke-width="1.7" />
                                    <path d="m5 7 6.15 4.4a1.5 1.5 0 0 0 1.7 0L19 7" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>

                            <x-text-input
                                id="email"
                                name="email"
                                type="email"
                                :value="old('email', $request->email)"
                                required
                                autofocus
                                autocomplete="username"
                                inputmode="email"
                                spellcheck="false"
                                class="block w-full rounded-xl border border-white/10 bg-slate-950/60
                                       py-3 ps-11 pe-4 text-sm text-white placeholder-slate-600
                                       outline-none transition duration-200 hover:border-white/15
                                       focus:border-cyan-400/50 focus:bg-slate-950/80 focus:ring-4 focus:ring-cyan-400/10"
                                placeholder="{{ __('Enter your email') }}"
                            />

                        </div>

                        <x-input-error :messages="$errors->get('email')" class="mt-1.5" />

                    </div>

                    {{-- New Password --}}
                    <div class="mt-3.5">

                        <x-input-label for="password" :value="__('New password')" class="mb-1.5 !text-sm !font-medium !text-slate-300" />

                        <div class="group relative">

                            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
                                <svg class="h-[18px] w-[18px] text-slate-500 transition duration-200 group-focus-within:text-cyan-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <rect x="5" y="10" width="14" height="10" rx="2" stroke="currentColor" stroke-width="1.7" />
                                    <path d="M8 10V7.5a4 4 0 0 1 8 0V10" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" />
                                </svg>
                            </div>

                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                required
                                autocomplete="new-password"
                                class="block w-full rounded-xl border border-white/10 bg-slate-950/60
                                       py-3 ps-11 pe-11 text-sm text-white placeholder-slate-600
                                       outline-none transition duration-200 hover:border-white/15
                                       focus:border-cyan-400/50 focus:bg-slate-950/80 focus:ring-4 focus:ring-cyan-400/10"
                                placeholder="{{ __('Create a new password') }}"
                            />

                            <button
                                type="button"
                                class="tf-toggle-password absolute inset-y-0 end-0 flex items-center pe-3.5 text-slate-500
                                       transition hover:text-cyan-300 focus:outline-none focus:ring-2
                                       focus:ring-cyan-400/40 rounded-e-xl"
                                data-target="password"
                                aria-label="{{ __('Show password') }}"
                                aria-pressed="false"
                            >
                                <svg class="tf-eye-icon h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.7" />
                                    <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.7" />
                                </svg>
                            </button>

                        </div>

                        {{-- Live password strength meter --}}
                        <div class="mt-2.5" id="passwordStrengthWrap" hidden>

                            <div class="flex items-center gap-1.5" aria-hidden="true">
                                <span class="tf-strength-bar h-1 flex-1 rounded-full bg-white/10 transition-colors duration-300"></span>
                                <span class="tf-strength-bar h-1 flex-1 rounded-full bg-white/10 transition-colors duration-300"></span>
                                <span class="tf-strength-bar h-1 flex-1 rounded-full bg-white/10 transition-colors duration-300"></span>
                                <span class="tf-strength-bar h-1 flex-1 rounded-full bg-white/10 transition-colors duration-300"></span>
                            </div>

                            <p class="mt-1.5 text-xs" id="passwordStrengthLabel"></p>

                        </div>

                        <x-input-error :messages="$errors->get('password')" class="mt-1.5" />

                    </div>

                    {{-- Confirm Password --}}
                    <div class="mt-3.5">

                        <x-input-label for="password_confirmation" :value="__('Confirm password')" class="mb-1.5 !text-sm !font-medium !text-slate-300" />

                        <div class="group relative">

                            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
                                <svg class="h-[18px] w-[18px] text-slate-500 transition duration-200 group-focus-within:text-cyan-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M5 12.5L9.2 16.5L19 6.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>

                            <x-text-input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                required
                                autocomplete="new-password"
                                class="block w-full rounded-xl border border-white/10 bg-slate-950/60
                                       py-3 ps-11 pe-11 text-sm text-white placeholder-slate-600
                                       outline-none transition duration-200 hover:border-white/15
                                       focus:border-cyan-400/50 focus:bg-slate-950/80 focus:ring-4 focus:ring-cyan-400/10"
                                placeholder="{{ __('Re-enter your new password') }}"
                            />

                            <button
                                type="button"
                                class="tf-toggle-password absolute inset-y-0 end-0 flex items-center pe-3.5 text-slate-500
                                       transition hover:text-cyan-300 focus:outline-none focus:ring-2
                                       focus:ring-cyan-400/40 rounded-e-xl"
                                data-target="password_confirmation"
                                aria-label="{{ __('Show password') }}"
                                aria-pressed="false"
                            >
                                <svg class="tf-eye-icon h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.7" />
                                    <circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.7" />
                                </svg>
                            </button>

                        </div>

                        {{-- Live match indicator --}}
                        <p class="mt-1.5 hidden items-center gap-1.5 text-xs" id="passwordMatchHint">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M5 12.5L9.2 16.5L19 6.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span></span>
                        </p>

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />

                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="group relative mt-5 flex w-full items-center justify-center gap-2
                               overflow-hidden rounded-xl border border-cyan-300/20
                               bg-gradient-to-r from-indigo-600 via-indigo-500 to-cyan-500
                               px-5 py-3 text-sm font-semibold text-white
                               shadow-[0_12px_30px_rgba(79,70,229,.28)]
                               transition-all duration-300 hover:-translate-y-0.5
                               hover:shadow-[0_16px_38px_rgba(34,211,238,.18)]
                               focus:outline-none focus:ring-4 focus:ring-cyan-400/20 active:translate-y-0"
                    >

                        <span class="absolute inset-y-0 -start-20 w-20 -skew-x-12 bg-white/20 transition-all duration-700 group-hover:start-[120%]"></span>

                        <span class="relative">{{ __('Reset Password') }}</span>

                        <svg
                            class="relative h-4 w-4 transition-transform duration-300 group-hover:translate-x-1
                                   rtl:rotate-180 rtl:group-hover:-translate-x-1"
                            viewBox="0 0 24 24" fill="none" aria-hidden="true"
                        >
                            <path d="M5 12h13" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            <path d="m13 6 6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                    </button>

                </form>

                {{-- Security note --}}
                <div class="mt-4 flex items-center justify-center gap-2 border-t border-white/[0.06] pt-4 text-[11px] text-slate-500 lg:justify-start">

                    <svg class="h-3.5 w-3.5 shrink-0 text-emerald-400" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 3 5 6v5c0 4.5 2.9 8.2 7 10 4.1-1.8 7-5.5 7-10V6l-7-3Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round" />
                        <path d="m9 12 2 2 4-4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <span>{{ __('Secure access to your workspace') }}</span>

                </div>

                {{-- Mobile-only footer --}}
                <p class="mt-4 text-center text-[11px] text-slate-600 lg:hidden">
                    © {{ date('Y') }} TaskFlow. {{ __('Built for focused work and better teamwork.') }}
                </p>

            </div>

        </div>

    </div>

    {{-- =============================================================
        PASSWORD TOGGLE + LIVE STRENGTH / MATCH FEEDBACK
    ============================================================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /* ---------- Show / hide password (both fields) ---------- */

            document.querySelectorAll('.tf-toggle-password').forEach(function (btn) {

                btn.addEventListener('click', function () {

                    const input = document.getElementById(btn.dataset.target);

                    if (!input) {
                        return;
                    }

                    const isPassword = input.type === 'password';

                    input.type = isPassword ? 'text' : 'password';

                    btn.setAttribute('aria-pressed', isPassword ? 'true' : 'false');
                });

            });

            /* ---------- Live password strength meter ---------- */

            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirmation');

            const strengthWrap = document.getElementById('passwordStrengthWrap');
            const strengthBars = document.querySelectorAll('.tf-strength-bar');
            const strengthLabel = document.getElementById('passwordStrengthLabel');

            const matchHint = document.getElementById('passwordMatchHint');
            const matchHintText = matchHint ? matchHint.querySelector('span') : null;

            const strengthLevels = [
                { label: @json(__('Too weak')), color: '#f87171' },
                { label: @json(__('Weak')), color: '#fb923c' },
                { label: @json(__('Good')), color: '#facc15' },
                { label: @json(__('Strong')), color: '#4ade80' },
            ];

            function scorePassword(value) {

                if (!value) {
                    return 0;
                }

                let score = 0;

                if (value.length >= 8) score++;
                if (value.length >= 12) score++;
                if (/[a-z]/.test(value) && /[A-Z]/.test(value)) score++;
                if (/\d/.test(value)) score++;
                if (/[^A-Za-z0-9]/.test(value)) score++;

                return Math.min(score, 4);
            }

            function renderStrength() {

                if (!passwordInput || !strengthWrap) {
                    return;
                }

                const value = passwordInput.value;

                if (!value) {
                    strengthWrap.hidden = true;
                    return;
                }

                strengthWrap.hidden = false;

                const score = Math.max(scorePassword(value), 1);
                const level = strengthLevels[score - 1];

                strengthBars.forEach(function (bar, index) {
                    bar.style.backgroundColor = index < score ? level.color : 'rgba(255,255,255,.1)';
                });

                if (strengthLabel) {
                    strengthLabel.textContent = level.label;
                    strengthLabel.style.color = level.color;
                }
            }

            function renderMatch() {

                if (!passwordInput || !confirmInput || !matchHint || !matchHintText) {
                    return;
                }

                if (!confirmInput.value) {
                    matchHint.classList.add('hidden');
                    matchHint.classList.remove('flex');
                    return;
                }

                const matches = passwordInput.value === confirmInput.value;

                matchHint.classList.remove('hidden');
                matchHint.classList.add('flex');

                matchHint.style.color = matches ? '#4ade80' : '#f87171';
                matchHintText.textContent = matches
                    ? @json(__('Passwords match'))
                    : @json(__('Passwords do not match'));
            }

            if (passwordInput) {
                passwordInput.addEventListener('input', function () {
                    renderStrength();
                    renderMatch();
                });
            }

            if (confirmInput) {
                confirmInput.addEventListener('input', renderMatch);
            }

        });
    </script>

</x-guest-layout>