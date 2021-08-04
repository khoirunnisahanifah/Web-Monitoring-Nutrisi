<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <link rel="shortcut icon" type="image/x-icon" href="../assets/img/hydropponics.png" alt="" />
  <title>Web Monitoring Nutrisi Bayam Hidroponik - Login</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">


  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/logind.css">
  <link rel="stylesheet" href="../assets/css/components.css">

  <?php
  session_start();
  if (isset($_SESSION['id_user'])) {
    header('location:../');
  } else {
    include 'connect.php';
    if (isset($_POST['submit'])) {
      @$user = mysqli_real_escape_string($conn, $_POST['username']);
      @$pass = mysqli_real_escape_string($conn, $_POST['password']);

      $login = mysqli_query($conn, "SELECT * FROM user WHERE (username='$user' or email='$user') AND password='".md5($pass)."' AND aktif='1'");
      $cek = mysqli_num_rows($login);
      $userid = mysqli_fetch_array($login);

      if ($cek == 0) {
        echo '
        <script>
        setTimeout(function() {
          swal({
            title: "Login Gagal",
            text: "Username atau Password Anda Salah. Mohon periksa kembali form anda!",
            icon: "error"
            });
            }, 500);
            </script>
            ';
      } else {
        header('location:../');
        $_SESSION['id_user'] = $userid['id'];
      }
    }
  ?>
</head>

<body>
  <div id="app">
  
    <section class="login-content homepages__login">
      <div class="login-container">
        <div class="login-style">
          <div class="login-coloum pdn-btm">
          <h1 class="clr-h1">Welcome!  </h1>
              <h6 class="clr-h1">Web Monitoring Nutrisi Bayam Hidroponik</h6>
            <div class="login-brand">
            <img src="https://img.icons8.com/windows/32/000000/hydropponics.png"/>
            </div>
            <p class="text-center">Login:</p>
            <form method="POST" action="" class="needs-validation" novalidate="" autocomplete="off">
              <div class="form-group form-flex">
                <label for="username" class="form-hidden">Username</label>
                <i class="far fa-user fa-lg form-icon"></i>
                <div class="">
                  <input id="username" type="text" placeholder="Username" class="form-control form-bord " minlength="2" name="username" tabindex="1" required autofocus>
                  <div class="invalid-feedback">
                  Mohon masukkan username dengan benar!
                  </div>
                </div>
              </div>

              <div class="form-group form-flex">
                <div class="d-block">
                  <label for="password" class="control-label form-hidden">Password</label>
                </div>
                <i class="fas fa-lock fa-lg  form-icon"></i>
                <div class="">
                  <input id="password" type="password" placeholder="Password" class="form-control form-bord" name="password" tabindex="2" required>
                  <div class="invalid-feedback">
                  Mohon masukkan Password !
                  </div>
                </div>
              </div>
              <div class="div-syle">
                <a href="forget.php" class="a-style">
                  <p class="text-center a-style"><span style="text-decoration: underline"> Lupa Password</p>
                </a>
              </div>
              <div class="form-group form-flexs mrg-btm-reset">
                        <button type="submit" name="submit" class="btn black btn-primary btn-lg btn-block btn-widthlogin" tabindex="4">
                Masuk
                </button>
              </div>
              <div id="myId" class="div-syle ">
                <a href="register.php" class="a-style">
                  <p class="text-center a-style">Tidak Punya Akun? <span style="text-decoration: underline; font-weight: bold;">Daftar Disini</span></p>
                </a>
              </div> 
            </form>
          </div>

        </div>


      </div>
  </div>
  </div>
  </section>
  </div>

  <!-- General JS Scripts -->
  <script src="../assets/modules/jquery.min.js"></script>
  <script src="../assets/modules/popper.js"></script>
  <script src="../assets/modules/tooltip.js"></script>
  <script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="../assets/modules/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  
  <!-- Sweet Alert -->
  <script src="../assets/modules/sweetalert/sweetalert.min.js"></script>
  <script src="../assets/js/page/modules-sweetalert.js"></script>
</body>
<?php } ?>

</html>