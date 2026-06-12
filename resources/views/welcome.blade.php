<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM IKU - Universitas Sriwijaya</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Latar belakang titik-titik samar agar tidak terlalu kosong */
        .bg-pattern {
            background-color: #f0f4f8;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="bg-pattern min-h-screen flex flex-col justify-center items-center p-4">

    <div class="max-w-lg w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 transform transition-all hover:-translate-y-1 hover:shadow-blue-900/20">
        
        <!-- Bagian Atas (Header & Logo) -->
        <div class="bg-[#082b57] pt-10 pb-8 flex justify-center relative overflow-hidden">
            <!-- Aksen lingkaran pudar di belakang logo -->
            <div class="absolute w-40 h-40 bg-white/10 rounded-full blur-2xl top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
            
            <img src="https://fkm.unsri.ac.id/assets/kcfinder/upload/files/logo-unsri.png" alt="Logo Unsri" class="h-36 drop-shadow-xl relative z-10 hover:scale-105 transition-transform duration-300">
        </div>

        <!-- Bagian Tengah (Teks & Tombol) -->
        <div class="p-10 text-center">
            <div class="inline-block bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full text-xs font-bold tracking-widest mb-4 uppercase border border-blue-100">
                IKU UNIVERITAS SRIWIJAYA
            </div>
            
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2 tracking-tight">SIM IKU UNSRI</h1>
            <p class="text-gray-500 font-medium mb-8 text-sm leading-relaxed">
                Sistem Informasi Manajemen Indikator Kinerja Utama<br>Universitas Sriwijaya
            </p>

            <!-- Tombol Langsung ke Dashboard -->
            <a href="{{ route('dashboard') }}" class="group inline-flex items-center justify-center w-full px-8 py-4 font-bold text-white bg-[#1769e0] hover:bg-[#082b57] rounded-xl transition-all duration-300 shadow-lg shadow-blue-500/30 overflow-hidden">
                <span class="flex items-center gap-2">
                    Akses Dashboard
                    <!-- Ikon Panah -->
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </span>
            </a>
        </div>
        
        <!-- Bagian Bawah (Footer Kartu) -->
        <div class="bg-gray-50 p-4 text-center border-t border-gray-100">
            <span class="text-xs text-gray-400 font-semibold uppercase tracking-wider">
                &copy; {{ date('Y') }} Universitas Sriwijaya
            </span>
        </div>

    </div>

</body>
</html>