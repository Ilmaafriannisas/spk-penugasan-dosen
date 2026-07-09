<!DOCTYPE html>
<html>
<head>
    <title>Tambah Dosen</title>
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

        .sidebar a:hover {
            background-color: #df7518;
        }

        /* CONTENT */
        .content {
            margin-left: 220px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
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
        .input-box {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            background: white;
            color: #333;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .input-box:focus {
            border-color: #1f1060;
            outline: none;
            box-shadow: 0 0 5px rgba(31,16,96,0.2);
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
    <a href="/penilaian">📊 Penilaian</a>
    <a href="/seleksi">🎯 Seleksi</a>
    <a href="/hasil-seleksi">📋 Hasil Seleksi</a>
</div>

<!-- CONTENT -->
<div class="content">
    <div class="card">
        <h1>Tambah Dosen</h1>

        <form method="POST" action="/simpan-dosen">
            @csrf

            <input type="text" name="nidn" placeholder="NIDN" required>
            <input type="text" name="nama" placeholder="Nama Dosen" required>
            <input type="text" name="bidang_keahlian" placeholder="Bidang Keahlian" required>

            <button type="submit">Simpan</button>
        </form>
            <a href="/dosen" class="back">Kembali</a>
    </div>
</div>

</body>
</html>