<!DOCTYPE html>
<html>

<head>
    <title>Form Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php
        //Include file koneksi, untuk koneksikan ke database
        include "koneksi.php";

        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id
        if (isset($_GET['id'])) {
            $id = input($_GET["id"]);

            $sql = "select * from biodata where id=$id";
            $hasil = mysqli_query($kon, $sql);
            $data = mysqli_fetch_assoc($hasil);
        }

        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $id = htmlspecialchars($_POST["id"]);
            $nama = input($_POST["nama"]);
            $npm = input($_POST["umur"]);
            $kelas = input($_POST["alamat"]);
            $alamat = input($_POST["email"]);

            //Query update data pada tabel anggota
            $sql = "update biodata set
			nama='$nama',
			umur='$umur',
			alamat='$alamat',
			email='$email'
			where id=$id";

            //Mengeksekusi atau menjalankan query diatas
            $hasil = mysqli_query($kon, $sql);

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                header("Location:index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

            }

        }

        ?>
        <h2>Update Data</h2>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" class="form-control" placeholder="Input Nama" required />

            </div>
            <div class="form-group">
                <label>umur:</label>
                <input type="text" name="umur" class="form-control" placeholder="Input Umur" required />
            </div>
            <div class="form-group">
                <label>alamat :</label>
                <input type="text" name="alamat" class="form-control" placeholder="Input Alamat" required />
            </div>
            <div class="form-group">
                <label>email:</label>
                <textarea name="email" class="form-control" rows="5" placeholder="Input Email" required></textarea>
            </div>

            <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>