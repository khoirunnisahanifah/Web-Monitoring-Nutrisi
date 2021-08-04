<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Dashboard";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
  include 'part_func/tgl_ind.php';
  

  $sessionid = $_SESSION['id_user'];

  if (!isset($sessionid)) {
    header('location:auth');
  }
  $nama = mysqli_query($conn, "SELECT * FROM user WHERE id=$sessionid"); 
  $output = mysqli_fetch_array($nama);

  $tampilPeg = mysqli_query($conn, "SELECT * FROM tds_riwayat WHERE id_user=$sessionid");
  $peg    = mysqli_fetch_array($tampilPeg);
  $data1 = '';

  $tanggal = '';

  ?>
  <style>
    #link-no {
      text-decoration: none;
    }
  </style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css" integrity="sha512-C7hOmCgGzihKXzyPU/z4nv97W0d9bv4ALuuEbSf6hm93myico9qa0hv4dODThvCsqQUmKmLcJmlpRmCaApr83g==" crossorigin="anonymous" />
  <link rel="stylesheet" href="assets/css/dash.css"/>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js" type="text/javascript"></script>
	<script >
var hostname = "broker.emqx.io";
var port = 8084;
var sessionId = "<?php echo $_SESSION['id_user'] ?>";
var clientId = sessionId;
var topic = "client_id/hidro/sen1";
var topic2 = "client_id/hidro/reAir";
var topic3 = "client_id/hidro/reA";
var topic4 = "client_id/hidro/reB";
var topic5 = "client_id/hidro/peng";
var topic6 = "client_id/hidro/waktu";
var topic7 = "client_id/hidro/mingg";

var tds1 = "";
var reAir = "";
var reA = "";
var reB= "";
var peng = "";
var waktu="";
var mingg="";


mqttClient = new Paho.MQTT.Client(hostname, port, clientId);
mqttClient.onMessageArrived = MessageArrived;
mqttClient.onConnectionLost = ConnectionLost;
Connect(clientId);

console.log(clientId);

/Initiates a connection to the MQTT broker/
function Connect(){
	mqttClient.connect({
	onSuccess: Connected,
	onFailure: ConnectionFailed,
	keepAliveInterval: 10,
useSSL: true,
});
}

/*Callback for successful MQTT connection */
function Connected() {
	console.log("Connected to broker");
	mqttClient.subscribe(topic);
  mqttClient.subscribe(topic2);
	mqttClient.subscribe(topic3);
	mqttClient.subscribe(topic4);
	mqttClient.subscribe(topic5);
  mqttClient.subscribe(topic6);
  mqttClient.subscribe(topic7);
}

/Callback for failed connection/
function ConnectionFailed(res) {
	console.log("Connect failed:" + res.errorMessage);
}

/Callback for lost connection/
function ConnectionLost(res) {
	if (res.errorCode !== 0) {
		console.log("Connection lost:" + res.errorMessage);
		Connect();
	}
}

/*Callback for incoming message processing */
function MessageArrived(message) {
  date = new Date();
  millisecond = date.getMilliseconds();
  detik = date.getSeconds();
  menit = date.getMinutes();
  jam = date.getHours();
	console.log(message.destinationName +" : " + message.payloadString +" "+jam+" : "+menit+" : "+detik+"."+millisecond);
	
	if (message.destinationName == "client_id/hidro/sen1" ) {
		tds1 = message.payloadString;
		document.getElementsByClassName("tds_value")[0].innerHTML=tds1;
} 
  if (message.destinationName == "client_id/hidro/reAir") {
		reAir = message.payloadString;
		document.getElementsByClassName("pompa_air")[0].innerHTML=reAir;
	} 

	if (message.destinationName == "client_id/hidro/reA") {
		reA = message.payloadString;
		document.getElementsByClassName("pompa_nuta")[0].innerHTML=reA;
	} 

	if (message.destinationName == "client_id/hidro/reB") {
		reB = message.payloadString;
		document.getElementsByClassName("pompa_nutb")[0].innerHTML=reB;
	} 

	if (message.destinationName == "client_id/hidro/peng") {
		peng = message.payloadString;
		document.getElementsByClassName("pompa_pengaduk")[0].innerHTML=peng;
	} 
  if (message.destinationName == "client_id/hidro/waktu") {
		waktu = message.payloadString;
		document.getElementsByClassName("waktu")[0].innerHTML=waktu;
	} 
  if (message.destinationName == "client_id/hidro/mingg") {
		mingg = message.payloadString;
		document.getElementsByClassName("mingg")[0].innerHTML=mingg;
	} 



}
		</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
