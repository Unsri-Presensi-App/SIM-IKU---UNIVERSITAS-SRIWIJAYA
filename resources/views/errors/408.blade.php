@extends('errors.layout')

@section('code', '408')
@section('title', 'Permintaan Habis Waktu')

@section('message_title')
    Permintaan Anda<br>terlalu lama.
@endsection

@section('message_desc')
    Server tidak menerima permintaan lengkap dalam batas waktu yang ditentukan. Koneksi Anda mungkin lambat atau terputus di tengah jalan. Silakan periksa koneksi internet Anda dan coba lagi.
@endsection

@section('illustration')
<svg viewBox="0 0 380 360" xmlns="http://www.w3.org/2000/svg" width="100%" aria-hidden="true">
    <defs>
        <linearGradient id="grad408" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#EEF2FA"/>
            <stop offset="100%" stop-color="#DDE6F5"/>
        </linearGradient>
        <linearGradient id="grad408s" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#F0FDF4"/>
            <stop offset="100%" stop-color="#DCFCE7"/>
        </linearGradient>
        <style>
            .f1-408{animation:fA408 5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .f2-408{animation:fB408 6.5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .f3-408{animation:fC408 4.8s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .main-408{animation:rock408 6s ease-in-out infinite;transform-origin:center}
            .sp-a-408{animation:spop408 2.4s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .sp-b-408{animation:spop408 3.1s ease-in-out infinite 0.7s;transform-box:fill-box;transform-origin:center}
            .flash-408{animation:flash408 1.4s ease-in-out infinite}
            .hourglass-408{animation:hourglassDrip 2s ease-in-out infinite;transform-origin:190px 180px}
            .sand-408{animation:sandFill 2s ease-in-out infinite}
            .packet-408{animation:packetSlide 3s linear infinite}
            .packet-408b{animation:packetSlide 3s linear infinite 1.5s}
            .stall-408{animation:stallPulse 1.8s ease-in-out infinite}
            .countdown-408{animation:countFlash 1s steps(1) infinite}

            @keyframes fA408{0%,100%{transform:translateY(0) rotate(15deg)}50%{transform:translateY(-10px) rotate(12deg)}}
            @keyframes fB408{0%,100%{transform:translateY(0) rotate(-12deg)}50%{transform:translateY(-14px) rotate(-9deg)}}
            @keyframes fC408{0%,100%{transform:translateY(0) rotate(8deg)}50%{transform:translateY(-8px) rotate(11deg)}}
            @keyframes rock408{0%,100%{transform:rotate(-1.5deg) translateY(0)}50%{transform:rotate(1.5deg) translateY(-6px)}}
            @keyframes spop408{0%,100%{opacity:.4;transform:scale(1)}50%{opacity:1;transform:scale(1.3)}}
            @keyframes flash408{0%,100%{opacity:0.9}50%{opacity:0.2}}
            @keyframes hourglassDrip{0%,100%{transform:rotate(0deg)}48%{transform:rotate(0deg)}50%{transform:rotate(180deg)}98%{transform:rotate(180deg)}100%{transform:rotate(360deg)}}
            @keyframes sandFill{0%{height:12;y:171}50%{height:0;y:183}51%{height:0;y:171}100%{height:12;y:171}}
            @keyframes packetSlide{0%{transform:translateX(0);opacity:0}10%{opacity:1}60%{transform:translateX(52px);opacity:1}70%{transform:translateX(52px);opacity:0}100%{transform:translateX(52px);opacity:0}}
            @keyframes stallPulse{0%,100%{opacity:0.6;transform:scaleX(1)}50%{opacity:1;transform:scaleX(1.04)}}
            @keyframes countFlash{0%{opacity:1}50%{opacity:0}}
        </style>
    </defs>

    {{-- Floating document decorations --}}
    <g class="f1-408" transform="translate(295,42) rotate(15)">
        <rect width="50" height="62" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
        <path d="M38,0 L50,12 L38,12 Z" fill="#EEF2FA"/>
        <line x1="38" y1="0" x2="38" y2="12" stroke="#CBD5E1" stroke-width="1"/>
        <line x1="38" y1="12" x2="50" y2="12" stroke="#CBD5E1" stroke-width="1"/>
        <rect x="8" y="20" width="30" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="8" y="30" width="23" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="8" y="39" width="27" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>
    <g class="f2-408" transform="translate(18,108) rotate(-12)">
        <rect width="44" height="54" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
        <path d="M33,0 L44,11 L33,11 Z" fill="#EEF2FA"/>
        <line x1="33" y1="0" x2="33" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        <line x1="33" y1="11" x2="44" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        <rect x="7" y="18" width="26" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="20" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="7" y="35" width="24" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>
    <g class="f3-408" transform="translate(308,275) rotate(8)">
        <rect width="42" height="52" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
        <path d="M31,0 L42,11 L31,11 Z" fill="#EEF2FA"/>
        <line x1="31" y1="0" x2="31" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        <line x1="31" y1="11" x2="42" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        <rect x="7" y="18" width="22" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="17" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>

    {{-- Main group --}}
    <g class="main-408">

        {{-- CLIENT card --}}
        <rect x="55" y="115" width="96" height="130" rx="10" fill="url(#grad408)"/>
        <rect x="55" y="115" width="96" height="130" rx="10" fill="none" stroke="#2A5298" stroke-width="4"/>
        <rect x="55" y="115" width="96" height="13" rx="10" fill="#1B3A6B"/>
        <rect x="55" y="122" width="96" height="6" fill="#1B3A6B"/>
        <rect x="65" y="140" width="56" height="5" rx="2.5" fill="#CBD5E1"/>
        <rect x="65" y="152" width="70" height="4" rx="2" fill="#E2E8F0"/>
        <rect x="65" y="162" width="48" height="4" rx="2" fill="#E2E8F0"/>
        <rect x="65" y="172" width="64" height="4" rx="2" fill="#E2E8F0"/>

        {{-- Progress bar (stalled packet upload) --}}
        <rect x="65" y="195" width="70" height="8" rx="4" fill="#E2E8F0"/>
        <rect x="65" y="195" width="42" height="8" rx="4" fill="#3B82F6" class="stall-408"/>
        <rect x="65" y="220" width="70" height="14" rx="5" fill="#1B3A6B"/>
        <rect x="74" y="225" width="50" height="4" rx="2" fill="white" opacity="0.5"/>

        {{-- SERVER card --}}
        <rect x="229" y="115" width="96" height="130" rx="10" fill="url(#grad408s)"/>
        <rect x="229" y="115" width="96" height="130" rx="10" fill="none" stroke="#16A34A" stroke-width="4"/>
        <rect x="229" y="115" width="96" height="13" rx="10" fill="#15803D"/>
        <rect x="229" y="122" width="96" height="6" fill="#15803D"/>
        <rect x="239" y="140" width="56" height="5" rx="2.5" fill="#BBF7D0"/>
        <rect x="239" y="152" width="70" height="4" rx="2" fill="#D1FAE5" opacity="0.9"/>
        <rect x="239" y="162" width="48" height="4" rx="2" fill="#D1FAE5" opacity="0.7"/>
        <rect x="239" y="172" width="64" height="4" rx="2" fill="#D1FAE5" opacity="0.5"/>
        <circle cx="252" cy="207" r="5" fill="#22C55E"/>
        <circle cx="272" cy="207" r="5" fill="#22C55E"/>
        <circle cx="292" cy="207" r="5" fill="#22C55E"/>
        <rect x="239" y="220" width="70" height="14" rx="5" fill="#15803D"/>
        <rect x="248" y="225" width="50" height="4" rx="2" fill="white" opacity="0.45"/>

        {{-- Packet 1: sliding from client toward center, stalls --}}
        <g class="packet-408" transform="translate(152,172)">
            <rect width="18" height="10" rx="3" fill="#3B82F6" opacity="0.9"/>
            <rect x="3" y="3" width="12" height="2" rx="1" fill="white" opacity="0.6"/>
        </g>

        {{-- Packet 2: same path, offset --}}
        <g class="packet-408b" transform="translate(152,172)">
            <rect width="18" height="10" rx="3" fill="#3B82F6" opacity="0.7"/>
            <rect x="3" y="3" width="9" height="2" rx="1" fill="white" opacity="0.5"/>
        </g>

        {{-- Connection line (dashed, slow) --}}
        <line x1="152" y1="180" x2="228" y2="180"
              stroke="#3B82F6" stroke-width="1.5" stroke-dasharray="5 5" opacity="0.3"/>

        {{-- Hourglass center --}}
        <g class="hourglass-408">
            {{-- Outer frame --}}
            <rect x="181" y="163" width="18" height="34" rx="3" fill="white" stroke="#E2E8F0" stroke-width="1.5"/>
            {{-- Top sand --}}
            <rect x="184" y="166" width="12" height="12" rx="1" fill="#F59E0B" opacity="0.9"/>
            {{-- Neck --}}
            <rect x="189" y="178" width="2" height="4" rx="1" fill="#F59E0B" opacity="0.7"/>
            {{-- Bottom sand (animated fill) --}}
            <rect class="sand-408" x="184" y="183" width="12" rx="1" fill="#F59E0B" opacity="0.6"/>
            {{-- Frame lines --}}
            <line x1="181" y1="180" x2="199" y2="180" stroke="#E2E8F0" stroke-width="1"/>
        </g>

        {{-- Timeout label --}}
        <text x="190" y="207" text-anchor="middle" font-family="Inter, sans-serif" font-size="7.5" font-weight="700" fill="#DC2626" class="flash-408">408</text>

        {{-- Labels --}}
        <text x="103" y="260" text-anchor="middle" font-family="Inter, sans-serif" font-size="9" font-weight="600" fill="#1B3A6B" opacity="0.6">CLIENT</text>
        <text x="277" y="260" text-anchor="middle" font-family="Inter, sans-serif" font-size="9" font-weight="600" fill="#15803D" opacity="0.8">SERVER</text>

        {{-- "Waiting..." hint --}}
        <text x="190" y="218" text-anchor="middle" font-family="Inter, sans-serif" font-size="7" fill="#94A3B8" opacity="0.8">menunggu...</text>
    </g>

    {{-- Decorative sparkles --}}
    <g class="sp-a-408" transform="translate(78,78)">
        <line x1="0" y1="-9" x2="0" y2="9" stroke="#DC2626" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-9" y1="0" x2="9" y2="0" stroke="#DC2626" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-5.5" y1="-5.5" x2="5.5" y2="5.5" stroke="#DC2626" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
        <line x1="5.5" y1="-5.5" x2="-5.5" y2="5.5" stroke="#DC2626" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <g class="sp-b-408" transform="translate(52,294)">
        <line x1="0" y1="-6" x2="0" y2="6" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
        <line x1="-6" y1="0" x2="6" y2="0" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <circle cx="330" cy="90"  r="4.5" fill="#DC2626" opacity="0.4"/>
    <circle cx="44"  cy="245" r="5"   fill="#DC2626" opacity="0.25"/>
    <circle cx="352" cy="312" r="3"   fill="#94A3B8" opacity="0.4"/>
    <circle cx="30"  cy="65"  r="3.5" fill="#1B3A6B" opacity="0.18"/>
    <circle cx="190" cy="180" r="130" fill="none" stroke="#DC2626" stroke-width="1" stroke-dasharray="6 14" opacity="0.06"/>
</svg>
@endsection