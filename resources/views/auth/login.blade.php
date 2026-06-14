<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Masuk – SIM IKU Universitas Sriwijaya</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <style>
    /* Token warna mengikuti tema sidebar pada layouts/app.blade.php
       (Navy/Biru UNSRI + aksen Emas + Indigo) agar konsisten. */
    :root {
      --sb-bg-1:   #05172e;
      --sb-bg-2:   #091f45;
      --sb-bg-3:   #03101f;
      --gold:      #f5b301;
      --indigo:    #4f46e5;
      --indigo-dk: #3730a3;
      --text:      #101828;
      --sub:       #344054;
      --muted:     #667085;
      --border:    #d0d5dd;
      --surface:   #ffffff;
      --danger:    #d92d20;
      --danger-bg: #fef3f2;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; }

    body {
      font-family: 'Inter', system-ui, sans-serif;
      background: linear-gradient(135deg, var(--sb-bg-1) 0%, var(--sb-bg-2) 55%, var(--sb-bg-3) 100%);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
    }

    /* Aksen dekoratif lembut (lingkaran emas/indigo) */
    .bg-orb {
      position: fixed;
      border-radius: 50%;
      filter: blur(80px);
      opacity: .25;
      pointer-events: none;
    }
    .bg-orb.gold   { width: 360px; height: 360px; background: var(--gold);   top: -90px;  right: -60px; }
    .bg-orb.indigo { width: 420px; height: 420px; background: var(--indigo); bottom: -120px; left: -80px; }

    .login-card {
      position: relative;
      width: 100%;
      max-width: 420px;
      background: var(--surface);
      border-radius: 18px;
      box-shadow: 0 24px 60px rgba(0,0,0,.35);
      padding: 40px 34px 32px;
      z-index: 1;
    }

    .login-brand {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      margin-bottom: 28px;
    }
    .login-brand img {
      width: 76px;
      height: 76px;
      object-fit: contain;
      margin-bottom: 14px;
    }
    .login-brand h1 {
      font-size: 22px;
      font-weight: 800;
      letter-spacing: -.02em;
      color: var(--sb-bg-2);
    }
    .login-brand p {
      font-size: 13px;
      color: var(--muted);
      margin-top: 4px;
    }

    .form-group { margin-bottom: 18px; }
    .form-group label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: var(--sub);
      margin-bottom: 7px;
    }
    .form-group input[type="email"],
    .form-group input[type="password"] {
      width: 100%;
      height: 46px;
      padding: 0 14px;
      font-size: 15px;
      font-family: inherit;
      color: var(--text);
      background: #fff;
      border: 1.5px solid var(--border);
      border-radius: 10px;
      transition: border-color .15s, box-shadow .15s;
    }
    .form-group input:focus {
      outline: none;
      border-color: var(--indigo);
      box-shadow: 0 0 0 4px rgba(79,70,229,.12);
    }

    .form-remember {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 22px;
      font-size: 13px;
      color: var(--sub);
    }
    .form-remember input { width: 16px; height: 16px; accent-color: var(--indigo); }

    .btn-login {
      width: 100%;
      height: 48px;
      font-size: 15px;
      font-weight: 700;
      font-family: inherit;
      color: #fff;
      background: linear-gradient(135deg, var(--indigo), var(--indigo-dk));
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: transform .08s, box-shadow .15s, opacity .15s;
      box-shadow: 0 8px 20px rgba(79,70,229,.28);
    }
    .btn-login:hover  { box-shadow: 0 10px 26px rgba(79,70,229,.36); }
    .btn-login:active { transform: translateY(1px); }

    .alert-error {
      background: var(--danger-bg);
      border: 1px solid #fecdca;
      color: var(--danger);
      font-size: 13px;
      font-weight: 500;
      padding: 11px 14px;
      border-radius: 10px;
      margin-bottom: 20px;
      line-height: 1.4;
    }

    .login-foot {
      text-align: center;
      font-size: 12px;
      color: var(--muted);
      margin-top: 24px;
      line-height: 1.5;
    }

    @media (max-width: 480px) {
      .login-card { padding: 32px 22px 26px; }
      .login-brand img { width: 64px; height: 64px; }
    }
  </style>
</head>
<body>

  <div class="bg-orb gold"></div>
  <div class="bg-orb indigo"></div>

  <div class="login-card">
    <div class="login-brand">
      <img src="{{ asset('images/logo-unsri.png') }}" alt="Logo Universitas Sriwijaya" />
      <h1>SIM IKU</h1>
      <p>Sistem Informasi Manajemen Indikator Kinerja Utama</p>
    </div>

    {{-- Tampilkan error autentikasi/validasi --}}
    @if ($errors->any())
      <div class="alert-error">
        {{ $errors->first() }}
      </div>
    @endif

    <form method="POST" action="{{ route('login.attempt') }}">
      @csrf

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email"
               value="{{ old('email') }}"
               placeholder="admin@unsri.ac.id"
               autocomplete="username" autofocus required />
      </div>

      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password"
               placeholder="Masukkan kata sandi"
               autocomplete="current-password" required />
      </div>

      <label class="form-remember">
        <input type="checkbox" name="remember" value="1" />
        Ingat saya di perangkat ini
      </label>

      <button type="submit" class="btn-login">Masuk</button>
    </form>

    <p class="login-foot">
      &copy; {{ date('Y') }} Universitas Sriwijaya<br>
      Akses terbatas — akun ditambahkan oleh administrator.
    </p>
  </div>

</body>
</html>