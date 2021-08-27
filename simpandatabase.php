<?php  
 session_start();
 include 'auth/connect.php';
 $sessionid = $_SESSION['id_user'];
 date_default_timezone_set("Asia/Jakarta");

 if (!isset($sessionid)) {
   header('location:auth');
 } 

 if(isset($_POST["tdsValue"]) && isset($_POST["relayAir"]) && isset($_POST["relayNuta"]) && isset($_POST["relayNutb"]) && isset($_POST["relayPengaduk"]) && isset($_POST["minggu"]))
 {
  $tanggal = date('d-m-Y');
  $tds_value = mysqli_real_escape_string($conn, $_POST["tdsValue"]);
  $pompa_air = mysqli_real_escape_string($conn, $_POST["relayAir"]);
  $pompa_nuta = mysqli_real_escape_string($conn, $_POST["relayNuta"]);
  $pompa_nutb = mysqli_real_escape_string($conn, $_POST["relayNutb"]);
  $pompa_pengaduk = mysqli_real_escape_string($conn, $_POST["relayPengaduk"]);
  $minggu = mysqli_real_escape_string($conn, $_POST["minggu"]);
  $waktu = date('H:i:s'); 
  
    //insert post  
    $sql = "INSERT INTO tds_riwayat(id_user, tanggal, waktu, tds_value, pompa_air, pompa_nuta, pompa_nutb, pompa_pengaduk, minggu ) VALUES ('".$_SESSION['id_user']."', '".$tanggal."','".$waktu."','".$tds_value."', '".$pompa_air."','".$pompa_nuta."','".$pompa_nutb."','".$pompa_pengaduk."','".$minggu."')";  
    mysqli_query($conn, $sql);  
    echo mysqli_insert_id($conn);  

 }  
 ?>