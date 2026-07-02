<?php
session_start();
include "config/koneksi.php";
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
$pesan = "";
if (isset($_POST['ganti'])) {
    $password_baru   = $_POST['password_baru'];
    $konfirmasi      = $_POST['konfirmasi'];
    if ($password_baru !== $konfirmasi) {
        $pesan = "Password baru dan konfirmasi tidak sama!";
    } elseif (strlen($password_baru) < 4) {
        $pesan = "Password minimal 4 karakter!";
    } else {
        $id_user = $_SESSION['id_user'];
        $update = mysqli_query($koneksi, "UPDATE users SET password = '$password_baru' WHERE id_user = '$id_user'");
        if ($update) {
            // Redirect sesuai role setelah ganti password
            if ($_SESSION['level'] == 'guru') {
                header("Location: page/guru.php");
            } elseif ($_SESSION['level'] == 'siswa') {
                header("Location: page/siswa.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            $pesan = "Gagal update password: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ganti Password</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>Ganti</b> Password
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Password masih default, silakan ganti password Anda terlebih dahulu.</p>
            <?php if ($pesan != "") { ?>
                <div class="alert alert-danger"><?= $pesan ?></div>
            <?php } ?>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="password" name="password_baru" class="form-control" placeholder="Password Baru" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="konfirmasi" class="form-control" placeholder="Konfirmasi Password Baru" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <input type="submit" name="ganti" value="Simpan Password Baru" class="btn btn-primary btn-block">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>