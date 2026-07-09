<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mata Kuliah</title>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            display: flex;
            background-color: #f4f6f9;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            background-color: #1f1060;
            position: fixed;
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
        }

        .content {
            margin-left: 220px;
            margin-top: 80px;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            width: 400px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        h1 {
            text-align: center;
            color: #1f1060;
        }

        input {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #df7518;
            color: white;
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

<div class="sidebar">
    <a href="/dashboard">🏠 Dashboard</a>
    <a href="/dosen">👨‍🏫 Data Dosen</a>
    <a href="/mata-kuliah" class="active">📚 Mata Kuliah</a>
    <a href="/kriteria">⚙️ Kriteria</a>
    <a href="/penilaian">📊 Penilaian</a>
    <a href="/seleksi">🎯 Seleksi</a>
    <a href="/hasil-seleksi">📋 Hasil Seleksi</a>
</div>

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

<div class="content">
    <div class="form-card">
        <h1>Tambah Mata Kuliah</h1>

        <form method="POST" action="/mata-kuliah/simpan">
            @csrf

            <input type="text" name="kode_matkul" placeholder="Kode Mata Kuliah" required>
            <input type="text" name="nama_matkul" placeholder="Nama Mata Kuliah" required>
            <input type="number" name="sks" placeholder="SKS" required>
            <input type="number" name="semester" placeholder="Semester" required>
            <input type="text" name="kategori_bidang" placeholder="Kategori Bidang" required>

            <button type="submit">Simpan</button>
        </form>

        <a href="/mata-kuliah" class="back">Kembali</a>
    </div>
</div>

</body>
</html>