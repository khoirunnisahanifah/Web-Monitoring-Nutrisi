<?php
$judul = "Web Monitoring Nutrisi";
$pecahjudul = explode(" ", $judul);
$acronym = "";

foreach ($pecahjudul as $w) {
  $acronym .= $w[0];
}
?>
<div class="main-sidebar sidebar-style-2 ">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.php"><?php echo $judul; ?></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.php"><?php echo $acronym; ?></a>
    </div>
    <ul class="sidebar-menu">
      <li <?php echo ($page == "Dashboard") ? "class=active" : ""; ?>><a class="nav-link" href="index.php"><i class="fas fa-cube"></i><span>Dashboard</span></a></li>

      <li <?php echo ($page == "Riwayat" ) ? "class=active" : ""; ?>><a class="nav-link" href="tds_riwayat.php"><i class="fas fa-calendar-alt"></i> <span>Riwayat</span></a></li>
      
  </aside>
</div>