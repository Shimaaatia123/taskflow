
<x-guest-layout>
    <div class="tf-verify-page"
         dir="{{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'rtl' : 'ltr' }}">

        {{-- Ambient background --}}
        <div class="tf-verify-ambient" aria-hidden="true">
            <span class="tf-verify-glow tf-verify-glow-one"></span>
            <span class="tf-verify-glow tf-verify-glow-two"></span>
            <span class="tf-verify-grid"></span>

            <span class="tf-verify-spark tf-verify-spark-1">✦</span>
            <span class="tf-verify-spark tf-verify-spark-2">✧</span>
            <span class="tf-verify-spark tf-verify-spark-3">✦</span>
            <span class="tf-verify-spark tf-verify-spark-4">·</span>
            <span class="tf-verify-spark tf-verify-spark-5">✧</span>
            <span class="tf-verify-spark tf-verify-spark-6">·</span>
            <span class="tf-verify-spark tf-verify-spark-7">✦</span>
        </div>

        <main class="tf-verify-shell">

            <section class="tf-verify-card" aria-labelledby="verify-email-title">

                {{-- Brand / information side --}}
                <div class="tf-verify-brand">

                    <div class="tf-verify-brand-top">

                        <div class="tf-verify-logo" aria-hidden="true">
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
                            <div class="tf-verify-brand-name">TaskFlow</div>

                            <div class="tf-verify-brand-label">
                                {{ __('Secure Workspace') }}
                            </div>
                        </div>

                    </div>

                    <div class="tf-verify-brand-content">

                        <span class="tf-verify-eyebrow">
                            <span class="tf-verify-eyebrow-dot"></span>
                            {{ __('ACCOUNT VERIFICATION') }}
                        </span>

                        <h1>
                            {{ __('Almost there.') }}
                        </h1>

                        <p>
                            {{ __('One quick step before you start. Verify your email address to activate your TaskFlow workspace and keep your account secure.') }}
                        </p>

                    </div>

                    {{-- Verification status visual --}}
                    <div class="tf-verify-progress">

                        <div class="tf-verify-progress-icon">

                            <svg viewBox="0 0 64 64" fill="none" aria-hidden="true">
                                <circle cx="32"
                                        cy="32"
                                        r="27"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        opacity=".25"/>

                                <path d="M20 32.5L28 40L44 24"
                                      stroke="currentColor"
                                      stroke-width="3"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"/>

                                <circle cx="32"
                                        cy="32"
                                        r="21"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        stroke-dasharray="3 5"
                                        opacity=".45"/>
                            </svg>

                        </div>

                        <div class="tf-verify-progress-copy">

                            <strong>
                                {{ __('Secure verification') }}
                            </strong>

                            <span>
                                {{ __('Check your inbox and click the verification link.') }}
                            </span>

                        </div>

                    </div>

                </div>

                {{-- Form side --}}
                <div class="tf-verify-form-panel">

                    <div class="tf-verify-form-header">

                        <div class="tf-verify-header-icon" aria-hidden="true">

                            <svg viewBox="0 0 24 24" fill="none">
                                <rect x="4" y="5.5" width="16" height="13"
                                      rx="2.5"
                                      stroke="currentColor"
                                      stroke-width="1.8"/>

                                <path d="M5.5 7L12 12.2L18.5 7"
                                      stroke="currentColor"
                                      stroke-width="1.8"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"/>

                                <path d="M16.5 15.5L18 17L21 13.5"
                                      stroke="currentColor"
                                      stroke-width="1.7"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>

                        </div>

                        <div>

                            <span class="tf-verify-form-kicker">
                                {{ __('Verify your account') }}
                            </span>

                            <h2 id="verify-email-title">
                                {{ __('Check your email') }}
                            </h2>

                            <p>
                                {{ __('We sent a verification link to the email address you registered with.') }}
                            </p>

                        </div>

                    </div>

                    {{-- Success status --}}
                    @if (session('status') == 'verification-link-sent')

                        <div class="tf-verify-success"
                             role="status"
                             aria-live="polite">

                            <div class="tf-verify-success-icon">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M5 12.5L9.2 16.5L19 6.8"
                                          stroke="currentColor"
                                          stroke-width="2"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </div>

                            <div>
                                <strong>
                                    {{ __('Verification email sent') }}
                                </strong>

                                <span>
                                    {{ __('A new verification link has been sent to your registered email address.') }}
                                </span>
                            </div>

                        </div>

                    @endif

                    {{-- Main verification form --}}
                    <form method="POST"
                          action="{{ route('verification.send') }}"
                          class="tf-verify-form">

                        @csrf

                        <div class="tf-verify-inbox-card">

                            <div class="tf-verify-inbox-icon">
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                    <path d="M4 7.5C4 6.67 4.67 6 5.5 6H18.5C19.33 6 20 6.67 20 7.5V16.5C20 17.33 19.33 18 18.5 18H5.5C4.67 18 4 17.33 4 16.5V7.5Z"
                                          stroke="currentColor"
                                          stroke-width="1.7"/>

                                    <path d="M5 8L12 13L19 8"
                                          stroke="currentColor"
                                          stroke-width="1.7"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                            </div>

                            <div class="tf-verify-inbox-copy">

                                <strong>
                                    {{ __('Check your inbox') }}
                                </strong>

                                <span>
                                    {{ __('Look for an email from TaskFlow. If you don’t see it, check your spam or junk folder.') }}
                                </span>

                            </div>

                        </div>

                        <button type="submit"
                                class="tf-verify-submit">

                            <span class="tf-verify-submit-content">

                                <svg viewBox="0 0 24 24"
                                     fill="none"
                                     aria-hidden="true">

                                    <path d="M4 7.5C4 6.67 4.67 6 5.5 6H18.5C19.33 6 20 6.67 20 7.5V16.5C20 17.33 19.33 18 18.5 18H5.5C4.67 18 4 17.33 4 16.5V7.5Z"
                                          stroke="currentColor"
                                          stroke-width="1.8"/>

                                    <path d="M5 8L12 13L19 8"
                                          stroke="currentColor"
                                          stroke-width="1.8"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>

                                <span>
                                    {{ __('Resend Verification Email') }}
                                </span>

                            </span>

                            <span class="tf-verify-submit-shine"></span>

                        </button>

                    </form>

                    {{-- Logout --}}
                    <div class="tf-verify-actions">

                        <span class="tf-verify-action-line"></span>

                        <form method="POST"
                              action="{{ route('logout') }}">

                            @csrf

                            <button type="submit"
                                    class="tf-verify-logout">

                                <svg viewBox="0 0 24 24"
                                     fill="none"
                                     aria-hidden="true">

                                    <path d="M10 5H6.5C5.67 5 5 5.67 5 6.5V17.5C5 18.33 5.67 19 6.5 19H10"
                                          stroke="currentColor"
                                          stroke-width="1.7"
                                          stroke-linecap="round"/>

                                    <path d="M13 8L17 12L13 16"
                                          stroke="currentColor"
                                          stroke-width="1.7"
                                          stroke-linecap="round"
                                          stroke-linejoin="round"/>

                                    <path d="M9 12H17"
                                          stroke="currentColor"
                                          stroke-width="1.7"
                                          stroke-linecap="round"/>
                                </svg>

                                <span>
                                    {{ __('Log Out') }}
                                </span>

                            </button>

                        </form>

                        <span class="tf-verify-action-line"></span>

                    </div>

                    <div class="tf-verify-footer">

                        <span class="tf-verify-footer-shield">
                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 aria-hidden="true">

                                <path d="M12 3L19 6V11.5C19 16.1 16.05 19.75 12 21C7.95 19.75 5 16.1 5 11.5V6L12 3Z"
                                      stroke="currentColor"
                                      stroke-width="1.6"
                                      stroke-linejoin="round"/>

                                <path d="M9 12L11.2 14.2L15.3 10"
                                      stroke="currentColor"
                                      stroke-width="1.6"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </span>

                        <span>
                            {{ __('Your account is protected by TaskFlow security.') }}
                        </span>

                    </div>

                </div>

            </section>

            <p class="tf-verify-copyright">
                © {{ date('Y') }} TaskFlow · {{ __('Secure workspace management') }}
            </p>

        </main>
    </div>

    <style>
        /* =========================================================
           TaskFlow — Verify Email
           Fully isolated styles: tf-verify-*
           ========================================================= */

        .tf-verify-page {
            --tf-verify-blue: #3b82f6;
            --tf-verify-cyan: #22d3ee;
            --tf-verify-purple: #8b5cf6;
            --tf-verify-text: #f8fafc;
            --tf-verify-muted: #94a3b8;

            position: relative;
            width: 100%;
            min-height: 100dvh;
            height: 100dvh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px;
            color: var(--tf-verify-text);
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
                    #050914 48%,
                    #070d1b 100%
                );
            isolation: isolate;
        }

        .tf-verify-ambient,
        .tf-verify-grid {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .tf-verify-ambient {
            z-index: -1;
            overflow: hidden;
        }

        .tf-verify-grid {
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

        /* Ambient glows */
        .tf-verify-glow {
            position: absolute;
            width: 440px;
            height: 440px;
            border-radius: 50%;
            filter: blur(95px);
            opacity: .24;
        }

        .tf-verify-glow-one {
            top: -190px;
            left: -130px;
            background: rgba(59, 130, 246, .45);
        }

        .tf-verify-glow-two {
            right: -170px;
            bottom: -190px;
            background: rgba(139, 92, 246, .40);
        }

        /* Sparkles */
        .tf-verify-spark {
            position: absolute;
            color: rgba(191, 219, 254, .68);
            text-shadow:
                0 0 8px rgba(96, 165, 250, .55),
                0 0 18px rgba(59, 130, 246, .35);
            animation: tf-verify-twinkle 4s ease-in-out infinite;
        }

        .tf-verify-spark-1 {
            top: 11%;
            left: 12%;
            font-size: 15px;
        }

        .tf-verify-spark-2 {
            top: 18%;
            right: 15%;
            font-size: 12px;
            animation-delay: .6s;
        }

        .tf-verify-spark-3 {
            bottom: 17%;
            left: 17%;
            font-size: 21px;
            animation-delay: 1.1s;
        }

        .tf-verify-spark-4 {
            bottom: 22%;
            right: 11%;
            font-size: 24px;
            animation-delay: 1.7s;
        }

        .tf-verify-spark-5 {
            top: 9%;
            right: 37%;
            font-size: 18px;
            animation-delay: 2.2s;
        }

        .tf-verify-spark-6 {
            bottom: 12%;
            right: 34%;
            font-size: 18px;
            animation-delay: 2.8s;
        }

        .tf-verify-spark-7 {
            top: 34%;
            left: 5%;
            font-size: 11px;
            animation-delay: 3.2s;
        }

        @keyframes tf-verify-twinkle {
            0%, 100% {
                opacity: .28;
                transform: scale(.88) rotate(0deg);
            }

            50% {
                opacity: 1;
                transform: scale(1.16) rotate(8deg);
            }
        }

        .tf-verify-shell {
            position: relative;
            z-index: 2;
            width: min(1120px, 100%);
        }

        /* Main card */
        .tf-verify-card {
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
        .tf-verify-brand {
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

        .tf-verify-brand::after {
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

        .tf-verify-brand-top {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .tf-verify-logo {
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

        .tf-verify-logo svg {
            width: 28px;
            height: 28px;
        }

        .tf-verify-brand-name {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -.02em;
        }

        .tf-verify-brand-label {
            margin-top: 2px;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .tf-verify-brand-content {
            max-width: 430px;
            margin-block: auto;
            padding-block: 45px;
        }

        .tf-verify-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
            color: #60a5fa;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .14em;
        }

        .tf-verify-eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22d3ee;
            box-shadow: 0 0 14px rgba(34, 211, 238, .8);
        }

        .tf-verify-brand-content h1 {
            margin: 0;
            max-width: 410px;
            font-size: clamp(40px, 4.3vw, 55px);
            line-height: 1.01;
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

        .tf-verify-brand-content p {
            max-width: 405px;
            margin: 21px 0 0;
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.85;
        }

        /* Verification progress */
        .tf-verify-progress {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 15px 16px;
            border: 1px solid rgba(96, 165, 250, .13);
            border-radius: 16px;
            background: rgba(59, 130, 246, .055);
        }

        .tf-verify-progress-icon {
            width: 43px;
            height: 43px;
            flex: 0 0 43px;
            display: grid;
            place-items: center;
            color: #67e8f9;
        }

        .tf-verify-progress-icon svg {
            width: 43px;
            height: 43px;
        }

        .tf-verify-progress-copy strong,
        .tf-verify-progress-copy span {
            display: block;
        }

        .tf-verify-progress-copy strong {
            color: #dbeafe;
            font-size: 12px;
            font-weight: 750;
        }

        .tf-verify-progress-copy span {
            margin-top: 3px;
            color: #64748b;
            font-size: 10px;
            line-height: 1.5;
        }

        /* Form panel */
        .tf-verify-form-panel {
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

        .tf-verify-form-header {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 27px;
        }

        .tf-verify-header-icon {
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

        .tf-verify-header-icon svg {
            width: 24px;
            height: 24px;
        }

        .tf-verify-form-kicker {
            display: block;
            margin-bottom: 5px;
            color: #60a5fa;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .tf-verify-form-header h2 {
            margin: 0;
            color: #f8fafc;
            font-size: clamp(24px, 2.5vw, 31px);
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: -.035em;
        }

        .tf-verify-form-header p {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.65;
        }

        /* Success state */
        .tf-verify-success {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 16px;
            padding: 13px 14px;
            border: 1px solid rgba(74, 222, 128, .17);
            border-radius: 14px;
            background: rgba(34, 197, 94, .055);
            color: #bbf7d0;
        }

        .tf-verify-success-icon {
            width: 30px;
            height: 30px;
            flex: 0 0 30px;
            display: grid;
            place-items: center;
            border-radius: 9px;
            color: #86efac;
            background: rgba(34, 197, 94, .10);
        }

        .tf-verify-success-icon svg {
            width: 17px;
            height: 17px;
        }

        .tf-verify-success strong,
        .tf-verify-success span {
            display: block;
        }

        .tf-verify-success strong {
            font-size: 11px;
            font-weight: 800;
        }

        .tf-verify-success span {
            margin-top: 3px;
            color: #86a98f;
            font-size: 10px;
            line-height: 1.5;
        }

        /* Inbox card */
        .tf-verify-inbox-card {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 17px;
            padding: 16px;
            border: 1px solid rgba(148, 163, 184, .11);
            border-radius: 16px;
            background: rgba(15, 23, 42, .42);
        }

        .tf-verify-inbox-icon {
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            display: grid;
            place-items: center;
            color: #60a5fa;
            border-radius: 11px;
            background: rgba(59, 130, 246, .08);
        }

        .tf-verify-inbox-icon svg {
            width: 21px;
            height: 21px;
        }

        .tf-verify-inbox-copy strong,
        .tf-verify-inbox-copy span {
            display: block;
        }

        .tf-verify-inbox-copy strong {
            color: #cbd5e1;
            font-size: 11px;
            font-weight: 750;
        }

        .tf-verify-inbox-copy span {
            margin-top: 4px;
            color: #64748b;
            font-size: 10px;
            line-height: 1.55;
        }

        /* Submit */
        .tf-verify-submit {
            position: relative;
            width: 100%;
            height: 56px;
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

        .tf-verify-submit:hover {
            transform: translateY(-2px);
            filter: brightness(1.06);
            box-shadow:
                0 20px 38px rgba(37, 99, 235, .3),
                inset 0 1px 0 rgba(255, 255, 255, .18);
        }

        .tf-verify-submit:active {
            transform: translateY(0);
        }

        .tf-verify-submit:focus-visible {
            outline: 3px solid rgba(96, 165, 250, .28);
            outline-offset: 3px;
        }

        .tf-verify-submit-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 800;
        }

        .tf-verify-submit-content svg {
            width: 20px;
            height: 20px;
        }

        .tf-verify-submit-shine {
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

        .tf-verify-submit:hover .tf-verify-submit-shine {
            left: 150%;
        }

        /* Logout */
        .tf-verify-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 21px;
        }

        .tf-verify-action-line {
            height: 1px;
            flex: 1;
            background: rgba(148, 163, 184, .08);
        }

        .tf-verify-logout {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 5px 8px;
            border: 0;
            color: #64748b;
            background: transparent;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
            transition:
                color .2s ease,
                transform .2s ease;
        }

        .tf-verify-logout:hover {
            color: #cbd5e1;
            transform: translateY(-1px);
        }

        .tf-verify-logout:focus-visible {
            outline: 2px solid rgba(96, 165, 250, .4);
            outline-offset: 3px;
            border-radius: 5px;
        }

        .tf-verify-logout svg {
            width: 15px;
            height: 15px;
        }

        /* Footer */
        .tf-verify-footer {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            margin-top: 19px;
            color: #475569;
            font-size: 9px;
            text-align: center;
        }

        .tf-verify-footer-shield {
            display: inline-flex;
            color: #64748b;
        }

        .tf-verify-footer-shield svg {
            width: 14px;
            height: 14px;
        }

        .tf-verify-copyright {
            margin: 16px 0 0;
            color: #334155;
            font-size: 9px;
            text-align: center;
        }

        /* Tablet */
        @media (max-width: 900px) {
            .tf-verify-page {
                height: auto;
                min-height: 100dvh;
                overflow: auto;
                padding: 24px;
            }

            .tf-verify-card {
                grid-template-columns:
                    minmax(0, .82fr)
                    minmax(380px, 1.18fr);
                min-height: 560px;
            }

            .tf-verify-brand {
                padding: 36px;
            }

            .tf-verify-form-panel {
                padding: 42px 38px;
            }

            .tf-verify-brand-content h1 {
                font-size: 40px;
            }
        }

        /* Mobile */
        @media (max-width: 700px) {
            .tf-verify-page {
                height: auto;
                min-height: 100dvh;
                padding: 16px;
                overflow-x: hidden;
            }

            .tf-verify-card {
                display: block;
                min-height: auto;
                border-radius: 24px;
            }

            .tf-verify-brand {
                padding: 28px 24px;
                border-inline-end: 0;
                border-bottom: 1px solid rgba(148, 163, 184, .11);
            }

            .tf-verify-brand-content {
                padding-block: 30px 24px;
            }

            .tf-verify-brand-content h1 {
                font-size: 35px;
            }

            .tf-verify-brand-content p {
                font-size: 13px;
                line-height: 1.75;
            }

            .tf-verify-progress {
                padding: 13px;
            }

            .tf-verify-form-panel {
                padding: 30px 24px 28px;
            }

            .tf-verify-form-header {
                margin-bottom: 24px;
            }

            .tf-verify-form-header h2 {
                font-size: 25px;
            }
        }

        /* Small phones */
        @media (max-width: 420px) {
            .tf-verify-page {
                padding: 10px;
            }

            .tf-verify-card {
                border-radius: 20px;
            }

            .tf-verify-brand {
                padding: 24px 19px;
            }

            .tf-verify-form-panel {
                padding: 26px 19px 24px;
            }

            .tf-verify-logo {
                width: 43px;
                height: 43px;
                flex-basis: 43px;
            }

            .tf-verify-brand-content h1 {
                font-size: 31px;
            }

            .tf-verify-inbox-card {
                padding: 13px;
            }

            .tf-verify-footer {
                font-size: 8px;
            }
        }

        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .tf-verify-spark,
            .tf-verify-submit,
            .tf-verify-submit-shine,
            .tf-verify-logout {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>
</x-guest-layout>

