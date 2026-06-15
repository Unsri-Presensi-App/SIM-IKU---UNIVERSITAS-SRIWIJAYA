@extends('errors.layout')

@section('code', '502')
@section('title', 'Gateway Bermasalah')

@section('message_title')
    Gateway menerima<br>respons tidak valid.
@endsection

@section('message_desc')
    Server bertindak sebagai gateway dan menerima respons tidak valid dari server upstream. Masalah ini bersifat sementara — silakan coba beberapa saat lagi.
@endsection

@section('illustration')
<svg viewBox="0 0 380 360" xmlns="http://www.w3.org/2000/svg" width="100%" aria-hidden="true">
    <defs>
        <linearGradient id="grad502" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#EEF2FA"/>
            <stop offset="100%" stop-color="#DDE6F5"/>
        </linearGradient>
        <linearGradient id="rim502" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#2A5298"/>
            <stop offset="100%" stop-color="#1B3A6B"/>
        </linearGradient>
        <filter id="shadow502">
            <feDropShadow dx="2" dy="8" stdDeviation="10" flood-color="#0F2245" flood-opacity="0.16"/>
        </filter>
        <filter id="doc502">
            <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#1B3A6B" flood-opacity="0.1"/>
        </filter>
        <style>
            .f1-502{animation:fA502 5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .f2-502{animation:fB502 6.5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .f3-502{animation:fC502 4.8s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .main-502{animation:rock502 6s ease-in-out infinite;transform-origin:center}
            .sp-a-502{animation:spop502 2.4s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .sp-b-502{animation:spop502 3.1s ease-in-out infinite 0.7s;transform-box:fill-box;transform-origin:center}
            .signal-502{animation:signalFlow 1.5s ease-in-out infinite}
            .signal-502b{animation:signalFlow 1.5s ease-in-out infinite 0.5s}
            .broken-502{animation:brokenFlash 2s ease-in-out infinite}
            @keyframes fA502{0%,100%{transform:translateY(0) rotate(15deg)}50%{transform:translateY(-10px) rotate(12deg)}}
            @keyframes fB502{0%,100%{transform:translateY(0) rotate(-12deg)}50%{transform:translateY(-14px) rotate(-9deg)}}
            @keyframes fC502{0%,100%{transform:translateY(0) rotate(8deg)}50%{transform:translateY(-8px) rotate(11deg)}}
            @keyframes rock502{0%,100%{transform:rotate(-1.5deg) translateY(0)}50%{transform:rotate(1.5deg) translateY(-6px)}}
            @keyframes spop502{0%,100%{opacity:.5;transform:scale(1)}50%{opacity:1;transform:scale(1.3)}}
            @keyframes signalFlow{0%{stroke-dashoffset:40}100%{stroke-dashoffset:0}}
            @keyframes brokenFlash{0%,100%{opacity:1}50%{opacity:0.25}}
        </style>
    </defs>

    <!-- Floating docs -->
    <g class="f1-502" transform="translate(295,42) rotate(15)">
        <g filter="url(#doc502)">
            <rect width="50" height="62" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M38,0 L50,12 L38,12 Z" fill="#EEF2FA"/>
            <line x1="38" y1="0" x2="38" y2="12" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="38" y1="12" x2="50" y2="12" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="8" y="20" width="30" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="8" y="30" width="23" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="8" y="39" width="27" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>
    <g class="f2-502" transform="translate(18,108) rotate(-12)">
        <g filter="url(#doc502)">
            <rect width="44" height="54" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M33,0 L44,11 L33,11 Z" fill="#EEF2FA"/>
            <line x1="33" y1="0" x2="33" y2="11" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="33" y1="11" x2="44" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="7" y="18" width="26" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="20" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="7" y="35" width="24" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>
    <g class="f3-502" transform="translate(308,275) rotate(8)">
        <g filter="url(#doc502)">
            <rect width="42" height="52" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M31,0 L42,11 L31,11 Z" fill="#EEF2FA"/>
            <line x1="31" y1="0" x2="31" y2="11" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="31" y1="11" x2="42" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="7" y="18" width="22" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="17" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>

    <!-- Main: two servers with broken connection -->
    <g class="main-502" filter="url(#shadow502)">

        <!-- Left server (client) — healthy -->
        <rect x="55" y="115" width="96" height="130" rx="10" fill="url(#grad502)"/>
        <rect x="55" y="115" width="96" height="130" rx="10" fill="none" stroke="url(#rim502)" stroke-width="4"/>
        <rect x="55" y="115" width="96" height="13" rx="10" fill="#1B3A6B"/>
        <rect x="55" y="122" width="96" height="6" fill="#1B3A6B"/>
        <rect x="65" y="140" width="56" height="5" rx="2.5" fill="#CBD5E1"/>
        <rect x="65" y="152" width="70" height="4" rx="2" fill="#E2E8F0"/>
        <rect x="65" y="162" width="48" height="4" rx="2" fill="#E2E8F0"/>
        <rect x="65" y="172" width="64" height="4" rx="2" fill="#E2E8F0"/>
        <circle cx="78"  cy="207" r="6" fill="#22C55E"/>
        <circle cx="98"  cy="207" r="6" fill="#22C55E"/>
        <circle cx="118" cy="207" r="6" fill="#22C55E"/>
        <rect x="65" y="220" width="70" height="14" rx="5" fill="#1B3A6B"/>
        <rect x="74" y="225" width="50" height="4" rx="2" fill="white" opacity="0.5"/>

        <!-- Right server (upstream) — error -->
        <rect x="229" y="115" width="96" height="130" rx="10" fill="url(#grad502)"/>
        <rect x="229" y="115" width="96" height="130" rx="10" fill="none" stroke="#EF4444" stroke-width="4"/>
        <rect x="229" y="115" width="96" height="13" rx="10" fill="#EF4444"/>
        <rect x="229" y="122" width="96" height="6" fill="#EF4444"/>
        <rect x="239" y="140" width="56" height="5" rx="2.5" fill="#FCA5A5"/>
        <rect x="239" y="152" width="70" height="4" rx="2" fill="#FCA5A5" opacity="0.6"/>
        <rect x="239" y="162" width="48" height="4" rx="2" fill="#FCA5A5" opacity="0.5"/>
        <rect x="239" y="172" width="64" height="4" rx="2" fill="#FCA5A5" opacity="0.4"/>
        <g class="broken-502">
            <circle cx="252" cy="207" r="6" fill="#EF4444"/>
            <circle cx="272" cy="207" r="6" fill="#EF4444"/>
            <circle cx="292" cy="207" r="6" fill="#EF4444"/>
        </g>
        <rect x="239" y="220" width="70" height="14" rx="5" fill="#EF4444"/>
        <rect x="248" y="225" width="50" height="4" rx="2" fill="white" opacity="0.4"/>

        <!-- Connection line between servers -->
        <!-- Healthy side going right -->
        <line x1="152" y1="180" x2="188" y2="180"
              stroke="#22C55E" stroke-width="2.5" stroke-dasharray="8 4"
              stroke-dashoffset="0">
            <animate attributeName="stroke-dashoffset" from="24" to="0" dur="0.9s" repeatCount="indefinite"/>
        </line>
        <!-- Arrow pointing right (OK direction) -->
        <polyline points="182,173 190,180 182,187" fill="none" stroke="#22C55E" stroke-width="2.5" stroke-linecap="round"/>

        <!-- Broken side going left -->
        <line x1="228" y1="180" x2="194" y2="180"
              stroke="#EF4444" stroke-width="2.5" stroke-dasharray="8 4"
              stroke-dashoffset="0">
            <animate attributeName="stroke-dashoffset" from="0" to="24" dur="0.9s" repeatCount="indefinite"/>
        </line>
        <!-- Arrow pointing left (broken response) -->
        <polyline points="200,173 192,180 200,187" fill="none" stroke="#EF4444" stroke-width="2.5" stroke-linecap="round"/>

        <!-- Break / X mark in the middle -->
        <circle cx="190" cy="180" r="14" fill="white" stroke="#E2E8F0" stroke-width="1.5"/>
        <g class="broken-502">
            <line x1="183" y1="173" x2="197" y2="187" stroke="#EF4444" stroke-width="2.5" stroke-linecap="round"/>
            <line x1="197" y1="173" x2="183" y2="187" stroke="#EF4444" stroke-width="2.5" stroke-linecap="round"/>
        </g>

        <!-- Labels -->
        <text x="103" y="260" text-anchor="middle" font-family="Inter, sans-serif" font-size="9" font-weight="600" fill="#1B3A6B" opacity="0.6">CLIENT</text>
        <text x="277" y="260" text-anchor="middle" font-family="Inter, sans-serif" font-size="9" font-weight="600" fill="#EF4444" opacity="0.7">UPSTREAM</text>
    </g>

    <!-- Sparkles & dots -->
    <g class="sp-a-502" transform="translate(78,78)">
        <line x1="0" y1="-9" x2="0" y2="9" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-9" y1="0" x2="9" y2="0" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-5.5" y1="-5.5" x2="5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
        <line x1="5.5" y1="-5.5" x2="-5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <g class="sp-b-502" transform="translate(52,294)">
        <line x1="0" y1="-6" x2="0" y2="6" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
        <line x1="-6" y1="0" x2="6" y2="0" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <circle cx="330" cy="90"  r="4.5" fill="#F59E0B" opacity="0.55"/>
    <circle cx="44"  cy="245" r="5"   fill="#F59E0B" opacity="0.35"/>
    <circle cx="352" cy="312" r="3"   fill="#94A3B8" opacity="0.4"/>
    <circle cx="30"  cy="65"  r="3.5" fill="#1B3A6B" opacity="0.18"/>
    <circle cx="190" cy="180" r="130" fill="none" stroke="#1B3A6B" stroke-width="1" stroke-dasharray="6 14" opacity="0.07"/>
</svg>
@endsection