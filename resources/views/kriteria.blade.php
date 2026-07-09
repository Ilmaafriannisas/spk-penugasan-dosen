<!DOCTYPE html>
<html>
<head>
    <title>Data Kriteria</title>
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

        .content {
            margin-left: 220px;
            margin-top: 80px;
            padding: 30px;
            width: 100%;
        }

        .action-bar {
            margin: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }

        .btn-primary {
            background: #df7518;
        }

        .btn-edit,
        .btn-delete {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-edit {
            background: #f1c40f;
        }

        .btn-delete {
            background: #e74c3c;
        }

        .btn:hover {
            opacity: 0.9;
        }

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
            text-align: left;
        }

        th {
            background-color: #1f1060;
            color: white;
        }

        .aksi a {
            margin-right: 10px;
            text-decoration: none;
            color: #1f1060;
            font-weight: bold;
        }

        .aksi a:hover {
            color: #df7518;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 9999;

            left: 0;
            top: 0;

            width: 100%;
            height: 100%;

            background: rgba(0,0,0,0.4);

            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 25px;
            border-radius: 12px;
            width: 350px;
            text-align: center;

            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        .modal-buttons {
            margin-top: 20px;

            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .btn-cancel {
            background: #95a5a6;
            color: white;

            border: none;
            padding: 8px 15px;
            border-radius: 6px;

            cursor: pointer;
        }

        .btn-confirm {
            background: #e74c3c;
            color: white;

            border: none;
            padding: 8px 15px;
            border-radius: 6px;

            cursor: pointer;

            text-decoration: none;
        }

        .alert-success {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);

            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            border-radius: 10px;

            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            z-index: 9999;

            font-weight: bold;
        }

        .pagination {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a,
        .pagination li span {
            display: block;
            padding: 8px 14px;
            background: white;
            border: 1px solid #ddd;
            color: #1f1060;
            text-decoration: none;
            border-radius: 6px;
        }

        .pagination .active span {
            background: #df7518;
            color: white;
            border-color: #df7518;
        }

        .pagination li a:hover {
            background: #f4f4f4;
        }        
    </style>
</head>

<div id="deleteModal" class="modal">

    <div class="modal-content">

        <h3>Hapus Kriteria</h3>

        <p>
            Data yang dihapus tidak dapat dikembalikan.
        </p>

        <div class="modal-buttons">

            <button
                class="btn-cancel"
                onclick="closeDeleteModal()">
                Batal
            </button>

            <a
                id="deleteLink"
                href="#"
                class="btn-confirm">
                Hapus
            </a>

        </div>

    </div>

</div>
<script>

function showDeleteModal(kode)
{
    document.getElementById('deleteModal').style.display = 'flex';

    document.getElementById('deleteLink').href =
        '/kriteria/hapus/' + kode;
}

function closeDeleteModal()
{
    document.getElementById('deleteModal').style.display = 'none';
}

window.onclick = function(event)
{
    let modal = document.getElementById('deleteModal');

    if(event.target == modal)
    {
        modal.style.display = 'none';
    }
}

</script>

<script>
setTimeout(function() {
    let alert = document.getElementById('success-alert');

    if(alert)
    {
        alert.style.opacity = '0';
        alert.style.transition = '0.5s';

        setTimeout(() => alert.remove(), 500);
    }
}, 2000);
</script>

<body>

<div class="sidebar">
    <a href="/dashboard">🏠 Dashboard</a>
    <a href="/dosen">👨‍🏫 Data Dosen</a>
    <a href="/mata-kuliah">📚 Mata Kuliah</a>
    <a href="/kriteria" class="active">⚙️ Kriteria</a>
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
            cursor: pointer;
        ">
            Logout
        </button>
    </form>
</div>

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

<div class="content">

    <h1>Data Kriteria</h1>

    <div class="action-bar">
        <a href="/kriteria/tambah" class="btn btn-primary">+ Tambah Kriteria</a>

        @if(session('success'))
            <div id="success-alert" class="alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <table>
        <tr>
            <th>Kode</th>
            <th>Nama Kriteria</th>
            <th>Bobot</th>
            <th>Aksi</th>
        </tr>

        @foreach($kriteria as $k)
        <tr>
            <td>{{ $k->kode_kriteria }}</td>
            <td>{{ $k->nama_kriteria }}</td>
            <td>{{ $k->bobot }}</td>
            <td>
                <a href="/kriteria/edit/{{ $k->kode_kriteria }}" class="btn-edit">Edit</a>
                <a href="#"
                    class="btn-delete"
                    onclick="showDeleteModal('{{ $k->kode_kriteria }}')">
                    Hapus
                </a>
            </td>
        </tr>
        @endforeach
    </table>

    <p>
    Menampilkan
    {{ $kriteria->firstItem() }}
    -
    {{ $kriteria->lastItem() }}
    dari
    {{ $kriteria->total() }}
    data kriteria
</p>

<div style="margin-top:20px;">
    {{ $kriteria->links() }}
</div>

</div>

</body>
</html>