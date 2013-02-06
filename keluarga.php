<?php
	session_start();

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
	
	if ( $_SESSION[ 'group_id' ] == 1 ) {
		$kecamatanList = $kecamatan->getAllRecord();
		$kelurahanList = $kelurahan->getAllRecord();
	} else {
		$kecamatanList = $kecamatan->getKecamatanByKelurahan( $_SESSION[ 'kelurahan_id' ] );
		$kelurahanList = $kelurahan->getKelurahanById( $_SESSION[ 'kelurahan_id' ] );
		$rwList = $rw->getRwByKelurahan( $_SESSION[ 'kelurahan_id' ] );		
	}

	$bulanList = $bulan->getAllRecord();	
?>

<div id="panel-keluarga" class="easyui-panel" title=" " style="padding: 5px">
	<div id="panel-search" class="easyui-panel" title="Pencarian" data-options="collapsible: true">		
		<table width="100%">				
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
				<td align="right">RW / RT</td>
				<td>:</td>
				<td>
					<select onchange="getRtByRw();" id="Rw" name="Rw1">
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
					<select id="Rt" name="Rt">
						<option value="0">--Pilih--</option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right">No. KKI</td>
				<td>:</td>
				<td><input type="text" name="NoKKI" id="NoKKI" style="width: 150px;" /></td>
				<td align="right">Nama Kepala Keluarga</td>
				<td>:</td>
				<td><input type="text" name="NamaKK" id="NamaKK" style="width: 200px;" /></td>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="9" align="center"><button id="btn-search">Cari</button></td>
			</tr>
		</table>
	</div>

	<table class="easyui-datagrid" title="Tabel Keluarga" id="tbl-keluarga" data-options="singleSelect: true, collapsible: true, rownumbers: true, pagination: true" style="height: 320px; padding: 10px;" iconCls="" >
		<thead>
			<tr>
				<th data-options="field: 'KeluargaId', width: 80">ID</th>
				<th data-options="field: 'NoKKI', width: 150">No. KKI</th>
				<th data-options="field: 'KepalaKeluarga', width: 200">Nama KK</th>
				<th data-options="field: 'NamaIstri', width: 200">Nama Istri</th>
				<th data-options="field: 'Kecamatan', width: 150">Kecamatan</th>
				<th data-options="field: 'Kelurahan', width: 150">Kelurahan</th>
				<th data-options="field: 'RW', width: 50">RW</th>
				<th data-options="field: 'RT', width: 50">RT</th>
			</tr>
		</thead>
	</table>
</div>

<script type="text/javascript">
	$(function() {
		// default loading
		if ($("#Kecamatan").val() != "" && $("#Kelurahan").val() != "") {
			$("#tbl-keluarga").datagrid({
				url: "model/keluarga/get-all-keluarga-json.php",
				queryParams: { Kecamatan: $("#Kecamatan").val(), Kelurahan: $("#Kelurahan").val() }
			});
		}

		$("#btn-search").unbind("click").bind("click", function() {
			$("#tbl-keluarga").datagrid("load", {
				search: "true",
				NoKKI: $("#NoKKI").val(),
				Kecamatan: $("#Kecamatan").val(),
				Kelurahan: $("#Kelurahan").val(),
				Rw: $("#Rw").val(),
				Rt: $("#Rt").val(),
				NamaKK: $("#NamaKK").val()				
			});		
		});
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