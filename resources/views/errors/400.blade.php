@extends('errors.layout')

@section('code', '400')
@section('title', 'Permintaan Tidak Valid')

@section('message_title')
    Permintaan yang dikirim<br>tidak dapat diproses.
@endsection

@section('message_desc')
    Server tidak dapat memahami permintaan yang dikirim karena format atau data yang tidak valid. Periksa kembali input Anda dan coba lagi.
@endsection

@section('illustration')
<svg viewBox="0 0 380 360" xmlns="http://www.w3.org/2000/svg" width="100%" aria-hidden="true">
    <defs>
        <linearGradient id="grad400" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#EEF2FA"/>
            <stop offset="100%" stop-color="#DDE6F5"/>
        </linearGradient>
        <linearGradient id="rim400" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#2A5298"/>
            <stop offset="100%" stop-color="#1B3A6B"/>
        </linearGradient>
        <filter id="shadow400">
            <feDropShadow dx="2" dy="8" stdDeviation="12" flood-color="#0F2245" flood-opacity="0.18"/>
        </filter>
        <filter id="doc400">
            <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#1B3A6B" flood-opacity="0.1"/>
        </filter>
        <style>
            .f1-400{animation:fA400 5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .f2-400{animation:fB400 6.5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .f3-400{animation:fC400 4.8s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .main-400{animation:rock400 6s ease-in-out infinite;transform-origin:center}
            .sp-a-400{animation:spop400 2.4s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .sp-b-400{animation:spop400 3.1s ease-in-out infinite 0.7s;transform-box:fill-box;transform-origin:center}
            .err-line{animation:errBlink 1.8s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .err-line2{animation:errBlink 1.8s ease-in-out infinite 0.4s;transform-box:fill-box;transform-origin:center}
            @keyframes fA400{0%,100%{transform:translateY(0) rotate(15deg)}50%{transform:translateY(-10px) rotate(12deg)}}
            @keyframes fB400{0%,100%{transform:translateY(0) rotate(-12deg)}50%{transform:translateY(-14px) rotate(-9deg)}}
            @keyframes fC400{0%,100%{transform:translateY(0) rotate(8deg)}50%{transform:translateY(-8px) rotate(11deg)}}
            @keyframes rock400{0%,100%{transform:rotate(-1.5deg) translateY(0)}50%{transform:rotate(1.5deg) translateY(-6px)}}
            @keyframes spop400{0%,100%{opacity:.5;transform:scale(1)}50%{opacity:1;transform:scale(1.3)}}
            @keyframes errBlink{0%,100%{opacity:1}50%{opacity:0.3}}
        </style>
    </defs>

    <!-- Floating docs -->
    <g class="f1-400" transform="translate(295,42) rotate(15)">
        <g filter="url(#doc400)">
            <rect width="50" height="62" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M38,0 L50,12 L38,12 Z" fill="#EEF2FA"/>
            <line x1="38" y1="0" x2="38" y2="12" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="38" y1="12" x2="50" y2="12" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="8" y="20" width="30" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="8" y="30" width="23" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="8" y="39" width="27" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>
    <g class="f2-400" transform="translate(18,108) rotate(-12)">
        <g filter="url(#doc400)">
            <rect width="44" height="54" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M33,0 L44,11 L33,11 Z" fill="#EEF2FA"/>
            <line x1="33" y1="0" x2="33" y2="11" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="33" y1="11" x2="44" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="7" y="18" width="26" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="20" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="7" y="35" width="24" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>
    <g class="f3-400" transform="translate(308,275) rotate(8)">
        <g filter="url(#doc400)">
            <rect width="42" height="52" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M31,0 L42,11 L31,11 Z" fill="#EEF2FA"/>
            <line x1="31" y1="0" x2="31" y2="11" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="31" y1="11" x2="42" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="7" y="18" width="22" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="17" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>

    <!-- Main: code editor / terminal with bad request -->
    <g class="main-400" filter="url(#shadow400)">
        <!-- Editor window -->
        <rect x="90" y="80" width="200" height="200" rx="12" fill="url(#grad400)"/>
        <rect x="90" y="80" width="200" height="200" rx="12" fill="none" stroke="url(#rim400)" stroke-width="5"/>
        <!-- Title bar -->
        <rect x="90" y="80" width="200" height="28" rx="12" fill="#1B3A6B"/>
        <rect x="90" y="96" width="200" height="12" fill="#1B3A6B"/>
        <!-- Traffic lights -->
        <circle cx="110" cy="94" r="5" fill="#EF4444"/>
        <circle cx="126" cy="94" r="5" fill="#F59E0B"/>
        <circle cx="142" cy="94" r="5" fill="#22C55E"/>
        <!-- Window title text -->
        <rect x="158" y="91" width="60" height="6" rx="3" fill="white" opacity="0.2"/>

        <!-- Code area background -->
        <rect x="102" y="118" width="176" height="148" rx="4" fill="#F1F5F9"/>

        <!-- Line numbers -->
        <rect x="102" y="118" width="24" height="148" rx="4" fill="#E2E8F0"/>
        <rect x="110" y="128" width="8" height="4" rx="2" fill="#94A3B8"/>
        <rect x="110" y="140" width="8" height="4" rx="2" fill="#94A3B8"/>
        <rect x="110" y="152" width="8" height="4" rx="2" fill="#94A3B8"/>
        <rect x="110" y="164" width="8" height="4" rx="2" fill="#94A3B8"/>
        <rect x="110" y="176" width="8" height="4" rx="2" fill="#94A3B8"/>
        <rect x="110" y="188" width="8" height="4" rx="2" fill="#94A3B8"/>
        <rect x="110" y="200" width="8" height="4" rx="2" fill="#94A3B8"/>
        <rect x="110" y="212" width="8" height="4" rx="2" fill="#94A3B8"/>
        <rect x="110" y="224" width="8" height="4" rx="2" fill="#94A3B8"/>
        <rect x="110" y="236" width="8" height="4" rx="2" fill="#94A3B8"/>
        <rect x="110" y="248" width="8" height="4" rx="2" fill="#94A3B8"/>

        <!-- Normal code lines -->
        <rect x="134" y="128" width="55" height="4" rx="2" fill="#1B3A6B" opacity="0.5"/>
        <rect x="134" y="140" width="75" height="4" rx="2" fill="#64748B" opacity="0.45"/>
        <rect x="134" y="152" width="40" height="4" rx="2" fill="#64748B" opacity="0.35"/>

        <!-- Error highlighted row -->
        <rect x="128" y="160" width="144" height="16" rx="3" fill="#FEE2E2"/>
        <rect x="134" y="164" width="88" height="4" rx="2" fill="#EF4444" opacity="0.7"/>
        <g class="err-line">
            <!-- wavy underline -->
            <path d="M134 172 Q140 169 146 172 Q152 175 158 172 Q164 169 170 172 Q176 175 182 172 Q188 169 194 172 Q200 175 206 172 Q212 169 218 172"
                  fill="none" stroke="#EF4444" stroke-width="1.5" stroke-linecap="round"/>
        </g>

        <rect x="134" y="184" width="60" height="4" rx="2" fill="#64748B" opacity="0.4"/>
        <rect x="134" y="196" width="82" height="4" rx="2" fill="#64748B" opacity="0.35"/>

        <!-- Second error row -->
        <rect x="128" y="204" width="144" height="16" rx="3" fill="#FEE2E2"/>
        <rect x="134" y="208" width="50" height="4" rx="2" fill="#EF4444" opacity="0.7"/>
        <g class="err-line2">
            <path d="M134 216 Q140 213 146 216 Q152 219 158 216 Q164 213 170 216 Q176 219 182 216"
                  fill="none" stroke="#EF4444" stroke-width="1.5" stroke-linecap="round"/>
        </g>

        <rect x="134" y="228" width="70" height="4" rx="2" fill="#64748B" opacity="0.3"/>
        <rect x="134" y="240" width="45" height="4" rx="2" fill="#64748B" opacity="0.25"/>

        <!-- Error badge in editor -->
        <rect x="102" y="252" width="176" height="14" rx="4" fill="#FCA5A5" opacity="0.4"/>
        <rect x="110" y="255" width="6" height="6" rx="3" fill="#EF4444"/>
        <rect x="122" y="256" width="60" height="4" rx="2" fill="#EF4444" opacity="0.6"/>
    </g>

    <!-- Sparkles & dots -->
    <g class="sp-a-400" transform="translate(78,78)">
        <line x1="0" y1="-9" x2="0" y2="9" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-9" y1="0" x2="9" y2="0" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-5.5" y1="-5.5" x2="5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
        <line x1="5.5" y1="-5.5" x2="-5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <g class="sp-b-400" transform="translate(52,294)">
        <line x1="0" y1="-6" x2="0" y2="6" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
        <line x1="-6" y1="0" x2="6" y2="0" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <circle cx="330" cy="90"  r="4.5" fill="#F59E0B" opacity="0.55"/>
    <circle cx="44"  cy="245" r="5"   fill="#F59E0B" opacity="0.35"/>
    <circle cx="352" cy="312" r="3"   fill="#94A3B8" opacity="0.4"/>
    <circle cx="30"  cy="65"  r="3.5" fill="#1B3A6B" opacity="0.18"/>
    <circle cx="190" cy="180" r="120" fill="none" stroke="#1B3A6B" stroke-width="1" stroke-dasharray="6 14" opacity="0.07"/>
</svg>
@endsection