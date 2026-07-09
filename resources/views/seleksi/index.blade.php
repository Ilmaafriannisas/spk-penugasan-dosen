<!DOCTYPE html>
<html>
<head>
    <title>Seleksi Dosen Pengampu</title>

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

        h1 {
            color: #1f1060;
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
        }

        th {
            background-color: #1f1060;
            color: white;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .rank {
            font-weight: bold;
            color: #df7518;
        }

        .btn-tugaskan {
            background: #df7518;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-tugaskan:hover {
            opacity: 0.9;
        }

        .btn-batalkan {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-batalkan:hover {
            opacity: 0.9;
        }

        .modal {
            display:none;
            position:fixed;
            left:0;
            top:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.4);

            justify-content:center;
            align-items:center;

            z-index:9999;
        }

        .modal-content {
            background:white;
            padding:25px;
            border-radius:12px;
            width:400px;
            text-align:center;
        }

        .modal-buttons {
            margin-top:20px;
            display:flex;
            justify-content:center;
            gap:10px;
        }

        .btn-cancel {
            background:#95a5a6;
            color:white;
            border:none;
            padding:8px 15px;
            border-radius:6px;
            cursor:pointer;
        }

        .btn-confirm {
            background:#df7518;
            color:white;
            border:none;
            padding:8px 15px;
            border-radius:6px;
            cursor:pointer;
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

<div id="tugaskanModal" class="modal">

    <div class="modal-content">

        <h3>Konfirmasi Penugasan</h3>

        <p>Apakah Anda yakin ingin menugaskan dosen berikut?</p>

        <p><b>Mata Kuliah:</b> <span id="modalMatkul"></span></p>

        <p><b>Dosen:</b> <span id="modalDosen"></span></p>

        <p><b>Ranking:</b> <span id="modalRanking"></span></p>

        <div class="modal-buttons">

            <button
                class="btn-cancel"
                onclick="closeModal()">
                Batal
            </button>

            <form
                id="formTugaskan"
                method="POST"
                action="/seleksi/tugaskan">

                @csrf

                <input
                    type="hidden"
                    name="kode_matkul"
                    id="inputKodeMatkul">

                <input
                    type="hidden"
                    name="nidn"
                    id="inputNidn">

                <button
                    type="submit"
                    class="btn-confirm">
                    Konfirmasi
                </button>

            </form>

        </div>

    </div>

</div>

<script>

function showModal(
    kodeMatkul,
    nidn,
    namaMatkul,
    namaDosen,
    ranking
)
{
    document.getElementById('tugaskanModal').style.display='flex';

    document.getElementById('modalMatkul').innerText =
        namaMatkul;

    document.getElementById('modalDosen').innerText =
        namaDosen;

    document.getElementById('modalRanking').innerText =
        ranking;

    document.getElementById('inputKodeMatkul').value =
        kodeMatkul;

    document.getElementById('inputNidn').value =
        nidn;
}

function closeModal()
{
    document.getElementById('tugaskanModal').style.display='none';
}

</script>

<div id="batalkanModal" class="modal">

    <div class="modal-content">

        <h3>Batalkan Penugasan</h3>

        <p>
            Apakah Anda yakin ingin membatalkan penugasan berikut?
        </p>

        <p>
            <b>Mata Kuliah:</b>
            <span id="batalkanMatkul"></span>
        </p>

        <p>
            <b>Dosen:</b>
            <span id="batalkanDosen"></span>
        </p>

        <div class="modal-buttons">

            <button
                class="btn-cancel"
                onclick="closeBatalkanModal()">
                Batal
            </button>

            <form
                id="formBatalkan"
                method="POST"
                action="/seleksi/batalkan">

                @csrf

                <input
                    type="hidden"
                    name="kode_matkul"
                    id="batalkanKodeMatkul">

                <input
                    type="hidden"
                    name="nidn"
                    id="batalkanNidn">

                <button
                    type="submit"
                    class="btn-batalkan">
                    Ya, Batalkan
                </button>

            </form>

        </div>

    </div>

</div>

<script>

function showBatalkanModal(
    kodeMatkul,
    nidn,
    namaMatkul,
    namaDosen
)
{
    document.getElementById('batalkanModal').style.display = 'flex';

    document.getElementById('batalkanMatkul').innerText =
        namaMatkul;

    document.getElementById('batalkanDosen').innerText =
        namaDosen;

    document.getElementById('batalkanKodeMatkul').value =
        kodeMatkul;

    document.getElementById('batalkanNidn').value =
        nidn;
}

function closeBatalkanModal()
{
    document.getElementById('batalkanModal').style.display = 'none';
}

</script>

<script>
setTimeout(function() {

    let alert =
        document.getElementById('success-alert');

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
    <a href="/kriteria">⚙️ Kriteria</a>
    <a href="/penilaian">📊 Penilaian</a>
    <a href="/seleksi" class="active">🎯 Seleksi</a>
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

    <h1>Seleksi Dosen Pengampu</h1>

    @if(session('success'))
        <div id="success-alert" class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div style="margin-bottom:20px;">

        <form method="GET">

            <select
                name="matkul"
                onchange="this.form.submit()"

                style="
                    padding:8px;
                    border-radius:6px;
                    border:1px solid #ccc;
                ">

                <option value="">
                    Semua Mata Kuliah
                </option>

                @foreach($matkul as $m)

                    <option
                        value="{{ $m->kode_matkul }}"

                        {{ request('matkul') == $m->kode_matkul ? 'selected' : '' }}>

                        {{ $m->nama_matkul }}

                    </option>

                @endforeach

            </select>

        </form>

    </div>

    <table>
        <tr>
            <th>Mata Kuliah</th>
            <th>Dosen Relevan</th>
            <th>Ranking</th>
            <th>Total Nilai</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @php
            $currentMatkul = '';
            $ranking = 1;
        @endphp

        @foreach($hasil as $h)

            @if($currentMatkul != $h->nama_matkul)
                @php
                    $ranking = 1;
                    $currentMatkul = $h->nama_matkul;
                @endphp
            @endif

            <tr>
                <td>{{ $h->nama_matkul }}</td>

                <td>{{ $h->Nama_Dosen }}</td>

                <td>
                @if($ranking == 1)
                    🥇
                @elseif($ranking == 2)
                    🥈
                @elseif($ranking == 3)
                    🥉
                @else
                    #{{ $ranking }}
                @endif
                </td>

                <td>{{ number_format($h->total_nilai,2) }}</td>

                <td>

                    @if($h->status_penugasan)

                        <span style="
                            background:#27ae60;
                            color:white;
                            padding:5px 10px;
                            border-radius:20px;
                            font-size:12px;
                        ">
                            Ditugaskan
                        </span>

                    @else

                        <span style="
                            background:#f39c12;
                            color:white;
                            padding:5px 10px;
                            border-radius:20px;
                            font-size:12px;
                        ">
                            Belum Ditugaskan
                        </span>

                    @endif

                </td>

                <td>

                    @if($h->status_penugasan)

                        <button class="btn-batalkan"

                            onclick="showBatalkanModal(
                                '{{ $h->kode_matkul }}',
                                '{{ $h->NIDN }}',
                                '{{ $h->nama_matkul }}',
                                '{{ $h->Nama_Dosen }}'
                            )">

                            Batalkan
                        </button>

                    @else

                        <button
                            class="btn-tugaskan"

                            onclick="showModal(
                                '{{ $h->kode_matkul }}',
                                '{{ $h->NIDN }}',
                                '{{ $h->nama_matkul }}',
                                '{{ $h->Nama_Dosen }}',
                                '{{ $ranking }}'
                            )">

                            Tugaskan

                        </button>

                    @endif

                </td>
            </tr>

            @php $ranking++; @endphp

        @endforeach
    </table>

        <p>
            Menampilkan
            {{ $hasil->firstItem() }}
            -
            {{ $hasil->lastItem() }}
            dari
            {{ $hasil->total() }}
            data seleksi
        </p>

        <div style="margin-top:20px;">
            {{ $hasil->links() }}
        </div>    

</div>

</body>
</html>