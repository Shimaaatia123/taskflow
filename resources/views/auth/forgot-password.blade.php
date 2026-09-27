
<x-guest-layout>
    <div class="tf-forgot-page"
         dir="{{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'rtl' : 'ltr' }}">

        {{-- Ambient background --}}
        <div class="tf-forgot-ambient" aria-hidden="true">
            <span class="tf-forgot-glow tf-forgot-glow-one"></span>
            <span class="tf-forgot-glow tf-forgot-glow-two"></span>
            <span class="tf-forgot-grid"></span>

            <span class="tf-forgot-spark tf-forgot-spark-1">✦</span>
            <span class="tf-forgot-spark tf-forgot-spark-2">✧</span>
            <span class="tf-forgot-spark tf-forgot-spark-3">✦</span>
            <span class="tf-forgot-spark tf-forgot-spark-4">·</span>
            <span class="tf-forgot-spark tf-forgot-spark-5">✧</span>
            <span class="tf-forgot-spark tf-forgot-spark-6">·</span>
        </div>

        <main class="tf-forgot-shell">

            <section class="tf-forgot-card" aria-labelledby="forgot-password-title">

                {{-- Brand side --}}
                <div class="tf-forgot-brand">

                    <div class="tf-forgot-brand-top">
                        <div class="tf-forgot-logo" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none">
                                <rect x="5" y="5" width="38" height="38" rx="12"
                                      stroke="currentColor"
                                      stroke-width="2.5"/>
                                <path d="M15 18H33M15 24H29M15 30H25"
                                      stroke="currentColor"
                                      stroke-width="2.5"
                                      stroke-linecap="round"/>
                            </svg>
                        </div>

                        <div>
                            <div class="tf-forgot-brand-name">TaskFlow</div>
                            <div class="tf-forgot-brand-label">
                                {{ __('Secure Workspace') }}
                            </div>
                        </div>
                    </div>

                    <div class="tf-forgot-brand-content">

                        <span class="tf-forgot-eyebrow">
                            <span class="tf-forgot-eyebrow-dot"></span>
                            {{ __('ACCOUNT RECOVERY') }}
                        </span>

                        <h1>
                            {{ __('Let’s get you back in.') }}
                        </h1>

                        <p>
                            {{ __('Enter the email address connected to your TaskFlow account and we’ll send you a secure link to create a new password.') }}
                        </p>

                    </div>

                    <div class="tf-forgot-security">

                        <div class="tf-forgot-security-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M4 6.5C4 5.67 4.67 5 5.5 5H18.5C19.33 5 20 5.67 20 6.5V17.5C20 18.33 19.33 19 18.5 19H5.5C4.67 19 4 18.33 4 17.5V6.5Z"
                                      stroke="currentColor"
                                      stroke-width="1.7"/>
                                <path d="M5 7L12 12.5L19 7"
                                      stroke="currentColor"
                                      stroke-width="1.7"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <div>
                            <strong>{{ __('Secure recovery') }}</strong>
                            <span>{{ __('Your reset link will be sent to your verified email address.') }}</span>
                        </div>

                    </div>
                </div>

                {{-- Form side --}}
                <div class="tf-forgot-form-panel">

                    <div class="tf-forgot-form-header">

                        <div class="tf-forgot-header-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M4 6.5C4 5.67 4.67 5 5.5 5H18.5C19.33 5 20 5.67 20 6.5V17.5C20 18.33 19.33 19 18.5 19H5.5C4.67 19 4 18.33 4 17.5V6.5Z"
                                      stroke="currentColor"
                                      stroke-width="1.8"/>
                                <path d="M5 7L12 12.5L19 7"
                                      stroke="currentColor"
                                      stroke-width="1.8"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <div>
                            <span class="tf-forgot-form-kicker">
                                {{ __('Password recovery') }}
                            </span>

                            <h2 id="forgot-password-title">
                                {{ __('Forgot your password?') }}
                            </h2>

                            <p>
                                {{ __('No worries. We’ll help you reset it securely.') }}
                            </p>
                        </div>

                    </div>

                    {{-- Session Status --}}
                    <div class="tf-forgot-status">
                        <x-auth-session-status
                            :status="session('status')"
                        />
                    </div>

                    <form method="POST"
                          action="{{ route('password.email') }}"
                          class="tf-forgot-form">

                        @csrf

                        {{-- Email --}}
                        <div class="tf-forgot-field">

                            <label for="email" class="tf-forgot-label">
                                <span>{{ __('Email address') }}</span>
                                <span class="tf-forgot-required">
                                    {{ __('Required') }}
                                </span>
                            </label>

                            <div class="tf-forgot-input-wrap">

                                <span class="tf-forgot-input-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <rect x="4" y="5.5" width="16" height="13"
                                              rx="2.5"
                                              stroke="currentColor"
                                              stroke-width="1.7"/>
                                        <path d="M5.5 7L12 12.2L18.5 7"
                                              stroke="currentColor"
                                              stroke-width="1.7"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    </svg>
                                </span>

                                <input
                                    id="email"
                                    class="tf-forgot-input"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="email"
                                    placeholder="{{ __('you@example.com') }}"
                                    aria-describedby="email-error"
                                >

                            </div>

                            <div id="email-error" class="tf-forgot-error">
                                <x-input-error :messages="$errors->get('email')" />
                            </div>

                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="tf-forgot-submit">

                            <span class="tf-forgot-submit-content">

                                <span>
                                    {{ __('Email Password Reset Link') }}
                                </span>

                                <svg viewBox="0 0 24 24"
                                     fill="none"
                                     aria-hidden="true">

                                    @if(app()->getLocale() === 'ar')
                                        <path d="M19 12H5M11 6L5 12L11 18"
                                              stroke="currentColor"
                                              stroke-width="1.8"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    @else
                                        <path d="M5 12H19M13 6L19 12L13 18"
                                              stroke="currentColor"
                                              stroke-width="1.8"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                    @endif

                                </svg>

                            </span>

                            <span class="tf-forgot-submit-shine"></span>

                        </button>

                    </form>

                    {{-- Back to login --}}
                    <div class="tf-forgot-back">

                        <a href="{{ route('login') }}" class="tf-forgot-back-link">

                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 aria-hidden="true">

                                @if(app()->getLocale() === 'ar')
                                    <path d="M19 12H5M11 6L5 12L11 18"
                                          stroke="currentColor"
                                          stroke-width="1.8"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                @else
                                    <path d="M5 12H19M13 6L19 12L13 18"
                                          stroke="currentColor"
                                          stroke-width="1.8"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                @endif

                            </svg>

                            <span>{{ __('Back to Login') }}</span>

                        </a>

                    </div>

                    <div class="tf-forgot-footer">
                        <span class="tf-forgot-footer-line"></span>

                        <span>
                            {{ __('TaskFlow keeps your account recovery secure.') }}
                        </span>

                        <span class="tf-forgot-footer-line"></span>
                    </div>

                </div>

            </section>

            <p class="tf-forgot-copyright">
                © {{ date('Y') }} TaskFlow · {{ __('Secure workspace management') }}
            </p>

        </main>
    </div>

    <style>
        /* =========================================================
           TaskFlow — Forgot Password
           Fully isolated styles: tf-forgot-*
           ========================================================= */

        .tf-forgot-page {
            --tf-forgot-navy-950: #050914;
            --tf-forgot-navy-900: #08101f;
            --tf-forgot-blue: #3b82f6;
            --tf-forgot-cyan: #22d3ee;
            --tf-forgot-purple: #8b5cf6;
            --tf-forgot-text: #f8fafc;
            --tf-forgot-muted: #94a3b8;

            position: relative;
            width: 100%;
            min-height: 100dvh;
            height: 100dvh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px;
            color: var(--tf-forgot-text);
            background:
                radial-gradient(
                    circle at 12% 18%,
                    rgba(59, 130, 246, .12),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 88% 82%,
                    rgba(139, 92, 246, .11),
                    transparent 32%
                ),
                linear-gradient(
                    145deg,
                    #040711 0%,
                    var(--tf-forgot-navy-950) 48%,
                    #070d1b 100%
                );
            isolation: isolate;
        }

        .tf-forgot-ambient,
        .tf-forgot-grid {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .tf-forgot-ambient {
            z-index: -1;
            overflow: hidden;
        }

        .tf-forgot-grid {
            opacity: .17;
            background-image:
                linear-gradient(
                    rgba(148, 163, 184, .06) 1px,
                    transparent 1px
                ),
                linear-gradient(
                    90deg,
                    rgba(148, 163, 184, .06) 1px,
                    transparent 1px
                );
            background-size: 48px 48px;
            mask-image: linear-gradient(
                to bottom,
                transparent,
                black 20%,
                black 80%,
                transparent
            );
        }

        .tf-forgot-glow {
            position: absolute;
            width: 440px;
            height: 440px;
            border-radius: 50%;
            filter: blur(95px);
            opacity: .24;
        }

        .tf-forgot-glow-one {
            top: -190px;
            left: -130px;
            background: rgba(59, 130, 246, .45);
        }

        .tf-forgot-glow-two {
            right: -170px;
            bottom: -190px;
            background: rgba(139, 92, 246, .40);
        }

        /* Sparkles */
        .tf-forgot-spark {
            position: absolute;
            color: rgba(191, 219, 254, .68);
            text-shadow:
                0 0 8px rgba(96, 165, 250, .55),
                0 0 18px rgba(59, 130, 246, .35);
            animation: tf-forgot-twinkle 4s ease-in-out infinite;
        }

        .tf-forgot-spark-1 {
            top: 12%;
            left: 12%;
            font-size: 15px;
        }

        .tf-forgot-spark-2 {
            top: 19%;
            right: 15%;
            font-size: 12px;
            animation-delay: .7s;
        }

        .tf-forgot-spark-3 {
            bottom: 17%;
            left: 18%;
            font-size: 20px;
            animation-delay: 1.2s;
        }

        .tf-forgot-spark-4 {
            bottom: 23%;
            right: 11%;
            font-size: 24px;
            animation-delay: 1.8s;
        }

        .tf-forgot-spark-5 {
            top: 9%;
            right: 37%;
            font-size: 18px;
            animation-delay: 2.4s;
        }

        .tf-forgot-spark-6 {
            bottom: 12%;
            right: 34%;
            font-size: 18px;
            animation-delay: 3s;
        }

        @keyframes tf-forgot-twinkle {
            0%, 100% {
                opacity: .28;
                transform: scale(.88) rotate(0deg);
            }

            50% {
                opacity: 1;
                transform: scale(1.16) rotate(8deg);
            }
        }

        .tf-forgot-shell {
            position: relative;
            z-index: 2;
            width: min(1120px, 100%);
        }

        /* Card */
        .tf-forgot-card {
            width: 100%;
            min-height: 590px;
            display: grid;
            grid-template-columns:
                minmax(0, .95fr)
                minmax(450px, 1.05fr);
            overflow: hidden;
            border: 1px solid rgba(148, 163, 184, .16);
            border-radius: 30px;
            background: rgba(9, 16, 31, .77);
            box-shadow:
                0 35px 95px rgba(0, 0, 0, .43),
                0 0 0 1px rgba(255, 255, 255, .02) inset,
                0 0 90px rgba(59, 130, 246, .07);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
        }

        /* Brand */
        .tf-forgot-brand {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 46px;
            overflow: hidden;
            border-inline-end: 1px solid rgba(148, 163, 184, .11);
            background:
                radial-gradient(
                    circle at 18% 12%,
                    rgba(59, 130, 246, .14),
                    transparent 38%
                ),
                linear-gradient(
                    145deg,
                    rgba(13, 27, 52, .74),
                    rgba(7, 14, 28, .45)
                );
        }

        .tf-forgot-brand::after {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            right: -150px;
            bottom: -165px;
            border-radius: 50%;
            background: rgba(34, 211, 238, .055);
            filter: blur(30px);
        }

        .tf-forgot-brand-top {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .tf-forgot-logo {
            width: 48px;
            height: 48px;
            flex: 0 0 48px;
            display: grid;
            place-items: center;
            color: #93c5fd;
            border: 1px solid rgba(96, 165, 250, .25);
            border-radius: 14px;
            background:
                linear-gradient(
                    145deg,
                    rgba(59, 130, 246, .16),
                    rgba(139, 92, 246, .10)
                );
            box-shadow:
                0 12px 30px rgba(37, 99, 235, .16),
                inset 0 1px 0 rgba(255, 255, 255, .06);
        }

        .tf-forgot-logo svg {
            width: 28px;
            height: 28px;
        }

        .tf-forgot-brand-name {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -.02em;
        }

        .tf-forgot-brand-label {
            margin-top: 2px;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .tf-forgot-brand-content {
            max-width: 430px;
            margin-block: auto;
            padding-block: 48px;
        }

        .tf-forgot-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
            color: #60a5fa;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .14em;
        }

        .tf-forgot-eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22d3ee;
            box-shadow: 0 0 14px rgba(34, 211, 238, .8);
        }

        .tf-forgot-brand-content h1 {
            margin: 0;
            max-width: 410px;
            font-size: clamp(38px, 4.2vw, 54px);
            line-height: 1.02;
            font-weight: 850;
            letter-spacing: -.048em;
            background:
                linear-gradient(
                    110deg,
                    #ffffff 15%,
                    #bfdbfe 56%,
                    #a78bfa 100%
                );
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .tf-forgot-brand-content p {
            max-width: 405px;
            margin: 21px 0 0;
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.85;
        }

        /* Security box */
        .tf-forgot-security {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 15px 16px;
            border: 1px solid rgba(96, 165, 250, .13);
            border-radius: 16px;
            background: rgba(59, 130, 246, .055);
        }

        .tf-forgot-security-icon {
            width: 39px;
            height: 39px;
            flex: 0 0 39px;
            display: grid;
            place-items: center;
            color: #67e8f9;
            border-radius: 11px;
            background: rgba(34, 211, 238, .08);
        }

        .tf-forgot-security-icon svg {
            width: 21px;
            height: 21px;
        }

        .tf-forgot-security strong,
        .tf-forgot-security span {
            display: block;
        }

        .tf-forgot-security strong {
            color: #dbeafe;
            font-size: 12px;
            font-weight: 750;
        }

        .tf-forgot-security span {
            margin-top: 3px;
            color: #64748b;
            font-size: 10px;
            line-height: 1.5;
        }

        /* Form panel */
        .tf-forgot-form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 54px 60px;
            background:
                linear-gradient(
                    180deg,
                    rgba(255, 255, 255, .018),
                    transparent 35%
                ),
                rgba(4, 9, 20, .28);
        }

        .tf-forgot-form-header {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 32px;
        }

        .tf-forgot-header-icon {
            width: 47px;
            height: 47px;
            flex: 0 0 47px;
            display: grid;
            place-items: center;
            color: #93c5fd;
            border: 1px solid rgba(96, 165, 250, .17);
            border-radius: 14px;
            background:
                linear-gradient(
                    145deg,
                    rgba(59, 130, 246, .13),
                    rgba(139, 92, 246, .09)
                );
        }

        .tf-forgot-header-icon svg {
            width: 23px;
            height: 23px;
        }

        .tf-forgot-form-kicker {
            display: block;
            margin-bottom: 5px;
            color: #60a5fa;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .tf-forgot-form-header h2 {
            margin: 0;
            color: #f8fafc;
            font-size: clamp(24px, 2.5vw, 31px);
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: -.035em;
        }

        .tf-forgot-form-header p {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        /* Status */
        .tf-forgot-status {
            min-height: 0;
            margin-bottom: 4px;
            color: #86efac;
            font-size: 12px;
        }

        .tf-forgot-status:empty {
            display: none;
        }

        /* Form */
        .tf-forgot-form {
            width: 100%;
        }

        .tf-forgot-field {
            width: 100%;
        }

        .tf-forgot-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 9px;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 700;
        }

        .tf-forgot-required {
            color: #475569;
            font-size: 10px;
            font-weight: 600;
        }

        .tf-forgot-input-wrap {
            position: relative;
        }

        .tf-forgot-input {
            width: 100%;
            height: 56px;
            padding: 0 18px 0 52px;
            border: 1px solid rgba(148, 163, 184, .15);
            border-radius: 14px;
            outline: none;
            color: #f8fafc;
            background: rgba(15, 23, 42, .68);
            font-size: 14px;
            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;
        }

        .tf-forgot-input::placeholder {
            color: #475569;
        }

        .tf-forgot-input:hover {
            border-color: rgba(148, 163, 184, .24);
        }

        .tf-forgot-input:focus {
            border-color: rgba(59, 130, 246, .7);
            background: rgba(15, 23, 42, .9);
            box-shadow:
                0 0 0 4px rgba(59, 130, 246, .09),
                0 10px 30px rgba(37, 99, 235, .07);
        }

        .tf-forgot-input-icon {
            position: absolute;
            top: 50%;
            left: 17px;
            width: 20px;
            height: 20px;
            transform: translateY(-50%);
            color: #64748b;
            pointer-events: none;
            transition: color .2s ease;
        }

        .tf-forgot-input-icon svg {
            width: 100%;
            height: 100%;
        }

        .tf-forgot-input:focus {
            outline: none;
        }

        .tf-forgot-input:focus ~ .tf-forgot-input-icon {
            color: #60a5fa;
        }

        [dir="rtl"] .tf-forgot-input {
            padding-left: 18px;
            padding-right: 52px;
        }

        [dir="rtl"] .tf-forgot-input-icon {
            left: auto;
            right: 17px;
        }

        .tf-forgot-error {
            min-height: 18px;
            margin-top: 7px;
            color: #fca5a5;
            font-size: 11px;
        }

        .tf-forgot-error p {
            margin: 0;
        }

        /* Button */
        .tf-forgot-submit {
            position: relative;
            width: 100%;
            height: 56px;
            margin-top: 18px;
            overflow: hidden;
            border: 0;
            border-radius: 14px;
            color: #fff;
            background:
                linear-gradient(
                    110deg,
                    #2563eb 0%,
                    #4f46e5 52%,
                    #7c3aed 100%
                );
            box-shadow:
                0 15px 32px rgba(37, 99, 235, .22),
                inset 0 1px 0 rgba(255, 255, 255, .16);
            cursor: pointer;
            transition:
                transform .2s ease,
                box-shadow .2s ease,
                filter .2s ease;
        }

        .tf-forgot-submit:hover {
            transform: translateY(-2px);
            filter: brightness(1.06);
            box-shadow:
                0 20px 38px rgba(37, 99, 235, .3),
                inset 0 1px 0 rgba(255, 255, 255, .18);
        }

        .tf-forgot-submit:active {
            transform: translateY(0);
        }

        .tf-forgot-submit:focus-visible {
            outline: 3px solid rgba(96, 165, 250, .28);
            outline-offset: 3px;
        }

        .tf-forgot-submit-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 800;
        }

        .tf-forgot-submit-content svg {
            width: 19px;
            height: 19px;
            transition: transform .2s ease;
        }

        .tf-forgot-submit:hover
        .tf-forgot-submit-content svg {
            transform: translateX(3px);
        }

        [dir="rtl"] .tf-forgot-submit:hover
        .tf-forgot-submit-content svg {
            transform: translateX(-3px);
        }

        .tf-forgot-submit-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 45%;
            height: 100%;
            transform: skewX(-20deg);
            background:
                linear-gradient(
                    90deg,
                    transparent,
                    rgba(255, 255, 255, .14),
                    transparent
                );
            transition: left .7s ease;
        }

        .tf-forgot-submit:hover .tf-forgot-submit-shine {
            left: 150%;
        }

        /* Back link */
        .tf-forgot-back {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .tf-forgot-back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            transition:
                color .2s ease,
                transform .2s ease;
        }

        .tf-forgot-back-link:hover {
            color: #93c5fd;
            transform: translateY(-1px);
        }

        .tf-forgot-back-link:focus-visible {
            outline: 2px solid rgba(96, 165, 250, .4);
            outline-offset: 4px;
            border-radius: 5px;
        }

        .tf-forgot-back-link svg {
            width: 16px;
            height: 16px;
        }

        /* Footer */
        .tf-forgot-footer {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 22px;
            color: #475569;
            font-size: 9px;
            text-align: center;
        }

        .tf-forgot-footer-line {
            height: 1px;
            flex: 1;
            background: rgba(148, 163, 184, .08);
        }

        .tf-forgot-copyright {
            margin: 16px 0 0;
            color: #334155;
            font-size: 9px;
            text-align: center;
        }

        /* Tablet */
        @media (max-width: 900px) {
            .tf-forgot-page {
                height: auto;
                min-height: 100dvh;
                overflow: auto;
                padding: 24px;
            }

            .tf-forgot-card {
                grid-template-columns:
                    minmax(0, .82fr)
                    minmax(380px, 1.18fr);
                min-height: 560px;
            }

            .tf-forgot-brand {
                padding: 36px;
            }

            .tf-forgot-form-panel {
                padding: 42px 38px;
            }

            .tf-forgot-brand-content h1 {
                font-size: 40px;
            }
        }

        /* Mobile */
        @media (max-width: 700px) {
            .tf-forgot-page {
                height: auto;
                min-height: 100dvh;
                padding: 16px;
                overflow-x: hidden;
            }

            .tf-forgot-card {
                display: block;
                min-height: auto;
                border-radius: 24px;
            }

            .tf-forgot-brand {
                padding: 28px 24px;
                border-inline-end: 0;
                border-bottom: 1px solid rgba(148, 163, 184, .11);
            }

            .tf-forgot-brand-content {
                padding-block: 30px 24px;
            }

            .tf-forgot-brand-content h1 {
                font-size: 35px;
            }

            .tf-forgot-brand-content p {
                font-size: 13px;
                line-height: 1.75;
            }

            .tf-forgot-security {
                padding: 13px;
            }

            .tf-forgot-form-panel {
                padding: 30px 24px 28px;
            }

            .tf-forgot-form-header {
                margin-bottom: 26px;
            }

            .tf-forgot-form-header h2 {
                font-size: 25px;
            }
        }

        /* Small phones */
        @media (max-width: 420px) {
            .tf-forgot-page {
                padding: 10px;
            }

            .tf-forgot-card {
                border-radius: 20px;
            }

            .tf-forgot-brand {
                padding: 24px 19px;
            }

            .tf-forgot-form-panel {
                padding: 26px 19px 24px;
            }

            .tf-forgot-logo {
                width: 43px;
                height: 43px;
                flex-basis: 43px;
            }

            .tf-forgot-brand-content h1 {
                font-size: 31px;
            }

            .tf-forgot-security span {
                font-size: 9px;
            }

            .tf-forgot-footer {
                font-size: 8px;
            }
        }

        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .tf-forgot-spark,
            .tf-forgot-submit,
            .tf-forgot-submit-shine,
            .tf-forgot-submit-content svg,
            .tf-forgot-back-link,
            .tf-forgot-input {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</x-guest-layout>

