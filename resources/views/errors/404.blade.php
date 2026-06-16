@extends('errors.layout')

@section('code', '404')
@section('title', 'Halaman Tidak Ditemukan')

@section('message_title')
    Maaf, halaman<br>yang Anda cari<br>tidak tersedia.
@endsection

@section('message_desc')
    URL yang Anda tuju tidak terdaftar dalam sistem, sudah dipindahkan, atau mungkin telah dihapus. Periksa kembali alamat yang dimasukkan.
@endsection

@section('illustration')
<svg viewBox="0 0 380 360" xmlns="http://www.w3.org/2000/svg" width="100%" aria-hidden="true">
    <defs>
        <clipPath id="lensClip">
            <circle cx="175" cy="162" r="86"/>
        </clipPath>
        <radialGradient id="lensGrad" cx="40%" cy="35%" r="65%">
            <stop offset="0%" stop-color="#EEF2FA"/>
            <stop offset="100%" stop-color="#DDE6F5"/>
        </radialGradient>
        <linearGradient id="handleGrad" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#1B3A6B"/>
            <stop offset="100%" stop-color="#0F2245"/>
        </linearGradient>
        <linearGradient id="rimGrad" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#2A5298"/>
            <stop offset="100%" stop-color="#1B3A6B"/>
        </linearGradient>
        <filter id="glassShadow" x="-15%" y="-15%" width="130%" height="130%">
            <feDropShadow dx="2" dy="8" stdDeviation="12" flood-color="#0F2245" flood-opacity="0.18"/>
        </filter>
        <style>
            .float-doc-1{animation:floatA 5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .float-doc-2{animation:floatB 6.5s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .float-doc-3{animation:floatC 4.8s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .glass-group{animation:glassRock 6s ease-in-out infinite;transform-origin:center}
            .sparkle-a{animation:sparklePop 2.4s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            .sparkle-b{animation:sparklePop 3.1s ease-in-out infinite 0.7s;transform-box:fill-box;transform-origin:center}
            .qmark{animation:qPulse 3s ease-in-out infinite;transform-box:fill-box;transform-origin:center}
            @keyframes floatA{0%,100%{transform:translateY(0) rotate(15deg)}50%{transform:translateY(-10px) rotate(12deg)}}
            @keyframes floatB{0%,100%{transform:translateY(0) rotate(-12deg)}50%{transform:translateY(-14px) rotate(-9deg)}}
            @keyframes floatC{0%,100%{transform:translateY(0) rotate(8deg)}50%{transform:translateY(-8px) rotate(11deg)}}
            @keyframes glassRock{0%,100%{transform:rotate(-2deg) translateY(0)}50%{transform:rotate(2deg) translateY(-6px)}}
            @keyframes sparklePop{0%,100%{opacity:0.5;transform:scale(1)}50%{opacity:1;transform:scale(1.3)}}
            @keyframes qPulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:0.75;transform:scale(0.92)}}
        </style>
    </defs>

    <!-- Floating document 1 (top-right) -->
    <g class="float-doc-1" transform="translate(290, 40) rotate(15)">
        <g filter="url(#glassShadow)">
            <rect width="50" height="62" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M38,0 L50,12 L38,12 Z" fill="#EEF2FA"/>
            <line x1="38" y1="0" x2="38" y2="12" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="38" y1="12" x2="50" y2="12" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="8" y="20" width="30" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="8" y="30" width="23" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="8" y="39" width="27" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="8" y="48" width="19" height="3.5" rx="1.8" fill="#EEF2F9"/>
    </g>

    <!-- Floating document 2 (left side) -->
    <g class="float-doc-2" transform="translate(18, 105) rotate(-12)">
        <g filter="url(#glassShadow)">
            <rect width="44" height="54" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M33,0 L44,11 L33,11 Z" fill="#EEF2FA"/>
            <line x1="33" y1="0" x2="33" y2="11" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="33" y1="11" x2="44" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="7" y="18" width="26" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="20" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="7" y="35" width="24" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="7" y="43" width="16" height="3.5" rx="1.8" fill="#EEF2F9"/>
    </g>

    <!-- Floating document 3 (bottom-right) -->
    <g class="float-doc-3" transform="translate(302, 270) rotate(8)">
        <g filter="url(#glassShadow)">
            <rect width="42" height="52" rx="5" fill="white" stroke="#CBD5E1" stroke-width="1.2"/>
            <path d="M31,0 L42,11 L31,11 Z" fill="#EEF2FA"/>
            <line x1="31" y1="0" x2="31" y2="11" stroke="#CBD5E1" stroke-width="1"/>
            <line x1="31" y1="11" x2="42" y2="11" stroke="#CBD5E1" stroke-width="1"/>
        </g>
        <rect x="7" y="18" width="22" height="4" rx="2" fill="#CBD5E1"/>
        <rect x="7" y="27" width="17" height="3.5" rx="1.8" fill="#E2E8F0"/>
        <rect x="7" y="35" width="21" height="3.5" rx="1.8" fill="#E2E8F0"/>
    </g>

    <!-- Magnifying glass -->
    <g class="glass-group" filter="url(#glassShadow)">
        <circle cx="175" cy="162" r="86" fill="url(#lensGrad)"/>
        <g clip-path="url(#lensClip)">
            <rect x="128" y="104" width="94" height="116" rx="7" fill="white" stroke="#E2E8F0" stroke-width="1.5"/>
            <rect x="128" y="104" width="94" height="8" rx="7" fill="#1B3A6B"/>
            <rect x="128" y="108" width="94" height="4" fill="#1B3A6B"/>
            <rect x="140" y="124" width="40" height="5" rx="2.5" fill="#CBD5E1"/>
            <rect x="140" y="136" width="66" height="4" rx="2" fill="#E2E8F0"/>
            <rect x="140" y="146" width="54" height="4" rx="2" fill="#E2E8F0"/>
            <rect x="140" y="156" width="60" height="4" rx="2" fill="#EEF2F9"/>
            <line x1="140" y1="168" x2="210" y2="168" stroke="#E2E8F0" stroke-width="1" stroke-dasharray="4 3"/>
            <text class="qmark" x="175" y="208"
                text-anchor="middle"
                font-family="'Plus Jakarta Sans', sans-serif"
                font-size="42"
                font-weight="800"
                fill="#F59E0B">?</text>
        </g>
        <circle cx="175" cy="162" r="86" fill="none" stroke="url(#rimGrad)" stroke-width="7"/>
        <circle cx="175" cy="162" r="86" fill="none" stroke="white" stroke-width="2"
            stroke-dasharray="36 600" stroke-dashoffset="-18" opacity="0.4"/>
    </g>

    <!-- Handle -->
    <line x1="246" y1="233" x2="302" y2="289" stroke="url(#handleGrad)" stroke-width="18" stroke-linecap="round"/>
    <line x1="248" y1="237" x2="298" y2="287" stroke="white" stroke-width="3" stroke-linecap="round" opacity="0.18"/>

    <!-- Sparkles -->
    <g class="sparkle-a" transform="translate(76, 76)">
        <line x1="0" y1="-9" x2="0" y2="9" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-9" y1="0" x2="9" y2="0" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round"/>
        <line x1="-5.5" y1="-5.5" x2="5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
        <line x1="5.5" y1="-5.5" x2="-5.5" y2="5.5" stroke="#F59E0B" stroke-width="1.2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <g class="sparkle-b" transform="translate(52, 290)">
        <line x1="0" y1="-6" x2="0" y2="6" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
        <line x1="-6" y1="0" x2="6" y2="0" stroke="#1B3A6B" stroke-width="2" stroke-linecap="round" opacity="0.5"/>
    </g>
    <circle cx="330" cy="90" r="4.5" fill="#F59E0B" opacity="0.55"/>
    <circle cx="338" cy="180" r="3" fill="#1B3A6B" opacity="0.2"/>
    <circle cx="30" cy="65" r="3.5" fill="#1B3A6B" opacity="0.18"/>
    <circle cx="44" cy="240" r="5" fill="#F59E0B" opacity="0.35"/>
    <circle cx="350" cy="310" r="3" fill="#94A3B8" opacity="0.4"/>
    <circle cx="175" cy="162" r="120" fill="none" stroke="#1B3A6B" stroke-width="1" stroke-dasharray="6 14" opacity="0.07"/>
</svg>
@endsection
