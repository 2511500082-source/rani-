<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Guru</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM guru WHERE kd_guru='$kd'"));

if (isset($_POST['tambah'])) {
    $kd_guru = $_POST['kd_guru'];
    $id_user = $_POST['id_user'];
    $nm_guru = $_POST['nm_guru'];
    $jenkel = $_POST['jenkel'];
    $pend_terakhir = $_POST['pend_terakhir'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];

    $update = mysqli_query($koneksi, "
        UPDATE guru SET
            id_user='$id_user',
            nm_guru='$nm_guru',
            jenkel='$jenkel',
            pend_terakhir='$pend_terakhir',
            hp='$hp',
            alamat='$alamat'
        WHERE kd_guru='$kd_guru'
    ");

    if ($update) {
        echo '<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h5><i class="icon fas fa-info"></i> Info</h5>
                <h4>Berhasil Disimpan</h4>
              </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';
    } else {
        echo '<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h5><i class="icon fas fa-info"></i> Info</h5>
                <h4>Gagal Disimpan</h4>
              </div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="">

                    <div class="form-group">
                        <label>Kode Guru</label>
                        <input type="text" name="kd_guru" value="<?= $edit['kd_guru']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>ID User</label>
                        <input type="text" name="id_user" value="<?= $edit['id_user']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Nama Guru</label>
                        <input type="text" name="nm_guru" value="<?= $edit['nm_guru']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" name="jenkel" value="<?= $edit['jenkel']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <input type="text" name="pend_terakhir" value="<?= $edit['pend_terakhir']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Handphone</label>
                        <input type="text" name="hp" value="<?= $edit['hp']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" value="<?= $edit['alamat']; ?>" class="form-control">
                    </div>

                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>