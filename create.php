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
        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nama = input($_POST["nama"]);
            $umur = input($_POST["umur"]);
            $alamat = input($_POST["alamat"]);
            $email = input($_POST["email"]);

            //Query input menginput data kedalam tabel anggota
            $sql = "insert into biodata (nama,umur,alamat,email) values
		('$nama','$umur','$alamat','$email')";

            //Mengeksekusi/menjalankan query diatas
            $hasil = mysqli_query($kon, $sql);

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                header("Location:index.php");
            } else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

            }

        }
        ?>
        <h2>Input Data</h2>


        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label>Nama:</label>
                <input type="text" name="nama" class="form-control" placeholder="Input Nama" required />

            </div>
            <div class="form-group">
                <label>Umur:</label>
                <input type="text" name="umur" class="form-control" placeholder="Input Umur" required />
            </div>
            <div class="form-group">
                <label>Alamat :</label>
                <input type="text" name="alamat" class="form-control" placeholder="Input Alamat" required />
            </div>
            <div class="form-group">
                <label>Email:</label>
                <textarea name="email" class="form-control" rows="5" placeholder="Input Email" required></textarea>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>