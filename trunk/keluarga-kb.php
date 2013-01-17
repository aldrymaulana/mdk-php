<?php
	require_once 'model/kecamatan-service.php';
	require_once 'model/kelurahan-service.php';
	require_once 'model/bulan-service.php';
	require_once 'model/jenis-kontrasepsi-service.php';
	require_once 'model/tempat-pelayanan-kb-service.php';

	$kecamatan = new KecamatanService();
	$kelurahan = new KelurahanService();
	$bulan = new BulanService();
	$jenisKontrasepsi = new JenisKontrasepsiService();
	$tempatPelayananKb = new TempatPelayananKbService();

	$kecamatanList = $kecamatan->getAllRecord();
	$kelurahanList = $kelurahan->getAllRecord();
	$bulanList = $bulan->getAllRecord();
	$jenisKontrasepsiList = $jenisKontrasepsi->getAllRecord();
	$tempatPelayananKbList = $tempatPelayananKb->getAllRecord();
?>

<div id="panel-keluarga-kb" class="easyui-panel" title=" " style="padding: 10px">
	<div id="panel-search" class="easyui-panel" title="Pencarian" data-options="collapsible: true">
		<form name="" id="">
			<table width="100%">
				<tr>
					<td align="right">Negara</td>
					<td>:</td>
					<td><input type="text" value="REPUBLIK INDONESIA" style="width: 200px;" disabled /></td>
					<td align="right">Provinsi</td>
					<td>:</td>
					<td><input type="text" value="JAWA BARAT" disabled /></td>
					<td align="right">Kota</td>
					<td>:</td>
					<td><input type="text" value="CIMAHI" disabled /></td>
				</tr>
				<tr>
					<td align="right">Kecamatan</td>
					<td>:</td>
					<td>
						<select id="Kecamatan1" name="Kecamatan" onchange="getKelurahanByKecamatanId1();">
							<option value="0">--Pilih--</option>
							<?php
								if ( count( $kecamatanList ) > 0 ) {
									for ( $i=0; $i < count( $kecamatanList ); $i++ ) {
										echo '<option value="' . $kecamatanList[ $i ][ 'KecamatanId' ] . '">' . $kecamatanList[ $i ][ 'Nama' ] . '</option>';
									}
								}
							?>
						</select>
					</td>
					<td align="right">Kelurahan</td>
					<td>:</td>
					<td>
						<select onchange="getRwByKelurahan1();" id="Kelurahan1" name="Kelurahan">
							<option value="0">--Pilih--</option>							
						</select>
					</td>
					<td align="right">RW / RT</td>
					<td>:</td>
					<td>
						<select onchange="getRtByRw1();" id="Rw1" name="rw">
							<option value="0">--Pilih--</option>
						</select> / 
						<select id="Rt1" name="rt">
							<option value="0">--Pilih--</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">No. KKI</td>
					<td>:</td>
					<td><input type="text" name="NoKKI" id="NoKKI1" style="width: 150px;" /></td>
					<td align="right">Nama Kepala Keluarga</td>
					<td>:</td>
					<td><input type="text" name="NamaKK" id="NamaKK1" style="width: 200px;" /></td>
					<td align="right">Periode (Bulan/Tahun)</td>
					<td>:</td>
					<td>
						<select id="Bulan1" name="Bulan">
							<option value="0">--Pilih--</option>
							<?php
								if ( count( $bulanList ) > 0 ) {
									for ( $i=0; $i < count( $bulanList ); $i++ ) {
										echo '<option value="' . $bulanList[ $i ][ 'BulanId' ] . '">' . $bulanList[ $i ][ 'Bulan' ] . '</option>';
									}
								}
							?>
						</select> /
						<select id="Tahun1" name="Tahun">
							<option value="0">--Pilih--</option>
							<?php
								for ( $i=2010; $i <= date( 'Y' ); $i++ ) {
									echo '<option value="' . $i . '">' . $i . '</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="9" align="center"><button id="btn-search1">Cari</button></td>
				</tr>
			</table>
		</form>
	</div>

	<table class="easyui-datagrid" title="Tabel Keluarga" data-options="singleSelect: true, collapsible: true, url: 'model/get-all-keluarga-kb-json.php', tools:'#tools', rownumbers: true, pagination: true" style="height: 360px; padding: 10px;">
		<thead>
			<tr>
				<th data-options="field: 'KeluargaId', width: 80">ID</th>
				<th>No. KKI</th>
				<th>Bulan</th>
				<th>Tahun</th>
				<th>Nama KK</th>
				<th>Jenis Kontrasepsi</th>
				<th>Tempat Pelayana KB</th>
				<th>Aksi</th>
			</tr>
		</thead>
	</table>	
</div>

<div id="tools">
	<a href="javascript:void(0);" class="icon-add" onclick="$('#win-form').window('open');"></a>
</div>

<div id="win-form" class="easyui-window" title="Form Input" data-options="modal: true, closed: true" style="width: 500px; height: 300px; padding: 10px">
	<table width="100%">		
		<tr>
			<td>No. KKI</td>
			<td>:</td>
			<td>
				<input type="text" name="NoKKI" id="NoKKI" style="width: 150px;" disabled />
				&nbsp;<a href="javascript:void(0);" onclick="$('#win-search').window('open');">Cari</a>
			</td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>:</td>
			<td>
				<select id="Tahun" name="Tahun">
					<option value="0">--Pilih--</option>
					<?php
						for ( $i=2010; $i <= date( 'Y' ); $i++ ) {
							echo '<option value="' . $i . '">' . $i . '</option>';
						}
					?>
				</select>
			</td>			
		</tr>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td>
				<select id="Bulan" name="Bulan">
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
			<td>Nama KK</td>
			<td>:</td>
			<td><input type="text" name="NamaKk" id="NamaKk" style="width: 200px;" /></td>			
		</tr>
		<tr>
			<td>Nama Istri</td>
			<td>:</td>
			<td><input type="text" name="Istri" id="Istri" style="width: 200px;" /></td>			
		</tr>
		<tr>
			<td>Jenis Kontrasepsi</td>
			<td>:</td>
			<td>
				<?php
					if ( count( $jenisKontrasepsiList ) > 0 ) {
						for ( $i=0; $i < count( $jenisKontrasepsiList ); $i++ ) {
							echo '<input type="radio" name="JenisKontrasepsi" value="' . $jenisKontrasepsiList[ $i ][ 'JenisKontrasepId' ] . '" />' . $jenisKontrasepsiList[ $i ][ 'Jenis' ];
						}
					}
				?>
			</td>			
		</tr>
		<tr>
			<td>Tempat Pelayanan</td>
			<td>:</td>
			<td>
				<?php
					if ( count( $tempatPelayananKbList ) > 0 ) {
						for ( $i=0; $i < count( $tempatPelayananKbList ); $i++ ) {
							echo '<input type="radio" name="TempatPelayanan" value="' . $tempatPelayananKbList[ $i ][ 'TempatPelayananKBId' ] . '" />' . $tempatPelayananKbList[ $i ][ 'Nama' ];
						}
					}
				?>
			</td>			
		</tr>
		<tr>
			<td colspan="3" align="center"><button id="">Simpan</button></td>			
		</tr>
	</table>
</div>

<div id="win-search" class="easyui-window" title="Pencarian Data Keluarga" data-options="modal: true, closed: true" style="height: 520px; padding: 5px">
	<div id="panel-search" class="easyui-panel" title="Pencarian" data-options="collapsible: true" style="">
		<form name="" id="">
			<table width="100%">
				<tr>
					<td align="right">Negara</td>
					<td>:</td>
					<td><input type="text" value="REPUBLIK INDONESIA" style="width: 200px;" disabled /></td>
					<td align="right">Provinsi</td>
					<td>:</td>
					<td><input type="text" value="JAWA BARAT" disabled /></td>
					<td align="right">Kota</td>
					<td>:</td>
					<td><input type="text" value="CIMAHI" disabled /></td>
				</tr>
				<tr>
					<td align="right">Kecamatan</td>
					<td>:</td>
					<td>
						<select id="Kecamatan2" name="Kecamatan" onchange="getKelurahanByKecamatanId2();">
							<option value="0">--Pilih--</option>
							<?php
								if ( count( $kecamatanList ) > 0 ) {
									for ( $i=0; $i < count( $kecamatanList ); $i++ ) {
										echo '<option value="' . $kecamatanList[ $i ][ 'KecamatanId' ] . '">' . $kecamatanList[ $i ][ 'Nama' ] . '</option>';
									}
								}
							?>
						</select>
					</td>
					<td align="right">Kelurahan</td>
					<td>:</td>
					<td>
						<select onchange="getRwByKelurahan2();" id="Kelurahan2" name="Kelurahan">
							<option value="0">--Pilih--</option>							
						</select>
					</td>
					<td align="right">RW / RT</td>
					<td>:</td>
					<td>
						<select onchange="getRtByRw2();" id="Rw2" name="rw">
							<option value="0">--Pilih--</option>
						</select> / 
						<select id="Rt2" name="rt">
							<option value="0">--Pilih--</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">No. KKI</td>
					<td>:</td>
					<td><input type="text" name="NoKKI" id="NoKKI2" style="width: 150px;" /></td>
					<td align="right">Nama Kepala Keluarga</td>
					<td>:</td>
					<td><input type="text" name="NamaKK" id="NamaKK2" style="width: 200px;" /></td>
					<td align="right">Periode (Bulan/Tahun)</td>
					<td>:</td>
					<td>
						<select id="Bulan2" name="Bulan">
							<option value="0">--Pilih--</option>
							<?php
								if ( count( $bulanList ) > 0 ) {
									for ( $i=0; $i < count( $bulanList ); $i++ ) {
										echo '<option value="' . $bulanList[ $i ][ 'BulanId' ] . '">' . $bulanList[ $i ][ 'Bulan' ] . '</option>';
									}
								}
							?>
						</select> /
						<select id="Tahun2" name="Tahun">
							<option value="0">--Pilih--</option>
							<?php
								for ( $i=2010; $i <= date( 'Y' ); $i++ ) {
									echo '<option value="' . $i . '">' . $i . '</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="9" align="center"><button id="btn-search2">Cari</button></td>
				</tr>
			</table>
		</form>
	</div>

	<table id="tbl-keluarga" class="easyui-datagrid" title="Tabel Keluarga" data-options="rownumbers: true, singleSelect: true, url: 'model/get-all-keluarga-json.php', pagination: true, collapsible: true" style="height:330px" title="Load data" iconCls="">
		<thead>
			<tr>
				<th field="KeluargaId" width="80">ID</th>
				<th field="NoKKI" width="150">No. KKI</th>
				<th field="KepalaKeluarga" width="250">Nama KK</th>
				<th field="NamaIstri" width="250">Nama Istri</th>				
			</tr>
		</thead>
	</table>
</div>

<script type="text/javascript">	
	function getKelurahanByKecamatanId1() {
		$.ajax({
			url: "model/get-kelurahan-by-kecamatan-json.php",
			data: { id: $("#Kecamatan1").val() },
			success: function(data) {
				$("#Kelurahan1").empty();
				$("#Kelurahan1").append("<option value='0'>--Pilih</option>");
				$.each(data, function(key, val) {
					$("#Kelurahan1").append("<option value='" + val.KelurahanId + "'>" + val.Nama + "</option>");
				});
			},
			error: function(xhr, status, error) {
				console.log(xhr.statusText);
				console.log(status);
				console.log(error);
			}
		});
	}

	function getRwByKelurahan1() {
		$.ajax({
			url: "model/get-rw-by-kelurahan-json.php",
			data: { id: $("#Kelurahan1").val() },
			success: function(data) {
				$("#Rw1").empty();
				$("#Rw1").append("<option value='0'>--Pilih</option>");
				$.each(data, function(key, val) {
					$("#Rw1").append("<option value='" + val.RWId + "'>" + val.Nama + "</option>");
				});
			},
			error: function(xhr, status, error) {
				console.log(xhr.statusText);
				console.log(status);
				console.log(error);
			}
		});
	}

	function getRtByRw1() {
		$.ajax({
			url: "model/get-rt-by-rw-json.php",
			data: { id: $("#Rw1").val() },
			success: function(data) {
				$("#Rt1").empty();
				$("#Rt1").append("<option value='0'>--Pilih</option>");
				$.each(data, function(key, val) {
					$("#Rt1").append("<option value='" + val.RTId + "'>" + val.Nama + "</option>");
				});
			},
			error: function(xhr, status, error) {
				console.log(xhr.statusText);
				console.log(status);
				console.log(error);
			}
		});
	}

	function getKelurahanByKecamatanId2() {
		$.ajax({
			url: "model/get-kelurahan-by-kecamatan-json.php",
			data: { id: $("#Kecamatan2").val() },
			success: function(data) {
				$("#Kelurahan2").empty();
				$("#Kelurahan2").append("<option value='0'>--Pilih</option>");
				$.each(data, function(key, val) {
					$("#Kelurahan2").append("<option value='" + val.KelurahanId + "'>" + val.Nama + "</option>");
				});
			},
			error: function(xhr, status, error) {
				console.log(xhr.statusText);
				console.log(status);
				console.log(error);
			}
		});
	}

	function getRwByKelurahan2() {
		$.ajax({
			url: "model/get-rw-by-kelurahan-json.php",
			data: { id: $("#Kelurahan2").val() },
			success: function(data) {
				$("#Rw2").empty();
				$("#Rw2").append("<option value='0'>--Pilih</option>");
				$.each(data, function(key, val) {
					$("#Rw2").append("<option value='" + val.RWId + "'>" + val.Nama + "</option>");
				});
			},
			error: function(xhr, status, error) {
				console.log(xhr.statusText);
				console.log(status);
				console.log(error);
			}
		});
	}

	function getRtByRw2() {
		$.ajax({
			url: "model/get-rt-by-rw-json.php",
			data: { id: $("#Rw2").val() },
			success: function(data) {
				$("#Rt2").empty();
				$("#Rt2").append("<option value='0'>--Pilih</option>");
				$.each(data, function(key, val) {
					$("#Rt2").append("<option value='" + val.RTId + "'>" + val.Nama + "</option>");
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