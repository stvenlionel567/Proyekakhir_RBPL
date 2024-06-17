<?php
session_start();
require "functions.php";


if (isset($_SESSION["role"])) {
  $role = $_SESSION["role"];
  if ($role == "Admin") {
    header("Location: admin/home.php");
  } else {
    header("Location: user/lapangan.php");
  }
}

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $cariadmin = query("SELECT * FROM admin_212279 WHERE 212279_email = '$username' AND 212279_password = '$password'");
  $cariuser = query("SELECT * FROM user_212279 WHERE 212279_email = '$username' AND 212279_password = '$password'");

  if ($cariadmin) {
    // set session
    $_SESSION['username'] = $cariadmin[0]['212279_nama'];
    $_SESSION['role'] = "Admin";
    header("Location: admin/admin.php");
  } else if ($cariuser) {
    // set session
    $_SESSION['username'] = $cariuser[0]['212279_nama_lengkap'];
    $_SESSION['email'] = $cariuser[0]['212279_email'];
    $_SESSION['id_user'] = $cariuser[0]['212279_id_user'];
    $_SESSION['role'] = "User";
    header("Location: user/lapangan.php");
  } else {
    echo "<div class='alert alert-warning'>Username atau Password salah</div>
    <meta http-equiv='refresh' content='2'>";
  }

}



?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Reset Sandi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>  
  <style>
    .btn-inti{
      border-radius: 12px;
    }

    .btn-inti:hover{
      background-color: #468a29 !important;
    }
  </style>
</head>

<body class="login" style="overflow: hidden; backgrounf-color: #ffffff;"> 
  <div class="center ms-5 pt-3" style=" border: solid 1px #ffffff80; width: 30%; left:47%;">
    <h1 class="pb-0 " style="font-weight: bolder; font-family: inter; font-size: 30px;">Reset Sandi</h1>
    <h6 class="pb-0 text-center" style="font-family: montserrat; font-size:14px;">Masukan Sandi Baru Anda</h6>
    <form method="POST" action="cek.php">
      <div class="txt_field">
        <input type="text" name="newpassword" required>
        <span></span>
        <label>Sandi Baru</label>
      </div>
      <div class="txt_field">
        <input type="text" name="newpassword1" required>
        <span></span>
        <label>Konfirmasi Sandi</label>
      </div>

      <button class="button btn-inti mb-4" name="sandibaru" id="sandibaru" style="background-color: #000000; width: 100%; color:#ffffff; font-weight: bold; font-size: 12px;">Reset Sandi</button>
    </form>
  </div>

</body>


</html>