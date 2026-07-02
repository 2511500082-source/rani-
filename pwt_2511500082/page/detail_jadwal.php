<?php
$id_jadwal = $_GET['id'];
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Detail Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <!-- Tombol Kembali -->
                <a href="index.php?page=jadwal" class="btn btn-secondary btn-sm mb-3">
                    &laquo; Kembali
                </a>

                <!-- Info Jadwal -->
                <?php
                $info = mysqli_query($koneksi, "SELECT j.*, k.nm_kelas 
                            FROM jadwal_kelas j
                            JOIN kelas k ON j.idd_kelas = k.id_kelas
                            WHERE j.id_jadwal = '$id_jadwal'")
                            or die(mysqli_error($koneksi));
                $data = mysqli_fetch_assoc($info);
                ?>

                <table class="table table-bordered" style="width:50%;">
                    <tr>
                        <th>Kelas</th>
                        <td><?= $data['nm_kelas'] ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Ajaran</th>
                        <td><?= $data['thn_ajaran'] ?></td>
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <td><?= $data['semester'] ?></td>
                    </tr>
                </table>

                <hr>
                <h5>Rincian Jadwal</h5>

                <!-- Tabel Detail -->
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $det = mysqli_query($koneksi, "SELECT d.*, m.nm_mapel, g.nm_guru
                                    FROM detail_jadwal d
                                    JOIN mapel m ON d.kd_mapel = m.kd_mapel
                                    JOIN guru g ON d.kd_guru = g.kd_guru
                                    WHERE d.id_jadwal = '$id_jadwal'")
                                    or die(mysqli_error($koneksi));

                        while ($d = mysqli_fetch_assoc($det)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$d['nm_mapel']}</td>
                                <td>{$d['nm_guru']}</td>
                                <td>{$d['hari']}</td>
                                <td>{$d['jam_mulai']}</td>
                                <td>{$d['jam_selesai']}</td>
                            </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>