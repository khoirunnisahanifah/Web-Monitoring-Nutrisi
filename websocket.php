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
  $data2 = '';
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
	<script >
var hostname = "broker.mqttdashboard.com";
var port = 8000;
var clientId = "WebSocket";
clientId += new Date().getUTCMilliseconds();;
var topic = "client_id/hidro/sen1";
var topic2 = "client_id/hidro/reA";
var topic3 = "client_id/hidro/reB";
var topic4 = "client_id/hidro/reAir";
var topic5 = "client_id/hidro/peng";
var topic6 = "client_id/hidro/sen2";

var tds1 = "";
var tds2= "";
var reA = "";
var reB= "";
var reAir = "";
var peng = "";



mqttClient = new Paho.MQTT.Client(hostname, port, clientId);
mqttClient.onMessageArrived = MessageArrived;
mqttClient.onConnectionLost = ConnectionLost;
Connect();

/Initiates a connection to the MQTT broker/
function Connect(){
	mqttClient.connect({
	onSuccess: Connected,
	onFailure: ConnectionFailed,
	keepAliveInterval: 10,
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
	console.log(message.destinationName +" : " + message.payloadString);

	if (message.destinationName == "client_id/hidro/sen1" ) {
		pulse = message.payloadString;
		
		document.getElementById("tds1").innerHTML=pulse;

	} 

	if (message.destinationName == "client_id/hidro/sen2") {
		oksigen = message.payloadString;
		document.getElementById("tds2").innerHTML=oksigen;
	} 

	if (message.destinationName == "client_id/hidro/reA") {
		oksigen = message.payloadString;
		document.getElementById("reA").innerHTML=oksigen;
	} 

	if (message.destinationName == "client_id/hidro/reB") {
		oksigen = message.payloadString;
		document.getElementById("reB").innerHTML=oksigen;
	} 

	if (message.destinationName == "client_id/hidro/reAir") {
		oksigen = message.payloadString;
		document.getElementById("reAir").innerHTML=oksigen;
	} 

	if (message.destinationName == "client_id/hidro/peng") {
		oksigen = message.payloadString;
		document.getElementById("peng").innerHTML=oksigen;
	} 


	
	// var a=parseInt(message.payloadString);
	// var ht=100-a;
	// document.getElementById("top").style.height=""+ht+"%" ;
	// document.getElementById("top").innerHTML=message.payloadString;
	// document.getElementById("container").style.backgroundColor="yellow";
	// switch(message.payloadString){
	// 	case "ON":
	// 		displayClass = "on";
	// 		break;
	// 	case "OFF":
	// 		displayClass = "off";
	// 		break;
	// 	default:
	// 		displayClass = "unknown";
	// }
	// var topic = message.destinationName.split("/");
	// if (topic.length == 3){
	// 	var ioname = topic[1];
	// 	UpdateElement(ioname, displayClass);
	// }
}
		</script>
</head>

<body>
<div class="loading">
    <div class="load">
    <div class="clover"><div class="fade-in"></div>
        <div class="fade-out"></div></div>
      
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
                    <div  class="status status_tds1">
                      <div id="tds1" > 0 </div> 
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
                    <h7> Bayam adalah tanaman hijau yang di tanam selama sekitar 25 hari. </h7> 
                    <h7> Masa Tumbuh Bayam dibagi menjadi 4 minggu atau fase yaitu : </h7> <br/>
                    <h7> 1. Minggu pertama, dibutuhkan sekitar 400-600 PPM nutrisi </h7> <br/>
                    <h7> 2. Minggu kedua, dibutuhkan sekitar 600-900 PPM nutrisi </h7> <br/>
                    <h7> 3. Minggu ketiga, dibutuhkan sekitar 900-1200 PPM nutrisi </h7> <br/>
                    <h7> 4. Minggu keempat, dibutuhkan sekitar 1200-1400 PPM nutrisi </h7> <br/>
 
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
                        
                          <div class="stats__value">OFF</div>
                         
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
                        
                          <div class="stats__value">OFF</div>
                         
                         </div> 
                        
                        <div class="stats_unit stats_unit_power"></div>
                      </div>
                    </div>
                    
                  </div>
                  <div class="dashboard-card__card-piece">
                    <div class="stats__item">
                      <div class="stats__title__nutrisiB">Nutrisi B</div>
                      <div class="stats__icon__nutB"><span class="fa fa-flask"></span></div>
                      <div class="stats__measure">
                        <div id="reB" class="stats__value"> 
                        
                          <div class="stats__value">OFF</div>
                         
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
                          <div class="stats__value">OFF</div>
                        
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
            
                      <?php 
                        $grafik1 = "SELECT * FROM tds_riwayat WHERE id_user=$sessionid";
                        $regrafik1 = mysqli_query($conn, $grafik1);
                        
                    
                      //loop through the returned data
                      while ($row = mysqli_fetch_array($regrafik1)) {
                    
                        $data1 = $data1 . '"'. $row['tds_value1'].'",';
                        $data2 = $data2 . '"'. $row['tds_value2'] .'",';
                        $tanggal = $tanggal . '"'. $row['tanggal'] .'",';
                      }
                    
                      $data1 = trim($data1,",");
                      $data2 = trim($data2,",");
                      $tanggal = trim($tanggal,",");
                      ?>
                        <canvas id="chart" style="overflow: hidden;  width: 100%; height: 300px; background: #ffffff;  margin-top: 10px;"></canvas>
                        <script>
                            var ctx = document.getElementById("chart").getContext('2d');
                              var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: [<?php echo $tanggal; ?>],
                                    datasets: 
                                    [{
                                        label: 'Nutrisi Bak',
                                        data: [<?php echo $data1; ?>],
                                        backgroundColor: 'transparent',
                                        borderColor:'rgba(255,126,101)',
                                        borderWidth: 3
                                    },

                                    {
                                      label: 'Nutrisi Gully',
                                        data: [<?php echo $data2; ?>],
                                        backgroundColor: 'transparent',
                                        borderColor:'rgb(44,128,133)',
                                        borderWidth: 3	
                                    }]
                                },
                            
                                options: {
                                    scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                                    tooltips:{mode: 'index'},
                                    legend:{display: true, position: 'top', labels: {fontColor: 'rgb(0,0,0)', fontSize: 16}}
                                }
                            });
                          </script>
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
</body>

</html>
