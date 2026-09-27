
<x-guest-layout>

    <div
        class="tf-register-page"
        dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
    >

        {{-- Ambient Background --}}
        <div class="tf-register-bg tf-register-bg-one"></div>
        <div class="tf-register-bg tf-register-bg-two"></div>
        <div class="tf-register-grid"></div>

        {{-- Stars --}}
        <div class="tf-register-stars" aria-hidden="true">
            <span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span>
        </div>

        <main class="tf-register-main">

            <section class="tf-register-card">

                {{-- =================================================
                     LEFT BRAND PANEL
                ================================================== --}}
                <div class="tf-register-brand">

                    <div class="tf-register-brand-content">

                        {{-- Logo --}}
                        <div class="tf-register-logo">
                            <div class="tf-register-logo-icon">
                                <i class="bi bi-check2-square"></i>
                            </div>

                            <span>TaskFlow</span>
                        </div>


                        {{-- Hero --}}
                        <div class="tf-register-hero">

                            <span class="tf-register-eyebrow">
                                {{ __('START YOUR WORKFLOW') }}
                            </span>

                            <h1>
                                {{ __('Build.') }}
                                <span>{{ __('Organize. Achieve.') }}</span>
                            </h1>

                            <p>
                                {{ __('Create your workspace and bring your projects, tasks and team together in one focused place.') }}
                            </p>

                        </div>


                        {{-- Benefits --}}
                        <div class="tf-register-benefits">

                            <div class="tf-register-benefit">
                                <div class="tf-register-benefit-icon">
                                    <i class="bi bi-lightning-charge"></i>
                                </div>

                                <div>
                                    <strong>{{ __('Fast setup') }}</strong>
                                    <small>{{ __('Get started in moments') }}</small>
                                </div>
                            </div>

                            <div class="tf-register-benefit">
                                <div class="tf-register-benefit-icon">
                                    <i class="bi bi-kanban"></i>
                                </div>

                                <div>
                                    <strong>{{ __('Stay organized') }}</strong>
                                    <small>{{ __('Keep work under control') }}</small>
                                </div>
                            </div>

                            <div class="tf-register-benefit">
                                <div class="tf-register-benefit-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>

                                <div>
                                    <strong>{{ __('Secure workspace') }}</strong>
                                    <small>{{ __('Your account stays protected') }}</small>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="tf-register-brand-glow"></div>

                </div>


                {{-- =================================================
                     RIGHT REGISTER PANEL
                ================================================== --}}
                <div class="tf-register-form-panel">

                    <div class="tf-register-form-inner">

                        {{-- Heading --}}
                        <div class="tf-register-heading">

                            <span class="tf-register-welcome">
                                {{ __('CREATE ACCOUNT') }}
                            </span>

                            <h2>
                                {{ __('Create your TaskFlow account') }}
                            </h2>

                            <p>
                                {{ __('Set up your account and start managing your work.') }}
                            </p>

                        </div>


                        {{-- Form --}}
                        <form
                            method="POST"
                            action="{{ route('register') }}"
                            class="tf-register-form"
                        >
                            @csrf


                            {{-- Name --}}
                            <div class="tf-register-field">

                                <x-input-label
                                    for="name"
                                    :value="__('Name')"
                                    class="tf-register-label"
                                />

                                <div class="tf-register-input-wrap">

                                    <i class="bi bi-person tf-register-input-icon"></i>

                                    <x-text-input
                                        id="name"
                                        class="tf-register-input"
                                        type="text"
                                        name="name"
                                        :value="old('name')"
                                        required
                                        autofocus
                                        autocomplete="name"
                                        placeholder="{{ __('Your name') }}"
                                    />

                                </div>

                                <x-input-error
                                    :messages="$errors->get('name')"
                                    class="tf-register-error"
                                />

                            </div>


                            {{-- Email --}}
                            <div class="tf-register-field">

                                <x-input-label
                                    for="email"
                                    :value="__('Email')"
                                    class="tf-register-label"
                                />

                                <div class="tf-register-input-wrap">

                                    <i class="bi bi-envelope tf-register-input-icon"></i>

                                    <x-text-input
                                        id="email"
                                        class="tf-register-input"
                                        type="email"
                                        name="email"
                                        :value="old('email')"
                                        required
                                        autocomplete="username"
                                        placeholder="{{ __('Your email address') }}"
                                    />

                                </div>

                                <x-input-error
                                    :messages="$errors->get('email')"
                                    class="tf-register-error"
                                />

                            </div>


                            {{-- Password --}}
                            <div class="tf-register-field">

                                <x-input-label
                                    for="password"
                                    :value="__('Password')"
                                    class="tf-register-label"
                                />

                                <div class="tf-register-input-wrap">

                                    <i class="bi bi-lock tf-register-input-icon"></i>

                                    <x-text-input
                                        id="password"
                                        class="tf-register-input tf-register-password-input"
                                        type="password"
                                        name="password"
                                        required
                                        autocomplete="new-password"
                                        placeholder="{{ __('Create a password') }}"
                                    />

                                    <button
                                        type="button"
                                        class="tf-register-password-toggle"
                                        data-target="password"
                                        aria-label="{{ __('Show password') }}"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>

                                </div>

                                <x-input-error
                                    :messages="$errors->get('password')"
                                    class="tf-register-error"
                                />

                            </div>


                            {{-- Confirm Password --}}
                            <div class="tf-register-field">

                                <x-input-label
                                    for="password_confirmation"
                                    :value="__('Confirm Password')"
                                    class="tf-register-label"
                                />

                                <div class="tf-register-input-wrap">

                                    <i class="bi bi-shield-lock tf-register-input-icon"></i>

                                    <x-text-input
                                        id="password_confirmation"
                                        class="tf-register-input tf-register-password-input"
                                        type="password"
                                        name="password_confirmation"
                                        required
                                        autocomplete="new-password"
                                        placeholder="{{ __('Confirm your password') }}"
                                    />

                                    <button
                                        type="button"
                                        class="tf-register-password-toggle"
                                        data-target="password_confirmation"
                                        aria-label="{{ __('Show password') }}"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>

                                </div>

                                <x-input-error
                                    :messages="$errors->get('password_confirmation')"
                                    class="tf-register-error"
                                />

                            </div>


                            {{-- Actions --}}
                            <div class="tf-register-actions">

                                <a
                                    href="{{ route('login') }}"
                                    class="tf-register-login-link"
                                >
                                    <i class="bi bi-arrow-left"></i>

                                    <span>
                                        {{ __('Already registered?') }}
                                    </span>
                                </a>


                                <button
                                    type="submit"
                                    class="tf-register-submit"
                                >
                                    <span>{{ __('Register') }}</span>
                                    <i class="bi bi-arrow-right"></i>
                                </button>

                            </div>

                        </form>


                        {{-- Security --}}
                        <div class="tf-register-security">
                            <i class="bi bi-shield-check"></i>

                            <span>
                                {{ __('Your account information is securely handled.') }}
                            </span>
                        </div>

                    </div>

                </div>

            </section>

        </main>

    </div>


    <style>

        /* =========================================================
           TASKFLOW REGISTER
           Completely isolated styles
        ========================================================= */

        .tf-register-page {
            position: relative;

            width: 100%;
            height: 100dvh;
            min-height: 600px;

            overflow: hidden;

            isolation: isolate;

            color: #f8fafc;

            background:
                radial-gradient(
                    circle at 10% 45%,
                    rgba(37, 99, 235, .16),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 90% 20%,
                    rgba(124, 58, 237, .15),
                    transparent 30%
                ),
                #020617;
        }


        /* =========================================================
           BACKGROUND
        ========================================================= */

        .tf-register-bg {
            position: absolute;

            border-radius: 50%;

            filter: blur(85px);

            pointer-events: none;

            z-index: -2;
        }

        .tf-register-bg-one {
            width: 430px;
            height: 430px;

            left: -190px;
            top: 15%;

            background: rgba(37, 99, 235, .14);
        }

        .tf-register-bg-two {
            width: 380px;
            height: 380px;

            right: -150px;
            bottom: -110px;

            background: rgba(124, 58, 237, .13);
        }


        .tf-register-grid {
            position: absolute;

            inset: 0;

            z-index: -3;

            opacity: .21;

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

            background-size: 42px 42px;

            mask-image:
                linear-gradient(
                    to bottom,
                    transparent,
                    black 18%,
                    black 82%,
                    transparent
                );
        }


        /* =========================================================
           STARS
        ========================================================= */

        .tf-register-stars {
            position: absolute;

            inset: 0;

            pointer-events: none;

            z-index: -1;
        }

        .tf-register-stars span {
            position: absolute;

            width: 3px;
            height: 3px;

            border-radius: 50%;

            background: rgba(255,255,255,.72);

            box-shadow:
                0 0 10px rgba(147,197,253,.7);

            animation:
                tf-register-twinkle
                3.2s
                infinite
                ease-in-out;
        }

        .tf-register-stars span:nth-child(1)  { left: 6%;  top: 17%; }
        .tf-register-stars span:nth-child(2)  { left: 16%; top: 80%; animation-delay: .4s; }
        .tf-register-stars span:nth-child(3)  { left: 28%; top: 10%; animation-delay: 1s; }
        .tf-register-stars span:nth-child(4)  { left: 40%; top: 88%; animation-delay: 1.4s; }
        .tf-register-stars span:nth-child(5)  { left: 53%; top: 12%; animation-delay: 2s; }
        .tf-register-stars span:nth-child(6)  { left: 65%; top: 82%; animation-delay: .8s; }
        .tf-register-stars span:nth-child(7)  { left: 78%; top: 15%; animation-delay: 1.3s; }
        .tf-register-stars span:nth-child(8)  { left: 92%; top: 65%; animation-delay: 1.8s; }
        .tf-register-stars span:nth-child(9)  { left: 11%; top: 48%; animation-delay: 2.2s; }
        .tf-register-stars span:nth-child(10) { left: 23%; top: 31%; animation-delay: .2s; }
        .tf-register-stars span:nth-child(11) { left: 72%; top: 45%; animation-delay: 1.5s; }
        .tf-register-stars span:nth-child(12) { left: 86%; top: 84%; animation-delay: 2.1s; }
        .tf-register-stars span:nth-child(13) { left: 36%; top: 70%; animation-delay: .9s; }
        .tf-register-stars span:nth-child(14) { left: 60%; top: 27%; animation-delay: 1.7s; }
        .tf-register-stars span:nth-child(15) { left: 4%;  top: 90%; animation-delay: 1.1s; }
        .tf-register-stars span:nth-child(16) { left: 96%; top: 20%; animation-delay: 2.4s; }

        @keyframes tf-register-twinkle {

            0%, 100% {
                opacity: .2;
                transform: scale(.7);
            }

            50% {
                opacity: 1;
                transform: scale(1.4);
            }
        }


        /* =========================================================
           MAIN
        ========================================================= */

        .tf-register-main {
            position: relative;

            width: 100%;
            height: 100%;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 28px 40px;
        }


        /* =========================================================
           CARD
        ========================================================= */

        .tf-register-card {
            position: relative;

            display: grid;

            grid-template-columns:
                minmax(0, 1.08fr)
                minmax(440px, .92fr);

            width: min(1180px, 100%);

            height: min(
                650px,
                calc(100dvh - 56px)
            );

            min-height: 570px;

            overflow: hidden;

            border:
                1px solid
                rgba(148,163,184,.16);

            border-radius: 30px;

            background:
                linear-gradient(
                    135deg,
                    rgba(15,23,42,.89),
                    rgba(2,6,23,.84)
                );

            box-shadow:
                0 35px 100px rgba(0,0,0,.55),
                0 0 0 1px rgba(255,255,255,.025),
                0 0 80px rgba(37,99,235,.08);

            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
        }


        /* =========================================================
           BRAND
        ========================================================= */

        .tf-register-brand {
            position: relative;

            display: flex;
            align-items: center;

            overflow: hidden;

            padding: 55px 60px;

            border-right:
                1px solid
                rgba(148,163,184,.10);

            background:
                linear-gradient(
                    145deg,
                    rgba(15,23,42,.82),
                    rgba(15,23,42,.44)
                );
        }

        .tf-register-brand-content {
            position: relative;

            z-index: 2;

            width: 100%;
        }


        /* Logo */

        .tf-register-logo {
            display: flex;
            align-items: center;

            gap: 12px;

            margin-bottom: 48px;

            font-size: 23px;

            font-weight: 800;

            letter-spacing: -.5px;
        }

        .tf-register-logo-icon {
            width: 43px;
            height: 43px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 13px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #7c3aed
                );

            box-shadow:
                0 10px 30px rgba(37,99,235,.35),
                inset 0 1px rgba(255,255,255,.25);

            font-size: 21px;
        }


        /* Hero */

        .tf-register-eyebrow {
            display: inline-flex;
            align-items: center;

            gap: 8px;

            margin-bottom: 17px;

            font-size: 10px;

            font-weight: 800;

            letter-spacing: 2px;

            color: #60a5fa;
        }

        .tf-register-eyebrow::before {
            content: "";

            width: 24px;
            height: 1px;

            background:
                linear-gradient(
                    90deg,
                    #3b82f6,
                    transparent
                );
        }

        .tf-register-hero h1 {
            max-width: 540px;

            margin: 0;

            font-size: clamp(
                38px,
                4vw,
                56px
            );

            line-height: 1.03;

            letter-spacing: -2.7px;

            font-weight: 800;
        }

        .tf-register-hero h1 span {
            display: block;

            margin-top: 5px;

            background:
                linear-gradient(
                    90deg,
                    #60a5fa,
                    #a78bfa
                );

            -webkit-background-clip: text;
            background-clip: text;

            color: transparent;
        }

        .tf-register-hero p {
            max-width: 500px;

            margin: 22px 0 0;

            color: #94a3b8;

            font-size: 14px;

            line-height: 1.8;
        }


        /* Benefits */

        .tf-register-benefits {
            display: flex;

            gap: 11px;

            margin-top: 37px;
        }

        .tf-register-benefit {
            flex: 1;
            min-width: 0;

            display: flex;
            align-items: center;

            gap: 10px;

            padding: 12px;

            border:
                1px solid
                rgba(148,163,184,.09);

            border-radius: 14px;

            background:
                rgba(15,23,42,.52);
        }

        .tf-register-benefit-icon {
            flex: 0 0 auto;

            width: 34px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background:
                rgba(37,99,235,.12);

            color: #60a5fa;
        }

        .tf-register-benefit strong {
            display: block;

            font-size: 10px;

            font-weight: 700;

            color: #e2e8f0;
        }

        .tf-register-benefit small {
            display: block;

            margin-top: 2px;

            color: #64748b;

            font-size: 8.5px;
        }


        .tf-register-brand-glow {
            position: absolute;

            width: 320px;
            height: 320px;

            right: -170px;
            bottom: -180px;

            border-radius: 50%;

            background:
                rgba(37,99,235,.15);

            filter: blur(60px);

            pointer-events: none;
        }


        /* =========================================================
           FORM PANEL
        ========================================================= */

        .tf-register-form-panel {
            display: flex;

            align-items: center;
            justify-content: center;

            padding: 42px 55px;

            background:
                linear-gradient(
                    145deg,
                    rgba(2,6,23,.34),
                    rgba(15,23,42,.28)
                );
        }

        .tf-register-form-inner {
            width: min(100%, 410px);
        }


        /* Heading */

        .tf-register-heading {
            margin-bottom: 25px;
        }

        .tf-register-welcome {
            font-size: 10px;

            font-weight: 800;

            letter-spacing: 2px;

            color: #60a5fa;
        }

        .tf-register-heading h2 {
            margin: 8px 0 7px;

            color: #f8fafc;

            font-size: 28px;

            line-height: 1.15;

            letter-spacing: -1px;

            font-weight: 800;
        }

        .tf-register-heading p {
            margin: 0;

            color: #64748b;

            font-size: 11px;

            line-height: 1.6;
        }


        /* Form */

        .tf-register-form {
            display: grid;

            grid-template-columns: 1fr 1fr;

            column-gap: 14px;
            row-gap: 15px;
        }


        .tf-register-field {
            position: relative;
            min-width: 0;
        }


        /* Labels */

        .tf-register-label {
            display: block;

            margin-bottom: 7px;

            color: #cbd5e1 !important;

            font-size: 10px;

            font-weight: 700;
        }


        /* Inputs */

        .tf-register-input-wrap {
            position: relative;
        }

        .tf-register-input-icon {
            position: absolute;

            z-index: 2;

            top: 50%;
            left: 14px;

            transform: translateY(-50%);

            color: #64748b;

            pointer-events: none;

            transition: .2s ease;
        }

        .tf-register-input {
            width: 100% !important;

            height: 46px;

            padding:
                0 40px !important;

            border:
                1px solid
                rgba(148,163,184,.15) !important;

            border-radius: 12px !important;

            outline: none !important;

            background:
                rgba(15,23,42,.72) !important;

            color: #f8fafc !important;

            box-shadow:
                inset 0 1px
                rgba(255,255,255,.025) !important;

            font-size: 11px;

            transition: .2s ease;
        }

        .tf-register-input::placeholder {
            color: #475569;
        }

        .tf-register-input:focus {
            border-color:
                rgba(59,130,246,.65) !important;

            background:
                rgba(15,23,42,.92) !important;

            box-shadow:
                0 0 0 3px
                rgba(59,130,246,.09),
                0 10px 30px
                rgba(0,0,0,.12) !important;
        }

        .tf-register-input-wrap:focus-within
        .tf-register-input-icon {
            color: #60a5fa;
        }


        /* Password toggle */

        .tf-register-password-toggle {
            position: absolute;

            z-index: 3;

            top: 50%;
            right: 11px;

            transform: translateY(-50%);

            width: 28px;
            height: 28px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 0;

            border-radius: 8px;

            background: transparent;

            color: #64748b;

            cursor: pointer;

            transition: .2s ease;
        }

        .tf-register-password-toggle:hover {
            background:
                rgba(148,163,184,.08);

            color: #cbd5e1;
        }


        /* RTL */

        [dir="rtl"] .tf-register-input-icon {
            left: auto;
            right: 14px;
        }

        [dir="rtl"] .tf-register-input {
            padding-left: 40px !important;
            padding-right: 40px !important;
        }

        [dir="rtl"] .tf-register-password-toggle {
            right: auto;
            left: 11px;
        }


        /* Errors */

        .tf-register-error {
            margin-top: 5px !important;

            font-size: 9px !important;

            color: #f87171 !important;
        }


        /* =========================================================
           ACTIONS
        ========================================================= */

        .tf-register-actions {
            grid-column: 1 / -1;

            display: flex;

            align-items: center;
            justify-content: space-between;

            gap: 15px;

            margin-top: 3px;
        }


        .tf-register-login-link {
            display: inline-flex;

            align-items: center;

            gap: 7px;

            color: #64748b;

            font-size: 10px;

            font-weight: 600;

            text-decoration: none;

            transition: .2s ease;
        }

        .tf-register-login-link:hover {
            color: #93c5fd;
        }

        .tf-register-login-link i {
            transition: transform .2s ease;
        }

        .tf-register-login-link:hover i {
            transform: translateX(-3px);
        }

        [dir="rtl"] .tf-register-login-link:hover i {
            transform: translateX(3px);
        }


        /* Register button */

        .tf-register-submit {
            position: relative;

            height: 47px;

            min-width: 150px;

            display: flex;

            align-items: center;
            justify-content: center;

            gap: 9px;

            border: 0;

            border-radius: 12px;

            background:
                linear-gradient(
                    100deg,
                    #2563eb,
                    #6366f1,
                    #7c3aed
                );

            color: #fff;

            font-size: 11px;

            font-weight: 800;

            cursor: pointer;

            overflow: hidden;

            box-shadow:
                0 12px 28px
                rgba(37,99,235,.24),
                inset 0 1px
                rgba(255,255,255,.22);

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .tf-register-submit::before {
            content: "";

            position: absolute;

            inset: 0;

            background:
                linear-gradient(
                    110deg,
                    transparent 25%,
                    rgba(255,255,255,.18) 50%,
                    transparent 75%
                );

            transform: translateX(-100%);

            transition:
                transform .6s ease;
        }

        .tf-register-submit:hover {
            transform: translateY(-2px);

            box-shadow:
                0 18px 38px
                rgba(37,99,235,.34),
                inset 0 1px
                rgba(255,255,255,.25);
        }

        .tf-register-submit:hover::before {
            transform: translateX(100%);
        }

        .tf-register-submit i {
            transition: transform .2s ease;
        }

        .tf-register-submit:hover i {
            transform: translateX(4px);
        }

        [dir="rtl"] .tf-register-submit:hover i {
            transform: translateX(-4px);
        }


        /* Security */

        .tf-register-security {
            display: flex;

            align-items: center;
            justify-content: center;

            gap: 6px;

            margin-top: 19px;

            color: #475569;

            font-size: 8.5px;
        }

        .tf-register-security i {
            color: #22c55e;

            font-size: 11px;
        }


        /* =========================================================
           TABLET
        ========================================================= */

        @media (max-width: 1050px) {

            .tf-register-main {
                padding: 22px;
            }

            .tf-register-card {
                grid-template-columns: 1fr 1fr;

                height:
                    min(
                        620px,
                        calc(100dvh - 44px)
                    );
            }

            .tf-register-brand {
                padding: 42px;
            }

            .tf-register-form-panel {
                padding: 36px;
            }

            .tf-register-benefits {
                gap: 7px;
            }

            .tf-register-benefit {
                padding: 9px;
            }

            .tf-register-benefit small {
                display: none;
            }
        }


        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 768px) {

            .tf-register-page {
                height: auto;

                min-height: 100dvh;

                overflow-y: auto;
            }

            .tf-register-main {
                height: auto;

                min-height: 100dvh;

                align-items: flex-start;

                padding: 18px;
            }

            .tf-register-card {
                display: block;

                width: 100%;

                height: auto;

                min-height: 0;

                margin: auto;

                border-radius: 24px;
            }

            .tf-register-brand {
                min-height: auto;

                padding: 32px 25px;

                border-right: 0;

                border-bottom:
                    1px solid
                    rgba(148,163,184,.10);
            }

            .tf-register-logo {
                margin-bottom: 28px;
            }

            .tf-register-hero h1 {
                font-size: 34px;

                letter-spacing: -1.8px;
            }

            .tf-register-hero p {
                margin-top: 16px;
            }

            .tf-register-benefits {
                margin-top: 25px;
            }

            .tf-register-form-panel {
                padding: 32px 25px 35px;
            }

            .tf-register-form {
                grid-template-columns: 1fr;

                row-gap: 17px;
            }

            .tf-register-actions {
                grid-column: auto;

                margin-top: 3px;
            }

            .tf-register-submit {
                min-width: 135px;
            }
        }


        /* =========================================================
           SMALL MOBILE
        ========================================================= */

        @media (max-width: 480px) {

            .tf-register-benefits {
                display: grid;

                grid-template-columns: 1fr;
            }

            .tf-register-benefit small {
                display: block;
            }

            .tf-register-actions {
                align-items: stretch;

                flex-direction: column-reverse;
            }

            .tf-register-submit {
                width: 100%;
            }

            .tf-register-login-link {
                justify-content: center;
            }
        }


        /* =========================================================
           REDUCED MOTION
        ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            .tf-register-stars span,
            .tf-register-submit,
            .tf-register-submit::before,
            .tf-register-submit i,
            .tf-register-login-link i {
                animation: none !important;

                transition: none !important;
            }
        }

    </style>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const toggles =
                document.querySelectorAll(
                    '.tf-register-password-toggle'
                );

            toggles.forEach(function (toggle) {

                toggle.addEventListener('click', function () {

                    const targetId =
                        toggle.getAttribute('data-target');

                    const input =
                        document.getElementById(targetId);

                    if (!input) {
                        return;
                    }

                    const icon =
                        toggle.querySelector('i');

                    const isPassword =
                        input.type === 'password';

                    input.type =
                        isPassword
                            ? 'text'
                            : 'password';

                    if (icon) {

                        icon.className =
                            isPassword
                                ? 'bi bi-eye-slash'
                                : 'bi bi-eye';
                    }

                    toggle.setAttribute(
                        'aria-label',
                        isPassword
                            ? @json(__('Hide password'))
                            : @json(__('Show password'))
                    );

                });

            });

        });
    </script>

</x-guest-layout>

