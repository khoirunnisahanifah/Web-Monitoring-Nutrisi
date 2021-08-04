<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="https://img.icons8.com/windows/32/000000/hydropponics.png" />
    <title>Web Monitoring Nutrisi Bayam Hidroponik - Daftar</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">


    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/logind.css">
    <link rel="stylesheet" href="../assets/css/components.css">

    <?php
    include 'connect.php';
    if (isset($_POST['submit'])) {
        $username = stripslashes($_POST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        $email = stripslashes($_POST['email']);
        $email = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $nama     = stripslashes($_POST['nama']);
        $nama     = mysqli_real_escape_string($conn, $nama);
        $token = hash('sha256', md5(date('Y-m-d')));

        $cekuser = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
        $baris = mysqli_num_rows($cekuser);
        if ($baris >= 1) {
            echo '<script>
				setTimeout(function() {
					swal({
						title: "Username sudah digunakan",
						text: "Username sudah digunakan, gunakan username lain!",
						icon: "error"
						});
					}, 500);
			</script>';
        } else {
            $add = mysqli_query($conn, "INSERT INTO user (username, email, password, nama, token, aktif) VALUES ('$username', '$email' ,'" . md5($password) . "', '$nama', '".$token."', '0')");
            require_once('../PHPMailer/class.phpmailer.php');
            require_once('../PHPMailer/class.smtp.php');
            $mail = new PHPMailer(true);

            $body      = "Selamat, anda berhasil membuat akun! Untuk mengaktifkan akun anda, silahkan klik link berikut, <a href='https://monitoring-nutrisi-bayam-hidro.herokuapp.com/auth/activation.php?t=".$token."'>Link Aktivasi Akun"; //isi dari email

            // $mail->CharSet =  "utf-8";
            $mail->IsSMTP();
            // enable SMTP authentication
            $mail->SMTPDebug  = 1;
            $mail->SMTPAuth = true;
            // GMAIL username
            $mail->Username = "xx";
            // GMAIL password
            $mail->Password = "xx";
            $mail->SMTPSecure = "ssl";
            // sets GMAIL as the SMTP server
            $mail->Host = "smtp.gmail.com";
            // set the SMTP port for the GMAIL server
            $mail->Port = "465";
            $mail->From = 'xx';
            $mail->FromName = 'Web Monitoring Nutrisi Bayam Hidroponik';

            $email = $_POST['email'];

            $mail->AddAddress($email, 'User Sistem');
            $mail->Subject  =  '"Aktivasi Pendaftaran Akun"';
            $mail->IsHTML(true);
            $mail->MsgHTML($body);
            if ($mail->Send()) {
                echo "<script> alert('Selamat, anda berhasil membuat akun. Untuk mengaktifkan akun anda silahkan klik link dibawah ini.'); window.location = 'mail.html'; </script>";
            } else {
                echo "Mail Error - >" . $mail->ErrorInfo;
            }
        }
    }
    ?>
</head>

<body>
    <div id="app">
    <section class="login-content homepages__login">
      <div class="login-container">
        <div class="login-style">
          <div class="login-coloum pdn-btms">
              <h3 class="clr-h1">Daftar Akun</h3>
              <h6 class="clr-h1">Web Monitoring Nutrisi Bayam Hidroponik </h6>
            <div class="login-brand">
            </div>
                        <p class="text-center">Isi Data Berikut :</p>
                        <form method="POST" action="" class="needs-validation" novalidate="" autocomplete="off">
                            <div class="form-group form-flex">
                                <label for="username" class="form-hidden">Username</label>
                                <i class="fas fa-user-tie fa-lg form-icon"></i>
                                <div class="">
                                    <input id="username" type="text" placeholder="Username" class="form-control form-bord " minlength="2" name="username" tabindex="1" required autofocus>
                                    <div class="invalid-feedback">
                                    Mohon Isikan username! 
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-flex">
                                <div class="d-block">
                                    <label for="email" class="control-label form-hidden">Email</label>
                                </div>
                                <i class="fas fa-envelope fa-lg  form-icon"></i>
                                <div class="">
                                    <input id="email" type="text" placeholder="Email" class="form-control form-bord" name="email" tabindex="2" required>
                                    <div class="invalid-feedback">
                                   Mohon Isikan email anda! 
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
                                    Mohon Isikan password anda !
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-flex">
                                <div class="d-block">
                                    <label for="nama" class="control-label form-hidden">Nama</label>
                                </div>
                                <i class="fas fa-user fa-lg  form-icon"></i>
                                <div class="">
                                    <input id="nama" type="text" placeholder="Nama Lengkap" class="form-control form-bord" name="nama" tabindex="2" required>
                                    <div class="invalid-feedback">
                                    Mohon Isikan Nama Lengkap Anda!
                                    </div>
                                </div>
                            </div>

                            <div class="form-group form-flexs mrg-btm-reset">
                                <button type=" submit" name="submit" class="btn black btn-primary btn-lg btn-block btn-widthlogin" tabindex="4">
                                    Daftar
                                </button>
                            </div>
                            <div id="myId" class="div-syle ">
                                <a href="index.php" class="a-style">
                                    <p class="text-center a-style">Sudah Punya Akun? <span style="text-decoration: underline; font-weight: bold;">Login</span></p>
                                </a>
                            </div>
                        </form>
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


</html>
