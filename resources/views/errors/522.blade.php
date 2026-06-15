@extends('errors.layout')

@section('code', '522')
@section('title', 'Waktu Koneksi Habis')

@section('message_title')
    Waktu koneksi<br>telah habis.
@endsection

@section('message_desc')
    Server asal membutuhkan waktu terlalu lama untuk merespons permintaan. Hal ini biasanya terjadi karena beban server yang terlalu tinggi atau masalah pada rute jaringan. Silakan coba muat ulang beberapa saat lagi.
@endsection

@section('illustration')
<svg viewBox="0 0 380 360" xmlns="http://www.w3.org/2000/svg" width="100%" aria-hidden="true">
    <defs>
        <linearGradient id="grad522" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#EEF2FA"/>
            <stop offset="100%" stop-color="#DDE6F5"/>
        </linearGradient>
        <linearGradient id="rim522" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#2A5298"/>
            <stop offset="100%" stop-color="#1B3A6B"/>
        </linearGradient>
        <style>
            .f1-522{animation:fA522 5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .f2-522{animation:fB522 6.5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .f3-522{animation:fC522 4.8s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .main-522{animation:rock522 6s ease-in-out infinite;transform-origin:center}
            .sp-a-522{animation:spop522 2.4s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .sp-b-522{animation:spop522 3.1s ease-in-out infinite 0.7s;transform-box:fill-box;transform-origin:center}
            .timeout-flash-522{animation:timeoutFlash 2s ease-in-out infinite}
            .spin-hand-522{animation:spinHand 2.5s linear infinite;transform-origin:190px 180px}
            .fade-line-522{animation:fadeLine 1.8s ease-in-out infinite}

            @keyframes fA522{0%,100%{transform:translateY(0) rotate(15deg)}50%{transform:translateY(-10px) rotate(12deg)}}
            @keyframes fB522{0%,100%{transform:translateY(0) rotate(-12deg)}50%{transform:translateY(-14px) rotate(-9deg)}}
            @keyframes fC522{0%,100%{transform:translateY(0) rotate(8deg)}50%{transform:translateY(-8px) rotate(11deg)}}
            @keyframes rock522{0%,100%{transform:rotate(-1.5deg) translateY(0)}50%{transform:rotate(1.5deg) translateY(-6px)}}
            @keyframes spop522{0%,100%{opacity:.4;transform:scale(1)}50%{opacity:1;transform:scale(1.3)}}
            @keyframes timeoutFlash{0%,100%{opacity:1}50%{opacity:0.3}}
            @keyframes spinHand{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
            @keyframes fadeLine{0%,100%{opacity:0.15}50%{opacity:0.6}}
        </style>
    </defs>

    {{-- Floating document decorations --}}
    <g class="f1-522" transform="translate(295,42) rotate(15)">
        <rect width="50" height="62" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
        <path d="M38,0 L50,12 L38,12 Z" fill="#EEF2FA"/>
        <line x1="38" y1="0" x2="38" y2="12" stroke="#CBD5E1" stroke-width="1"/>
        <line x1="38" y1="12" x2="50" y2="12" stroke="#CBD5E1" stroke-width="1"/>
        <rect x="8" y="20" width="30" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="8" y="30" width="23" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="8" y="39" width="27" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>
    <g class="f2-522" transform="translate(18,108) rotate(-12)">
        <rect width="44" height="54" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
        <path d="M33,0 L44,11 L33,11 Z" fill="#EEF2FA"/>
        <line x1="33" y1="0" x2="33" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        <line x1="33" y1="11" x2="44" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        <rect x="7" y="18" width="26" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="20" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="7" y="35" width="24" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>
    <g class="f3-522" transform="translate(308,275) rotate(8)">
        <rect width="42" height="52" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
        <path d="M31,0 L42,11 L31,11 Z" fill="#EEF2FA"/>
        <line x1="31" y1="0" x2="31" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        <line x1="31" y1="11" x2="42" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        <rect x="7" y="18" width="22" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="17" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>

    {{-- Main illustration group (rocks gently) --}}
    <g class="main-522">

        {{-- CLIENT server card --}}
        <rect x="55" y="115" width="96" height="130" rx="10" fill="url(#grad522)"/>
        <rect x="55" y="115" width="96" height="130" rx="10" fill="none" stroke="url(#rim522)" stroke-width="4"/>
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

        {{-- UPSTREAM server card (amber/warning) --}}
        <rect x="229" y="115" width="96" height="130" rx="10" fill="url(#grad522)"/>
        <rect x="229" y="115" width="96" height="130" rx="10" fill="none" stroke="#F59E0B" stroke-width="4"/>
        <rect x="229" y="115" width="96" height="13" rx="10" fill="#F59E0B"/>
        <rect x="229" y="122" width="96" height="6" fill="#F59E0B"/>
        <rect x="239" y="140" width="56" height="5" rx="2.5" fill="#FDE68A"/>
        <rect x="239" y="152" width="70" height="4" rx="2" fill="#FDE68A" opacity="0.6"/>
        <rect x="239" y="162" width="48" height="4" rx="2" fill="#FDE68A" opacity="0.5"/>
        <rect x="239" y="172" width="64" height="4" rx="2" fill="#FDE68A" opacity="0.4"/>
        {{-- Blinking indicator dots --}}
        <g class="timeout-flash-522">
            <circle cx="252" cy="207" r="6" fill="#F59E0B"/>
            <circle cx="272" cy="207" r="6" fill="#F59E0B"/>
            <circle cx="292" cy="207" r="6" fill="#F59E0B"/>
        </g>
        <rect x="239" y="220" width="70" height="14" rx="5" fill="#F59E0B"/>
        <rect x="248" y="225" width="50" height="4" rx="2" fill="white" opacity="0.4"/>

        {{-- Request arrow: client → upstream (animated dashes) --}}
        <line x1="152" y1="180" x2="188" y2="180"
              stroke="#22C55E" stroke-width="2.5" stroke-dasharray="8 4"
              stroke-dashoffset="0">
            <animate attributeName="stroke-dashoffset" from="24" to="0" dur="0.9s" repeatCount="indefinite"/>
        </line>
        <polyline points="182,173 190,180 182,187" fill="none" stroke="#22C55E" stroke-width="2.5" stroke-linecap="round"/>

        {{-- No-response return line (fades in/out — upstream never replies) --}}
        <line x1="228" y1="180" x2="194" y2="180"
              stroke="#F59E0B" stroke-width="2" stroke-dasharray="3 7"
              class="fade-line-522"/>

        {{-- Clock icon in the middle --}}
        <circle cx="190" cy="180" r="16" fill="white" stroke="#E2E8F0" stroke-width="1.5"/>
        <circle cx="190" cy="180" r="11" fill="none" stroke="#F59E0B" stroke-width="2"/>
        {{-- Tick marks at 12, 3, 6, 9 --}}
        <line x1="190" y1="170" x2="190" y2="172" stroke="#F59E0B" stroke-width="1.5" stroke-linecap="round"/>
        <line x1="190" y1="188" x2="190" y2="190" stroke="#F59E0B" stroke-width="1.5" stroke-linecap="round"/>
        <line x1="180" y1="180" x2="182" y2="180" stroke="#F59E0B" stroke-width="1.5" stroke-linecap="round"/>
        <line x1="198" y1="180" x2="200" y2="180" stroke="#F59E0B" stroke-width="1.5" stroke-linecap="round"/>
        {{-- Spinning clock hands --}}
        <g class="spin-hand-522">
            <line x1="190" y1="174" x2="190" y2="180" stroke="#F59E0B" stroke-width="2" stroke-linecap="round"/>
            <line x1="190" y1="180" x2="195" y2="180" stroke="#F59E0B" stroke-width="1.5" stroke-linecap="round"/>
        </g>

        {{-- Labels --}}
        <text x="103" y="260" text-anchor="middle" font-family="Inter, sans-serif" font-size="9" font-weight="600" fill="#1B3A6B" opacity="0.6">CLIENT</text>
        <text x="277" y="260" text-anchor="middle" font-family="Inter, sans-serif" font-size="9" font-weight="600" fill="#F59E0B" opacity="0.9">UPSTREAM</text>

        {{-- Timeout label below clock --}}
        <text x="190" y="205" text-anchor="middle" font-family="Inter, sans-serif" font-size="8" fill="#F59E0B" opacity="0.85" class="timeout-flash-522">TIMEOUT</text>
    </g>

    {{-- Decorative sparkles --}}
    <g class="sp-a-522" transform="translate(78,78)">
        <line x1="0" y1="-9" x2="0" y2="9" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-9" y1="0" x2="9" y2="0" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-5.5" y1="-5.5" x2="5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
        <line x1="5.5" y1="-5.5" x2="-5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <g class="sp-b-522" transform="translate(52,294)">
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