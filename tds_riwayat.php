<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Riwayat";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
  include 'part/navbar.php';
  include 'part/sidebar.php';
  include "part_func/waktu.php";
 
  ?>
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js" type="text/javascript"></script>
</script>
 <script type="text/javascript">
    var auto_refresh = setInterval(
    function () {
       $('.tds-table').load('show.php').fadeIn("slow");
    }, 60000); // refresh setiap 1 mnt
    
</script>
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
            <h1><?php echo $page; ?></h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4> Riwayat</h4>
                    <div class="card-header-action"></div>
                  </div>
                  <div class="tds-table"></div>
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