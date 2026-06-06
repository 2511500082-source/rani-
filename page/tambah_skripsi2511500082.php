<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Skripsi</h1>
            </div>
        </div>
    </div>
</div>

<?php
$query = mysqli_query($koneksi, "SELECT * FROM skripsi");
$data = mysqli_fetch_assoc($query);

if (!empty($data['id_skripsi082'])) {
    $nilaikode = substr($data['id_skripsi082'], 2);
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
    $id_skripsi082 = $_POST['id_skripsi082'];
    $judul_skripsi082 = $_POST['judul_skripsi082'];
    $topik = $_POST['topik'];
    $semester082 = $_POST['semester082'];
    $thn_ajaran082 = $_POST['thn_ajaran082'];

    $insert = mysqli_query($koneksi, "
        INSERT INTO skripsi
        (id_skripsi082, judul_skripsi082, topik, semester082, thn_ajaran082)
        VALUES
        ('$id_skripsi082', '$judul_skripsi082', '$topik', '$semester082', '$thn_ajaran082')
    ");

    if ($insert) {
        echo '
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <h5><i class="icon fas fa-check"></i> Sukses</h5>
            Data skripsi berhasil disimpan
        </div>';

        echo '<meta http-equiv="refresh" content="1;url=index.php?page=skripsi">';
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
                <h3 class="card-title">Form Tambah Skripsi</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="">
                    
                    <div class="form-group">
                        <label for="id_skripsi082">Id Skripsi</label>
                        <input type="text" 
                               name="id_skripsi082" 
                               id="id_skripsi082"
                               value="<?= $_SESSION["KODE"] ?>"
                               class="form-control" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="judul_skripsi082">Judul Skripsi</label>
                        <input type="text" 
                               name="judul_skripsi082" 
                               id="judul_skripsi082"
                               placeholder="Masukkan Judul Skripsi"
                               class="form-control"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="topik">Topik</label>
                        <input type="text" 
                               name="topik" 
                               id="topik"
                               placeholder="Masukkan Topik"
                               class="form-control"
                               required>
                    </div>

                     <div class="form-group">
                        <label for="semester082">Semester</label>
                        <select name="semester082" id="semester082" class="form-control" required>
                            <option value="">-- Pilih Semester --</option>
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>

                     <div class="form-group">
                        <label for="thn_ajaran082">Tahun Ajaran</label>
                        <select name="thn_ajaran082" id="thn_ajaran082" class="form-control" required>
                            <option value="">-- Pilih Tahun Ajaran --</option>
                            <option value="2020/2021">2020/2021</option>
                            <option value="2021/2022">2021/2022</option>
                            <option value="2022/2023">2022/2023</option>
                            <option value="2023/2024">2023/2024</option>
                            <option value="2024/2025">2024/2025</option>
                            <option value="2025/2026">2025/2026</option>
                            
                        </select>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                        <a href="index.php?page=skripsi" class="btn btn-secondary">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>