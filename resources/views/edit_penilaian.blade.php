<!DOCTYPE html>
<html>
<head>
    <title>Edit Penilaian</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            display: flex;
            background-color: #f4f6f9;
        }

        /* SIDEBAR */
        .sidebar {
            width: 220px;
            height: 100vh;
            background-color: #1f1060;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 50px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover,
        .active {
            background-color: #df7518;
        }

        /* TOPBAR */
        .topbar {
            position: fixed;
            left: 220px;
            top: 0;
            width: calc(97% - 220px);
            height: 70px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .topbar-left img {
            height: 40px;
        }

        .topbar-left h2 {
            margin: 0;
            color: #1f1060;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #df7518;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* CONTENT */
        .content {
            margin-left: 220px;
            margin-top: 80px;
            width: 100%;
            display: flex;
            justify-content: center;
            padding: 30px;
        }

        .card {
            width: 450px;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        h1 {
            text-align: center;
            color: #1f1060;
            margin-bottom: 20px;
        }

        select, input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background: #df7518;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }
        .back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #1f1060;
            text-decoration: none;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <a href="/dashboard">🏠 Dashboard</a>
    <a href="/dosen">👨‍🏫 Data Dosen</a>
    <a href="/mata-kuliah">📚 Mata Kuliah</a>
    <a href="/kriteria">⚙️ Kriteria</a>
    <a href="/penilaian" class="active">📊 Penilaian</a>
    <a href="/seleksi">🎯 Seleksi</a>
    <a href="/hasil-seleksi">📋 Hasil Seleksi</a>
</div>

<!-- TOPBAR -->
<div class="topbar">
    <div class="topbar-left">
        <img src="{{ asset('images/logoutama.png') }}">
        <h2>Sistem Penugasan Dosen</h2>
    </div>

    <div class="topbar-right">
        <span>{{ Auth::user()->name }}</span>
        <a href="/profile" style="text-decoration:none;">
            <div class="profile">
                {{ strtoupper(substr(Auth::user()->name,0,1)) }}
            </div>
        </a>
    </div>
</div>

<!-- CONTENT -->
<div class="content">
    <div class="card">
        <h1>Edit Penilaian</h1>

        <form method="POST" action="/penilaian/update/{{ $penilaian->id }}">
            @csrf

            <select name="nidn" required>
                @foreach($dosen as $d)
                    <option value="{{ $d->NIDN }}"
                        {{ $penilaian->nidn == $d->NIDN ? 'selected' : '' }}>
                        {{ $d->Nama_Dosen }}
                    </option>
                @endforeach
            </select>

            <select name="kategori_bidang" required>
                @foreach($kategori_bidang as $kb)
                    <option value="{{ $kb }}"
                        {{ $penilaian->kategori_bidang == $kb ? 'selected' : '' }}>
                        {{ $kb }}
                    </option>
                @endforeach
            </select>

            <select name="kode_kriteria" required>
                @foreach($kriteria as $k)
                    <option value="{{ $k->kode_kriteria }}"
                        {{ $penilaian->kode_kriteria == $k->kode_kriteria ? 'selected' : '' }}>
                        {{ $k->nama_kriteria }}
                    </option>
                @endforeach
            </select>

            <input type="number" name="nilai" value="{{ $penilaian->nilai }}" required>

            <button type="submit">Update</button>
        </form>
            <a href="/penilaian" class="back">Kembali</a>
    </div>
</div>

</body>
</html>