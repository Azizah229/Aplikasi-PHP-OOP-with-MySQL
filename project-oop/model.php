<?php

class Model
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $namadatabase = 'tugasproject';
    protected $koneksi;

    function __construct()
    {
        $this->koneksi = new mysqli($this->host, $this->username, $this->password, $this->namadatabase);
        if ($this->koneksi->connect_error) {
            echo 'Koneksi tidak terhubung';
        } else {
            return $this->koneksi;
        }
    }

    public function simpandata($post)
    {
        $nim = $post['nim'];
        $namamhs = $post['namamhs'];
        $jk = $post['jk'];
        $alamat = $post['alamat'];
        $kota = $post['kota'];
        $email = $post['email'];

        $rand = rand();
        $ekstensi = array('pgn', 'jgp', 'jgep');
        $foto = $_FILES['foto']['name'];
        $x = pathinfo($foto, PATHINFO_EXTENSION);

        if (in_array($x, $ekstensi)) {
            header('location:index.php?msg=head');
        } else {
            $x2 = $rand . '_' . $foto;
            move_uploaded_file($_FILES['foto']['tmp_name'], 'image/' . $rand . '_' . $foto);
            $sql = "INSERT INTO tbl_mhs(nim,namamhs,jk,alamat,kota,email,foto) VALUES('$nim','$namamhs','$jk','$alamat','$kota','$email','$x2')";
            $result = $this->koneksi->query($sql);
            if ($result) {
                header('location:index.php?msg=ins');
            } else {
                echo "Error " . $sql . "<br>" . $this->koneksi->error;
            }
        }
    }

    public function lihatdata()
    {
        $sql = "SELECT * FROM tbl_mhs";
        $result = $this->koneksi->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function lihatdatabyId($editid)
    {
        $sql = "SELECT * FROM tbl_mhs WHERE id = '$editid'";
        $result = $this->koneksi->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row;
        }
    }

    public function updatedata($post)
    {
        $nim = $post['nim'];
        $namamhs = $post['namamhs'];
        $jk = $post['jk'];
        $alamat = $post['alamat'];
        $kota = $post['kota'];
        $email = $post['email'];
        $editid = $post['hid'];

        $rand = rand();
        $ekstensi = array('pgn', 'jgp', 'jgep');
        $foto = $_FILES['foto']['name'];
        $x = pathinfo($foto, PATHINFO_EXTENSION);

        if (in_array($x, $ekstensi)) {
            header('location:index.php?msg=head');
        } else {
            $x2 = $rand . '_' . $foto;
            move_uploaded_file($_FILES['foto']['tmp_name'], 'image/' . $rand . '_' . $foto);
            $sql = "UPDATE tbl_mhs SET nim='$nim',namamhs='$namamhs',jk='$jk',alamat='$alamat',kota='$kota',email='$email',foto='$x2' WHERE id='$editid'";
            $result = $this->koneksi->query($sql);
            if ($result) {
                header('location:index.php?msg=ups');
            } else {
                echo "Error " . $sql . "<br>" . $this->koneksi->error;
            }
        }
    }

    public function hapusdata($delid)
    {
        $sql = "DELETE FROM tbl_mhs WHERE id='$delid'";
        $result = $this->koneksi->query($sql);
        if ($result) {
            header('location:index.php?msg=del');
        } else {
            echo "Error " . $sql . "<br>" . $this->koneksi->error;
        }
    }
}
