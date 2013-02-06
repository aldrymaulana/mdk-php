<?php
  session_start();

  require_once 'lib/custom.inc.php';
  require_once 'lib/path.inc.php';
  require_once 'model/kecamatan/kecamatan-service.php';
	require_once 'model/kelurahan/kelurahan-service.php';
	require_once 'model/bulan/bulan-service.php';
	require_once 'model/rw/rw-service.php';
	require_once 'model/rt/rt-service.php';
	
	$kecamatan = new KecamatanService();
	$kelurahan = new KelurahanService();
	$bulan = new BulanService();
	$rt = new RtService();
	$rw = new RwService();
			
	$bulanList = $bulan->getAllRecord();
	
	if ( $_SESSION[ 'group_id' ] == 1 ) {
		$kecamatanList = $kecamatan->getAllRecord();
		$kelurahanList = $kelurahan->getAllRecord();
	} else {
		$kecamatanList = $kecamatan->getKecamatanByKelurahan( $_SESSION[ 'kelurahan_id' ] );
		$kelurahanList = $kelurahan->getKelurahanById( $_SESSION[ 'kelurahan_id' ] );
		$rwList = $rw->getRwByKelurahan( $_SESSION[ 'kelurahan_id' ] );		
	}

  checkSession();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Dinas BPMPPKB Pemerintah Kota Cimahi</title>
		<link rel="icon" type="image/png" href="img/cimahi-kecil.png">
		<link rel="shortcut icon" type="image/ico" href="favicon.ico">
		<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.3.2/themes/default/easyui.css">
		<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.3.2/themes/icon.css">
		<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.3.2/demo/demo.css">
		<script type="text/javascript" src="js/jquery-easyui-1.3.2/jquery-1.8.0.min.js"></script>
		<script type="text/javascript" src="js/jquery-easyui-1.3.2/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="js/jquery-easyui-1.3.2/locale/easyui-lang-id.js"></script>		
		<script type="text/javascript" src="js/custom.js"></script>
		<script type="text/javascript" src="js/ofc/js/swfobject.js"></script>
	</head>
	<body>			
		<div class="easyui-layout" style="width:100%; height:662px;">
			<div data-options="region:'north'" style="height:96px">				
				<table width="100%">
					<tr>
						<td valign="middle" align="center">
							<table width="100%">
								<tr>
									<td valign="top" width="5%"><img src="img/cimahi-sedang.png" /></td>
									<td>
										<h2>Aplikasi Pengelolaan Data Peserta KB</h2>
										<font style="font-size: 11px;"><b>Dinas BPMPPKB Kota Cimahi</b><br />										
											Komp. Perkantoran Pemkot Cimahi, Gd. C Lt. 3<br />
											Jl. Rd. Demang Hardjakusumah, Cihanjuang, Kota Cimahi
										</font>			
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>				
			</div>
			<div data-options="region:'south',split:true" style="height:30px;">
				<table width="100%">
					<tr>
						<td valign="bottom" align="center">
							Copyright &copy; 2013 KAPPDE Pemerintah Kota Cimahi
						</td>
					</tr>
				</table>
			</div>
			<div data-options="region:'west',split:true" title="Panel Menu" style="width:230px;">
				<div class="easyui-panel" data-options="fit:true,border:false">
					<div class="easyui-panel" data-options="collapsible: true, region:'north',split:true,border:true" title="Informasi" style="height:150px; padding: 3px;">
						Selamat datang, <?php echo '<b>' . $_SESSION[ 'username' ] . '</b>'; ?>
						<p>
							Tahun Aktif: <?php echo $_SESSION[ 'tahun' ]; ?><br />
							Tgl. Login: <?php echo date( 'd/m/Y' ); ?><br />
							Instansi: <?php echo $_SESSION[ 'nama' ]; ?>
						</p>
					</div>										
					<div class="easyui-panel" data-options="collapsed: true, collapsible: true, region:'north',split:true,border:true" title="MDK" style="padding: 3px;">
						<ul id="menu-tree" class="easyui-tree" data-options="url:'json/menu-tree.json',animate:false,dnd:true" style="height: 210px;"></ul>		
					</div>
					<div class="easyui-panel" data-options="collapsed: true, collapsible: true, region:'north',split:true,border:true" title="Sistem" style="padding: 3px;">
						<ul id="menu-sistem-tree" class="easyui-tree" data-options="url:'json/menu-sistem-tree.json',animate:false,dnd:true"></ul>
					</div>
				</div>									
			</div>
			<div id="content" class="easyui-tabs" data-options="region:'center',title:'Dashboard',iconCls:'icon-ok'">
			</div>
		</div>

		<div id="report-form" class="easyui-window" title="Form Input" data-options="modal: true, minimizable: false, maximizable: false, closed: true, modal: true" style="width: 435px; height: 220px; padding: 10px">
			<table width="100%">
				<tr>
					<td align="right">Tahun</td>
					<td>:</td>
					<td>
						<select id="Tahun" name="Tahun">
							<option value="0">--Pilih--</option>
							<?php
								$tahunAwal = 2010;
                $tahunAkhir = date( 'Y' );
                for ( $i=$tahunAwal; $i <= $tahunAkhir; $i++ ) {
                  if ( $tahunAkhir == $i ) {
                    echo '<option value=' . $i . ' selected>' . $i . '</option>';
                  } else {
                    echo '<option value=' . $i . '>' . $i . '</option>';
                  }
                }
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Bulan</td>
					<td>:</td>
					<td>
						<select id="BulanRpt" name="BulanRpt">
							<option value="0">--Pilih--</option>
							<?php
								if ( count( $bulanList ) > 0 ) {
									for ( $i=0; $i < count( $bulanList ); $i++ ) {
										echo '<option value="' . $bulanList[ $i ][ 'BulanId' ] . '">' . $bulanList[ $i ][ 'Bulan' ] . '</option>';
									}
								}
							?>
						</select>
					</td>					
				</tr>				
				<tr>
					<td align="right">Kecamatan</td>
					<td>:</td>
					<td>
						<select id="Kecamatan" name="Kecamatan" onchange="getKelurahanByKecamatanId();">
							<?php
								if ( $_SESSION[ 'group_id' ] != 1 ) {
									if ( count( $kecamatanList ) > 0 ) {
										for ( $i=0; $i < count( $kecamatanList ); $i++ ) {
											echo '<option value="' . $kecamatanList[ $i ][ 'KecamatanId' ] . '">' . $kecamatanList[ $i ][ 'Nama' ] . '</option>';
										}
									}
								} else {
							?>
							<option value="0">--Pilih--</option>
							<?php
									if ( count( $kecamatanList ) > 0 ) {
										for ( $i=0; $i < count( $kecamatanList ); $i++ ) {
											echo '<option value="' . $kecamatanList[ $i ][ 'KecamatanId' ] . '">' . $kecamatanList[ $i ][ 'Nama' ] . '</option>';
										}
									}
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Kelurahan</td>
					<td>:</td>
					<td>
						<select onchange="getRwByKelurahan();" id="Kelurahan" name="Kelurahan">
							<?php
								if ( $_SESSION[ 'group_id' ] != 1 ) {
									if ( count( $kelurahanList ) > 0 ) {
										for ( $i=0; $i < count( $kelurahanList ); $i++ ) {
											echo '<option value="' . $kelurahanList[ $i ][ 'KelurahanId' ] . '">' . $kelurahanList[ $i ][ 'Nama' ] . '</option>';
										}
									}
								} else {
							?>
							<option value="0">--Pilih--</option>
							<?php
								}
							?>									
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">RW / RT</td>
					<td>:</td>
					<td>
						<select onchange="getRtByRw();" id="Rw" name="rw">
							<option value="0">--Pilih--</option>
							<?php
								if ( $_SESSION[ 'group_id' ] != 1 ) {
									if ( count( $rwList ) > 0 ) {
										for ( $i=0; $i < count( $rwList ); $i++ ) {
											echo '<option value="' . $rwList[ $i ][ 'RWId' ] . '">' . $rwList[ $i ][ 'Nama' ] . '</option>';
										}
									}
								}
							?>
						</select> / 
						<select id="Rt" name="rt">
							<option value="0">--Pilih--</option>
						</select>						
					</td>
				</tr>
				<tr>
					<td colspan="3" align="center"><button id="btn-cetak">Cetak</button></td>
				</tr>			
			</table>
		</div>

		<script>
			$(function() {
				// default page
				addTab($("#content"), "Grafik", "dashboard.php");

				$("#menu-tree").tree({
					onClick: function(node) {
						switch (node.text) {
							case "Keluarga" : {
								addTab($("#content"), node.text, "keluarga.php");
							} break;
							
							case "Keluarga KB" : {
								addTab($("#content"), node.text, "keluarga-kb.php");
							} break;							

							case "Rekap Kepesertaan KB" : {
								$("#report-form").window({
									title: "Form Laporan Rekap Kepesertaan KB"
								}).window("open");

								$("#btn-cetak").unbind("click").bind("click", function() {
									var tahun = $("#Tahun").val();
									var bulan = $("#BulanRpt").val();
									var rt_id = $("#Rt").val();
									var rw_id = $("#Rw").val();
									var kelurahan_id = $("#Kelurahan").val();
									var kecamatan_id = $("#Kecamatan").val();
									var kki = null;
									
									window.open("report/rekap-kb.php?tahun=" + tahun + "&rt_id=" + rt_id + "&rw_id=" + rw_id + "&kelurahan_id=" + kelurahan_id + "&kecamatan_id=" + kecamatan_id + "&kki=" + kki + "&bulan=" + bulan, "print-window", "addressbar=no");
									$("#report-form").window("close");
								});								
							} break;							

							case "Pembinaan PUS" : {
								$("#report-form").window({
									title: "Form Laporan Pembinaan PUS & Kepesertaan KB"
								}).window("open");

								$("#btn-cetak").unbind("click").bind("click", function() {
									var tahun = $("#Tahun").val();
									var bulan = $("#BulanRpt").val();
									var rt_id = $("#Rt").val();
									var rw_id = $("#Rw").val();
									var kelurahan_id = $("#Kelurahan").val();
									var kecamatan_id = $("#Kecamatan").val();									
									
									window.open("report/pembinaan-pus.php?tahun=" + tahun + "&rt_id=" + rt_id + "&rw_id=" + rw_id + "&kelurahan_id=" + kelurahan_id + "&kecamatan_id=" + kecamatan_id + "&bulan=" + bulan, "print-window", "addressbar=no");
									$("#report-form").window("close");
								});								
							} break;	
						}
					}
				});

				$("#menu-sistem-tree").tree({
					onClick: function(node) {
						switch (node.text) {
							case "User" : {
								<?php 
									if ( $_SESSION[ 'group_id' ] == 1 )
										echo 'addTab($("#content"), node.text, "user.php");';
									else
										echo '$.messager.alert("Peringatan", "Anda tidak memiliki hak untuk mengakses Modul User!", "warning");';
								?>
							} break;							

							case "Logout" : {
								$.messager.confirm("Konfirmasi", "Keluar dari aplikasi?", function(r) {
									if (r) {
										addTab($("#content"), node.text, "logout.php");
									}
								});								
							} break;
						}
					}
				})
			});		

			function getKelurahanByKecamatanId() {
				$.ajax({
					url: "model/kelurahan/get-kelurahan-by-kecamatan-json.php",
					data: { id: $("#Kecamatan").val() },
					success: function(data) {
						$("#Kelurahan").empty();
						$("#Kelurahan").append("<option value='0'>--Pilih</option>");
						$.each(data, function(key, val) {
							$("#Kelurahan").append("<option value='" + val.KelurahanId + "'>" + val.Nama + "</option>");
						});
					},
					error: function(xhr, status, error) {
						console.log(xhr.statusText);
						console.log(status);
						console.log(error);
					}
				});
			}

			function getRwByKelurahan() {
				$.ajax({
					url: "model/rw/get-rw-by-kelurahan-json.php",
					data: { id: $("#Kelurahan").val() },
					success: function(data) {
						$("#Rw").empty();
						$("#Rw").append("<option value='0'>--Pilih</option>");
						$.each(data, function(key, val) {
							$("#Rw").append("<option value='" + val.RWId + "'>" + val.Nama + "</option>");
						});
					},
					error: function(xhr, status, error) {
						console.log(xhr.statusText);
						console.log(status);
						console.log(error);
					}
				});
			}

			function getRtByRw() {
				$.ajax({
					url: "model/rt/get-rt-by-rw-json.php",
					data: { id: $("#Rw").val() },
					success: function(data) {
						$("#Rt").empty();
						$("#Rt").append("<option value='0'>--Pilih</option>");
						$.each(data, function(key, val) {
							$("#Rt").append("<option value='" + val.RTId + "'>" + val.Nama + "</option>");
						});
					},
					error: function(xhr, status, error) {
						console.log(xhr.statusText);
						console.log(status);
						console.log(error);
					}
				});	
			}
		</script>
	</body>
</html>
