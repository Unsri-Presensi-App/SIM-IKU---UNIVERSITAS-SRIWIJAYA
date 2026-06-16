@extends('errors.layout')

@section('code', '503')
@section('title', 'Pemeliharaan Sistem')

@section('message_title')
    Sistem sedang<br>dalam pemeliharaan.
@endsection

@section('message_desc')
    Sistem Informasi Manajemen IKU UNSRI sedang diperbarui oleh tim teknis. Mohon maaf atas ketidaknyamanan ini — silakan coba beberapa saat lagi atau hubungi helpdesk bila mendesak.
@endsection

@section('illustration')
<svg viewBox="0 0 380 360" xmlns="http://www.w3.org/2000/svg" width="100%" aria-hidden="true">
    <defs>
        <linearGradient id="grad503" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#EEF2FA"/>
            <stop offset="100%" stop-color="#DDE6F5"/>
        </linearGradient>
        <linearGradient id="rim503" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#2A5298"/>
            <stop offset="100%" stop-color="#1B3A6B"/>
        </linearGradient>
        <filter id="shadow503">
            <feDropShadow dx="2" dy="8" stdDeviation="12" flood-color="#0F2245" flood-opacity="0.18"/>
        </filter>
        <filter id="doc503">
            <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#1B3A6B" flood-opacity="0.1"/>
        </filter>
        <style>
            .f1-503{animation:fA503 5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .f2-503{animation:fB503 6.5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .f3-503{animation:fC503 4.8s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .main-503{animation:rock503 6s ease-in-out infinite;transform-origin:center}
            .sp-a-503{animation:spop503 2.4s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .sp-b-503{animation:spop503 3.1s ease-in-out infinite 0.7s;transform-box:fill-box;transform-origin:center}
            .gear-503{animation:gearSpin503 8s linear infinite;transform-box:fill-box;transform-origin:center}
            .gear-503r{animation:gearSpin503 6s linear infinite reverse;transform-box:fill-box;transform-origin:center}
            .warn-dot{animation:warnBlink 1.4s ease-in-out infinite}
            @keyframes fA503{0%,100%{transform:translateY(0) rotate(15deg)}50%{transform:translateY(-10px) rotate(12deg)}}
            @keyframes fB503{0%,100%{transform:translateY(0) rotate(-12deg)}50%{transform:translateY(-14px) rotate(-9deg)}}
            @keyframes fC503{0%,100%{transform:translateY(0) rotate(8deg)}50%{transform:translateY(-8px) rotate(11deg)}}
            @keyframes rock503{0%,100%{transform:rotate(-1.5deg) translateY(0)}50%{transform:rotate(1.5deg) translateY(-6px)}}
            @keyframes spop503{0%,100%{opacity:0.5;transform:scale(1)}50%{opacity:1;transform:scale(1.3)}}
            @keyframes gearSpin503{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
            @keyframes warnBlink{0%,100%{opacity:1}50%{opacity:0.25}}
        </style>
    </defs>

    <!-- Floating docs -->
    <g class="f1-503" transform="translate(295,42) rotate(15)">
        <g filter="url(#doc503)">
            <rect width="50" height="62" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M38,0 L50,12 L38,12 Z" fill="#EEF2FA"/>
            <line x1="38" y1="0" x2="38" y2="12" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="38" y1="12" x2="50" y2="12" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="8" y="20" width="30" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="8" y="30" width="23" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="8" y="39" width="27" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>
    <g class="f2-503" transform="translate(18,108) rotate(-12)">
        <g filter="url(#doc503)">
            <rect width="44" height="54" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M33,0 L44,11 L33,11 Z" fill="#EEF2FA"/>
            <line x1="33" y1="0" x2="33" y2="11" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="33" y1="11" x2="44" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="7" y="18" width="26" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="20" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="7" y="35" width="24" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>
    <g class="f3-503" transform="translate(308,275) rotate(8)">
        <g filter="url(#doc503)">
            <rect width="42" height="52" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M31,0 L42,11 L31,11 Z" fill="#EEF2FA"/>
            <line x1="31" y1="0" x2="31" y2="11" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="31" y1="11" x2="42" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="7" y="18" width="22" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="17" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>

    <!-- Main: screen with maintenance state + gears -->
    <g class="main-503" filter="url(#shadow503)">
        <!-- Monitor frame -->
        <rect x="90" y="70" width="200" height="160" rx="12" fill="url(#grad503)"/>
        <rect x="90" y="70" width="200" height="160" rx="12" fill="none" stroke="url(#rim503)" stroke-width="5"/>
        <!-- Top highlight -->
        <rect x="103" y="74" width="70" height="3" rx="1.5" fill="white" opacity="0.3"/>

        <!-- Amber warning bar at top -->
        <rect x="90" y="70" width="200" height="14" rx="12" fill="#F59E0B"/>
        <rect x="90" y="78" width="200" height="6" fill="#F59E0B"/>

        <!-- Warning icon -->
        <polygon points="190,82 185,92 195,92" fill="white" opacity="0.9"/>
        <rect x="189" y="84" width="2" height="4" rx="1" fill="#F59E0B"/>
        <circle cx="190" cy="90" r="1" fill="#F59E0B"/>

        <!-- Screen content area -->
        <rect x="106" y="94" width="168" height="124" rx="5" fill="white" stroke="#E2E8F0" stroke-width="1"/>

        <!-- Maintenance lines -->
        <rect x="118" y="106" width="88" height="5" rx="2.5" fill="#CBD5E1"/>
        <rect x="118" y="118" width="130" height="4" rx="2" fill="#E2E8F0"/>
        <rect x="118" y="128" width="100" height="4" rx="2" fill="#E2E8F0" opacity="0.7"/>

        <!-- Progress bar -->
        <rect x="118" y="142" width="144" height="9" rx="4.5" fill="#F1F5F9"/>
        <rect x="118" y="142" width="90" height="9" rx="4.5" fill="#F59E0B">
            <animate attributeName="width" values="40;120;40" dur="2.2s" repeatCount="indefinite" calcMode="ease-in-out"/>
        </rect>

        <rect x="118" y="160" width="75" height="4" rx="2" fill="#E2E8F0" opacity="0.5"/>
        <rect x="118" y="170" width="110" height="4" rx="2" fill="#E2E8F0" opacity="0.35"/>

        <!-- Maintenance badge -->
        <rect x="118" y="182" width="78" height="16" rx="8" fill="#FEF3C7" stroke="#FDE68A" stroke-width="1"/>
        <circle cx="131" cy="190" r="4" fill="#F59E0B" class="warn-dot"/>
        <rect x="139" y="187.5" width="48" height="4" rx="2" fill="#92400E" opacity="0.55"/>

        <!-- Monitor stand -->
        <rect x="182" y="230" width="16" height="30" rx="4" fill="url(#rim503)"/>
        <rect x="162" y="257" width="56" height="8" rx="4" fill="url(#rim503)"/>
    </g>

    <!-- Big gear (right of screen) -->
    <g class="gear-503" transform="translate(318,220)">
        <circle r="24" fill="none" stroke="#1B3A6B" stroke-width="5"/>
        <circle r="10" fill="#1B3A6B"/>
        <rect x="-4" y="-32" width="8" height="10" rx="2.5" fill="#1B3A6B"/>
        <rect x="-4" y="22"  width="8" height="10" rx="2.5" fill="#1B3A6B"/>
        <rect x="-32" y="-4" width="10" height="8" rx="2.5" fill="#1B3A6B"/>
        <rect x="22"  y="-4" width="10" height="8" rx="2.5" fill="#1B3A6B"/>
        <rect x="-24" y="-24" width="8" height="8" rx="2" fill="#1B3A6B" transform="rotate(45)"/>
        <rect x="16"  y="-24" width="8" height="8" rx="2" fill="#1B3A6B" transform="rotate(-45)"/>
    </g>

    <!-- Small gear -->
    <g class="gear-503r" transform="translate(292,200)">
        <circle r="14" fill="none" stroke="#F59E0B" stroke-width="3.5"/>
        <circle r="6" fill="#F59E0B"/>
        <rect x="-2.5" y="-19" width="5" height="7" rx="2" fill="#F59E0B"/>
        <rect x="-2.5" y="12"  width="5" height="7" rx="2" fill="#F59E0B"/>
        <rect x="-19" y="-2.5" width="7" height="5" rx="2" fill="#F59E0B"/>
        <rect x="12"  y="-2.5" width="7" height="5" rx="2" fill="#F59E0B"/>
    </g>

    <!-- Sparkles & dots -->
    <g class="sp-a-503" transform="translate(78,78)">
        <line x1="0" y1="-9" x2="0" y2="9" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-9" y1="0" x2="9" y2="0" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-5.5" y1="-5.5" x2="5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
        <line x1="5.5" y1="-5.5" x2="-5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <g class="sp-b-503" transform="translate(52,294)">
        <line x1="0" y1="-6" x2="0" y2="6" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
        <line x1="-6" y1="0" x2="6" y2="0" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <circle cx="330" cy="90"  r="4.5" fill="#F59E0B" opacity="0.55"/>
    <circle cx="44"  cy="245" r="5"   fill="#F59E0B" opacity="0.35"/>
    <circle cx="352" cy="312" r="3"   fill="#94A3B8" opacity="0.4"/>
    <circle cx="30"  cy="65"  r="3.5" fill="#1B3A6B" opacity="0.18"/>
    <circle cx="190" cy="185" r="120" fill="none" stroke="#1B3A6B" stroke-width="1" stroke-dasharray="6 14" opacity="0.07"/>
</svg>
@endsection
