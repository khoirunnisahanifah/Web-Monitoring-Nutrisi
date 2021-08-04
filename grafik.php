<?php
  session_start();
  include 'auth/connect.php';
  include "part/head.php";

  

  $sessionid = $_SESSION['id_user'];

  if (!isset($sessionid)) {
    header('location:auth');
  }
  $nama = mysqli_query($conn, "SELECT * FROM user WHERE id=$sessionid"); 
  $output = mysqli_fetch_array($nama);

  $tampilPeg = mysqli_query($conn, "SELECT * FROM tds_riwayat");
  $peg    = mysqli_fetch_array($tampilPeg);
  $data1 = '';

  $tanggal = '';

  ?>
<?php
 
                        $grafik1 = "SELECT * FROM tds_riwayat WHERE id_user=$sessionid ORDER BY id DESC LIMIT 10";
                        $regrafik1 = mysqli_query($conn, $grafik1);
                        
                    
                      //loop through the returned data
                      while ($row = mysqli_fetch_array($regrafik1)) {
                    
                        $data1 = $data1 . '"'. $row['tds_value'].'",';
                        $tanggal = $tanggal . '"'. $row['waktu'] .'",';
                      }
                    
                      $data1 = trim($data1,",");
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
                                    }]
                                },
                            
                                options: {
                                    scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                                    tooltips:{mode: 'index'},
                                    legend:{display: true, position: 'top', labels: {fontColor: 'rgb(0,0,0)', fontSize: 16}}
                                }
                            });
                          </script>