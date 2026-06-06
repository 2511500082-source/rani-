<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data-Data Kelas</h1>
            </div>
        </div>
    </div>
</div>

<?php
// =====================
// AUTO KODE KELAS
// =====================
// =====================
// AUTO KODE KELAS
// =====================
$query = mysqli_query($koneksi, "SELECT MAX(id_kelas) AS max_id FROM kelas");
$data = mysqli_fetch_assoc($query);

if ($data['max_id']) {
    $hasilkode = $data['max_id'] + 1;
} else {
    $hasilkode = 1;
}

$_SESSION["KODE"] = $hasilkode;

// =====================
// PROSES SIMPAN
// =====================
if (isset($_POST['tambah'])) {
    $id_kelas = $_POST['id_kelas'];
    $nm_kelas = $_POST['nm_kelas'];
   ;

    $insert = mysqli_query($koneksi, "
        INSERT INTO kelas
        (id_kelas, nm_kelas)
        VALUES
        ('$id_kelas', '$nm_kelas')
    ");

    if ($insert) {
        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <h5><i class="icon fas fa-check"></i> Sukses</h5>
            Data kelas berhasil disimpan
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas">';
    } else {
        echo '
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
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
                <h3 class="card-title">Form Tambah Kelas</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="">
                    
                    <div class="form-group">
                        <label for="id_kelas">Id Kelas</label>
                        <input type="text" 
                                name="id_kelas" 
                                id="id_kelas"
                                value="<?= $_SESSION["KODE"] ?>"
                                class="form-control"
                                readonly>
                    </div>

                    <div class="form-group">
                        <label for="nm_kelas">Nama Kelas</label>
                        <input type="text" 
                               name="nm_kelas" 
                               id="nm_kelas"
                               placeholder="Masukkan Nama Kelas"
                               class="form-control"
                               required>
                    </div>
                    <div class="card-footer">
                        <input type="submit" 
                               class="btn btn-primary" 
                               name="tambah" 
                               value="Simpan">
                       <a href="index.php?page=kelas" class="btn btn-secondary">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>