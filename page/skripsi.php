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
if (isset($_GET['action'])) {
  if ($_GET['action'] == "hapus") {
    $kd = $_GET['kd'];
    $query = mysqli_query($koneksi, "DELETE FROM skripsi where id_skripsi082 = '$kd'");
    if ($query){
      echo 
      '<div class="alert alert-warning alert-dismissible">
        Berhasil Di Hapus</div>';
      echo '<meta http-equiv="refresh" content="1;url=index.php?page=skripsi">';
    }
  }
}
?>
<d class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <a href="index.php?page=tambah_skripsi2511500082" class="btn btn-primary btn-sm">
      Tambah Skripsi</a>
      <table class="table table-striped">
          <tread>
            <tr>
              <th>No</th>
              <th>Id Skripsi082</th>
              <th>Judul Skripsi082</th>
              <th>Topik</th>
              <th>Semester082</th>
              <th>Tahun Ajaran082</th>
              <th>Aksi</th>
          </tr>
        </tread>
        <?php
        $no = 0;
        $query = mysqli_query($koneksi, "SELECT * FROM skripsi");
        while ($result = mysqli_fetch_array($query) ) {
          $no++
        ?>
        <tbody>
          <tr>
            <td><?= $no;?></td>
            <td><?=$result['id_skripsi082']; ?></td>
            <td><?=$result['judul_skripsi082']; ?></td>
            <td><?=$result['topik']; ?></td>
            <td><?=$result['semester082']; ?></td>
            <td><?=$result['thn_ajaran082']; ?></td>
            <td>
              <a href="index.php?page=skripsi&action=hapus&kd=<?= $result['id_skripsi082'] ?>" title="">
                <span class="badge badge-danger">Hapus</span></a>
              <a href="index.php?page=edit_skripsi2511500082&kd=<?= $result['id_skripsi082'] ?>" title=""><span class
                ="badge badge-warning">Edit</span></a>
            </td>
          </tr>
        </tbody>
        <?php } ?>
      </table>
    </div>
  </div>
</div>