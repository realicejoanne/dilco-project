<?php

if(isset($_POST["submit"])){
    $id = $_POST["id"];
    $idjurusan = $_POST["jurusan_id"];
    $idkelas = $_POST["kelas_id"];
    $idmapel = $_POST["mapel_id"];
    $materi = $_POST["materi"];
    mysqli_query($connection, "INSERT INTO materi VALUES('$id','$idjurusan','$idkelas','$idmapel','$materi', '$konten')");
    header("location:index.php?materi");
}

$jurusan = mysqli_query($connection, "SELECT * FROM jurusan ORDER BY id ASC");

$kelas = mysqli_query($connection, "SELECT * FROM kelas ORDER BY id ASC");

$mapel = mysqli_query($connection, "SELECT * FROM mata_pelajaran ORDER BY id ASC");

$materi = mysqli_query($connection, "SELECT materi.*, jurusan.jurusan, kelas.kelas, mata_pelajaran.mata_pelajaran
                                    FROM materi, jurusan, kelas, mata_pelajaran
                                    WHERE materi.jurusan_id = jurusan.id
                                    AND materi.kelas_id = kelas.id
                                    AND materi.mapel_id = mata_pelajaran.id
                                    ORDER BY materi.id ASC");

?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Database &raquo; Materi</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Input Data
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" action="" method="post">
                            
                            <div class="form-group">
                                <label>Jurusan</label>
                                <select class="form-control" name="jurusan_id" required>
                                    <option value="">Pilih...</option>
                                    <?php if(mysqli_num_rows($jurusan)){?>
                                        <?php while ($row_jurusan=mysqli_fetch_array($jurusan)){?>
                                        <option value="<?php echo $row_jurusan["id"]?>"> <?php echo $row_jurusan["jurusan"]?> </option>
                                        <?php }?>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kelas</label>
                                <select class="form-control" name="kelas_id" required>
                                    <option value="">Pilih...</option>
                                    <?php if(mysqli_num_rows($kelas)){?>
                                        <?php while ($row_kelas=mysqli_fetch_array($kelas)){?>
                                        <option value="<?php echo $row_kelas["id"]?>"> <?php echo $row_kelas["kelas"]?> </option>
                                        <?php }?>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Mata Pelajaran</label>
                                <select class="form-control" name="mapel_id" required>
                                    <option value="">Pilih...</option>
                                    <?php if(mysqli_num_rows($mapel)){?>
                                        <?php while ($row_mapel=mysqli_fetch_array($mapel)){?>
                                        <option value="<?php echo $row_mapel["id"]?>"> <?php echo $row_mapel["mata_pelajaran"]?> </option>
                                        <?php }?>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Judul Bab Materi</label>
                                <input class="form-control" type="text" name="materi" required/>
                            </div>
                            <button type="submit" name="submit" class="btn btn-success">Save</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                List Data
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Bab</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>   
                        <?php if (mysqli_num_rows($materi)){?>
                        <?php while($row_materi = mysqli_fetch_array($materi)){?>
                            <tr>
                                <td><?php echo $row_materi["id"]?></td>
                                <td><?php echo $row_materi["jurusan"]?></td>
                                <td><?php echo $row_materi["kelas"]?></td>
                                <td><?php echo $row_materi["mata_pelajaran"]?></td>
                                <td><?php echo $row_materi["materi"]?></td>
                                <td class="center">
									<a href="index.php?materi-update=<?php echo $row_materi["id"]?>" class="btn btn-warning btn-xs" type="button">Ubah</a>
									<a href="index.php?materi-delete=<?php echo $row_materi["id"]?>" class="btn btn-danger btn-xs" type="button">Hapus</a>
								</td>
                            </tr>
                        <?php }?>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>