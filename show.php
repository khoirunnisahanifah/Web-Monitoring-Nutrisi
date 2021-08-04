<?php
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
  include 'part_func/tgl_ind.php';
  

  $sessionid = $_SESSION['id_user'];

  if (!isset($sessionid)) {
    header('location:auth');
  }

  ?>
   <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">No</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Nilai Nutrisi Bak</th>
                            <th>Pump Air</th>
                            <th>Pump Nut A</th>
                            <th>Pump Nut B</th>
                            <th>Pump Pengaduk</th>
                            <th>Aksi</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql = mysqli_query($conn, "SELECT * FROM tds_riwayat WHERE id_user=$sessionid ORDER BY id DESC");
                          $i = 0;
                          while ($row = mysqli_fetch_array($sql)) {
                            
                            $i++;
                            $tanggal = $row['tanggal'];
		                        $waktu = $row['waktu'];
	                        	$tds_value = $row['tds_value'];
	                        	$pompa_air = $row['pompa_air'];
                            $pompa_nuta = $row['pompa_nuta'];
	                        	$pompa_nutb = $row['pompa_nutb'];
	                        	$pompa_pengaduk = $row['pompa_pengaduk'];
                          ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $tanggal; ?></td>
                              <td><?php echo $waktu; ?></td>
                              <td><?php echo $tds_value; ?> PPM</td>
                              <td><?php echo $pompa_air; ?></td>
                              <td><?php echo $pompa_nuta; ?></td>
                              <td><?php echo $pompa_nutb; ?></td>
                              <td><?php echo $pompa_pengaduk; ?></td>

                              </div>
									          	</td>
                              <td>
											          <a class="btn btn-danger btn-actionriwayat" data-toggle="tooltip" title="Hapus" data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?" data-confirm-yes="window.location.href = 'auth/delete.php?type=tds_riwayat&id=<?php echo $row['id']; ?>'" ;><i class="fas fa-trash"></i></a>
										          </td>
										        </tr>
                            
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div> 
                  <?php include "part/all-js.php"; ?>
                  