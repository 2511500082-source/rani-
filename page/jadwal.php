<?php
if (isset($_GET['hapus'])) {
    $id_jadwal = $_GET['hapus'];

    mysqli_query($koneksi, "DELETE FROM detail_jadwal WHERE id_jadwal = '$id_jadwal'");
    $hapus = mysqli_query($koneksi, "DELETE FROM jadwal_kelas WHERE id_jadwal = '$id_jadwal'");

    if ($hapus) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Berhasil!</strong> Data jadwal telah dihapus.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Gagal!</strong> Tidak dapat menghapus data.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
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

                <a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm mb-2">
                    Tambah Jadwal
                </a>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Kode Jadwal</th>
                            <th>Guru</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Detail Jadwal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "
                            SELECT j.id_jadwal, j.thn_ajaran, j.semester, g.nm_guru
                            FROM jadwal_kelas j
                            LEFT JOIN detail_jadwal d ON j.id_jadwal = d.id_jadwal
                            LEFT JOIN guru g ON d.kd_guru = g.kd_guru
                            GROUP BY j.id_jadwal, j.thn_ajaran, j.semester, g.nm_guru
                        ") or die(mysqli_error($koneksi));

                        while ($row = mysqli_fetch_assoc($query)) {
                            $id = $row['id_jadwal'];

                            $detail_query = mysqli_query($koneksi, "
                                SELECT d.hari, d.jam_mulai, d.jam_selesai, d.nm_kelas,m.nm_mapel
                                FROM detail_jadwal d
                                LEFT JOIN mapel m ON d.kd_mapel = m.kd_mapel
                                WHERE d.id_jadwal = '$id'
                            ");

                            $detail_html = "<ul style='margin:0; padding-left:18px;'>";
                            while ($det = mysqli_fetch_assoc($detail_query)) {
                                $jam_mulai_fmt = date('H.i', strtotime($det['jam_mulai']));
                                $jam_selesai_fmt = date('H.i', strtotime($det['jam_selesai']));
                                $detail_html .= "<li>{$det['nm_mapel']} - {$det['hari']} - {$jam_mulai_fmt}-{$jam_selesai_fmt} - {$det['nm_kelas']}</li>";
                            }
                            $detail_html .= "</ul>";

                            $kode = 'J-'.str_pad($id,3,'0',STR_PAD_LEFT);
                            echo "<tr>
                                <td>{$kode}</td>
                                <td>{$row['nm_guru']}</td>
                                <td>{$row['semester']}</td>
                                <td>{$row['thn_ajaran']}</td>
                                <td>{$detail_html}</td>
                                <td>
                            <a href='index.php?page=jadwal&hapus={$id}'onclick=\"return confirm('Yakin ingin menghapus data ini?')\" class='btn btn-danger btn-sm'>Hapus</a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>