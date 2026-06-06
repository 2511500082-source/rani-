<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data-Data Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php
// =====================
// AUTO KODE GURU
// =====================
$carikode = mysqli_query($koneksi, "SELECT MAX(nis) as kode FROM siswa");
$datakode = mysqli_fetch_assoc($carikode);

if (!empty($datakode['kode'])) {
    $nilaikode = substr($datakode['kode'], 2);
    $kode = (int)$nilaikode + 1;
    $hasilkode = "S-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "S-001";
}

$_SESSION["KODE"] = $hasilkode;

// =====================
// PROSES SIMPAN
// =====================
if (isset($_POST['tambah'])) {
    $nis = $_POST['nis'];
    $id_user = $_POST['id_user'];
    $nm_siswa = $_POST['nm_siswa'];
    $jenkel = $_POST['jenkel'];
    $hp = $_POST['hp'];
    $id_kelas = $_POST['id_kelas'];

    $insert = mysqli_query($koneksi, "
        INSERT INTO siswa
        (nis, id_user, nm_siswa, jenkel, hp, id_kelas)
        VALUES
        ('$nis', '$id_user', '$nm_siswa', '$jenkel', '$hp', '$id_kelas')
    ");

    if ($insert) {
        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Sukses</h5>
            Data nis berhasil disimpan
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';
    } else {
        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-times"></i> Gagal</h5>
            Data gagal disimpan: ' . mysqli_error($koneksi) . '
        </div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">Form Tambah Siswa</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="">
                    
                    <div class="form-group">
                        <label for="nis">NIS</label>
                        <input type="text" 
                               name="nis" 
                               value="<?= $hasilkode?>"
                                placeholder="Masukkan NIS Anda"
                               class="form-control" 
                               required READONLY>
                    </div>

                    </div>

                    <div class="form-group">
                        <label for="nm_siswa">Nama Siswa</label>
                        <input type="text" 
                               name="nm_siswa" 
                               id="nm_siswa"
                               placeholder="Masukkan Nama Siswa"
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
                        <label for="hp">No HP</label>
                        <input type="text" 
                               name="hp" 
                               id="hp"
                               placeholder="Masukkan nomor HP"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="id_kelas">ID Kelas</label>
                        <select class="form-control" name="id_kelas" required>
                                <option value="" disabled selected>--Pilih Kelas--</option>
                                <?php
                                $getkelas = mysqli_query($koneksi, "SELECT * FROM kelas");
                                while ($returnkelas = mysqli_fetch_array($getkelas)) {
                                ?>
                                    <option value="<?= $returnkelas['id_kelas']; ?>"><?= $returnkelas['nm_kelas']; ?></option>
                                <?php } ?>
                            </select>
                    </div>

                    <div class="card-footer">
                        <input type="submit" 
                               class="btn btn-primary" 
                               name="tambah" 
                               value="Simpan">
                        <a href="index.php?page=nis" class="btn btn-secondary">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>