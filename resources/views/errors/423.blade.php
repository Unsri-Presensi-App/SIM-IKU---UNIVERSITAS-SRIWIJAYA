@extends('errors.layout')

@section('code', '423')
@section('title', 'Sumber Daya Terkunci')

@section('message_title')
    Sumber daya ini<br>sedang terkunci.
@endsection

@section('message_desc')
    Halaman atau data yang Anda coba akses sedang dikunci oleh pengguna atau proses lain. Silakan coba beberapa saat lagi atau hubungi administrator.
@endsection

@section('illustration')
<svg viewBox="0 0 380 360" xmlns="http://www.w3.org/2000/svg" width="100%" aria-hidden="true">
    <defs>
        <linearGradient id="grad423" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#EEF2FA"/>
            <stop offset="100%" stop-color="#DDE6F5"/>
        </linearGradient>
        <linearGradient id="rim423" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#2A5298"/>
            <stop offset="100%" stop-color="#1B3A6B"/>
        </linearGradient>
        <filter id="shadow423">
            <feDropShadow dx="2" dy="8" stdDeviation="12" flood-color="#0F2245" flood-opacity="0.18"/>
        </filter>
        <filter id="doc423">
            <feDropShadow dx="0" dy="2" stdDeviation="3" flood-color="#1B3A6B" flood-opacity="0.1"/>
        </filter>
        <style>
            .f1-423{animation:fA423 5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .f2-423{animation:fB423 6.5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .f3-423{animation:fC423 4.8s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .main-423{animation:rock423 6s ease-in-out infinite;transform-origin:center}
            .sp-a-423{animation:spop423 2.4s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .sp-b-423{animation:spop423 3.1s ease-in-out infinite 0.7s;transform-box:fill-box;transform-origin:center}
            .chain-423{animation:chainPulse 2s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            @keyframes fA423{0%,100%{transform:translateY(0) rotate(15deg)}50%{transform:translateY(-10px) rotate(12deg)}}
            @keyframes fB423{0%,100%{transform:translateY(0) rotate(-12deg)}50%{transform:translateY(-14px) rotate(-9deg)}}
            @keyframes fC423{0%,100%{transform:translateY(0) rotate(8deg)}50%{transform:translateY(-8px) rotate(11deg)}}
            @keyframes rock423{0%,100%{transform:rotate(-1.5deg) translateY(0)}50%{transform:rotate(1.5deg) translateY(-6px)}}
            @keyframes spop423{0%,100%{opacity:.5;transform:scale(1)}50%{opacity:1;transform:scale(1.3)}}
            @keyframes chainPulse{0%,100%{opacity:1}50%{opacity:0.55}}
        </style>
    </defs>

    <!-- Floating docs -->
    <g class="f1-423" transform="translate(295,42) rotate(15)">
        <g filter="url(#doc423)">
            <rect width="50" height="62" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M38,0 L50,12 L38,12 Z" fill="#EEF2FA"/>
            <line x1="38" y1="0" x2="38" y2="12" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="38" y1="12" x2="50" y2="12" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="8" y="20" width="30" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="8" y="30" width="23" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="8" y="39" width="27" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>
    <g class="f2-423" transform="translate(18,108) rotate(-12)">
        <g filter="url(#doc423)">
            <rect width="44" height="54" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M33,0 L44,11 L33,11 Z" fill="#EEF2FA"/>
            <line x1="33" y1="0" x2="33" y2="11" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="33" y1="11" x2="44" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="7" y="18" width="26" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="20" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="7" y="35" width="24" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>
    <g class="f3-423" transform="translate(308,275) rotate(8)">
        <g filter="url(#doc423)">
            <rect width="42" height="52" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M31,0 L42,11 L31,11 Z" fill="#EEF2FA"/>
            <line x1="31" y1="0" x2="31" y2="11" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="31" y1="11" x2="42" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="7" y="18" width="22" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="17" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>

    <!-- Main: chain-wrapped document -->
    <g class="main-423" filter="url(#shadow423)">
        <!-- Document -->
        <rect x="115" y="80" width="150" height="200" rx="12" fill="url(#grad423)"/>
        <rect x="115" y="80" width="150" height="200" rx="12" fill="none" stroke="url(#rim423)" stroke-width="5"/>
        <rect x="128" y="84" width="60" height="3" rx="1.5" fill="white" opacity="0.3"/>
        <!-- Navy header bar -->
        <rect x="115" y="80" width="150" height="16" rx="12" fill="#1B3A6B"/>
        <rect x="115" y="88" width="150" height="8" fill="#1B3A6B"/>
        <!-- Doc lines -->
        <rect x="132" y="112" width="80" height="5" rx="2.5" fill="#CBD5E1"/>
        <rect x="132" y="124" width="96" height="4" rx="2" fill="#E2E8F0"/>
        <rect x="132" y="134" width="76" height="4" rx="2" fill="#E2E8F0"/>
        <rect x="132" y="144" width="88" height="4" rx="2" fill="#E2E8F0"/>
        <line x1="132" y1="156" x2="228" y2="156" stroke="#E2E8F0" stroke-width="1" stroke-dasharray="4 3"/>

        <!-- Chain links horizontal top -->
        <g class="chain-423">
            <rect x="108" y="165" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
            <rect x="126" y="165" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
            <rect x="144" y="165" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
            <rect x="162" y="165" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
            <rect x="180" y="165" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
            <rect x="198" y="165" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
            <rect x="216" y="165" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
            <rect x="234" y="165" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
        </g>

        <!-- Mini padlock center -->
        <rect x="168" y="196" width="44" height="40" rx="8" fill="#1B3A6B"/>
        <path d="M180 196 L180 182 Q180 168 190 168 Q200 168 200 182 L200 196"
              fill="none" stroke="#1B3A6B" stroke-width="7" stroke-linecap="round"/>
        <circle cx="190" cy="212" r="7" fill="white" opacity="0.9"/>
        <rect x="187" y="212" width="6" height="9" rx="3" fill="white" opacity="0.9"/>

        <!-- Chain links horizontal bottom -->
        <g class="chain-423">
            <rect x="108" y="242" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
            <rect x="126" y="242" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
            <rect x="144" y="242" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
            <rect x="162" y="242" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
            <rect x="180" y="242" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
            <rect x="198" y="242" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
            <rect x="216" y="242" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
            <rect x="234" y="242" width="24" height="14" rx="7" fill="none" stroke="#1B3A6B" stroke-width="4"/>
        </g>
    </g>

    <!-- Sparkles & dots -->
    <g class="sp-a-423" transform="translate(78,78)">
        <line x1="0" y1="-9" x2="0" y2="9" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-9" y1="0" x2="9" y2="0" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-5.5" y1="-5.5" x2="5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
        <line x1="5.5" y1="-5.5" x2="-5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <g class="sp-b-423" transform="translate(52,294)">
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