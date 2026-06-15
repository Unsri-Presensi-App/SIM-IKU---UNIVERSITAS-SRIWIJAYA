@extends('errors.layout')

@section('code', '504')
@section('title', 'Gateway Timeout')

@section('message_title')
    Gateway tidak<br>merespons.
@endsection

@section('message_desc')
    Server gateway tidak menerima respons tepat waktu dari server upstream. Ini biasanya bersifat sementara dan disebabkan oleh beban server yang tinggi. Silakan coba muat ulang halaman beberapa saat lagi.
@endsection

@section('illustration')
<svg viewBox="0 0 380 360" xmlns="http://www.w3.org/2000/svg" width="100%" aria-hidden="true">
    <defs>
        <linearGradient id="grad504" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#FFF7ED"/>
            <stop offset="100%" stop-color="#FFEDD5"/>
        </linearGradient>
        <linearGradient id="grad504b" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#EEF2FA"/>
            <stop offset="100%" stop-color="#DDE6F5"/>
        </linearGradient>
        <style>
            .f1-504{animation:fA504 5.2s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .f2-504{animation:fB504 6.8s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .f3-504{animation:fC504 4.5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .main-504{animation:rock504 6s ease-in-out infinite;transform-origin:center}
            .sp-a-504{animation:spop504 2.2s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .sp-b-504{animation:spop504 3.4s ease-in-out infinite 0.9s;transform-box:fill-box;transform-origin:center}
            .flash-504{animation:flash504 1.6s ease-in-out infinite}
            .spin-504{animation:spin504 3s linear infinite;transform-origin:190px 180px}
            .pulse-ring-504{animation:pulseRing504 2s ease-out infinite}
            .slide-req-504{animation:slideReq504 2s linear infinite}
            .blocked-504{animation:blocked504 2s ease-in-out infinite}

            @keyframes fA504{0%,100%{transform:translateY(0) rotate(15deg)}50%{transform:translateY(-10px) rotate(12deg)}}
            @keyframes fB504{0%,100%{transform:translateY(0) rotate(-12deg)}50%{transform:translateY(-14px) rotate(-9deg)}}
            @keyframes fC504{0%,100%{transform:translateY(0) rotate(8deg)}50%{transform:translateY(-8px) rotate(11deg)}}
            @keyframes rock504{0%,100%{transform:rotate(-1.5deg) translateY(0)}50%{transform:rotate(1.5deg) translateY(-6px)}}
            @keyframes spop504{0%,100%{opacity:.4;transform:scale(1)}50%{opacity:1;transform:scale(1.3)}}
            @keyframes flash504{0%,100%{opacity:1}50%{opacity:0.25}}
            @keyframes spin504{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}
            @keyframes pulseRing504{0%{r:18;opacity:0.6}100%{r:32;opacity:0}}
            @keyframes slideReq504{0%{stroke-dashoffset:40}100%{stroke-dashoffset:0}}
            @keyframes blocked504{0%,100%{transform:translateX(0)}25%{transform:translateX(3px)}75%{transform:translateX(-3px)}}
        </style>
    </defs>

    {{-- Floating document decorations --}}
    <g class="f1-504" transform="translate(295,42) rotate(15)">
        <rect width="50" height="62" rx="5" fill="white" stroke="#FED7AA" stroke-width="1.2"/>
        <path d="M38,0 L50,12 L38,12 Z" fill="#FFF7ED"/>
        <line x1="38" y1="0" x2="38" y2="12" stroke="#FED7AA" stroke-width="1"/>
        <line x1="38" y1="12" x2="50" y2="12" stroke="#FED7AA" stroke-width="1"/>
        <rect x="8" y="20" width="30" height="4" rx="2" fill="#FED7AA"/>
        <rect x="8" y="30" width="23" height="3.5" rx="1.8" fill="#FFEDD5"/>
        <rect x="8" y="39" width="27" height="3.5" rx="1.8" fill="#FFEDD5"/>
    </g>
    <g class="f2-504" transform="translate(18,108) rotate(-12)">
        <rect width="44" height="54" rx="5" fill="white" stroke="#FED7AA" stroke-width="1.2"/>
        <path d="M33,0 L44,11 L33,11 Z" fill="#FFF7ED"/>
        <line x1="33" y1="0" x2="33" y2="11" stroke="#FED7AA" stroke-width="1"/>
        <line x1="33" y1="11" x2="44" y2="11" stroke="#FED7AA" stroke-width="1"/>
        <rect x="7" y="18" width="26" height="4" rx="2" fill="#FED7AA"/>
        <rect x="7" y="27" width="20" height="3.5" rx="1.8" fill="#FFEDD5"/>
        <rect x="7" y="35" width="24" height="3.5" rx="1.8" fill="#FFEDD5"/>
    </g>
    <g class="f3-504" transform="translate(308,275) rotate(8)">
        <rect width="42" height="52" rx="5" fill="white" stroke="#FED7AA" stroke-width="1.2"/>
        <path d="M31,0 L42,11 L31,11 Z" fill="#FFF7ED"/>
        <line x1="31" y1="0" x2="31" y2="11" stroke="#FED7AA" stroke-width="1"/>
        <line x1="31" y1="11" x2="42" y2="11" stroke="#FED7AA" stroke-width="1"/>
        <rect x="7" y="18" width="22" height="4" rx="2" fill="#FED7AA"/>
        <rect x="7" y="27" width="17" height="3.5" rx="1.8" fill="#FFEDD5"/>
    </g>

    {{-- Main group --}}
    <g class="main-504">

        {{-- CLIENT card --}}
        <rect x="30" y="115" width="90" height="130" rx="10" fill="url(#grad504b)"/>
        <rect x="30" y="115" width="90" height="130" rx="10" fill="none" stroke="#2A5298" stroke-width="3.5"/>
        <rect x="30" y="115" width="90" height="13" rx="10" fill="#1B3A6B"/>
        <rect x="30" y="122" width="90" height="6" fill="#1B3A6B"/>
        <rect x="40" y="140" width="52" height="5" rx="2.5" fill="#CBD5E1"/>
        <rect x="40" y="152" width="64" height="4" rx="2" fill="#E2E8F0"/>
        <rect x="40" y="162" width="44" height="4" rx="2" fill="#E2E8F0"/>
        <rect x="40" y="172" width="58" height="4" rx="2" fill="#E2E8F0"/>
        <circle cx="53"  cy="207" r="5" fill="#22C55E"/>
        <circle cx="70"  cy="207" r="5" fill="#22C55E"/>
        <circle cx="87"  cy="207" r="5" fill="#22C55E"/>
        <rect x="40" y="220" width="64" height="14" rx="5" fill="#1B3A6B"/>
        <rect x="48" y="225" width="46" height="4" rx="2" fill="white" opacity="0.5"/>

        {{-- GATEWAY card (center) --}}
        <rect x="145" y="105" width="90" height="150" rx="10" fill="url(#grad504b)"/>
        <rect x="145" y="105" width="90" height="150" rx="10" fill="none" stroke="#EA580C" stroke-width="3.5"/>
        <rect x="145" y="105" width="90" height="13" rx="10" fill="#EA580C"/>
        <rect x="145" y="112" width="90" height="6" fill="#EA580C"/>
        <rect x="155" y="132" width="52" height="5" rx="2.5" fill="#FED7AA"/>
        <rect x="155" y="144" width="64" height="4" rx="2" fill="#FFEDD5" opacity="0.8"/>
        <rect x="155" y="154" width="44" height="4" rx="2" fill="#FFEDD5" opacity="0.7"/>
        <rect x="155" y="164" width="58" height="4" rx="2" fill="#FFEDD5" opacity="0.6"/>
        {{-- Pulsing warning dots --}}
        <g class="flash-504">
            <circle cx="160" cy="197" r="5" fill="#EA580C"/>
            <circle cx="177" cy="197" r="5" fill="#EA580C"/>
            <circle cx="194" cy="197" r="5" fill="#EA580C"/>
        </g>
        <rect x="155" y="212" width="64" height="14" rx="5" fill="#EA580C"/>
        <rect x="163" y="217" width="46" height="4" rx="2" fill="white" opacity="0.4"/>
        {{-- Pulsing ring on gateway --}}
        <circle cx="190" cy="197" r="18" fill="none" stroke="#EA580C" stroke-width="1.5" class="pulse-ring-504" opacity="0.5"/>

        {{-- UPSTREAM card --}}
        <rect x="260" y="115" width="90" height="130" rx="10" fill="url(#grad504)"/>
        <rect x="260" y="115" width="90" height="130" rx="10" fill="none" stroke="#F59E0B" stroke-width="3.5"/>
        <rect x="260" y="115" width="90" height="13" rx="10" fill="#F59E0B"/>
        <rect x="260" y="122" width="90" height="6" fill="#F59E0B"/>
        <rect x="270" y="140" width="52" height="5" rx="2.5" fill="#FDE68A"/>
        <rect x="270" y="152" width="64" height="4" rx="2" fill="#FDE68A" opacity="0.6"/>
        <rect x="270" y="162" width="44" height="4" rx="2" fill="#FDE68A" opacity="0.5"/>
        <rect x="270" y="172" width="58" height="4" rx="2" fill="#FDE68A" opacity="0.4"/>
        <g class="flash-504">
            <circle cx="278" cy="207" r="5" fill="#F59E0B"/>
            <circle cx="295" cy="207" r="5" fill="#F59E0B"/>
            <circle cx="312" cy="207" r="5" fill="#F59E0B"/>
        </g>
        <rect x="270" y="220" width="64" height="14" rx="5" fill="#F59E0B"/>
        <rect x="278" y="225" width="46" height="4" rx="2" fill="white" opacity="0.4"/>

        {{-- Arrow: client → gateway (flowing) --}}
        <line x1="121" y1="180" x2="143" y2="180"
              stroke="#22C55E" stroke-width="2.5" stroke-dasharray="7 4">
            <animate attributeName="stroke-dashoffset" from="22" to="0" dur="0.8s" repeatCount="indefinite"/>
        </line>
        <polyline points="137,174 145,180 137,187" fill="none" stroke="#22C55E" stroke-width="2.5" stroke-linecap="round"/>

        {{-- Arrow: gateway → upstream (stalled / dashed fade) --}}
        <line x1="236" y1="180" x2="258" y2="180"
              stroke="#F59E0B" stroke-width="2" stroke-dasharray="4 6"
              opacity="0.45">
            <animate attributeName="opacity" values="0.2;0.55;0.2" dur="2s" repeatCount="indefinite"/>
        </line>
        <polyline points="252,174 260,180 252,187" fill="none" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>

        {{-- Spinning hourglass icon on gateway --}}
        <g class="spin-504">
            <path d="M183,171 Q190,178 197,171 L197,169 Q190,162 183,169 Z" fill="#EA580C" opacity="0.85"/>
            <path d="M183,189 Q190,182 197,189 L197,191 Q190,198 183,191 Z" fill="#EA580C" opacity="0.85"/>
            <line x1="183" y1="169" x2="183" y2="191" stroke="#EA580C" stroke-width="1.5" stroke-linecap="round"/>
            <line x1="197" y1="169" x2="197" y2="191" stroke="#EA580C" stroke-width="1.5" stroke-linecap="round"/>
        </g>

        {{-- Labels --}}
        <text x="75"  y="258" text-anchor="middle" font-family="Inter, sans-serif" font-size="8.5" font-weight="600" fill="#1B3A6B" opacity="0.6">CLIENT</text>
        <text x="190" y="268" text-anchor="middle" font-family="Inter, sans-serif" font-size="8.5" font-weight="600" fill="#EA580C" opacity="0.9">GATEWAY</text>
        <text x="305" y="258" text-anchor="middle" font-family="Inter, sans-serif" font-size="8.5" font-weight="600" fill="#F59E0B" opacity="0.9">UPSTREAM</text>
    </g>

    {{-- Decorative sparkles --}}
    <g class="sp-a-504" transform="translate(78,78)">
        <line x1="0" y1="-9" x2="0" y2="9" stroke="#EA580C" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-9" y1="0" x2="9" y2="0" stroke="#EA580C" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-5.5" y1="-5.5" x2="5.5" y2="5.5" stroke="#EA580C" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
        <line x1="5.5" y1="-5.5" x2="-5.5" y2="5.5" stroke="#EA580C" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <g class="sp-b-504" transform="translate(52,294)">
        <line x1="0" y1="-6" x2="0" y2="6" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
        <line x1="-6" y1="0" x2="6" y2="0" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <circle cx="330" cy="90"  r="4.5" fill="#EA580C" opacity="0.45"/>
    <circle cx="44"  cy="245" r="5"   fill="#EA580C" opacity="0.3"/>
    <circle cx="352" cy="312" r="3"   fill="#94A3B8" opacity="0.4"/>
    <circle cx="30"  cy="65"  r="3.5" fill="#1B3A6B" opacity="0.18"/>
    <circle cx="190" cy="180" r="130" fill="none" stroke="#EA580C" stroke-width="1" stroke-dasharray="6 14" opacity="0.06"/>
</svg>
@endsection