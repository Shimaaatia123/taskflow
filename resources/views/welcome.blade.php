<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <title>
        TaskFlow —
        {{ app()->getLocale() === 'ar' ? 'إدارة المشاريع والمهام' : 'Project & Task Management' }}
    </title>

    <meta name="description"
        content="{{ app()->getLocale() === 'ar'
            ? 'TaskFlow يساعدك على تنظيم المشاريع والمهام والفريق في مساحة عمل واحدة.'
            : 'TaskFlow helps you organize projects, tasks, and teams in one focused workspace.' }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --tf-bg: #020617;
            --tf-bg-soft: #07101f;

            --tf-white: #f8fafc;
            --tf-text: #e2e8f0;
            --tf-muted: #94a3b8;
            --tf-soft: #64748b;

            --tf-cyan: #38bdf8;
            --tf-cyan-bright: #7dd3fc;
            --tf-blue: #2563eb;
            --tf-indigo: #6366f1;
            --tf-purple: #7c3aed;
            --tf-violet: #c084fc;
            --tf-green: #86efac;

            --tf-border: rgba(148, 163, 184, .14);

            --tf-safe-top: env(safe-area-inset-top, 0px);
            --tf-safe-bottom: env(safe-area-inset-bottom, 0px);
            --tf-safe-right: env(safe-area-inset-right, 0px);
            --tf-safe-left: env(safe-area-inset-left, 0px);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden;
            color: var(--tf-white);
            background: var(--tf-bg);

            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        ::selection {
            background: rgba(56, 189, 248, .25);
            color: #fff;
        }

        a {
            text-decoration: none;
        }

        /* Accessible keyboard focus — visible without breaking the custom look */
        :focus-visible {
            outline: 2px solid var(--tf-cyan);
            outline-offset: 3px;
            border-radius: 6px;
        }

        section[id] {
            scroll-margin-top: 125px;
        }

        /* =========================================================
           MAIN PAGE
        ========================================================== */

        .taskflow-landing {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            isolation: isolate;

            background:
                radial-gradient(circle at 50% -8%,
                    rgba(37, 99, 235, .15),
                    transparent 30%),

                radial-gradient(circle at 92% 16%,
                    rgba(124, 58, 237, .12),
                    transparent 27%),

                radial-gradient(circle at 5% 58%,
                    rgba(14, 165, 233, .08),
                    transparent 24%),

                linear-gradient(180deg,
                    #020617 0%,
                    #040a17 46%,
                    #071122 100%);
        }

        /* =========================================================
           GRID
        ========================================================== */

        .taskflow-grid {
            position: absolute;
            inset: 0;
            z-index: -7;
            pointer-events: none;

            opacity: .22;

            background-image:
                linear-gradient(rgba(148, 163, 184, .045) 1px,
                    transparent 1px),
                linear-gradient(90deg,
                    rgba(148, 163, 184, .045) 1px,
                    transparent 1px);

            background-size: 72px 72px;

            mask-image:
                linear-gradient(to bottom,
                    black 0%,
                    transparent 74%);

            -webkit-mask-image:
                linear-gradient(to bottom,
                    black 0%,
                    transparent 74%);
        }

        .taskflow-vignette {
            position: absolute;
            inset: 0;
            z-index: -6;
            pointer-events: none;

            background:
                radial-gradient(circle at center,
                    transparent 35%,
                    rgba(2, 6, 23, .42) 100%);
        }

        /* =========================================================
           STARS
        ========================================================== */

        .taskflow-stars,
        .taskflow-stars::before,
        .taskflow-stars::after {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .taskflow-stars {
            z-index: -5;
            opacity: .78;
        }

        .taskflow-stars::before {
            content: "";

            background-image:
                radial-gradient(circle,
                    rgba(255, 255, 255, .92) 0 1px,
                    transparent 1.7px),
                radial-gradient(circle,
                    rgba(125, 211, 252, .65) 0 1px,
                    transparent 1.8px);

            background-size:
                94px 94px,
                153px 153px;

            background-position:
                12px 18px,
                58px 37px;

            animation:
                tf-stars-drift 28s linear infinite;
        }

        .taskflow-stars::after {
            content: "";

            background-image:
                radial-gradient(circle,
                    rgba(255, 255, 255, .64) 0 1px,
                    transparent 1.8px),
                radial-gradient(circle,
                    rgba(192, 132, 252, .56) 0 1px,
                    transparent 1.8px);

            background-size:
                184px 184px,
                129px 129px;

            background-position:
                20px 83px,
                105px 20px;

            opacity: .58;

            animation:
                tf-stars-drift-reverse 36s linear infinite;
        }

        @keyframes tf-stars-drift {

            from {
                transform: translate3d(0, 0, 0);
            }

            to {
                transform: translate3d(-75px, 55px, 0);
            }
        }

        @keyframes tf-stars-drift-reverse {

            from {
                transform: translate3d(0, 0, 0);
            }

            to {
                transform: translate3d(55px, -46px, 0);
            }
        }

        .taskflow-star {
            position: absolute;

            left: var(--x);
            top: var(--y);

            width: 4px;
            height: 4px;

            border-radius: 50%;

            background: #fff;

            opacity: var(--opacity);

            box-shadow:
                0 0 8px rgba(255, 255, 255, .85),
                0 0 18px rgba(56, 189, 248, .42);

            animation:
                tf-twinkle var(--duration) ease-in-out infinite;

            animation-delay: var(--delay);
        }

        @keyframes tf-twinkle {

            0%,
            100% {
                transform: scale(.55);
                opacity: .18;
            }

            50% {
                transform: scale(1.5);
                opacity: 1;
            }
        }

        /* =========================================================
           BACKGROUND ORBS
        ========================================================== */

        .taskflow-orb {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            z-index: -4;
            filter: blur(3px);
        }

        .taskflow-orb-a {
            left: -160px;
            top: 95px;

            width: 470px;
            height: 470px;

            background:
                radial-gradient(circle,
                    rgba(37, 99, 235, .17),
                    transparent 72%);
        }

        .taskflow-orb-b {
            right: -180px;
            top: 50px;

            width: 550px;
            height: 550px;

            background:
                radial-gradient(circle,
                    rgba(124, 58, 237, .16),
                    transparent 73%);
        }

        .taskflow-orb-c {
            left: 39%;
            bottom: -260px;

            width: 480px;
            height: 480px;

            background:
                radial-gradient(circle,
                    rgba(14, 165, 233, .10),
                    transparent 73%);
        }

        /* =========================================================
           CURSOR GLOW
           Desktop-with-mouse only — see (hover:none) rule below,
           which removes it entirely on touch devices where it has
           no purpose and only costs paint/battery.
        ========================================================== */

        .taskflow-cursor-glow {
            position: fixed;

            top: var(--my, 35%);
            left: var(--mx, 50%);

            z-index: -1;

            width: 280px;
            height: 280px;

            border-radius: 50%;

            transform: translate(-50%, -50%);

            pointer-events: none;

            background:
                radial-gradient(circle,
                    rgba(56, 189, 248, .06),
                    transparent 68%);

            filter: blur(4px);

            transition:
                left .16s ease-out,
                top .16s ease-out;
        }

        @media (hover: none) {

            .taskflow-cursor-glow {
                display: none;
            }
        }

        /* =========================================================
           FLOATING NAVBAR
        ========================================================== */

        .taskflow-public-nav-wrap {
            position: fixed;

            top: calc(16px + var(--tf-safe-top));
            left: 50%;

            z-index: 100;

            width:
                min(1180px,
                    calc(100% - 28px));

            transform:
                translateX(-50%);

            transition:
                transform .35s cubic-bezier(.22, 1, .36, 1);
        }

        .taskflow-public-nav-wrap.nav-hidden {
            transform:
                translate(-50%, -145%);
        }

        .taskflow-public-nav {
            position: relative;

            display: flex;
            align-items: center;
            justify-content: space-between;

            min-height: 64px;

            padding: 8px 9px;

            border:
                1px solid rgba(148, 163, 184, .14);

            border-radius: 19px;

            background:
                linear-gradient(145deg,
                    rgba(15, 23, 42, .66),
                    rgba(4, 9, 21, .56));

            backdrop-filter:
                blur(22px) saturate(135%);

            -webkit-backdrop-filter:
                blur(22px) saturate(135%);

            box-shadow:
                0 16px 48px rgba(2, 6, 23, .25),

                inset 0 1px 0 rgba(255, 255, 255, .035);

            transition:
                background .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }

        .taskflow-public-nav.scrolled {
            border-color:
                rgba(96, 165, 250, .22);

            background:
                linear-gradient(145deg,
                    rgba(10, 19, 40, .91),
                    rgba(3, 8, 20, .88));

            box-shadow:
                0 20px 58px rgba(2, 6, 23, .38),

                0 0 35px rgba(37, 99, 235, .06),

                inset 0 1px 0 rgba(255, 255, 255, .045);
        }

        /* =========================================================
           BRAND
        ========================================================== */

        .taskflow-brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;

            flex-shrink: 0;

            padding: 7px 10px;

            color: #fff;

            border-radius: 13px;

            font-size: 17px;
            font-weight: 850;

            letter-spacing: -.035em;

            transition:
                transform .2s ease;
        }

        .taskflow-brand:hover {
            color: #fff;
            transform: translateY(-1px);
        }

        .taskflow-brand-mark {
            position: relative;

            width: 39px;
            height: 39px;

            display: grid;
            place-items: center;

            overflow: hidden;

            border-radius: 12px;

            color: #fff;

            background:
                linear-gradient(135deg,
                    #2563eb,
                    #7c3aed);

            box-shadow:
                0 0 0 1px rgba(255, 255, 255, .07),

                0 10px 27px rgba(37, 99, 235, .30);
        }

        .taskflow-brand-mark::after {
            content: "";

            position: absolute;
            inset: -40%;

            background:
                linear-gradient(120deg,
                    transparent 42%,
                    rgba(255, 255, 255, .30) 50%,
                    transparent 58%);

            transform:
                translateX(-120%);

            animation:
                tf-brand-shine 4.6s ease-in-out infinite;
        }

        @keyframes tf-brand-shine {

            0%,
            58% {
                transform: translateX(-120%);
            }

            78%,
            100% {
                transform: translateX(120%);
            }
        }

        .taskflow-brand-mark i {
            position: relative;
            z-index: 2;
            font-size: 18px;
        }

        /* =========================================================
           NAV LINKS
        ========================================================== */

        .taskflow-nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .taskflow-nav-link {
            position: relative;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 41px;
            padding: 0 13px;

            border-radius: 11px;

            /* واضح وليس باهت */
            color: #e2e8f0;

            font-size: 12px;
            font-weight: 800;

            white-space: nowrap;

            transition:
                color .2s ease,
                background .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }

        /* الخط الذي يظهر تحت العنصر */
        .taskflow-nav-link::after {
            content: "";

            position: absolute;

            left: 13px;
            right: 13px;
            bottom: 4px;

            height: 2px;

            border-radius: 999px;

            background:
                linear-gradient(90deg,
                    #38bdf8,
                    #6366f1,
                    #c084fc);

            box-shadow:
                0 0 10px rgba(56, 189, 248, .35);

            transform: scaleX(0);

            transform-origin: center;

            transition:
                transform .25s ease;
        }

        .taskflow-nav-link:hover {
            color: #ffffff;

            background:
                rgba(148, 163, 184, .09);

            transform:
                translateY(-1px);
        }

        /* العنصر النشط */
        .taskflow-nav-link.is-active {
            color: #ffffff;

            background:
                linear-gradient(135deg,
                    rgba(56, 189, 248, .12),
                    rgba(124, 58, 237, .12));

            box-shadow:
                inset 0 0 0 1px rgba(125, 211, 252, .08),

                0 7px 20px rgba(2, 6, 23, .14);
        }

        .taskflow-nav-link.is-active::after {
            transform: scaleX(1);
        }

        .taskflow-nav-login {
            color: #e2e8f0;

            border:
                1px solid rgba(148, 163, 184, .13);

            background:
                rgba(15, 23, 42, .36);
        }

        .taskflow-nav-login:hover {
            background:
                rgba(30, 41, 59, .62);
        }

        .taskflow-nav-dashboard {
            color: #ffffff;

            border:
                1px solid rgba(56, 189, 248, .20);

            background:
                linear-gradient(135deg,
                    rgba(37, 99, 235, .92),
                    rgba(124, 58, 237, .92));

            box-shadow:
                0 10px 26px rgba(37, 99, 235, .25),

                inset 0 1px 0 rgba(255, 255, 255, .08);
        }

        .taskflow-nav-dashboard:hover {
            color: #ffffff;

            transform:
                translateY(-2px);

            box-shadow:
                0 14px 32px rgba(37, 99, 235, .34);
        }

        .taskflow-nav-cta {
            color: #fff;

            background:
                linear-gradient(135deg,
                    #2563eb,
                    #7c3aed);

            box-shadow:
                0 9px 23px rgba(37, 99, 235, .23);
        }

        .taskflow-nav-cta:hover {
            color: #fff;

            background:
                linear-gradient(135deg,
                    #1d4ed8,
                    #6d28d9);

            box-shadow:
                0 13px 29px rgba(37, 99, 235, .32);
        }

        .taskflow-nav-lang {
            min-width: 43px;

            color: #7dd3fc;

            border:
                1px solid rgba(56, 189, 248, .13);

            background:
                rgba(56, 189, 248, .055);
        }

        /* =========================================================
           MOBILE NAV
           Breakpoint intentionally set higher (900px) than the
           general layout breakpoint (760px): the nav has several
           items (Features, How it works, Login/Get Started, Lang)
           with no flex-wrap, so it can overflow on tablets like an
           iPad in portrait (~768–900px) well before the rest of the
           page needs to switch to its mobile layout.
        ========================================================== */

        .taskflow-nav-mobile-btn {
            display: none;

            width: 41px;
            height: 41px;

            border:
                1px solid rgba(148, 163, 184, .12);

            border-radius: 11px;

            color: #e2e8f0;

            background:
                rgba(15, 23, 42, .40);

            cursor: pointer;
        }

        .taskflow-nav-mobile-btn i {
            font-size: 18px;
        }

        .taskflow-mobile-menu {
            display: none;

            margin-top: 8px;

            padding: 9px;

            border:
                1px solid rgba(148, 163, 184, .13);

            border-radius: 17px;

            background:
                rgba(4, 9, 21, .91);

            backdrop-filter:
                blur(22px);

            -webkit-backdrop-filter:
                blur(22px);

            box-shadow:
                0 22px 50px rgba(2, 6, 23, .34);
        }

        .taskflow-mobile-menu.open {
            display: grid;
            gap: 4px;
        }

        .taskflow-mobile-menu a {
            min-height: 43px;

            display: flex;
            align-items: center;

            padding:
                0 13px;

            border-radius: 10px;

            color: #cbd5e1;

            font-size: 12px;
            font-weight: 750;
        }

        .taskflow-mobile-menu a:hover {
            color: #fff;
            background:
                rgba(148, 163, 184, .08);
        }

        @media (max-width: 900px) {

            .taskflow-nav-links {
                display: none;
            }

            .taskflow-nav-mobile-btn {
                display: grid;
                place-items: center;
            }
        }

        /* =========================================================
           HERO
        ========================================================== */

        .taskflow-hero {
            position: relative;
            z-index: 4;

            width:
                min(1200px,
                    calc(100% - 40px));

            /* Scales with viewport height too, so short laptop
               screens (~700-768px tall) don't get forced into an
               oversized hero purely to satisfy a fixed min-height. */
            min-height: clamp(560px, 88vh, 900px);

            margin: 0 auto;


            padding:
                140px 0 105px;

            display: grid;

            grid-template-columns:
                1.02fr .98fr;

            align-items: center;

            gap: 45px;
        }

        .taskflow-hero-copy {
            position: relative;
            z-index: 8;
        }

        .taskflow-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding:
                8px 13px;

            border:
                1px solid rgba(56, 189, 248, .16);

            border-radius:
                999px;

            color:
                var(--tf-cyan-bright);

            background:
                rgba(56, 189, 248, .05);

            box-shadow:
                inset 0 0 28px rgba(56, 189, 248, .022);

            font-size: 10px;
            font-weight: 850;

            letter-spacing:
                .11em;

            text-transform:
                uppercase;
        }

        .taskflow-chip i {
            font-size: 12px;
        }

        .taskflow-hero h1 {
            max-width: 725px;

            margin:
                21px 0 18px;

            color:
                var(--tf-white);

            font-size:
                clamp(47px, 6vw, 80px);

            line-height:
                .97;

            letter-spacing:
                -.062em;

            font-weight:
                900;
        }

        .taskflow-gradient-text {
            background:
                linear-gradient(100deg,
                    #f8fafc 2%,
                    #bfdbfe 27%,
                    #38bdf8 57%,
                    #a855f7 96%);

            -webkit-background-clip:
                text;

            background-clip:
                text;

            color:
                transparent;
        }

        .taskflow-hero-copy>p {
            max-width: 625px;

            margin: 0;

            color:
                #9aabc0;

            font-size:
                16px;

            line-height:
                1.9;
        }

        .taskflow-hero-actions {
            display: flex;
            flex-wrap: wrap;

            gap: 11px;

            margin-top:
                30px;
        }

        .taskflow-primary-btn,
        .taskflow-secondary-btn {
            min-height: 51px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 9px;

            padding:
                0 20px;

            border-radius:
                13px;

            font-size:
                12px;

            font-weight:
                800;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background .2s ease,
                border-color .2s ease;
        }

        .taskflow-primary-btn {
            color: #fff;

            background:
                linear-gradient(135deg,
                    #2563eb,
                    #7c3aed);

            box-shadow:
                0 14px 34px rgba(37, 99, 235, .25);
        }

        .taskflow-primary-btn:hover {
            color: #fff;

            transform:
                translateY(-3px);

            box-shadow:
                0 18px 41px rgba(37, 99, 235, .36);
        }

        .taskflow-secondary-btn {
            color:
                #e2e8f0;

            border:
                1px solid rgba(148, 163, 184, .15);

            background:
                rgba(15, 23, 42, .38);
        }

        .taskflow-secondary-btn:hover {
            color: #fff;

            border-color:
                rgba(96, 165, 250, .22);

            background:
                rgba(30, 41, 59, .64);

            transform:
                translateY(-2px);
        }

        .taskflow-hero-note {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-top: 17px;

            color:
                #53647a;

            font-size:
                10px;
        }

        .taskflow-hero-note i {
            color:
                #38bdf8;
        }

        /* =========================================================
           HERO VISUAL
        ========================================================== */

        .taskflow-visual {
            position: relative;

            min-height:
                620px;

            display: grid;
            place-items: center;
        }

        .taskflow-visual-glow {
            position: absolute;

            width: 455px;
            height: 455px;

            border-radius: 50%;

            background:
                radial-gradient(circle,
                    rgba(56, 189, 248, .15),
                    transparent 54%),

                radial-gradient(circle,
                    rgba(124, 58, 237, .12),
                    transparent 73%);

            filter: blur(5px);

            animation:
                tf-core-pulse 5.6s ease-in-out infinite;
        }

        @keyframes tf-core-pulse {

            0%,
            100% {
                transform:
                    scale(.95);

                opacity:
                    .70;
            }

            50% {
                transform:
                    scale(1.07);

                opacity:
                    1;
            }
        }

        .taskflow-ring {
            position: absolute;

            border:
                1px solid rgba(96, 165, 250, .15);

            border-radius: 50%;

            pointer-events: none;
        }

        .taskflow-ring-one {
            width: 480px;
            height: 480px;

            transform:
                rotate(18deg);
        }

        .taskflow-ring-two {
            width: 375px;
            height: 375px;

            border-color:
                rgba(192, 132, 252, .17);

            transform:
                rotate(-27deg) scaleX(.82);
        }

        .taskflow-ring-three {
            width: 560px;
            height: 228px;

            border-color:
                rgba(56, 189, 248, .105);

            transform:
                rotate(-17deg);
        }

        .taskflow-ring-four {
            width: 315px;
            height: 540px;

            border-color:
                rgba(129, 140, 248, .09);

            transform:
                rotate(21deg);
        }

        .taskflow-core {
            position: relative;
            z-index: 5;

            width: 190px;
            height: 190px;

            display: grid;
            place-items: center;

            border:
                1px solid rgba(125, 211, 252, .30);

            border-radius:
                50%;

            background:
                radial-gradient(circle at 34% 28%,
                    rgba(255, 255, 255, .115),
                    transparent 23%),

                radial-gradient(circle,
                    rgba(37, 99, 235, .24),
                    rgba(8, 15, 32, .97) 73%);

            box-shadow:
                0 0 0 13px rgba(56, 189, 248, .024),

                0 0 62px rgba(56, 189, 248, .18),

                0 0 120px rgba(124, 58, 237, .13),

                inset 0 0 48px rgba(59, 130, 246, .09);
        }

        .taskflow-core::before {
            content: "";

            position: absolute;

            inset: 18px;

            border:
                1px solid rgba(255, 255, 255, .075);

            border-radius: 50%;
        }

        .taskflow-core::after {
            content: "";

            position: absolute;
            inset: 0;

            border:
                1px solid rgba(56, 189, 248, .09);

            border-radius: 50%;

            animation:
                tf-core-ring 4s linear infinite;
        }

        @keyframes tf-core-ring {

            from {
                transform:
                    rotate(0deg) scale(.97);
            }

            to {
                transform:
                    rotate(360deg) scale(1.035);
            }
        }

        .taskflow-core-icon {
            position: relative;
            z-index: 2;

            width: 84px;
            height: 84px;

            display: grid;
            place-items: center;

            border-radius: 24px;

            background:
                linear-gradient(135deg,
                    rgba(37, 99, 235, .94),
                    rgba(124, 58, 237, .94));

            box-shadow:
                0 12px 37px rgba(37, 99, 235, .27),

                0 0 42px rgba(124, 58, 237, .18);
        }

        .taskflow-core-icon i {
            color: #fff;
            font-size: 35px;
        }

        /* =========================================================
           TWISTED LIGHT PATH
        ========================================================== */

        .taskflow-path-wrap {
            position: absolute;
            inset: 0;

            z-index: 8;

            display: grid;
            place-items: center;

            pointer-events: none;
        }

        .taskflow-path {
            width: 100%;
            max-width: 640px;
            height: 575px;

            overflow: visible;
        }

        .taskflow-path-glow {
            fill: none;

            stroke:
                rgba(56, 189, 248, .18);

            stroke-width:
                17px;

            stroke-linecap:
                round;

            stroke-dasharray:
                34 18;

            filter:
                blur(8px);

            animation:
                tf-path-flow 5.7s linear infinite;
        }

        .taskflow-path-main {
            fill: none;

            stroke:
                url(#taskflowGradient);

            stroke-width:
                2.7px;

            stroke-linecap:
                round;

            stroke-dasharray:
                16 11;

            animation:
                tf-path-flow 4.1s linear infinite;
        }

        @keyframes tf-path-flow {

            to {
                stroke-dashoffset:
                    -260px;
            }
        }

        .taskflow-moving-light {
            fill:
                #ecfeff;

            filter:
                drop-shadow(0 0 4px #fff) drop-shadow(0 0 11px #38bdf8) drop-shadow(0 0 24px #38bdf8);
        }

        .taskflow-moving-light.secondary {
            opacity:
                .82;
        }

        /* =========================================================
           FLOATING INFO CARDS
        ========================================================== */

        .taskflow-floating-card {
            position: absolute;

            z-index: 10;

            display: flex;
            align-items: center;

            gap: 10px;

            min-width:
                138px;

            padding:
                11px 13px;

            border:
                1px solid rgba(148, 163, 184, .13);

            border-radius:
                14px;

            background:
                rgba(7, 14, 30, .72);

            backdrop-filter:
                blur(16px);

            -webkit-backdrop-filter:
                blur(16px);

            box-shadow:
                0 19px 44px rgba(2, 6, 23, .29);

            animation:
                tf-floating-card 5.7s ease-in-out infinite;
        }

        .taskflow-floating-card i {
            width: 35px;
            height: 35px;

            display: grid;
            place-items: center;

            flex-shrink: 0;

            border-radius: 10px;

            color: #fff;

            background:
                linear-gradient(135deg,
                    #2563eb,
                    #7c3aed);
        }

        .taskflow-floating-card span {
            display: block;

            color:
                #64748b;

            font-size:
                9px;

            font-weight:
                700;
        }

        .taskflow-floating-card strong {
            display: block;

            margin-top:
                2px;

            color:
                #f8fafc;

            font-size:
                11px;

            font-weight:
                800;
        }

        .taskflow-floating-a {
            top: 14%;
            right: -1%;
        }

        .taskflow-floating-b {
            bottom: 14%;
            left: -1%;

            animation-delay:
                -1.8s;
        }

        .taskflow-floating-c {
            right: 7%;
            bottom: 3%;

            animation-delay:
                -3.15s;
        }

        @keyframes tf-floating-card {

            0%,
            100% {
                transform:
                    translateY(0);
            }

            50% {
                transform:
                    translateY(-11px);
            }
        }

        /* =========================================================
           SECTION
        ========================================================== */

        .taskflow-section {
            position: relative;
            z-index: 5;

            width:
                min(1200px,
                    calc(100% - 40px));

            margin:
                0 auto;

            padding:
                92px 0;
        }

        .taskflow-section-head {
            max-width:
                720px;

            margin-bottom:
                33px;
        }

        .taskflow-kicker {
            color:
                #38bdf8;

            font-size:
                10px;

            font-weight:
                850;

            letter-spacing:
                .14em;

            text-transform:
                uppercase;
        }

        .taskflow-section-head h2 {
            margin:
                10px 0 11px;

            color:
                #f8fafc;

            font-size:
                clamp(30px, 4vw, 47px);

            line-height:
                1.08;

            letter-spacing:
                -.047em;

            font-weight:
                870;
        }

        .taskflow-section-head p {
            margin:
                0;

            color:
                #718196;

            font-size:
                13px;

            line-height:
                1.85;
        }

        /* =========================================================
           FEATURE GRID
        ========================================================== */

        .taskflow-feature-grid {
            display:
                grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap:
                15px;
        }

        .taskflow-feature-card {
            position:
                relative;

            overflow:
                hidden;

            min-height:
                220px;

            padding:
                22px;

            border:
                1px solid rgba(148, 163, 184, .12);

            border-radius:
                20px;

            background:
                linear-gradient(145deg,
                    rgba(30, 41, 59, .64),
                    rgba(8, 15, 32, .85));

            box-shadow:
                0 18px 40px rgba(2, 6, 23, .19);

            transition:
                transform .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }

        .taskflow-feature-card::before {
            content: "";

            position:
                absolute;

            top:
                -65px;

            right:
                -65px;

            width:
                180px;

            height:
                180px;

            border-radius:
                50%;

            background:
                radial-gradient(circle,
                    rgba(56, 189, 248, .11),
                    transparent 72%);
        }

        .taskflow-feature-card::after {
            content: "";

            position:
                absolute;

            inset:
                0;

            pointer-events:
                none;

            opacity:
                0;

            background:
                linear-gradient(120deg,
                    transparent 30%,
                    rgba(255, 255, 255, .05) 50%,
                    transparent 70%);

            transform:
                translateX(-100%);
        }

        .taskflow-feature-card:hover {
            transform:
                translateY(-6px);

            border-color:
                rgba(56, 189, 248, .21);

            box-shadow:
                0 25px 50px rgba(2, 6, 23, .28);
        }

        .taskflow-feature-card:hover::after {
            opacity:
                1;

            animation:
                tf-card-shine .8s ease forwards;
        }

        @keyframes tf-card-shine {

            to {
                transform:
                    translateX(100%);
            }
        }

        .taskflow-feature-icon {
            position:
                relative;

            z-index:
                2;

            width:
                48px;

            height:
                48px;

            display:
                grid;

            place-items:
                center;

            border-radius:
                13px;

            color:
                #fff;

            background:
                linear-gradient(135deg,
                    rgba(37, 99, 235, .94),
                    rgba(124, 58, 237, .90));

            box-shadow:
                0 10px 26px rgba(37, 99, 235, .19);
        }

        .taskflow-feature-icon i {
            font-size:
                19px;
        }

        .taskflow-feature-card h3 {
            position:
                relative;

            z-index:
                2;

            margin:
                18px 0 8px;

            color:
                #f8fafc;

            font-size:
                15px;

            font-weight:
                800;
        }

        .taskflow-feature-card p {
            position:
                relative;

            z-index:
                2;

            margin:
                0;

            color:
                #6d7d91;

            font-size:
                11px;

            line-height:
                1.8;
        }

        /* =========================================================
           WORKFLOW
        ========================================================== */

        .taskflow-workflow {
            display:
                grid;

            grid-template-columns:
                .94fr 1.06fr;

            align-items:
                center;

            gap:
                65px;
        }

        .taskflow-workflow-visual {
            position:
                relative;

            min-height:
                405px;

            display:
                grid;

            place-items:
                center;
        }

        .taskflow-workflow-aura {
            position:
                absolute;

            width:
                345px;

            height:
                345px;

            border-radius:
                50%;

            background:
                radial-gradient(circle,
                    rgba(37, 99, 235, .11),
                    transparent 68%);

            filter:
                blur(7px);

            animation:
                tf-workflow-aura 5s ease-in-out infinite;
        }

        @keyframes tf-workflow-aura {

            0%,
            100% {
                transform:
                    scale(.95);

                opacity:
                    .6;
            }

            50% {
                transform:
                    scale(1.08);

                opacity:
                    1;
            }
        }

        .taskflow-workflow-card {
            position:
                relative;

            z-index:
                2;

            width:
                min(470px,
                    100%);

            padding:
                21px;

            border:
                1px solid rgba(148, 163, 184, .13);

            border-radius:
                22px;

            background:
                linear-gradient(145deg,
                    rgba(15, 23, 42, .90),
                    rgba(5, 11, 25, .88));

            backdrop-filter:
                blur(18px);

            -webkit-backdrop-filter:
                blur(18px);

            box-shadow:
                0 24px 60px rgba(2, 6, 23, .30);
        }

        .taskflow-mini-head {
            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                15px;

            margin-bottom:
                18px;
        }

        .taskflow-mini-title {
            color:
                #f8fafc;

            font-size:
                12px;

            font-weight:
                800;
        }

        .taskflow-window-dots {
            display:
                flex;

            gap:
                5px;
        }

        .taskflow-window-dots span {
            width:
                6px;

            height:
                6px;

            border-radius:
                50%;

            background:
                #334155;
        }

        .taskflow-progress {
            margin-bottom:
                17px;
        }

        .taskflow-progress-row {
            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            margin-bottom:
                8px;

            color:
                #64748b;

            font-size:
                9px;
        }

        .taskflow-progress-row strong {
            color:
                #cbd5e1;

            font-weight:
                800;
        }

        .taskflow-progress-bar {
            height:
                7px;

            overflow:
                hidden;

            border-radius:
                999px;

            background:
                rgba(148, 163, 184, .075);
        }

        .taskflow-progress-bar span {
            display:
                block;

            width:
                72%;

            height:
                100%;

            border-radius:
                inherit;

            background:
                linear-gradient(90deg,
                    #2563eb,
                    #38bdf8,
                    #a855f7);

            box-shadow:
                0 0 18px rgba(56, 189, 248, .24);
        }

        .taskflow-task-line {
            display:
                flex;

            align-items:
                center;

            gap:
                10px;

            padding:
                11px 0;

            border-bottom:
                1px solid rgba(148, 163, 184, .07);
        }

        .taskflow-task-line:last-child {
            border-bottom:
                0;
        }

        .taskflow-task-check {
            width:
                27px;

            height:
                27px;

            display:
                grid;

            place-items:
                center;

            flex-shrink:
                0;

            border:
                1px solid rgba(56, 189, 248, .14);

            border-radius:
                8px;

            color:
                #38bdf8;

            background:
                rgba(56, 189, 248, .05);
        }

        .taskflow-task-check.done {
            color:
                #86efac;

            border-color:
                rgba(34, 197, 94, .16);

            background:
                rgba(34, 197, 94, .06);
        }

        .taskflow-task-text {
            flex:
                1;

            min-width:
                0;
        }

        .taskflow-task-text strong {
            display:
                block;

            color:
                #e2e8f0;

            font-size:
                10px;

            font-weight:
                750;
        }

        .taskflow-task-text span {
            display:
                block;

            margin-top:
                2px;

            color:
                #475569;

            font-size:
                9px;
        }

        .taskflow-workflow-copy {
            position:
                relative;
        }

        .taskflow-workflow-copy h2 {
            margin:
                9px 0 12px;

            color:
                #f8fafc;

            font-size:
                clamp(31px, 4vw, 49px);

            line-height:
                1.06;

            letter-spacing:
                -.05em;

            font-weight:
                870;
        }

        .taskflow-workflow-copy>p {
            max-width:
                620px;

            margin:
                0;

            color:
                #718196;

            font-size:
                13px;

            line-height:
                1.9;
        }

        .taskflow-step-list {
            display:
                grid;

            gap:
                14px;

            margin-top:
                25px;
        }

        .taskflow-step {
            display:
                flex;

            align-items:
                flex-start;

            gap:
                11px;
        }

        .taskflow-step-number {
            width:
                29px;

            height:
                29px;

            display:
                grid;

            place-items:
                center;

            flex-shrink:
                0;

            border:
                1px solid rgba(56, 189, 248, .11);

            border-radius:
                9px;

            color:
                #7dd3fc;

            background:
                rgba(56, 189, 248, .06);

            font-size:
                9px;

            font-weight:
                850;
        }

        .taskflow-step strong {
            display:
                block;

            color:
                #cbd5e1;

            font-size:
                11px;

            font-weight:
                800;
        }

        .taskflow-step span {
            display:
                block;

            margin-top:
                3px;

            color:
                #64748b;

            font-size:
                9px;

            line-height:
                1.65;
        }

        /* =========================================================
           CTA
        ========================================================== */

        .taskflow-cta {
            position:
                relative;

            overflow:
                hidden;

            padding:
                76px 35px;

            border:
                1px solid rgba(96, 165, 250, .14);

            border-radius:
                29px;

            background:
                radial-gradient(circle at 20% 50%,
                    rgba(37, 99, 235, .16),
                    transparent 31%),

                radial-gradient(circle at 80% 50%,
                    rgba(124, 58, 237, .16),
                    transparent 31%),

                linear-gradient(145deg,
                    rgba(15, 23, 42, .88),
                    rgba(5, 11, 25, .94));

            box-shadow:
                0 29px 75px rgba(2, 6, 23, .28);
        }

        .taskflow-cta::before,
        .taskflow-cta::after {
            content: "";

            position:
                absolute;

            border:
                1px solid rgba(125, 211, 252, .08);

            border-radius:
                50%;

            pointer-events:
                none;
        }

        .taskflow-cta::before {
            width:
                340px;

            height:
                340px;

            top:
                -205px;

            left:
                -100px;
        }

        .taskflow-cta::after {
            width:
                380px;

            height:
                380px;

            right:
                -125px;

            bottom:
                -230px;
        }

        .taskflow-cta-inner {
            position:
                relative;

            z-index:
                2;

            max-width:
                720px;

            margin:
                0 auto;

            text-align:
                center;
        }

        .taskflow-cta-inner h2 {
            margin:
                0;

            color:
                #fff;

            font-size:
                clamp(32px, 4vw, 51px);

            line-height:
                1.05;

            letter-spacing:
                -.05em;

            font-weight:
                880;
        }

        .taskflow-cta-inner p {
            max-width:
                600px;

            margin:
                14px auto 0;

            color:
                #64748b;

            font-size:
                13px;

            line-height:
                1.85;
        }

        .taskflow-cta-action {
            margin-top:
                25px;
        }

        /* =========================================================
           FOOTER
        ========================================================== */

        .taskflow-public-footer {
            position:
                relative;

            z-index:
                5;

            width:
                min(1200px,
                    calc(100% - 40px));

            margin:
                0 auto;

            padding:
                30px 0 38px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                20px;

            border-top:
                1px solid rgba(148, 163, 184, .08);
        }

        .taskflow-public-footer p {
            margin:
                0;

            color:
                #475569;

            font-size:
                10px;
        }

        .taskflow-footer-tagline {
            color:
                #64748b;

            font-size:
                10px;

            font-weight:
                750;
        }

        /* =========================================================
           RTL
        ========================================================== */

        [dir="rtl"] .taskflow-public-nav,
        [dir="rtl"] .taskflow-hero,
        [dir="rtl"] .taskflow-workflow {
            direction:
                rtl;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1080px) {

            .taskflow-hero {
                grid-template-columns:
                    1fr;

                min-height:
                    auto;

                padding-top:
                    180px;

                padding-bottom:
                    80px;
            }

            .taskflow-hero-copy {
                text-align:
                    center;
            }

            .taskflow-hero-copy>p {
                margin-inline:
                    auto;
            }

            .taskflow-hero-actions {
                justify-content:
                    center;
            }

            .taskflow-hero-note {
                justify-content:
                    center;
            }

            .taskflow-visual {
                min-height:
                    560px;
            }

            .taskflow-feature-grid {
                grid-template-columns:
                    repeat(2, 1fr);
            }

            .taskflow-workflow {
                grid-template-columns:
                    1fr;

                gap:
                    45px;
            }

            .taskflow-workflow-copy {
                text-align:
                    center;
            }

            .taskflow-workflow-copy>p {
                margin-inline:
                    auto;
            }

            .taskflow-step {
                text-align:
                    start;
            }
        }

        @media (max-width: 900px) {

            .taskflow-public-nav-wrap {
                top:
                    calc(12px + var(--tf-safe-top));

                width:
                    calc(100% - 20px);
            }

            .taskflow-public-nav {
                min-height:
                    60px;

                border-radius:
                    17px;

                padding:
                    7px 8px;
            }

            .taskflow-brand {
                font-size:
                    15px;
            }

            .taskflow-brand-mark {
                width:
                    36px;

                height:
                    36px;
            }
        }

        @media (max-width: 760px) {

            .taskflow-public-nav-wrap {
                top:
                    calc(10px + var(--tf-safe-top));

                width:
                    calc(100% - 18px);
            }

            .taskflow-public-nav {
                min-height:
                    59px;

                border-radius:
                    16px;

                padding:
                    7px;
            }

            .taskflow-brand {
                font-size:
                    15px;
            }

            .taskflow-brand-mark {
                width:
                    35px;

                height:
                    35px;
            }

            .taskflow-hero {
                width:
                    min(100% - 28px,
                        1200px);

                padding-top:
                    145px;
            }

            .taskflow-hero h1 {
                font-size:
                    clamp(40px, 12vw, 62px);
            }

            .taskflow-hero-copy>p {
                font-size:
                    13px;

                line-height:
                    1.8;
            }

            .taskflow-hero-actions {
                flex-direction:
                    column;
            }

            .taskflow-primary-btn,
            .taskflow-secondary-btn {
                width:
                    100%;
            }

            .taskflow-visual {
                min-height:
                    450px;

                transform:
                    scale(.85);

                margin:
                    -12px 0 -35px;
            }

            .taskflow-ring-one {
                width:
                    395px;

                height:
                    395px;
            }

            .taskflow-ring-two {
                width:
                    310px;

                height:
                    310px;
            }

            .taskflow-ring-three {
                width:
                    445px;

                height:
                    182px;
            }

            .taskflow-ring-four {
                width:
                    263px;

                height:
                    450px;
            }

            .taskflow-core {
                width:
                    164px;

                height:
                    164px;
            }

            .taskflow-core-icon {
                width:
                    73px;

                height:
                    73px;

                border-radius:
                    21px;
            }

            .taskflow-core-icon i {
                font-size:
                    29px;
            }

            .taskflow-section {
                width:
                    min(100% - 28px,
                        1200px);

                padding:
                    60px 0;
            }

            .taskflow-feature-grid {
                grid-template-columns:
                    1fr;
            }

            .taskflow-workflow-visual {
                min-height:
                    350px;
            }

            .taskflow-cta {
                padding:
                    58px 20px;
            }

            .taskflow-public-footer {
                width:
                    min(100% - 28px,
                        1200px);

                flex-direction:
                    column;

                text-align:
                    center;
            }
        }

        @media (max-width: 480px) {

            .taskflow-visual {
                min-height:
                    375px;

                transform:
                    scale(.74);
            }

            .taskflow-floating-card {
                min-width:
                    125px;
            }

            .taskflow-floating-a {
                right:
                    -3%;
            }

            .taskflow-floating-b {
                left:
                    -3%;
            }

            .taskflow-floating-c {
                right:
                    0;
            }

            .taskflow-section-head h2,
            .taskflow-workflow-copy h2,
            .taskflow-cta-inner h2 {
                letter-spacing:
                    -.035em;
            }
        }

        /* Trim decorative load on small screens: cut the star count
           roughly in half and simplify a couple of heavy visuals —
           purely a performance/battery consideration on phones,
           the design still reads the same. */
        @media (max-width: 640px) {

            .taskflow-star:nth-child(n + 21) {
                display: none;
            }

            .taskflow-orb {
                filter: none;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            html {
                scroll-behavior:
                    auto;
            }

            *,
            *::before,
            *::after {
                animation-duration:
                    .001ms !important;

                animation-iteration-count:
                    1 !important;

                transition-duration:
                    .001ms !important;
            }
        }

        /* =========================================================
           SCROLL TO TOP
        ========================================================== */

        .taskflow-scroll-top {
            position: fixed;
            right: calc(24px + var(--tf-safe-right));
            bottom: calc(24px + var(--tf-safe-bottom));

            z-index: 90;

            width: 46px;
            height: 46px;

            display: grid;
            place-items: center;

            border: 1px solid rgba(56, 189, 248, .20);
            border-radius: 14px;

            color: #e0f2fe;

            background:
                linear-gradient(145deg,
                    rgba(15, 23, 42, .82),
                    rgba(7, 14, 30, .74));

            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);

            box-shadow:
                0 12px 30px rgba(2, 6, 23, .30),
                0 0 24px rgba(56, 189, 248, .07),
                inset 0 1px 0 rgba(255, 255, 255, .05);

            cursor: pointer;

            opacity: 0;
            visibility: hidden;
            transform: translateY(14px) scale(.9);

            transition:
                opacity .25s ease,
                visibility .25s ease,
                transform .25s ease,
                background .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }

        .taskflow-scroll-top.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .taskflow-scroll-top:hover {
            color: #fff;

            border-color:
                rgba(56, 189, 248, .34);

            background:
                linear-gradient(145deg,
                    rgba(14, 165, 233, .18),
                    rgba(124, 58, 237, .18));

            box-shadow:
                0 15px 35px rgba(2, 6, 23, .36),
                0 0 28px rgba(56, 189, 248, .12);

            transform:
                translateY(-3px) scale(1.04);
        }

        .taskflow-scroll-top i {
            font-size: 18px;
            transition: transform .25s ease;
        }

        .taskflow-scroll-top:hover i {
            transform: translateY(-2px);
        }

        @media (max-width: 760px) {

            .taskflow-scroll-top {
                right: calc(16px + var(--tf-safe-right));
                bottom: calc(16px + var(--tf-safe-bottom));

                width: 43px;
                height: 43px;

                border-radius: 13px;
            }
        }

        [dir="rtl"] .taskflow-scroll-top {
            right: auto;
            left: calc(24px + var(--tf-safe-left));
        }

        @media (max-width: 760px) {

            [dir="rtl"] .taskflow-scroll-top {
                left: calc(16px + var(--tf-safe-left));
            }
        }
    </style>
</head>

<body>

    @php
        $isArabic = app()->getLocale() === 'ar';
    @endphp

    <div class="taskflow-landing">

        <div class="taskflow-grid"></div>
        <div class="taskflow-vignette"></div>

        {{-- Stars --}}
        <div class="taskflow-stars">

            @for ($i = 1; $i <= 40; $i++)
                <span class="taskflow-star"
                    style="
                    --x: {{ ($i * 37) % 100 }}%;
                    --y: {{ ($i * 61) % 100 }}%;
                    --opacity: {{ 0.24 + ($i % 6) * 0.11 }};
                    --duration: {{ 2.7 + ($i % 5) * 0.75 }}s;
                    --delay: -{{ ($i % 7) * 0.55 }}s;
                "></span>
            @endfor

        </div>

        <div class="taskflow-orb taskflow-orb-a"></div>
        <div class="taskflow-orb taskflow-orb-b"></div>
        <div class="taskflow-orb taskflow-orb-c"></div>

        <div class="taskflow-cursor-glow"></div>

        {{-- =========================================================
         NAVBAR
    ========================================================== --}}

        <div class="taskflow-public-nav-wrap" id="taskflowNavWrap">

            <nav class="taskflow-public-nav" id="taskflowPublicNav">

                <a href="{{ url('/' . app()->getLocale()) }}" class="taskflow-brand" data-scroll-top>

                    <span class="taskflow-brand-mark">
                        <i class="bi bi-layers-half"></i>
                    </span>

                    <span>TaskFlow</span>

                </a>

                <div class="taskflow-nav-links">

                    <a href="#features" class="taskflow-nav-link" data-scroll-target="features">
                        {{ $isArabic ? 'المميزات' : 'Features' }}
                    </a>

                    <a href="#workflow" class="taskflow-nav-link" data-scroll-target="workflow">
                        {{ $isArabic ? 'طريقة العمل' : 'How it works' }}
                    </a>

                    @auth

                        <a href="{{ route('dashboard') }}" class="taskflow-nav-link taskflow-nav-dashboard">
                            <i class="bi bi-grid-1x2-fill"></i>
                            &nbsp;
                            {{ $isArabic ? 'لوحة التحكم' : 'Dashboard' }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="taskflow-nav-link taskflow-nav-login">
                            {{ $isArabic ? 'دخول' : 'Login' }}
                        </a>

                        <a href="{{ route('register') }}" class="taskflow-nav-link taskflow-nav-cta">
                            {{ $isArabic ? 'ابدأ الآن' : 'Get Started' }}
                        </a>

                    @endauth

                    <a href="{{ $isArabic ? url('/en') : url('/ar') }}" class="taskflow-nav-link taskflow-nav-lang"
                        title="{{ $isArabic ? 'English' : 'العربية' }}">
                        {{ $isArabic ? 'EN' : 'AR' }}
                    </a>

                </div>

                <button type="button" class="taskflow-nav-mobile-btn" id="taskflowMobileButton"
                    aria-label="Open navigation">
                    <i class="bi bi-list"></i>
                </button>

            </nav>

            <div class="taskflow-mobile-menu" id="taskflowMobileMenu">

                <a href="#features" data-scroll-target="features">
                    {{ $isArabic ? 'المميزات' : 'Features' }}
                </a>

                <a href="#workflow" data-scroll-target="workflow">
                    {{ $isArabic ? 'طريقة العمل' : 'How it works' }}
                </a>

                @auth

                    <a href="{{ route('dashboard') }}">
                        {{ $isArabic ? 'لوحة التحكم' : 'Dashboard' }}
                    </a>
                @else
                    <a href="{{ route('login') }}">
                        {{ $isArabic ? 'تسجيل الدخول' : 'Login' }}
                    </a>

                    <a href="{{ route('register') }}">
                        {{ $isArabic ? 'إنشاء حساب' : 'Get Started' }}
                    </a>

                @endauth

                <a href="{{ $isArabic ? url('/en') : url('/ar') }}">
                    {{ $isArabic ? 'English' : 'العربية' }}
                </a>

            </div>

        </div>

        {{-- =========================================================
         HERO
    ========================================================== --}}

        <section class="taskflow-hero">

            <div class="taskflow-hero-copy">

                <span class="taskflow-chip">
                    <i class="bi bi-stars"></i>

                    {{ $isArabic ? 'إدارة ذكية للمشاريع' : 'Smart Project Management' }}
                </span>

                <h1>

                    {{ $isArabic ? 'حوّل' : 'Turn' }}

                    <span class="taskflow-gradient-text">
                        {{ $isArabic ? 'الفوضى' : 'complex work' }}
                    </span>

                    {{ $isArabic ? 'إلى سير عمل واضح.' : 'into a clear workflow.' }}

                </h1>

                <p>
                    {{ $isArabic
                        ? 'TaskFlow يجمع المشاريع والمهام وأعضاء الفريق في مساحة عمل واحدة تمنحك رؤية أوضح وتحكمًا أفضل في كل خطوة.'
                        : 'TaskFlow brings projects, tasks, and team members into one focused workspace built for clarity, visibility, and control.' }}
                </p>

                <div class="taskflow-hero-actions">

                    @auth

                        <a href="{{ route('dashboard') }}" class="taskflow-primary-btn">
                            <i class="bi bi-grid-1x2-fill"></i>
                            {{ $isArabic ? 'افتح لوحة التحكم' : 'Open Dashboard' }}
                        </a>

                        <a href="#features" class="taskflow-secondary-btn" data-scroll-target="features">
                            <i class="bi bi-arrow-down"></i>
                            {{ $isArabic ? 'اكتشف المميزات' : 'Explore Features' }}
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="taskflow-primary-btn">
                            <i class="bi bi-arrow-up-right-circle-fill"></i>
                            {{ $isArabic ? 'ابدأ مع TaskFlow' : 'Start with TaskFlow' }}
                        </a>

                        <a href="#features" class="taskflow-secondary-btn" data-scroll-target="features">
                            <i class="bi bi-arrow-down"></i>
                            {{ $isArabic ? 'اكتشف المميزات' : 'Explore Features' }}
                        </a>

                    @endauth

                </div>

                <div class="taskflow-hero-note">

                    <i class="bi bi-shield-check"></i>

                    <span>
                        {{ $isArabic
                            ? 'تنظيم أوضح • صلاحيات واضحة • تجربة بسيطة'
                            : 'Clear organization • clear permissions • focused experience' }}
                    </span>

                </div>

            </div>

            {{-- =====================================================
             HERO VISUAL
        ====================================================== --}}

            <div class="taskflow-visual">

                <div class="taskflow-visual-glow"></div>

                <div class="taskflow-ring taskflow-ring-one"></div>
                <div class="taskflow-ring taskflow-ring-two"></div>
                <div class="taskflow-ring taskflow-ring-three"></div>
                <div class="taskflow-ring taskflow-ring-four"></div>

                {{-- Glowing twisted path --}}
                <div class="taskflow-path-wrap">

                    <svg class="taskflow-path" viewBox="0 0 640 575" role="img" aria-label="TaskFlow visual">

                        <defs>

                            <linearGradient id="taskflowGradient" x1="0%" y1="0%" x2="100%"
                                y2="100%">
                                <stop offset="0%" stop-color="#38bdf8" />
                                <stop offset="45%" stop-color="#6366f1" />
                                <stop offset="100%" stop-color="#c084fc" />
                            </linearGradient>

                            <filter id="taskflowGlow">
                                <feGaussianBlur stdDeviation="4" result="blur" />

                                <feMerge>
                                    <feMergeNode in="blur" />
                                    <feMergeNode in="SourceGraphic" />
                                </feMerge>
                            </filter>

                        </defs>

                        <path id="taskflowMotionPath" class="taskflow-path-glow" d="
                            M 118 96
                            C 212 20, 428 38, 508 128
                            C 575 207, 508 294, 403 279
                            C 297 263, 191 190, 128 274
                            C 54 372, 122 478, 258 470
                            C 390 461, 477 405, 522 479
                        " />

                        <path class="taskflow-path-main" d="
                            M 118 96
                            C 212 20, 428 38, 508 128
                            C 575 207, 508 294, 403 279
                            C 297 263, 191 190, 128 274
                            C 54 372, 122 478, 258 470
                            C 390 461, 477 405, 522 479
                        " />

                        {{-- Main moving light --}}
                        <circle class="taskflow-moving-light" r="5.7">
                            <animateMotion dur="5.2s" repeatCount="indefinite" rotate="auto">
                                <mpath href="#taskflowMotionPath" />
                            </animateMotion>
                        </circle>

                        {{-- Secondary moving light --}}
                        <circle class="taskflow-moving-light secondary" r="3.7">
                            <animateMotion dur="7.8s" begin="-3.6s" repeatCount="indefinite" rotate="auto">
                                <mpath href="#taskflowMotionPath" />
                            </animateMotion>
                        </circle>

                        {{-- Path nodes --}}
                        <circle cx="118" cy="96" r="3" fill="#7dd3fc" filter="url(#taskflowGlow)" />

                        <circle cx="403" cy="279" r="3" fill="#818cf8" filter="url(#taskflowGlow)" />

                        <circle cx="522" cy="479" r="3" fill="#c084fc" filter="url(#taskflowGlow)" />

                    </svg>

                </div>

                <div class="taskflow-core">

                    <div class="taskflow-core-icon">
                        <i class="bi bi-kanban-fill"></i>
                    </div>

                </div>

                <div class="taskflow-floating-card taskflow-floating-a">

                    <i class="bi bi-check2-circle"></i>

                    <div>

                        <span>
                            {{ $isArabic ? 'المهام' : 'Tasks' }}
                        </span>

                        <strong>
                            {{ $isArabic ? 'منظمة' : 'Organized' }}
                        </strong>

                    </div>

                </div>

                <div class="taskflow-floating-card taskflow-floating-b">

                    <i class="bi bi-people-fill"></i>

                    <div>

                        <span>
                            {{ $isArabic ? 'الفريق' : 'Team' }}
                        </span>

                        <strong>
                            {{ $isArabic ? 'متصل' : 'Connected' }}
                        </strong>

                    </div>

                </div>

                <div class="taskflow-floating-card taskflow-floating-c">

                    <i class="bi bi-graph-up-arrow"></i>

                    <div>

                        <span>
                            {{ $isArabic ? 'المشاريع' : 'Projects' }}
                        </span>

                        <strong>
                            {{ $isArabic ? 'تحت السيطرة' : 'Under Control' }}
                        </strong>

                    </div>

                </div>

            </div>

        </section>

        {{-- =========================================================
         FEATURES
    ========================================================== --}}

        <section id="features" class="taskflow-section">

            <div class="taskflow-section-head">

                <div class="taskflow-kicker">
                    {{ $isArabic ? 'لماذا TaskFlow' : 'Why TaskFlow' }}
                </div>

                <h2>
                    {{ $isArabic ? 'كل ما تحتاجه لإدارة العمل بوضوح.' : 'Everything you need to keep work clear.' }}
                </h2>

                <p>
                    {{ $isArabic
                        ? 'من إدارة المشروع إلى أصغر مهمة، كل جزء من العمل له مكان واضح داخل نفس المساحة.'
                        : 'From the project itself to the smallest task, every moving part has a clear place inside the same workspace.' }}
                </p>

            </div>

            <div class="taskflow-feature-grid">

                <article class="taskflow-feature-card">

                    <div class="taskflow-feature-icon">
                        <i class="bi bi-kanban"></i>
                    </div>

                    <h3>
                        {{ $isArabic ? 'إدارة المشاريع' : 'Project Management' }}
                    </h3>

                    <p>
                        {{ $isArabic
                            ? 'أنشئ المشاريع ونظّم تفاصيلها وتابع حالتها من مكان واحد.'
                            : 'Create projects, organize their details, and keep their status visible in one place.' }}
                    </p>

                </article>

                <article class="taskflow-feature-card">

                    <div class="taskflow-feature-icon">
                        <i class="bi bi-list-check"></i>
                    </div>

                    <h3>
                        {{ $isArabic ? 'إدارة المهام' : 'Task Management' }}
                    </h3>

                    <p>
                        {{ $isArabic
                            ? 'قسّم العمل إلى مهام مع الأولوية والحالة وتاريخ الاستحقاق والتكليف.'
                            : 'Break work into tasks with priority, status, due dates, and assignments.' }}
                    </p>

                </article>

                <article class="taskflow-feature-card">

                    <div class="taskflow-feature-icon">
                        <i class="bi bi-people"></i>
                    </div>

                    <h3>
                        {{ $isArabic ? 'تعاون الفريق' : 'Team Collaboration' }}
                    </h3>

                    <p>
                        {{ $isArabic
                            ? 'اجمع أعضاء المشروع داخل مساحة واحدة مع وصول مناسب لكل دور.'
                            : 'Keep project members together with access that matches each role.' }}
                    </p>

                </article>

                <article class="taskflow-feature-card">

                    <div class="taskflow-feature-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>

                    <h3>
                        {{ $isArabic ? 'صلاحيات واضحة' : 'Clear Permissions' }}
                    </h3>

                    <p>
                        {{ $isArabic
                            ? 'صلاحيات مبنية على الدور وملكية المشروع للحفاظ على التحكم الصحيح.'
                            : 'Role and ownership based permissions keep control aligned with responsibilities.' }}
                    </p>

                </article>

            </div>

        </section>

        {{-- =========================================================
         WORKFLOW
    ========================================================== --}}

        <section id="workflow" class="taskflow-section">

            <div class="taskflow-workflow">

                <div class="taskflow-workflow-visual">

                    <div class="taskflow-workflow-aura"></div>

                    <div class="taskflow-workflow-card">

                        <div class="taskflow-mini-head">

                            <span class="taskflow-mini-title">
                                {{ $isArabic ? 'نظرة على المشروع' : 'Project Overview' }}
                            </span>

                            <div class="taskflow-window-dots">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>

                        </div>

                        <div class="taskflow-progress">

                            <div class="taskflow-progress-row">

                                <span>
                                    {{ $isArabic ? 'التقدم' : 'Progress' }}
                                </span>

                                <strong>
                                    72%
                                </strong>

                            </div>

                            <div class="taskflow-progress-bar">
                                <span></span>
                            </div>

                        </div>

                        <div class="taskflow-task-line">

                            <div class="taskflow-task-check done">
                                <i class="bi bi-check2"></i>
                            </div>

                            <div class="taskflow-task-text">

                                <strong>
                                    {{ $isArabic ? 'إعداد هيكل المشروع' : 'Set up project structure' }}
                                </strong>

                                <span>
                                    {{ $isArabic ? 'مكتملة' : 'Completed' }}
                                </span>

                            </div>

                        </div>

                        <div class="taskflow-task-line">

                            <div class="taskflow-task-check">

                                <i class="bi bi-arrow-right"></i>

                            </div>

                            <div class="taskflow-task-text">

                                <strong>
                                    {{ $isArabic ? 'بناء واجهة لوحة التحكم' : 'Build dashboard interface' }}
                                </strong>

                                <span>
                                    {{ $isArabic ? 'قيد التنفيذ' : 'In progress' }}
                                </span>

                            </div>

                        </div>

                        <div class="taskflow-task-line">

                            <div class="taskflow-task-check">

                                <i class="bi bi-circle"></i>

                            </div>

                            <div class="taskflow-task-text">

                                <strong>
                                    {{ $isArabic ? 'المراجعة والاختبار' : 'Review and testing' }}
                                </strong>

                                <span>
                                    {{ $isArabic ? 'لم تبدأ' : 'Not started' }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="taskflow-workflow-copy">

                    <div class="taskflow-kicker">
                        {{ $isArabic ? 'طريقة العمل' : 'Workflow' }}
                    </div>

                    <h2>
                        {{ $isArabic ? 'من الفكرة إلى التنفيذ في مسار واحد.' : 'From idea to execution in one clear flow.' }}
                    </h2>

                    <p>
                        {{ $isArabic
                            ? 'المشروع والمهام والفريق يعيشون في نفس المساحة، حتى يكون واضحًا دائمًا ما الذي يحدث ومن المسؤول وما الخطوة التالية.'
                            : 'Projects, tasks, and people live in the same workspace, so it is always clear what is happening, who owns it, and what comes next.' }}
                    </p>

                    <div class="taskflow-step-list">

                        <div class="taskflow-step">

                            <div class="taskflow-step-number">
                                01
                            </div>

                            <div>

                                <strong>
                                    {{ $isArabic ? 'أنشئ المشروع' : 'Create the project' }}
                                </strong>

                                <span>
                                    {{ $isArabic ? 'حدد الاسم والوصف والمسؤول عن المشروع.' : 'Set the name, description, and project owner.' }}
                                </span>

                            </div>

                        </div>

                        <div class="taskflow-step">

                            <div class="taskflow-step-number">
                                02
                            </div>

                            <div>

                                <strong>
                                    {{ $isArabic ? 'أنشئ المهام' : 'Create tasks' }}
                                </strong>

                                <span>
                                    {{ $isArabic
                                        ? 'أضف الأولوية والحالة وتاريخ الاستحقاق والتكليف.'
                                        : 'Add priority, status, due date, and assignment.' }}
                                </span>

                            </div>

                        </div>

                        <div class="taskflow-step">

                            <div class="taskflow-step-number">
                                03
                            </div>

                            <div>

                                <strong>
                                    {{ $isArabic ? 'تابع الإنجاز' : 'Track progress' }}
                                </strong>

                                <span>
                                    {{ $isArabic
                                        ? 'اعرف ما تم وما هو قيد التنفيذ وما يحتاج إلى اهتمام.'
                                        : 'See what is completed, in progress, and what needs attention.' }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        {{-- =========================================================
         CTA
    ========================================================== --}}

        <section class="taskflow-section">

            <div class="taskflow-cta">

                <div class="taskflow-cta-inner">

                    <h2>
                        {{ $isArabic ? 'جاهز لترتيب طريقة عملك؟' : 'Ready to bring your workflow together?' }}
                    </h2>

                    <p>
                        {{ $isArabic
                            ? 'ابدأ بمساحة عمل أكثر وضوحًا وتنظيمًا لمشاريعك ومهامك وفريقك.'
                            : 'Create a clearer workspace for your projects, tasks, and team.' }}
                    </p>

                    <div class="taskflow-cta-action">

                        @auth

                            <a href="{{ route('dashboard') }}" class="taskflow-primary-btn">
                                <i class="bi bi-grid-1x2-fill"></i>
                                {{ $isArabic ? 'فتح لوحة التحكم' : 'Open Dashboard' }}
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="taskflow-primary-btn">
                                <i class="bi bi-arrow-up-right-circle-fill"></i>
                                {{ $isArabic ? 'ابدأ الآن' : 'Get Started' }}
                            </a>

                        @endauth

                    </div>

                </div>

            </div>

        </section>

        {{-- =========================================================
         FOOTER
    ========================================================== --}}

        <footer class="taskflow-public-footer">

            <p>
                © {{ now()->year }} TaskFlow.
                {{ $isArabic ? 'جميع الحقوق محفوظة.' : 'All rights reserved.' }}
            </p>

            <div class="taskflow-footer-tagline">
                {{ $isArabic ? 'تنظيم أفضل. تركيز أكثر.' : 'Better organization. Better focus.' }}
            </div>

        </footer>

    </div>

    {{-- Scroll To Top --}}

    <button type="button" class="taskflow-scroll-top" id="taskflowScrollTop" aria-label="Scroll to top">
        <i class="bi bi-arrow-up"></i>
    </button>

    <script>
        (() => {

            const page =
                document.querySelector('.taskflow-landing');

            const navWrap =
                document.getElementById('taskflowNavWrap');

            const nav =
                document.getElementById('taskflowPublicNav');

            const mobileButton =
                document.getElementById('taskflowMobileButton');

            const mobileMenu =
                document.getElementById('taskflowMobileMenu');

            const scrollTopButton = document.getElementById('taskflowScrollTop');

            const scrollTargets =
                document.querySelectorAll('[data-scroll-target]');

            const scrollTopLinks =
                document.querySelectorAll('[data-scroll-top]');

            if (!page) {
                return;
            }

            /* =====================================================
               CURSOR GLOW
               Only wired up on devices with a real hover-capable
               pointer (mouse/trackpad). The matching CSS rule
               (@media (hover:none)) already hides the element on
               touch devices, this just avoids attaching a listener
               that would never do anything useful there.
            ====================================================== */

            const hasFinePointer =
                window.matchMedia('(hover: hover) and (pointer: fine)').matches;

            if (hasFinePointer) {

                window.addEventListener(
                    'pointermove',
                    (event) => {

                        page.style.setProperty(
                            '--mx',
                            `${event.clientX}px`
                        );

                        page.style.setProperty(
                            '--my',
                            `${event.clientY}px`
                        );

                    }, {
                        passive: true
                    }
                );
            }

            /* =====================================================
               NAVBAR SCROLL BEHAVIOR
            ====================================================== */

            const updateNavbar = () => {

                if (!navWrap || !nav) {
                    return;
                }

                if (window.scrollY > 30) {

                    nav.classList.add('scrolled');

                } else {

                    nav.classList.remove('scrolled');
                }
            };

            updateNavbar();

            window.addEventListener(
                'scroll',
                updateNavbar, {
                    passive: true
                }
            );

            /* =====================================================
               SMOOTH INTERNAL NAVIGATION
               No new browser history entry.
            ====================================================== */

            const scrollToSection =
                (targetId) => {

                    const target =
                        document.getElementById(
                            targetId
                        );

                    if (!target) {
                        return;
                    }

                    navWrap.classList.remove(
                        'nav-hidden'
                    );

                    const navHeight =
                        nav.getBoundingClientRect().height;

                    const targetTop =
                        target.getBoundingClientRect().top +
                        window.scrollY -
                        navHeight -
                        42;

                    window.scrollTo({
                        top: Math.max(
                            targetTop,
                            0
                        ),
                        behavior: 'smooth'
                    });

                    /*
                     * Keep URL clean and prevent
                     * extra Back-button history entries.
                     */
                    window.history.replaceState({},
                        '',
                        window.location.pathname +
                        window.location.search
                    );
                };

            scrollTargets.forEach(
                (link) => {

                    link.addEventListener(
                        'click',
                        (event) => {

                            event.preventDefault();

                            const targetId =
                                link.dataset.scrollTarget;

                            if (targetId) {

                                scrollToSection(
                                    targetId
                                );
                            }

                            if (mobileMenu) {

                                mobileMenu.classList.remove(
                                    'open'
                                );

                            }

                            if (mobileButton) {

                                const icon =
                                    mobileButton.querySelector(
                                        'i'
                                    );

                                if (icon) {

                                    icon.classList.add(
                                        'bi-list'
                                    );

                                    icon.classList.remove(
                                        'bi-x-lg'
                                    );
                                }
                            }
                        }
                    );

                }
            );

            scrollTopLinks.forEach(
                (link) => {

                    link.addEventListener(
                        'click',
                        (event) => {

                            event.preventDefault();

                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });

                            window.history.replaceState({},
                                '',
                                window.location.pathname +
                                window.location.search
                            );

                        }
                    );

                }
            );

            /* =====================================================
               ACTIVE NAV ITEM
            ====================================================== */

            const sections = [
                document.getElementById('features'),
                document.getElementById('workflow')
            ].filter(Boolean);

            const sectionLinks = {
                features: document.querySelector(
                    '[data-scroll-target="features"]'
                ),

                workflow: document.querySelector(
                    '[data-scroll-target="workflow"]'
                )
            };

            if (
                'IntersectionObserver' in window &&
                sections.length
            ) {

                const observer =
                    new IntersectionObserver(
                        (entries) => {

                            entries.forEach(
                                (entry) => {

                                    if (!entry.isIntersecting) {
                                        return;
                                    }

                                    Object.values(
                                        sectionLinks
                                    ).forEach(
                                        (link) => {

                                            if (link) {
                                                link.classList.remove(
                                                    'is-active'
                                                );
                                            }
                                        }
                                    );

                                    const id =
                                        entry.target.id;

                                    if (
                                        sectionLinks[id]
                                    ) {

                                        sectionLinks[id]
                                            .classList.add(
                                                'is-active'
                                            );
                                    }
                                }
                            );

                        }, {
                            root: null,
                            threshold: .35
                        }
                    );

                sections.forEach(
                    (section) => {
                        observer.observe(section);
                    }
                );
            }

            /* =====================================================
               MOBILE MENU
            ====================================================== */

            /* Mobile menu */

            if (mobileButton && mobileMenu) {

                mobileButton.addEventListener('click', () => {
                    mobileMenu.classList.toggle('open');

                    const icon = mobileButton.querySelector('i');

                    if (icon) {
                        icon.classList.toggle('bi-list');
                        icon.classList.toggle('bi-x-lg');
                    }
                });

                mobileMenu.querySelectorAll('a').forEach((link) => {

                    link.addEventListener('click', () => {

                        mobileMenu.classList.remove('open');

                        const icon = mobileButton.querySelector('i');

                        if (icon) {
                            icon.classList.add('bi-list');
                            icon.classList.remove('bi-x-lg');
                        }
                    });

                });
            }

            /* =====================================================
               SCROLL TO TOP
            ====================================================== */

            const updateScrollTopButton = () => {

                if (!scrollTopButton) {
                    return;
                }

                if (window.scrollY > 450) {

                    scrollTopButton.classList.add('visible');

                } else {

                    scrollTopButton.classList.remove('visible');
                }
            };

            window.addEventListener(
                'scroll',
                updateScrollTopButton, {
                    passive: true
                }
            );

            updateScrollTopButton();

            scrollTopButton?.addEventListener(
                'click',
                () => {

                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });

                    window.history.replaceState({},
                        '',
                        window.location.pathname +
                        window.location.search
                    );
                }
            );

        })();
    </script>

</body>

</html>
