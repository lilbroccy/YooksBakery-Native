<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 offset-md-4 mt-5 bg-white shadow p-5 rounded">
                <div class="text-center">
                    <img src="asset/image/image-admin/Logo.png" width="150">
                </div>
                <form method="POST">
                    <div class="mb-3">
                        <label >Email</label>
                        <input type="email" name="email" class="form-control" placeholder="example@gmail.com">
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="************ ">
                    </div>
                    <button class="btn btn-primary" name="login">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="asset/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    //cek akun ke tabel admin
    $ambil = $koneksi->query("SELECT * FROM user WHERE email_user='$email' AND password_user='$password' ");
    $cekuser = $ambil->fetch_assoc();

    if (empty($cekuser)) {
        echo "<script>alert('Gagal akun tidak ditemukan !..')</script>";
        echo "<script>location='index.php'</script>";
    }
    else {
        //menyimpan data plogin dalam session agar sistem tau siapa yang pakai dia
        $_SESSION['User'] = $cekuser;
        $_SESSION['Admin'] = $cekuser;

        if ($cekuser['level_user']=="Admin"){
            echo "<script>alert('Sukses login')</script>";
            echo "<script>location='admin/html/index.php'</script>";
        }
        else if ($cekuser['level_user']=="User") {
            echo "<script>alert('Sukses login')</script>";
            echo "<script>location='user/index.php'</script>";
        }
    }
}
?>