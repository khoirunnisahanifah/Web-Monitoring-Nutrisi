<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <link rel="shortcut icon" type="image/x-icon" href="https://img.icons8.com/windows/32/000000/hydropponics.png" />
  <title>Web Monitoring Nutrisi Bayam Hidroponik - Reset Pass</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">


  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/logind.css">
  <link rel="stylesheet" href="../assets/css/components.css">

</head>

<body>
  <div id="app">
    <section class="login-content homepages__login">
      <div class="login-container">
        <div class="login-style">
          <div class="login-coloum pdn-btm">
            <div class="login-brand">
              <h3 class="clr-h1">Reset password Anda!</h3>
            </div>
            <p class="text-center">
            <br/>Mohon Masukkan Password Baru untuk Akun Anda,
            <br/>jangan lupa untuk menuliskan di note atau mengingat
            <br/>password terakhir. 
            <?php
				if($_GET['key'] && $_GET['reset'])
				{
                include 'connect.php';
				$email=$_GET['key'];
				$pass=$_GET['reset']; 
				
				$select=mysqli_query($conn, "SELECT email,password FROM user WHERE email='$email' AND md5(password)='$pass'");
				if(mysqli_num_rows($select)==1)
				{
				?>
            <form method="POST" action="" class="needs-validation" novalidate="" autocomplete="off">
              <div class="form-group form-flex">
                <label for="password" class="form-hidden">Password Baru</label>
                <i class="fas fa-lock fa-lg form-icon"></i>
                <div class="">
                  <input id="password" type="password" placeholder="Password Baru" class="form-control form-bord " minlength="2" name="password" tabindex="1" required autofocus>
                  <input type="hidden" name="email" value="<?php echo $email;?>">
						<input type="hidden" name="pass" value="<?php echo $pass;?>">
                  <div class="invalid-feedback">
                    Mohon isi Email anda dengan benar!
                  </div>
                </div>
              </div>

              <div class="form-group form-flex">
                <div class="d-block">
                  <label for="konfirmasi_password" class="control-label form-hidden">Konfirmasi Password</label>
                </div>
                <i class="fas fa-lock fa-lg  form-icon"></i>
                <div class="">
                  <input id="konfirmasi_password" type="password" placeholder="Konfirmasi Password" class="form-control form-bord" name="konfirmasi" tabindex="2" required>
                  <div class="invalid-feedback">
                    Mohon isi password anda!
                  </div>
                </div>
              </div>

              <div class="form-group form-flex">
                        <button type=" submit" name="submit_password" class="btn black btn-primary btn-lg btn-block btn-width" tabindex="4">
                Send
                </button>
              </div>
            </form>
            <?php
				  } else {
					  echo "Data Tidak Ditemukan";
				  }
				}
				?>
                <?php
if(isset($_POST['submit_password']))
{
include 'connect.php';
  $email=$_POST['email'];
  $pass=$_POST['password'];
  
  $select=mysqli_query($conn, "UPDATE user SET password='" . md5($pass) . "' WHERE email='$email'");
    if($select){
      echo "<script> alert('Berhasil'); window.location = 'index.php'; </script>";
	    
    }else{
      echo '
      <script>
      setTimeout(function() {
        swal({
          title: "Reset Gagal",
          text: "Password tidak sesuai!",
          icon: "error"
          });
          }, 500);
          </script>
          ';
     }
}
?>
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
  <script src="../assets/js/custom.js"></script>
  <!-- Sweet Alert -->
  <script src="../assets/modules/sweetalert/sweetalert.min.js"></script>
  <script src="../assets/js/page/modules-sweetalert.js"></script>
</body>

</html>