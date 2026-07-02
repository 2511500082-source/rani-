<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data-Data Guru</h1>
            </div>
        </div>
    </div>
</div>

<?php
// =====================
// AUTO KODE GURU
// =====================
$carikode = mysqli_query($koneksi, "SELECT MAX(kd_guru) as kode FROM guru");
$datakode = mysqli_fetch_assoc($carikode);

if (!empty($datakode['kode'])) {
    $nilaikode = substr($datakode['kode'], 2);
    $kode = (int)$nilaikode + 1;
    $hasilkode = "M-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "M-001";
}

$_SESSION["KODE"] = $hasilkode;

// =====================
// PROSES SIMPAN
// =====================
if (isset($_POST['tambah'])) {
    $kd_guru = $_POST['kd_guru'];
    $username = $_POST['username'];
    $nm_guru = $_POST['nm_guru'];
    $jenkel = $_POST['jenkel'];
    $pen_terakhir = $_POST['pend_terakhir'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];

    // 1. Insert dulu ke tabel users, password default 1234
    $insert_user = mysqli_query($koneksi, "
        INSERT INTO users (username, password, role)
        VALUES ('$username', '1234', 'guru')
    ");

    if ($insert_user) {
        $id_user = mysqli_insert_id($koneksi);

        // 2. Baru insert ke tabel guru pakai id_user hasil insert di atas
        $insert = mysqli_query($koneksi, "
            INSERT INTO guru
            (kd_guru, id_user, nm_guru, jenkel, pend_terakhir, hp, alamat)
            VALUES
            ('$kd_guru', '$id_user', '$nm_guru', '$jenkel', '$pen_terakhir', '$hp', '$alamat')
        ");

        if ($insert) {
            echo '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> Sukses</h5>
                Data guru berhasil disimpan. Username: ' . $username . ', Password default: 1234
            </div>';

            echo '<meta http-equiv="refresh" content="2;url=index.php?page=guru">';
        } else {
            // Kalau insert guru gagal, hapus lagi user yang udah kebuat biar gak nyangkut
            mysqli_query($koneksi, "DELETE FROM users WHERE id_user = '$id_user'");
            echo '
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-times"></i> Gagal</h5>
                Data guru gagal disimpan: ' . mysqli_error($koneksi) . '
            </div>';
        }
    } else {
        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-times"></i> Gagal</h5>
            Gagal membuat akun user: ' . mysqli_error($koneksi) . '
        </div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">Form Tambah Guru</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="">
                    
                    <div class="form-group">
                        <label for="kd_guru">Kode Guru</label>
                        <input type="text" 
                               name="kd_guru" 
                               id="kd_guru"
                               value="<?= $_SESSION["KODE"] ?>"
                               class="form-control" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" 
                               name="username" 
                               id="username"
                               placeholder="Masukkan Username untuk login"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="nm_guru">Nama Guru</label>
                        <input type="text" 
                               name="nm_guru" 
                               id="nm_guru"
                               placeholder="Masukkan Nama Guru"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="jenkel">Jenis Kelamin</label>
                        <select name="jenkel" id="jenkel" class="form-control" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pend_terakhir">Pendidikan Terakhir</label>
                        <input type="text" 
                               name="pend_terakhir" 
                               id="pend_terakhir"
                               placeholder="Masukkan Pendidikan Terakhir"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="hp">Handphone</label>
                        <input type="text" 
                               name="hp" 
                               id="hp"
                               placeholder="Masukkan nomor HP"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input  name="alamat" 
                                id="alamat"
                                rows="3"
                                placeholder="Masukkan Alamat"
                                class="form-control"
                                required>
                    </div>

                    <div class="card-footer">
                        <input type="submit" 
                               class="btn btn-primary" 
                               name="tambah" 
                               value="Simpan">
                        <a href="index.php?page=kd_guru" class="btn btn-secondary">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>