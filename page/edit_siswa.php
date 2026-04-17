<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$kd'"));

if (isset($_POST['tambah'])) {
    $nis = $_POST['nis'];
    $id_user = $_POST['id_user'];
    $nm_siswa = $_POST['nm_siswa'];
    $jenkel = $_POST['jenkel'];
    $hp = $_POST['hp'];
    $id_kelas = $_POST['id_kelas'];

    $update = mysqli_query($koneksi, "
        UPDATE siswa SET
            id_user='$id_user',
            nm_siswa='$nm_siswa',
            jenkel='$jenkel',
            hp='$hp',
            id_kelas='$id_kelas'
        WHERE nis='$nis'
    ");

    if ($update) {
        echo '<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">X</button>
                <h5><i class="icon fas fa-info"></i> Info</h5>
                <h4>Berhasil Disimpan</h4>
              </div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';
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
                        <label>NIS</label>
                        <input type="text" name="nis" value="<?= $edit['nis']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>ID User</label>
                        <input type="text" name="id_user" value="<?= $edit['id_user']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="nm_siswa" value="<?= $edit['nm_siswa']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" name="jenkel" value="<?= $edit['jenkel']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>HP</label>
                        <input type="text" name="hp" value="<?= $edit['hp']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>ID Kelas</label>
                        <input type="text" name="id_kelas" value="<?= $edit['id_kelas']; ?>" class="form-control">
                    </div>

                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>