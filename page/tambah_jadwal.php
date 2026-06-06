<?php
// Auto-generate kode jadwal
$carikode = mysqli_query($koneksi, "SELECT MAX(id_jadwal) FROM jadwal_kelas") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
$hasilkode = ($datakode[0] !== null) ? $datakode[0] + 1 : 1;
$kode_jadwal = 'J-' . str_pad($hasilkode, 3, '0', STR_PAD_LEFT);

if (isset($_POST['tambah'])) {
    $id_jadwal  = $hasilkode;
    $semester   = $_POST['semester'];
    $thn_ajaran = $_POST['thn_ajaran'];
    $kd_guru    = $_POST['kd_guru'];
    $kd_mapel   = $_POST['kd_mapel'];
    $hari       = $_POST['hari'];
    $jam        = $_POST['jam'];
    $nm_kelas   = $_POST['nm_kelas'];

    // Insert ke jadwal_kelas
    $insertjadwal = mysqli_query($koneksi, "INSERT INTO jadwal_kelas (id_jadwal, idd_kelas, thn_ajaran, semester) 
                    VALUES ('$id_jadwal', '0', '$thn_ajaran', '$semester')")
                    or die("Gagal masukkan jadwal: " . mysqli_error($koneksi));

    $allSuccess = true;
    for ($i = 0; $i < count($kd_mapel); $i++) {
        $jam_parts   = explode('-', $jam[$i]);
        $jam_mulai   = isset($jam_parts[0]) ? trim($jam_parts[0]) : '';
        $jam_selesai = isset($jam_parts[1]) ? trim($jam_parts[1]) : '';
        $kelas_item  = isset($nm_kelas[$i]) ? $nm_kelas[$i] : '';

        $insert = mysqli_query($koneksi, "
            INSERT INTO detail_jadwal (id_jadwal, kd_mapel, kd_guru, hari, jam_mulai, jam_selesai, nm_kelas)
            VALUES ('$id_jadwal', '{$kd_mapel[$i]}', '$kd_guru', '{$hari[$i]}', '$jam_mulai', '$jam_selesai', '$kelas_item')
        ");

        if (!$insert) {
            $allSuccess = false;
            die("ERROR DETAIL JADWAL: " . mysqli_error($koneksi));
        }
    }

    if ($allSuccess) {
        echo '<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=jadwal">';
    } else {
        echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            <h5><i class="icon fas fa-info"></i> Info</h5>
            <h4>Gagal menyimpan data detail.</h4></div>';
    }
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h3>Tambah Jadwal</h3>
                <form method="POST" action="">

                    <!-- Kode Jadwal (auto) -->
                    <div class="form-group">
                        <label><strong>Kode Jadwal</strong></label>
                        <input type="text" name="id_jadwal"
                               value="<?= $kode_jadwal ?>"
                               class="form-control" readonly>
                    </div>

                    <!-- Guru -->
                    <div class="form-group">
                        <label><strong>Guru</strong></label>
                        <select name="kd_guru" class="form-control" required>
                            <option selected disabled>--Pilih Guru--</option>
                            <?php
                            $guru = mysqli_query($koneksi, "SELECT * FROM guru");
                            while ($g = mysqli_fetch_assoc($guru)) {
                                echo "<option value='{$g['kd_guru']}'>{$g['nm_guru']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Semester -->
                    <div class="form-group">
                        <label><strong>Semester</strong></label>
                        <select name="semester" class="form-control" required>
                            <option value="">--Pilih semester--</option>
                            <option value="ganjil">Ganjil</option>
                            <option value="genap">Genap</option>
                        </select>
                    </div>

                    <!-- Tahun Ajaran -->
                    <div class="form-group">
                        <label><strong>Tahun Ajaran</strong></label>
                        <select name="thn_ajaran" class="form-control" required>
                            <option selected disabled>--Pilih Tahun Ajaran--</option>
                            <option value="2022-2023">2022-2023</option>
                            <option value="2023-2024">2023-2024</option>
                            <option value="2024-2025">2024-2025</option>
                            <option value="2025-2026">2025-2026</option>
                            <option value="2026-2027">2026-2027</option>
                        </select>
                    </div>

                    <hr>
                    <h5>Detail Jadwal</h5>

                    <div id="detail-jadwal">
                        <div class="row mb-2 align-items-center">

                            <!-- Mapel -->
                            <div class="col-md-3">
                                <select name="kd_mapel[]" class="form-control" required>
                                    <option selected disabled>--Pilih Mapel--</option>
                                    <?php
                                    $mapel = mysqli_query($koneksi, "SELECT * FROM mapel");
                                    while ($m = mysqli_fetch_assoc($mapel)) {
                                        echo "<option value='{$m['kd_mapel']}'>{$m['nm_mapel']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Hari -->
                            <div class="col-md-3">
                                <select name="hari[]" class="form-control" required>
                                    <option selected disabled>--Pilih Hari--</option>
                                    <option>Senin</option>
                                    <option>Selasa</option>
                                    <option>Rabu</option>
                                    <option>Kamis</option>
                                    <option>Jumat</option>
                                    <option>Sabtu</option>
                                </select>
                            </div>

                            <!-- Jam -->
                            <div class="col-md-3">
                                <select name="jam[]" class="form-control" required>
                                    <option selected disabled>--Pilih Jam--</option>
                                    <option value="08:00-10:00">08.00-10.00</option>
                                    <option value="08:00-10:30">08.00-10.30</option>
                                    <option value="10:00-12:00">10.00-12.00</option>
                                    <option value="10:30-12:30">10.30-12.30</option>
                                    <option value="12:00-14:00">12.00-14.00</option>
                                    <option value="13:00-15:00">13.00-15.00</option>
                                </select>
                            </div>

                            <!-- Kelas -->
                            <div class="col-md-3">
                                <input type="text" name="nm_kelas[]"
                                       class="form-control" placeholder="Kelas">
                            </div>

                        </div>
                    </div>

                    <button type="button" class="btn btn-info"
                            onclick="tambahBaris()">+ Tambah Mapel</button>
                    <br><br>

                    <input type="submit" class="btn btn-primary"
                           name="tambah" value="simpan">

                </form>
            </div>
        </div>
    </div>
</div>

<script>
function tambahBaris() {
    let container = document.getElementById('detail-jadwal');
    let original = container.firstElementChild;
    let row = original.cloneNode(true);
    row.querySelectorAll('select').forEach(sel => sel.selectedIndex = 0);
    row.querySelectorAll('input').forEach(input => input.value = '');
    container.appendChild(row);
}
</script>