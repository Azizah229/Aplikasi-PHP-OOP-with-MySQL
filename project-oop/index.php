<?php

include 'model.php';

$object = new Model();

if (isset($_POST['simpan'])) {
    $object->simpandata($_POST);
}

if (isset($_POST['update'])) {
    $object->updatedata($_POST);
}

if (isset($_GET['hapusid'])) {
    $delid = $_GET['hapusid'];
    $object->hapusdata($delid);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Aplikasi PHP OOP</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body><br>
    <h2 class="text-center text-info">Data Mahasiswa</h2><br>
    <div class="container">
        <?php
        if (isset($_GET['msg']) and $_GET['msg'] == 'ins') {
            echo '<div class="alert alert-success" role="alert">
            Data Berhasil Disimpan...!
          </div>';
        }

        if (isset($_GET['msg']) and $_GET['msg'] == 'ups') {
            echo '<div class="alert alert-success" role="alert">
            Data Berhasil Diupdate...!
          </div>';
        }

        if (isset($_GET['msg']) and $_GET['msg'] == 'del') {
            echo '<div class="alert alert-success" role="alert">
            Data Berhasil Dihapus...!
          </div>';
        }

        if (isset($_GET['msg']) and $_GET['msg'] == 'head') {
            echo '<div class="alert alert-success" role="alert">
            Data yang Anda Masukkan Salah!
          </div>';
        }

        ?>

        <?php
        if (isset($_GET['editid'])) {
            $editid = $_GET['editid'];
            $penyimpanan = $object->lihatdatabyId($editid);

        ?>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="nim" value="<?php echo $penyimpanan['nim']; ?>" placeholder="Masukkan NIM" class="form-control">
                </div>
                <div class="form-group">
                    <label>Nama Mahasiswa</label>
                    <input type="text" name="namamhs" value="<?php echo $penyimpanan['namamhs']; ?>" placeholder="Masukkan Nama Lengkap" class="form-control">
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <input type="text" name="jk" value="<?php echo $penyimpanan['jk']; ?>" placeholder="Masukkan Jenis Kelamin" class="form-control">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" value="<?php echo $penyimpanan['alamat']; ?>" placeholder="Masukkan Alamat" class="form-control">
                </div>
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" name="kota" value="<?php echo $penyimpanan['kota']; ?>" placeholder="Masukkan Kota" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="<?php echo $penyimpanan['email']; ?>" placeholder="Masukkan E-mail mahasiswa" class="form-control">
                </div>
                <div class="form-group">
                    <label>Foto Mahasiswa</label>
                    <input type="file" name="foto" value="<?php echo $penyimpanan['foto']; ?>" placeholder="Masukkan foto formal" class="form-control" required />
                </div>
                <div class="form-group">
                    <input type="hidden" name="hid" value="<?php echo $penyimpanan['id']; ?>">
                    <input type="submit" name="update" value="Update" class="btn btn-info">
                </div>
            </form>
        <?php
        } else {
        ?>
            <form action="index.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="nim" placeholder="Masukkan NIM" class="form-control">
                </div>
                <div class="form-group">
                    <label>Nama Mahasiswa</label>
                    <input type="text" name="namamhs" placeholder="Masukkan Nama Lengkap" class="form-control">
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <input type="text" name="jk" placeholder="P/L" class="form-control">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" placeholder="Masukkan Alamat" class="form-control">
                </div>
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" name="kota" placeholder="Masukkan Kota" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Masukkan E-mail mahasiswa" class="form-control">
                </div>
                <div class="form-group">
                    <label>Foto Mahasiswa</label>
                    <input type="file" name="foto" placeholder="Masukkan foto formal" class="form-control" required/>
                </div>
                <div class="form-group">
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-info">
                </div>
            </form>
        <?php } ?>

        <br>
        <h4 class="text-center text-danger">Daftar Mahasiswa</h4>
        <table class="table table-bordered">
            <tr class="bg-primary text-center">
                <th>No.</th>
                <th>NIM</th>
                <th>Nama Lengkap</th>
                <th>L/P</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>Email</th>
                <th>Foto</th>
            </tr>
            <?php
            $row = $object->lihatdata();
            $sno = 1;
            foreach ($row as $value) {
            ?>
                <tr class="text-center">
                    <td><?php echo $sno++; ?></td>
                    <td><?php echo $value['nim']; ?></td>
                    <td><?php echo $value['namamhs']; ?></td>
                    <td><?php echo $value['jk']; ?></td>
                    <td><?php echo $value['alamat']; ?></td>
                    <td><?php echo $value['kota']; ?></td>
                    <td><?php echo $value['email']; ?></td>
                    <td>
                        <img src="image/<?php echo $value['foto']?>" style="width: 80px;" style="100px">
                    </td>
                    <td>
                        <a href="index.php?editid=<?php echo $value['id']; ?>" class="btn btn-warning"> Edit</a>
                        <a href="index.php?hapusid=<?php echo $value['id']; ?>" class="btn btn-danger"> Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>