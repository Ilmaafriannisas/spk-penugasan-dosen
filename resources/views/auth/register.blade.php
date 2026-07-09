<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #0a2a7d, #ffffff);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            width: 350px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 10px;
            color: #2c3e50;
        }

        p {
            font-size: 14px;
            margin-bottom: 20px;
            color: #7f8c8d;
        }

        input {
            width: 95%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        input:focus {
            border-color: #0a2a7d;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #0a2a7d;
            border: none;
            color: white;
            border-radius: 6px;
            margin-top: 10px;
            cursor: pointer;
        }

        .extra {
            margin-top: 10px;
            font-size: 13px;
        }

        .extra a {
            text-decoration: none;
            color: #0a2a7d;
        }
    </style>
</head>
<body>

<div class="register-card">
    <h2>Buat Akun</h2>
    <p>Daftar ke Sistem Penugasan Dosen</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="name" placeholder="Nama" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

        <button type="submit">Register</button>
    </form>

    <div class="extra">
        <a href="/login">Sudah punya akun? Login</a>
    </div>
</div>

</body>
</html>