<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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

        .sidebar a:hover {
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
            z-index: 100;
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
            padding: 30px;
            width: 100%;
        }

        h1 {
            color: #1f1060;
        }

        /* CARD */
        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 12px;
            border-left: 6px solid #df7518;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        .card h3 {
            margin: 0;
            font-size: 14px;
            color: #888;
        }

        .card p {
            font-size: 26px;
            margin-top: 10px;
            font-weight: bold;
            color: #1f1060;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #1f1060;
            color: white;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <a href="/dashboard" class="active">🏠 Dashboard</a>
    <a href="/dosen">👨‍🏫 Data Dosen</a>
    <a href="/mata-kuliah">📚 Mata Kuliah</a>
    <a href="/kriteria">⚙️ Kriteria</a>
    <a href="/penilaian">📊 Penilaian</a>
    <a href="/seleksi">🎯 Seleksi</a>
    <a href="/hasil-seleksi">📋 Hasil Seleksi</a>

    <form method="POST" action="/logout" style="margin-top:20px;">
        @csrf
        <button style="
            margin: 10px;
            padding: 10px;
            width: 80%;
            background: #df7518;
            color: white;
            border: none;
            border-radius: 5px;
        ">
            Logout
        </button>
    </form>
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

    <h1>Dashboard</h1>

    <div class="cards">
        <div class="card">
            <h3>Total Dosen</h3>
            <p>{{ $totalDosen }}</p>
        </div>

        <div class="card">
            <h3>Total Mata Kuliah</h3>
            <p>{{ $totalMatkul }}</p>
        </div>

        <div class="card">
            <h3>Total Kriteria</h3>
            <p>{{ $totalKriteria }}</p>
        </div>

        <div class="card">
            <h3>Total Penugasan</h3>
            <p>{{ $totalPenugasan }}</p>
        </div>
    </div>

    <h2>Hasil Penugasan</h2>

    <table>
        <tr>
            <th>Dosen</th>
            <th>Jumlah SKS</th>
        </tr>
        @forelse($ringkasan as $r)

        <tr>
            <td>{{ $r->Nama_Dosen }}</td>

            <td>
                {{ $r->total_sks }}
            </td>
        </tr>

        @empty

        <tr>
            <td colspan="2">
                Belum ada penugasan
            </td>
        </tr>

        @endforelse
    </table>

</div>

</body>
</html>