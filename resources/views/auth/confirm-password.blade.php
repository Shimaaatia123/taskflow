
<x-guest-layout>
    <div class="tf-confirm-page" dir="{{ str_replace('_', '-', app()->getLocale()) === 'ar' ? 'rtl' : 'ltr' }}">

        {{-- Ambient background --}}
        <div class="tf-confirm-ambient" aria-hidden="true">
            <span class="tf-confirm-glow tf-confirm-glow-one"></span>
            <span class="tf-confirm-glow tf-confirm-glow-two"></span>
            <span class="tf-confirm-grid"></span>

            <span class="tf-confirm-star tf-confirm-star-1">✦</span>
            <span class="tf-confirm-star tf-confirm-star-2">✦</span>
            <span class="tf-confirm-star tf-confirm-star-3">·</span>
            <span class="tf-confirm-star tf-confirm-star-4">✧</span>
            <span class="tf-confirm-star tf-confirm-star-5">·</span>
        </div>

        {{-- Main content --}}
        <main class="tf-confirm-shell">

            <section class="tf-confirm-card" aria-labelledby="confirm-password-title">

                {{-- Brand / information side --}}
                <div class="tf-confirm-brand">

                    <div class="tf-confirm-brand-top">
                        <div class="tf-confirm-logo" aria-hidden="true">
                            <svg viewBox="0 0 48 48" fill="none">
                                <rect x="5" y="5" width="38" height="38" rx="12"
                                      stroke="currentColor" stroke-width="2.5"/>
                                <path d="M15 18H33M15 24H29M15 30H25"
                                      stroke="currentColor"
                                      stroke-width="2.5"
                                      stroke-linecap="round"/>
                            </svg>
                        </div>

                        <div>
                            <div class="tf-confirm-brand-name">TaskFlow</div>
                            <div class="tf-confirm-brand-label">
                                {{ __('Secure Workspace') }}
                            </div>
                        </div>
                    </div>

                    <div class="tf-confirm-brand-content">
                        <span class="tf-confirm-eyebrow">
                            <span class="tf-confirm-eyebrow-dot"></span>
                            {{ __('SECURITY CHECK') }}
                        </span>

                        <h1>
                            {{ __('One more step') }}
                        </h1>

                        <p>
                            {{ __('Confirm your password to continue to this secure area of your TaskFlow workspace.') }}
                        </p>
                    </div>

                    <div class="tf-confirm-security">
                        <div class="tf-confirm-security-icon">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M12 3L19 6V11.5C19 16.1 16.05 19.75 12 21C7.95 19.75 5 16.1 5 11.5V6L12 3Z"
                                      stroke="currentColor"
                                      stroke-width="1.7"
                                      stroke-linejoin="round"/>
                                <path d="M9.2 12L11.2 14L15.2 10"
                                      stroke="currentColor"
                                      stroke-width="1.7"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"/>
                            </svg>
                        </div>

                        <div>
                            <strong>{{ __('Protected session') }}</strong>
                            <span>{{ __('Your password is never displayed or stored here.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Form side --}}
                <div class="tf-confirm-form-panel">

                    <div class="tf-confirm-form-header">
                        <div class="tf-confirm-mobile-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <rect x="5" y="10" width="14" height="10" rx="2.5"
                                      stroke="currentColor" stroke-width="1.8"/>
                                <path d="M8 10V7.5C8 5.29 9.79 3.5 12 3.5C14.21 3.5 16 5.29 16 7.5V10"
                                      stroke="currentColor"
                                      stroke-width="1.8"
                                      stroke-linecap="round"/>
                                <circle cx="12" cy="15" r="1.2" fill="currentColor"/>
                            </svg>
                        </div>

                        <div>
                            <span class="tf-confirm-form-kicker">
                                {{ __('Confirm access') }}
                            </span>

                            <h2 id="confirm-password-title">
                                {{ __('Confirm your password') }}
                            </h2>

                            <p>
                                {{ __('Please enter your current password to continue.') }}
                            </p>
                        </div>
                    </div>

                    <form method="POST"
                          action="{{ route('password.confirm') }}"
                          class="tf-confirm-form">
                        @csrf

                        {{-- Password --}}
                        <div class="tf-confirm-field">
                            <label for="password" class="tf-confirm-label">
                                <span>{{ __('Password') }}</span>
                                <span class="tf-confirm-required">
                                    {{ __('Required') }}
                                </span>
                            </label>

                            <div class="tf-confirm-input-wrap">
                                <span class="tf-confirm-input-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" fill="none">
                                        <rect x="5" y="10" width="14" height="10" rx="2.5"
                                              stroke="currentColor" stroke-width="1.7"/>
                                        <path d="M8 10V7.5C8 5.29 9.79 3.5 12 3.5C14.21 3.5 16 5.29 16 7.5V10"
                                              stroke="currentColor"
                                              stroke-width="1.7"
                                              stroke-linecap="round"/>
                                    </svg>
                                </span>

                                <input
                                    id="password"
                                    class="tf-confirm-input"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    autofocus
                                    aria-describedby="password-error"
                                >

                                <button
                                    type="button"
                                    class="tf-confirm-toggle"
                                    data-password-toggle="password"
                                    aria-label="{{ __('Show password') }}"
                                    title="{{ __('Show password') }}"
                                >
                                    <svg class="tf-confirm-eye tf-confirm-eye-show"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         aria-hidden="true">
                                        <path d="M2.5 12S6 6.5 12 6.5S21.5 12 21.5 12S18 17.5 12 17.5S2.5 12 2.5 12Z"
                                              stroke="currentColor"
                                              stroke-width="1.7"
                                              stroke-linejoin="round"/>
                                        <circle cx="12" cy="12" r="2.5"
                                                stroke="currentColor"
                                                stroke-width="1.7"/>
                                    </svg>

                                    <svg class="tf-confirm-eye tf-confirm-eye-hide"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         aria-hidden="true">
                                        <path d="M3 3L21 21"
                                              stroke="currentColor"
                                              stroke-width="1.7"
                                              stroke-linecap="round"/>
                                        <path d="M10.6 6.7C11.05 6.57 11.52 6.5 12 6.5C18 6.5 21.5 12 21.5 12C20.78 13.13 19.83 14.3 18.7 15.28"
                                              stroke="currentColor"
                                              stroke-width="1.7"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                        <path d="M6.15 7.95C4.55 9.15 3.45 10.7 2.5 12C2.5 12 6 17.5 12 17.5C13.48 17.5 14.82 17.1 16 16.5"
                                              stroke="currentColor"
                                              stroke-width="1.7"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"/>
                                        <path d="M9.9 9.9C9.35 10.45 9 11.2 9 12C9 13.66 10.34 15 12 15C12.8 15 13.55 14.65 14.1 14.1"
                                              stroke="currentColor"
                                              stroke-width="1.7"
                                              stroke-linecap="round"/>
                                    </svg>
                                </button>
                            </div>

                            <div id="password-error" class="tf-confirm-error">
                                <x-input-error :messages="$errors->get('password')" />
                            </div>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="tf-confirm-submit">
                            <span class="tf-confirm-submit-content">
                                <span>{{ __('Confirm & Continue') }}</span>

                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
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

                            <span class="tf-confirm-submit-shine"></span>
                        </button>
                    </form>

                    <div class="tf-confirm-footer">
                        <span class="tf-confirm-footer-line"></span>

                        <span>
                            {{ __('Your session is protected by TaskFlow security.') }}
                        </span>

                        <span class="tf-confirm-footer-line"></span>
                    </div>

                </div>
            </section>

            <p class="tf-confirm-copyright">
                © {{ date('Y') }} TaskFlow · {{ __('Secure workspace management') }}
            </p>

        </main>
    </div>

    <style>
        /* =========================================================
           TaskFlow — Confirm Password
           Fully isolated styles: tf-confirm-*
           ========================================================= */

        .tf-confirm-page {
            --tf-navy-950: #050914;
            --tf-navy-900: #08101f;
            --tf-navy-850: #0b1426;
            --tf-blue: #3b82f6;
            --tf-cyan: #22d3ee;
            --tf-purple: #8b5cf6;
            --tf-text: #f7f9ff;
            --tf-muted: #94a3b8;
            --tf-border: rgba(148, 163, 184, .16);

            position: relative;
            width: 100%;
            min-height: 100dvh;
            height: 100dvh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px;
            background:
                radial-gradient(circle at 15% 20%, rgba(59, 130, 246, .11), transparent 30%),
                radial-gradient(circle at 85% 80%, rgba(139, 92, 246, .10), transparent 32%),
                linear-gradient(145deg, #040711 0%, var(--tf-navy-950) 48%, #070d1b 100%);
            color: var(--tf-text);
            isolation: isolate;
        }

        .tf-confirm-ambient,
        .tf-confirm-grid {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .tf-confirm-ambient {
            z-index: -1;
            overflow: hidden;
        }

        .tf-confirm-grid {
            opacity: .18;
            background-image:
                linear-gradient(rgba(148, 163, 184, .06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, .06) 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: linear-gradient(to bottom, transparent, black 20%, black 80%, transparent);
        }

        .tf-confirm-glow {
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            filter: blur(90px);
            opacity: .24;
        }

        .tf-confirm-glow-one {
            top: -180px;
            left: -120px;
            background: rgba(59, 130, 246, .45);
        }

        .tf-confirm-glow-two {
            right: -160px;
            bottom: -180px;
            background: rgba(139, 92, 246, .38);
        }

        .tf-confirm-star {
            position: absolute;
            color: rgba(191, 219, 254, .6);
            text-shadow: 0 0 14px rgba(96, 165, 250, .65);
            animation: tf-confirm-twinkle 3.8s ease-in-out infinite;
        }

        .tf-confirm-star-1 {
            top: 15%;
            left: 12%;
            font-size: 13px;
        }

        .tf-confirm-star-2 {
            top: 22%;
            right: 16%;
            font-size: 10px;
            animation-delay: .8s;
        }

        .tf-confirm-star-3 {
            bottom: 20%;
            left: 18%;
            font-size: 22px;
            animation-delay: 1.4s;
        }

        .tf-confirm-star-4 {
            bottom: 14%;
            right: 12%;
            font-size: 14px;
            animation-delay: 2s;
        }

        .tf-confirm-star-5 {
            top: 10%;
            right: 38%;
            font-size: 20px;
            animation-delay: 2.6s;
        }

        @keyframes tf-confirm-twinkle {
            0%, 100% {
                opacity: .35;
                transform: scale(.9);
            }
            50% {
                opacity: .95;
                transform: scale(1.15);
            }
        }

        .tf-confirm-shell {
            width: min(1080px, 100%);
            position: relative;
            z-index: 2;
        }

        .tf-confirm-card {
            width: 100%;
            min-height: 570px;
            display: grid;
            grid-template-columns: minmax(0, .92fr) minmax(440px, 1.08fr);
            overflow: hidden;
            border: 1px solid rgba(148, 163, 184, .16);
            border-radius: 30px;
            background: rgba(9, 16, 31, .76);
            box-shadow:
                0 35px 90px rgba(0, 0, 0, .42),
                0 0 0 1px rgba(255, 255, 255, .02) inset,
                0 0 80px rgba(59, 130, 246, .07);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }

        /* Brand */
        .tf-confirm-brand {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 46px;
            overflow: hidden;
            border-inline-end: 1px solid rgba(148, 163, 184, .11);
            background:
                radial-gradient(circle at 20% 10%, rgba(59, 130, 246, .13), transparent 36%),
                linear-gradient(145deg, rgba(13, 27, 52, .72), rgba(7, 14, 28, .44));
        }

        .tf-confirm-brand::after {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            right: -150px;
            bottom: -160px;
            border-radius: 50%;
            background: rgba(34, 211, 238, .06);
            filter: blur(30px);
        }

        .tf-confirm-brand-top {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .tf-confirm-logo {
            width: 48px;
            height: 48px;
            flex: 0 0 48px;
            display: grid;
            place-items: center;
            border: 1px solid rgba(96, 165, 250, .25);
            border-radius: 14px;
            color: #93c5fd;
            background:
                linear-gradient(145deg, rgba(59, 130, 246, .16), rgba(139, 92, 246, .10));
            box-shadow:
                0 12px 30px rgba(37, 99, 235, .16),
                inset 0 1px 0 rgba(255, 255, 255, .06);
        }

        .tf-confirm-logo svg {
            width: 28px;
            height: 28px;
        }

        .tf-confirm-brand-name {
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -.02em;
        }

        .tf-confirm-brand-label {
            margin-top: 2px;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .tf-confirm-brand-content {
            max-width: 430px;
            margin-block: auto;
            padding-block: 45px;
        }

        .tf-confirm-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 18px;
            color: #60a5fa;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .14em;
        }

        .tf-confirm-eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #22d3ee;
            box-shadow: 0 0 14px rgba(34, 211, 238, .8);
        }

        .tf-confirm-brand-content h1 {
            margin: 0;
            max-width: 390px;
            font-size: clamp(36px, 4vw, 52px);
            line-height: 1.02;
            font-weight: 850;
            letter-spacing: -.045em;
            background: linear-gradient(110deg, #ffffff 15%, #bfdbfe 55%, #a78bfa 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .tf-confirm-brand-content p {
            max-width: 390px;
            margin: 20px 0 0;
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.8;
        }

        .tf-confirm-security {
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

        .tf-confirm-security-icon {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            display: grid;
            place-items: center;
            border-radius: 11px;
            color: #67e8f9;
            background: rgba(34, 211, 238, .08);
        }

        .tf-confirm-security-icon svg {
            width: 21px;
            height: 21px;
        }

        .tf-confirm-security strong,
        .tf-confirm-security span {
            display: block;
        }

        .tf-confirm-security strong {
            color: #dbeafe;
            font-size: 12px;
            font-weight: 750;
        }

        .tf-confirm-security span {
            margin-top: 3px;
            color: #64748b;
            font-size: 10px;
            line-height: 1.5;
        }

        /* Form */
        .tf-confirm-form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 54px 58px;
            background:
                linear-gradient(180deg, rgba(255, 255, 255, .018), transparent 35%),
                rgba(4, 9, 20, .28);
        }

        .tf-confirm-form-header {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 34px;
        }

        .tf-confirm-mobile-icon {
            width: 46px;
            height: 46px;
            flex: 0 0 46px;
            display: grid;
            place-items: center;
            border: 1px solid rgba(96, 165, 250, .17);
            border-radius: 14px;
            color: #93c5fd;
            background: linear-gradient(
                145deg,
                rgba(59, 130, 246, .13),
                rgba(139, 92, 246, .09)
            );
        }

        .tf-confirm-mobile-icon svg {
            width: 23px;
            height: 23px;
        }

        .tf-confirm-form-kicker {
            display: block;
            margin-bottom: 5px;
            color: #60a5fa;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .tf-confirm-form-header h2 {
            margin: 0;
            color: #f8fafc;
            font-size: clamp(24px, 2.5vw, 31px);
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: -.035em;
        }

        .tf-confirm-form-header p {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        .tf-confirm-form {
            width: 100%;
        }

        .tf-confirm-field {
            width: 100%;
        }

        .tf-confirm-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 9px;
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 700;
        }

        .tf-confirm-required {
            color: #475569;
            font-size: 10px;
            font-weight: 600;
        }

        .tf-confirm-input-wrap {
            position: relative;
        }

        .tf-confirm-input {
            width: 100%;
            height: 56px;
            padding: 0 52px;
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

        .tf-confirm-input::placeholder {
            color: #475569;
        }

        .tf-confirm-input:hover {
            border-color: rgba(148, 163, 184, .24);
        }

        .tf-confirm-input:focus {
            border-color: rgba(59, 130, 246, .7);
            background: rgba(15, 23, 42, .9);
            box-shadow:
                0 0 0 4px rgba(59, 130, 246, .09),
                0 10px 30px rgba(37, 99, 235, .07);
        }

        .tf-confirm-input-icon {
            position: absolute;
            top: 50%;
            left: 17px;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #64748b;
            pointer-events: none;
            transition: color .2s ease;
        }

        .tf-confirm-input-icon svg {
            width: 100%;
            height: 100%;
        }

        .tf-confirm-input:focus ~ .tf-confirm-input-icon {
            color: #60a5fa;
        }

        [dir="rtl"] .tf-confirm-input {
            padding-left: 52px;
            padding-right: 52px;
        }

        [dir="rtl"] .tf-confirm-input-icon {
            left: auto;
            right: 17px;
        }

        .tf-confirm-toggle {
            position: absolute;
            top: 50%;
            right: 14px;
            width: 32px;
            height: 32px;
            padding: 0;
            display: grid;
            place-items: center;
            transform: translateY(-50%);
            border: 0;
            border-radius: 9px;
            color: #64748b;
            background: transparent;
            cursor: pointer;
            transition:
                color .2s ease,
                background .2s ease;
        }

        .tf-confirm-toggle:hover,
        .tf-confirm-toggle:focus-visible {
            color: #93c5fd;
            background: rgba(59, 130, 246, .09);
            outline: none;
        }

        .tf-confirm-toggle svg {
            width: 18px;
            height: 18px;
        }

        [dir="rtl"] .tf-confirm-toggle {
            right: auto;
            left: 14px;
        }

        .tf-confirm-eye-hide {
            display: none;
        }

        .tf-confirm-error {
            min-height: 18px;
            margin-top: 7px;
            color: #fca5a5;
            font-size: 11px;
        }

        .tf-confirm-error p {
            margin: 0;
        }

        .tf-confirm-submit {
            position: relative;
            width: 100%;
            height: 56px;
            margin-top: 20px;
            overflow: hidden;
            border: 0;
            border-radius: 14px;
            color: #fff;
            background: linear-gradient(110deg, #2563eb 0%, #4f46e5 52%, #7c3aed 100%);
            box-shadow:
                0 15px 32px rgba(37, 99, 235, .22),
                inset 0 1px 0 rgba(255, 255, 255, .16);
            cursor: pointer;
            transition:
                transform .2s ease,
                box-shadow .2s ease,
                filter .2s ease;
        }

        .tf-confirm-submit:hover {
            transform: translateY(-2px);
            filter: brightness(1.06);
            box-shadow:
                0 20px 38px rgba(37, 99, 235, .3),
                inset 0 1px 0 rgba(255, 255, 255, .18);
        }

        .tf-confirm-submit:active {
            transform: translateY(0);
        }

        .tf-confirm-submit:focus-visible {
            outline: 3px solid rgba(96, 165, 250, .28);
            outline-offset: 3px;
        }

        .tf-confirm-submit-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .01em;
        }

        .tf-confirm-submit-content svg {
            width: 19px;
            height: 19px;
            transition: transform .2s ease;
        }

        .tf-confirm-submit:hover .tf-confirm-submit-content svg {
            transform: translateX(3px);
        }

        [dir="rtl"] .tf-confirm-submit:hover .tf-confirm-submit-content svg {
            transform: translateX(-3px);
        }

        .tf-confirm-submit-shine {
            position: absolute;
            top: 0;
            left: -100%;
            width: 45%;
            height: 100%;
            transform: skewX(-20deg);
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, .14),
                transparent
            );
            transition: left .7s ease;
        }

        .tf-confirm-submit:hover .tf-confirm-submit-shine {
            left: 150%;
        }

        .tf-confirm-footer {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 26px;
            color: #475569;
            font-size: 9px;
            text-align: center;
        }

        .tf-confirm-footer-line {
            height: 1px;
            flex: 1;
            background: rgba(148, 163, 184, .08);
        }

        .tf-confirm-copyright {
            margin: 16px 0 0;
            color: #334155;
            font-size: 9px;
            text-align: center;
        }

        /* Tablet */
        @media (max-width: 900px) {
            .tf-confirm-page {
                height: auto;
                min-height: 100dvh;
                overflow: auto;
                padding: 24px;
            }

            .tf-confirm-card {
                grid-template-columns: minmax(0, .8fr) minmax(360px, 1.2fr);
                min-height: 530px;
            }

            .tf-confirm-brand {
                padding: 36px;
            }

            .tf-confirm-form-panel {
                padding: 42px 38px;
            }

            .tf-confirm-brand-content h1 {
                font-size: 38px;
            }
        }

        /* Mobile */
        @media (max-width: 700px) {
            .tf-confirm-page {
                height: auto;
                min-height: 100dvh;
                padding: 16px;
                overflow-x: hidden;
            }

            .tf-confirm-card {
                display: block;
                min-height: auto;
                border-radius: 24px;
            }

            .tf-confirm-brand {
                padding: 28px 24px;
                border-inline-end: 0;
                border-bottom: 1px solid rgba(148, 163, 184, .11);
            }

            .tf-confirm-brand-content {
                padding-block: 30px 24px;
            }

            .tf-confirm-brand-content h1 {
                font-size: 34px;
            }

            .tf-confirm-brand-content p {
                font-size: 13px;
                line-height: 1.7;
            }

            .tf-confirm-security {
                padding: 13px;
            }

            .tf-confirm-form-panel {
                padding: 30px 24px 28px;
            }

            .tf-confirm-form-header {
                margin-bottom: 26px;
            }

            .tf-confirm-form-header h2 {
                font-size: 25px;
            }

            .tf-confirm-footer {
                font-size: 8px;
            }
        }

        /* Small phones */
        @media (max-width: 420px) {
            .tf-confirm-page {
                padding: 10px;
            }

            .tf-confirm-card {
                border-radius: 20px;
            }

            .tf-confirm-brand {
                padding: 24px 19px;
            }

            .tf-confirm-form-panel {
                padding: 26px 19px 24px;
            }

            .tf-confirm-logo {
                width: 43px;
                height: 43px;
                flex-basis: 43px;
            }

            .tf-confirm-brand-content h1 {
                font-size: 31px;
            }

            .tf-confirm-security span {
                font-size: 9px;
            }
        }

        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .tf-confirm-star,
            .tf-confirm-submit,
            .tf-confirm-submit-shine,
            .tf-confirm-submit-content svg,
            .tf-confirm-input,
            .tf-confirm-toggle {
                animation: none !important;
                transition: none !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.querySelector('[data-password-toggle="password"]');
            const input = document.getElementById('password');

            if (!toggle || !input) {
                return;
            }

            const showIcon = toggle.querySelector('.tf-confirm-eye-show');
            const hideIcon = toggle.querySelector('.tf-confirm-eye-hide');

            toggle.addEventListener('click', function () {
                const isPassword = input.type === 'password';

                input.type = isPassword ? 'text' : 'password';

                if (showIcon && hideIcon) {
                    showIcon.style.display = isPassword ? 'none' : 'block';
                    hideIcon.style.display = isPassword ? 'block' : 'none';
                }

                const label = isPassword
                    ? @json(__('Hide password'))
                    : @json(__('Show password'));

                toggle.setAttribute('aria-label', label);
                toggle.setAttribute('title', label);
            });
        });
    </script>
</x-guest-layout>

