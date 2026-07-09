<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kriteria</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
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
            min-height: calc(100vh - 80px);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        h1 {
            text-align: center;
            color: #1f1060;
            margin-bottom: 20px;
        }

        input {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input:focus {
            border-color: #1f1060;
            outline: none;
        }

        button {
            background: #df7518;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 6px;
            width: 100%;
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
    <a href="/kriteria" class="active">⚙️ Kriteria</a>
    <a href="/penilaian">📊 Penilaian</a>
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
        <div class="profile">
            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
        </div>
    </div>
</div>

<!-- CONTENT -->
<div class="content">
    <div class="card">
        <h1>Tambah Kriteria</h1>

        <form method="POST" action="/kriteria/simpan">
            @csrf

            <input type="text" name="kode_kriteria" placeholder="Kode Kriteria" required>
            <input type="text" name="nama_kriteria" placeholder="Nama Kriteria" required>
            <input type="number" step="0.01" name="bobot" placeholder="Bobot" required>

            <button type="submit">Simpan</button>
        </form>
            <a href="/kriteria" class="back">Kembali</a>
    </div>
</div>

</body>
</html>