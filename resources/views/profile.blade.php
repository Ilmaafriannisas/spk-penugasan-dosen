<!DOCTYPE html>
<html>
<head>
    <title>Profile User</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background-color: #f4f6f9;
        }

        .content {
            padding: 40px;
        }

        h1 {
            color: #1f1060;
        }

        .profile-card {
            background: white;
            max-width: 600px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .avatar-large {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #df7518;
            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 36px;
            font-weight: bold;

            margin-bottom: 20px;
        }

        .profile-card h2 {
            margin-top: 0;
            color: #1f1060;
        }

        .profile-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .profile-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .profile-table td:first-child {
            width: 180px;
            font-weight: bold;
            color: #666;
        }

        .btn-back {
            display: inline-block;
            margin-top: 20px;
            background: #1f1060;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<div class="content">

    <h1>Profile User</h1>

    <div class="profile-card">

        <div class="avatar-large">
            {{ strtoupper(substr(Auth::user()->name,0,1)) }}
        </div>

        <h2>{{ Auth::user()->name }}</h2>

        <table class="profile-table">

            <tr>
                <td>Email</td>
                <td>{{ Auth::user()->email }}</td>
            </tr>

            <tr>
                <td>Role</td>
                <td>Administrator</td>
            </tr>

            <tr>
                <td>Bergabung Sejak</td>
                <td>{{ Auth::user()->created_at->format('d M Y') }}</td>
            </tr>

        </table>

        <a href="/dashboard" class="btn-back">
            Kembali
        </a>

    </div>

</div>

</body>
</html>