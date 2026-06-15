@extends('errors.layout')

@section('code', '403')
@section('title', 'Akses Ditolak')

@section('message_title')
    Anda tidak memiliki<br>izin untuk halaman ini.
@endsection

@section('message_desc')
    Akses ke halaman ini dibatasi. Pastikan Anda telah masuk dengan akun yang tepat dan memiliki hak akses yang diperlukan.
@endsection

@section('illustration')
{{-- Lock / shield illustration untuk error 403 --}}
<svg viewBox="0 0 380 360" xmlns="http://www.w3.org/2000/svg" width="100%" aria-hidden="true">
    <defs>
        <linearGradient id="lockGrad" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#EEF2FA"/>
            <stop offset="100%" stop-color="#DDE6F5"/>
        </linearGradient>
        <linearGradient id="lockRim" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#2A5298"/>
            <stop offset="100%" stop-color="#1B3A6B"/>
        </linearGradient>
        <filter id="lockShadow">
            <feDropShadow dx="2" dy="8" stdDeviation="12" flood-color="#0F2245" flood-opacity="0.18"/>
        </filter>
        <filter id="docShadow">
            <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#1B3A6B" flood-opacity="0.1"/>
        </filter>
        <style>
            .float-doc-1 { animation: floatA 5s ease-in-out infinite; transform-box: fill-box; transform-origin: center; }
            .float-doc-2 { animation: floatB 6.5s ease-in-out infinite; transform-box: fill-box; transform-origin: center; }
            .float-doc-3 { animation: floatC 4.8s ease-in-out infinite; transform-box: fill-box; transform-origin: center; }
            .main-illus-group { animation: illusRock 6s ease-in-out infinite; transform-origin: center; }
            .sparkle-a { animation: sparklePop 2.4s ease-in-out infinite; transform-box: fill-box; transform-origin: center; }
            .sparkle-b { animation: sparklePop 3.1s ease-in-out infinite 0.7s; transform-box: fill-box; transform-origin: center; }
            .lock-shake { animation: lockShake 4s ease-in-out infinite; transform-box: fill-box; transform-origin: center; }
            @keyframes floatA { 0%,100%{transform:translateY(0) rotate(15deg)}50%{transform:translateY(-10px) rotate(12deg)} }
            @keyframes floatB { 0%,100%{transform:translateY(0) rotate(-12deg)}50%{transform:translateY(-14px) rotate(-9deg)} }
            @keyframes floatC { 0%,100%{transform:translateY(0) rotate(8deg)}50%{transform:translateY(-8px) rotate(11deg)} }
            @keyframes illusRock { 0%,100%{transform:rotate(-1.5deg) translateY(0)}50%{transform:rotate(1.5deg) translateY(-6px)} }
            @keyframes sparklePop { 0%,100%{opacity:0.5;transform:scale(1)}50%{opacity:1;transform:scale(1.3)} }
            @keyframes lockShake { 0%,100%{transform:rotate(0)}10%,30%,50%{transform:rotate(-4deg)}20%,40%{transform:rotate(4deg)}60%{transform:rotate(0)} }
        </style>
    </defs>

    <!-- Floating docs -->
    <g class="float-doc-1" transform="translate(295,42) rotate(15)">
        <g filter="url(#docShadow)">
            <rect width="50" height="62" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M38,0 L50,12 L38,12 Z" fill="#EEF2FA"/>
            <line x1="38" y1="0" x2="38" y2="12" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="38" y1="12" x2="50" y2="12" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="8" y="20" width="30" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="8" y="30" width="23" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="8" y="39" width="27" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>

    <g class="float-doc-2" transform="translate(18,108) rotate(-12)">
        <g filter="url(#docShadow)">
            <rect width="44" height="54" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M33,0 L44,11 L33,11 Z" fill="#EEF2FA"/>
            <line x1="33" y1="0" x2="33" y2="11" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="33" y1="11" x2="44" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="7" y="18" width="26" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="20" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="7" y="35" width="24" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>

    <g class="float-doc-3" transform="translate(308,275) rotate(8)">
        <g filter="url(#docShadow)">
            <rect width="42" height="52" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M31,0 L42,11 L31,11 Z" fill="#EEF2FA"/>
            <line x1="31" y1="0" x2="31" y2="11" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="31" y1="11" x2="42" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="7" y="18" width="22" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="17" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>

    <!-- Main: padlock illustration -->
    <g class="main-illus-group" filter="url(#lockShadow)">
        <!-- Lock body -->
        <rect x="115" y="175" width="150" height="130" rx="16" fill="url(#lockGrad)"/>
        <rect x="115" y="175" width="150" height="130" rx="16" fill="none" stroke="url(#lockRim)" stroke-width="5"/>
        <!-- Top highlight -->
        <rect x="128" y="179" width="60" height="3" rx="1.5" fill="white" opacity="0.3"/>

        <!-- Shackle (lock arch) -->
        <g class="lock-shake">
            <path d="M152 175 L152 130 Q152 90 190 90 Q228 90 228 130 L228 175"
                  fill="none" stroke="url(#lockRim)" stroke-width="18" stroke-linecap="round"/>
            <!-- Shackle interior -->
            <path d="M152 175 L152 130 Q152 90 190 90 Q228 90 228 130 L228 175"
                  fill="none" stroke="url(#lockGrad)" stroke-width="8" stroke-linecap="round"/>
        </g>

        <!-- Keyhole -->
        <circle cx="190" cy="228" r="18" fill="#1B3A6B"/>
        <rect x="184" y="228" width="12" height="22" rx="4" fill="#1B3A6B"/>
        <circle cx="190" cy="228" r="18" fill="none" stroke="white" stroke-width="2" opacity="0.15"/>
    </g>

    <!-- Sparkles & dots -->
    <g class="sparkle-a" transform="translate(78,78)">
        <line x1="0" y1="-9" x2="0" y2="9" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-9" y1="0" x2="9" y2="0" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-5.5" y1="-5.5" x2="5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
        <line x1="5.5" y1="-5.5" x2="-5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <g class="sparkle-b" transform="translate(52,294)">
        <line x1="0" y1="-6" x2="0" y2="6" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
        <line x1="-6" y1="0" x2="6" y2="0" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <circle cx="330" cy="90"  r="4.5" fill="#F59E0B" opacity="0.55"/>
    <circle cx="44"  cy="245" r="5"   fill="#F59E0B" opacity="0.35"/>
    <circle cx="352" cy="312" r="3"   fill="#94A3B8" opacity="0.4"/>
    <circle cx="30"  cy="65"  r="3.5" fill="#1B3A6B" opacity="0.18"/>
    <circle cx="190" cy="200" r="120" fill="none" stroke="#1B3A6B" stroke-width="1" stroke-dasharray="6 14" opacity="0.07"/>
</svg>
@endsection