<div class="loading">
    <div class="load">
     <div class="clover">
    
    <div class="fade-in"></div>
    <div class="fade-out"></div>
    </div>
      
    </div>
  </div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <?php
      include 'part/navbar.php';
      include 'part/sidebar.php';
      ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="containerdash">
            <div class="dashboard">
              <div class="dashboard-card tds1">
                <div class="dashboard-card__title"> Nilai Nutrisi Bak</div>
                <div class="dashboad-card__content"> 
                <div class="img-dashboard"> <img src="assets/img/tds.png"/> </div>
                  <div class="dashboard-card__card-piece">
                    <div class="status status_tds1">
                    <div id="tds1"><textarea style="font-weight: bold; color: #FF7E65;" readonly name="tds_value" class="tds_value"  placeholder="0"  rows="1" cols="1" required></textarea> </div>
                      <div class="stats__unit stats__PPM"></div> 
                    </div>
                    <a href="tds_riwayat.php" class="dashboard-card__link" tabindex="1">Riwayat<span class="fa fa-angle-right"></span></a>
                  </div>
                </div>
              </div>
              <div class="dashboard-card tds2">
                <div class="dashboard-card__title">Ilustrasi Hidroponik</div>
                <div class="dashboad-card__content">
                <div class="img-dashboard"> </div>
                  <div class="dashboard-card__card-piece">
                                 
                <img class="animated-gif" src="assets\img\hidro.gif">
                  </div>
                </div>
              </div>
              <div class="dashboard-card informasi">
                <div class="dashboard-card__title"><img src="https://img.icons8.com/pastel-glyph/30/000000/information--v2.png"/>  Informasi </div>
                <div class="dashboad-card__content">
                  <div class="dashboard-card__card-piece">
                  <!-- <div class="light-switches">
                      <div class="switch switch_order-1">
                        <div class="switch__name">Minggu 1</div>
                        <input type="checkbox" id="switch1" class="switch__input" tabindex="1" ></input>
                        <label for="switch1" class="switch__label"></label>
                      </div>
                      <div class="switch switch_order-1">
                        <div class="switch__name">Minggu 2</div>
                        <input type="checkbox" id="switch2" class="switch__input" tabindex="2" focus> </input>
                        <label for="switch2" class="switch__label"></label>
                      </div>
                      <div class="switch switch_order-2">
                        <div class="switch__name">Minggu 3</div>
                        <input type="checkbox" id="switch3" class="switch__input" tabindex="3"></input>
                        <label for="switch3" class="switch__label"></label>
                      </div>
                      <div class="switch switch_order-2">
                        <div class="switch__name">Minggu 4</div>
                        <input type="checkbox" id="switch4" class="switch__input" tabindex="4"></input>
                        <label for="switch4" class="switch__label"></label>
                      </div> -->
                  <div class="dash_info_teks"> 
                  <div id="mingg">Batas Nutrisi : <textarea style="font-weight: 900; color: #333;" readonly name="mingg" class="mingg" placeholder="Tekan Nomor " rows="1" cols="1" required></textarea>  </div>
                    <h7> Bayam adalah tanaman hijau yang di tanam selama sekitar 30 hari. </h7> 
                    <h7> Masa Tumbuh Bayam dibagi menjadi 4 minggu atau fase yaitu : </h7> <br/>
                    <h7> - Minggu kesatu, semai </h7> <br/>
                    <h7> - Minggu kedua, dibutuhkan sekitar 600-900 PPM nutrisi (1) </h7> <br/>
                    <h7> - Minggu ketiga, dibutuhkan sekitar 900-1200 PPM nutrisi (2)</h7> <br/>
                    <h7> - Minggu keempat, dibutuhkan sekitar 1200-1400 PPM nutrisi(3) </h7> <br/>
                    <h7>  </h7> <br/>
                    <h7> Ganti batas nilai nutrisi dengan keypad: </h7> <br/>
                    <h7> 1.Tekan tombol no.1-3 untuk menentukan kadar nutrisi yang dibutuhkan </h7> <br/>
                    <h7> 2.Jika ganti kebutuhan nutrisi, tekan tombol 4 dulu  untuk berhenti, lalu tekan tombol kebutuhan nutrisi. </h7> <br/>
 
                  </div>
                  </div>
                </div>
                  
              </div>
              <div class="dashboard-card pompa">
                <div class="dashboard-card__title"><img src="https://img.icons8.com/windows/32/000000/water-pipe.png"/></span>PUMP</div>
                <div class="dashboad-card__content">
                <div class="dashboard-card__card-piece">
                    <div class="stats__item">
                      <div class="stats__title">Air</div>
                      <div class="stats__icon"><span class="fa fa-tint"></span></div>
                      <div class="stats__measure">
                        <div id="reAir" class="stats__value"> 
                        
                          <div class="stats__value"><textarea style="font-weight: 900; color: #333;" readonly name="pompa_air" class="pompa_air" placeholder="OFF" rows="1" cols="1" required></textarea> </div>
                         
                         </div> 
                        
                        <div class="stats_unit stats_unit_power"></div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="dashboard-card__card-piece">
                    <div class="stats__item">
                      <div class="stats__title__nutrisi">Nutrisi A</div>
                      <div class="stats__icon__nuta"><span class="fa fa-flask"></span></div>
                      <div class="stats__measure">
                        <div id="reA" class="stats__value"> 
                        
                          <div class="stats__value"><textarea style="font-weight: 900; color: #333;" readonly name="pompa_nuta" class="pompa_nuta" placeholder="OFF" rows="1" cols="1" required></textarea> </div>
                         
                         </div> 
                        
                        <div class="stats_unit stats_unit_power"></div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="dashboard-card__card-piece">
                    <div class="stats__item">
                      <div class="stats__title__nutrisiB">Nutrisi A</div>
                      <div class="stats__icon__nutB"><span class="fa fa-flask"></span></div>
                      <div class="stats__measure">
                        <div id="reB" class="stats__value"> 
                        
                          <div class="stats__value"><textarea style="font-weight: 900; color: #333;" readonly name="pompa_nutb" class="pompa_nutb" placeholder="OFF" rows="1" cols="1" required></textarea> </div>
                         
                         </div> 
                        
                        <div class="stats_unit stats_unit_power"></div>
                      </div>
                    </div> 
                    
                  </div>
                  <div class="dashboard-card__card-piece">
                    <div class="stats__item">
                      <div class="stats__title__pengaduk">Pengaduk</div>
                      <div class="stats__icon__pengaduk"><span class="fa fa-i-cursor"></span></div>
                      <div class="stats__measure">
                        <div id="peng" class="stats__value">
                          <div class="stats__value"><textarea style="font-weight: 900; color: #333;" readonly name="pompa_pengaduk" class="pompa_pengaduk" placeholder="OFF" rows="1" cols="1" required></textarea></div>
                        
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="containergrafiktds">
            <div class="dashboardgrafik">
              <div class="dashboard-card grafiktds">
               <div class="dashboard-card__title">Grafik Nilai Nutrisi </div>
                <div class="dashboad-card__content">
                  <div class="dashboard-card__card-piece">
                   <div class="chart"></div>
                  </div>  
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php include 'part/footer.php'; ?>
    </div>
  </div>

  <?php include "part/all-js.php"; ?>

  <script src="./assets/js/loading.js"></script>
  <script>  
 $(document).ready(function(){  
      function autoSave()  
      {  
           var tds_value = $('.tds_value').val();  
           var pompa_air = $('.pompa_air').val(); 
           var pompa_nuta = $('.pompa_nuta').val();  
           var pompa_nutb = $('.pompa_nutb').val();
           var pompa_pengaduk = $('.pompa_pengaduk').val();  
           var id_user = "<?php echo $_SESSION['id_user'] ?>";  
           if(tds_value != '' && pompa_air != '' && pompa_nuta != '' && pompa_nutb != '' && pompa_pengaduk != '' )  
           {  
                $.ajax({  
                     url:"simpandatabase.php",  
                     method:"POST",  
                     data:{tdsValue:tds_value, relayAir:pompa_air, relayNuta:pompa_nuta, relayNutb:pompa_nutb, relayPengaduk:pompa_pengaduk, clientID:id_user},  
                     dataType:"text",  
                     success:function(data)  
                     {  
                          if(data != '')  
                          {  
                               $('#id_user').val(data);  
                          }  
                     }  
                });  
           }            
      }  
      setInterval(function(){   
           autoSave();   
           }, 60000);  //save tiap 1 menit
 });  
 </script>
 <script type="text/javascript">
    var auto_refresh = setInterval(
    function () {
       $('.chart').load('grafik.php').fadeIn("slow");
    }, 5000); // refresh setiap 30 seconds
    
</script>
</body>

</html>