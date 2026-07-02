<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Skripsi</h1>
            </div>
        </div>
    </div>
</div>

    <?php
    $kd = $_GET['kd'];
    $edit = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM skripsi WHERE id_skripsi082='$kd' "));

    if (isset($_POST['tambah'])){
        $kd_skripsi082 = $_POST['id_skripsi082'];
        $judul_skripsi082 = $_POST['judul_skripsi082'];
        $topik = $_POST['topik'];
        $semester082 = $_POST['semester082'];
        $tahun_ajaran082 = $_POST['tahun_ajaran082'];


        $insert = mysqli_query($koneksi,"UPDATE skripsi SET judul_skripsi082='$judul_skripsi082', topik='$topik', semester082='$semester082', tahun_ajaran082='$tahun_ajaran082' WHERE id_skripsi082='$kd_skripsi082' ");
        if ($insert) {
            echo '<div class="alert alert-info-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <h5> <i class="icon fas fa-info"></i> Info </h5>
            <h4>Berhasil Disimpan</h4></div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=skripsi">';
        } else {
            echo '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Gagal Disimpan</h4></div>';
        }
    }
    ?>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card-body p-2">
                        <form method="POST" action="">
                        <div class="form-group">
                            <label for="id_skripsi082">Id Skripsi</label>
                            <input type="text" name="id_skripsi082" value="<?= $edit['id_skripsi082']; ?>" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="judul_skripsi082">Judul Skripsi</label>
            <input type="text" name="judul_skripsi082" value="<?= $edit['judul_skripsi082']; ?>" id="judul_skripsi082" placeholder="Judul Skripsi" class="form-control">
          </div>
          <div class="form-group">
            <label for="topik">Topik</label>
            <input type="text" name="topik" value="<?= $edit['topik']; ?>" id="topik" placeholder="Topik" class="form-control">
          </div>
          <div class="form-group">
            <label for="semester082">Semester</label>
            <input type="text" name="semester082" value="<?= $edit['semester082']; ?>" id="semester082" placeholder="Semester" class="form-control">
          </div>
          <div class="form-group">
            <label for="tahun_ajaran082">Tahun Ajaran</label>
            <input type="text" name="tahun_ajaran082" value="<?= $edit['tahun_ajaran082']; ?>" id="tahun_ajaran082" placeholder="Tahun Ajaran" class="form-control">
          </div>
          <div class="card-footer">
            <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>