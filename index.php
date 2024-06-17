<?php
session_start();
require "functions.php";

$id_user = $_SESSION["id_user"];

$profil = query("SELECT * FROM user_212279 WHERE 212279_id_user = '$id_user'")[0];


if (isset($_POST["simpan"])) {
  if (edit($_POST) > 0) {
    echo "<script>
          alert('Berhasil Diubah');
          </script>";
  } else {
    echo "<script>
          alert('Gagal Diubah');
          </script>";
  }
}


?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Telaga Futsal</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet" />
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>  

  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body style="font-family: 'Montserrat'; overflow-x: hidden;">
  <!-- Navbar -->
  <div class="container " style="background-color: #ffffff;">
    <nav class="navbar fixed-top navbar-expand-lg" style="background-color: #ffffff;">
      <div class="container">
        <a class="nav navbar-brand"  href="index.php">
          <img src="Logo.png" alt="Logo" width="90" height="70" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../index.php" style="color:#ffffff; background-color: #65B741; border-radius: 12px; padding-left: 20px; padding-right: 20px;">Beranda</a>
            </li>
            <li class="nav-item" style="">
              <a class="nav-link" aria-current="page" href="user/lapangan.php" style=" border-radius: 12px; padding-left: 20px; padding-right: 20px;">Sewa Lapangan</a>
            </li>
            <li class="nav-item" >
              <a class="nav-link" aria-current="page" href="user/bayar.php" style=" border-radius: 12px; padding-left: 20px; padding-right: 20px;">Pembayaran</a>
            </li>
          </ul>
          <?php
          if (isset($_SESSION['id_user'])) {
            // jika user telah login, tampilkan tombol profil dan sembunyikan tombol login
            echo '<a href="user/profil.php" data-bs-toggle="modal" data-bs-target="#profilModal" class="btn" style="display: flex; align-items: center; gap: 1em;"><i data-feather="user" style=" width: 30px; height: 30px; padding: 5px; border: solid 1px #000000; border-radius: 20px;"></i></a>';
          } else {
            // jika user belum login, tampilkan tombol login dan sembunyikan tombol profil
            echo '<a href="login.php" class="btn btn-inti" type="submit">Login</a>';
          }
          ?>
        </div>
      </div>
    </nav>
  </div>
  <!-- End Navbar -->

  <!-- Modal Profil -->
  <div class="modal fade" id="profilModal" tabindex="-1" aria-labelledby="profilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="profilModalLabel">Profil Pengguna</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="row">
              <div class="col-4 my-5">
                <img src="img/<?= $profil["212279_foto"]; ?>" alt="Foto Profil" class="img-fluid ">
              </div>
              <div class="col-8">
                <h5 class="mb-3"><?= $profil["212279_nama_lengkap"]; ?></h5>
                <p><?= $profil["212279_jenis_kelamin"]; ?></p>
                <p><?= $profil["212279_email"]; ?></p>
                <p><?= $profil["212279_no_handphone"]; ?></p>
                <p><?= $profil["212279_alamat"]; ?></p>
                <a href="logout.php" class="btn btn-danger">Logout</a>
                <a href="" data-bs-toggle="modal" data-bs-target="#editProfilModal" class="btn btn-inti">Edit Profil</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Profil -->

  <!-- Edit profil -->
  <div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
    <div class="modal-dialog edit modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfilModalLabel">Edit Profil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="fotoLama" class="form-control" id="exampleInputPassword1" value="<?= $profil["212279_foto"]; ?>">
          <div class="modal-body">
            <div class="row justify-content-center align-items-center">
              <div class="mb-3">
                <img src="img/<?= $profil["212279_foto"]; ?>" alt="Foto Profil" class="img-fluid ">
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Nama Lengkap</label>
                  <input type="text" name="212279_nama_lengkap" class="form-control" id="exampleInputPassword1" value="<?= $profil["212279_nama_lengkap"]; ?>">
                </div>
                <div class="mb-3">
                  <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                  <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" <?php if ($profil['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php if ($profil['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="mb-3">
                  <label for="212279_no_handphone" class="form-label">No Telp</label>
                  <input type="number" name="212279_no_handphone" 212279_class="form-control" id="exampleInputPassword1" value="<?= $profil["212279_no_handphone"]; ?>">
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="exampleInputPassword1" value="<?= $profil["212279_email"]; ?>">
                </div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">212279_alamat</label>
                <input type="text" name="212279_alamat" class="form-control" id="exampleInputPassword1" value="<?= $profil["212279_alamat"]; ?>">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Foto : </label>
                <input type="file" name="212279_foto" class="form-control" id="exampleInputPassword1">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-inti" name="simpan" id="simpan">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Edit Modal -->

  <!-- Jumbotron -->
  <section class="jumbotron" id="home" style="height: 700px; ">
    <main class="contain" data-aos="fade-right" data-aos-duration="1000">
      <h1 class="text-light shadow shadow-5" style="font-weight: 900; font-size: 64px;">Let's Have a Match in <span style="font-family: Inter;">Telaga Futsal</span> </h1>
      <p class="shadow shadow-5" style="margin-left: 1%;">
        <b>Click, Booking and Playing with Your Friends</b>
      </p>
      <a href="user/lapangan.php" class="btn px-5 py-2.5 shadow shadow-5" style="font-size: 15px; background-color: #EE7214; color: #ffffff;">Booking Sekarang</a>
    </main>
  </section>
  <!-- End Jumbotron -->

  <!-- About -->
  <section class="about" id="about">

    <div class="row d-flex" style="align-items: center;">
      <div class="about-img shadow shadow-3" data-aos="fade-right" data-aos-duration="1000">
        <img src="img/futsal.jpg" alt="" style=""/>
      </div>
      <div class="contain " data-aos="fade-left" data-aos-duration="1000">
        <h2 data-aos="fade-down" data-aos-duration="1000" style=" font-family: inter;">
          <span><b>Tentang </span>Kami</b> 
        </h2>
        <p>Telaga Futsal adalah tempat yang menyediakan berbagai fasilitas dan layanan penyewaan lapangan futsal untuk berbagai berbagai kalangan. Tempat ini dirancang untuk memfasilitasi kegiatan olahraga futsal bagi kelompok dan komunitas yang memiliki minat olahraga futsal. Setiap lapangan dilengkapi dengan fasilitas yang lengkap, guna mendukung keseruan olahraga bersama.</p>
      </div>
    </div>
  </section>
  <!-- End About -->

  <!-- Pembayaran -->
  <section class="pembayaran" id="bayar">
    <h2 data-aos="fade-down" data-aos-duration="1000" style=" font-family: inter; font-weight: bolder;">
      <span>Tata Cara</span> Pembayaran
    </h2>
    <p class="text-start"><span style="font-weight: bolder;">Berikut adalah tata cara pembayaran lapangan pada website Telaga Futsal:</span></p>
    <ul class="border list-group list-group-flush mt-4">
      <li class="list-group-item">1. Pengguna harus membuat akun atau mendaftar sebagai anggota pada website Sport Center.</li>
      <li class="list-group-item">2. Pengguna dapat memilih jenis lapangan yang ingin dipesan, memilih tanggal dan waktu tertentu.</li>
      <li class="list-group-item">3. Pengguna harus memilih tanggal dan waktu, melihat harga sewa lapangan, mengisi jumlah jam atau durasi, melengkapi formulir pemesanan.</li>
      <li class="list-group-item">4. Bila Dirasa sudah sesuai, pengguna dapat meng klik tombol pesan.</li>
      <li class="list-group-item">5. Lalu pengguna akan diarahkan ke menu pembayaran</li>
      <li class="list-group-item">6. Lakukan pembayaran ke rekening yang sudah tertera dan upload bukti pembayaran</li>
      <li class="list-group-item">7. Setelah upload, tunggu admin menyetujui pembayaran anda</li>
      <li class="list-group-item">8. Setelah status sudah di setujui, silahkan datang ke Sport Center sesuai jadwal yang di pesan</li>
    </ul>
  </section>
  <!-- End Pembayaran -->

  <!-- Contact 
  <section id="contact" class="contact" data-aos="fade-down" data-aos-duration="1000" >
    <h2 style=" font-family: inter; font-weight: bolder;"><span>Kontak</span> Kami</h2>
    <p class="text-center mt-2">
      Hubungi kami jika ada saran yang ingin di sampaikan
    </p>
    <div class="row">
      <div class="col">
        <form action="">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i data-feather="mail"></i></span>
            </div>
            <input type="text" name="" id="" placeholder="E-mail" class="form-control" />
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i data-feather="phone"></i></span>
            </div>
            <input type="text" name="" id="" placeholder="Nomor Telepon" class="form-control" />
          </div>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i data-feather="message-square"></i></span>
            </div>
            <input type="text" name="" id="" placeholder="Kritik/Saran" class="form-control" />
          </div>
          <button type="submit" class="btn px-5 py-2.5 mt-3 shadow shadow-3" style="font-size: 15px; background-color: #EE7214; color: #ffffff;">Kirim Pesan</button>
        </form>
      </div>
    </div>
  </section>-->
  <!-- End Contact -->

  <!-- footer -->
  <footer class="px-5 pt-3 pb-3 mb-0" style="background-color: #f7f7f7">
        <div class="row">

            <div class="col-sm-6 mb-3 mb-sm-0" style="background-color: #64646400;">
              <div class="card" style="border-color: #64646400; background-color: #64646400; margin-left:20px;">
                <div class="card-body">
                    <img src="Logo.png" class="rounded float-start" alt="Telaga Futsal" style="width: 120px; height: 96px;"> <br><br><br><br>
                    <p class="card-text text-start" style="margin-bottom: 0px;">Jl. Perumnas, Dabag, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281</p>
                    <p class="card-text text-start" style="margin-bottom: 0px;">Buka Jam 07.00 - 23.59</p>
                    <p class="card-text text-start" style="margin-bottom: 0px;"> <i class="bi bi-telephone-fill"> </i> 0818-278-300</p>
                </div>
              </div>
            </div>

            <div class="col-sm-6" >
              <div class="card" style="border-color: #64646400; background-color: #64646400;">
                <div class="card-body">
                    <div class="mapouter shadow shadow-5">
                      <div class="gmap_canvas" style="overflow: hidden; ">
                        <iframe width="583" height="312" id="gmap_canvas" src="https://maps.google.com/maps?q=Jl.+Perumnas%2C+Dabag%2C+Condongcatur%2C+Kec.+Depok%2C+Kabupaten+Sleman%2C+Daerah+Istimewa+Yogyakarta+55281&t=&z=16&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                        </iframe>
                        <a href="https://textcaseconvert.com"></a><br><a href="https://www.intimer.net"></a><br><style>.mapouter{position: relative; text-align: right; height: 312px;width: 500px;}</style><a href="https://www.ongooglemaps.com">google map for my website</a><style>.gmap_canvas{overflow: hidden;background: none !important;height: 312px;width: 500px;}</style>
                      </div>
                    </div>
                </div>
              </div>
            </div>

        </div>
      </footer>
  <!-- End Footer -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script>
    feather.replace();
  </script>
</body>

</html>