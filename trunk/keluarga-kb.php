<?php
	session_start();

	require_once 'model/kecamatan/kecamatan-service.php';
	require_once 'model/kelurahan/kelurahan-service.php';
	require_once 'model/bulan/bulan-service.php';
	require_once 'model/jenis-kontrasepsi/jenis-kontrasepsi-service.php';
	require_once 'model/tempat-pelayanan-kb/tempat-pelayanan-kb-service.php';
	require_once 'model/rw/rw-service.php';
	require_once 'model/rt/rt-service.php';
	require_once 'model/alasan-tidak-kb/alasan-tidak-kb-service.php';
	require_once 'model/tingkat-kesejahteraan/tingkat-kesejahteraan-service.php';

	$kecamatan = new KecamatanService();
	$kelurahan = new KelurahanService();
	$bulan = new BulanService();
	$jenisKontrasepsi = new JenisKontrasepsiService();
	$tempatPelayananKb = new TempatPelayananKbService();
	$rt = new RtService();
	$rw = new RwService();
	$alasanTidakKb = new AlasanTidakKbService();
	$tingkatKesejahteraan = new TingkatKesejahteraanService();

	if ( $_SESSION[ 'group_id' ] == 1 ) {
		$kecamatanList = $kecamatan->getAllRecord();
		$kelurahanList = $kelurahan->getAllRecord();
	} else {
		$kecamatanList = $kecamatan->getKecamatanByKelurahan( $_SESSION[ 'kelurahan_id' ] );
		$kelurahanList = $kelurahan->getKelurahanById( $_SESSION[ 'kelurahan_id' ] );
		$rwList = $rw->getRwByKelurahan( $_SESSION[ 'kelurahan_id' ] );		
	}
	
	$bulanList = $bulan->getAllRecord();
	$jenisKontrasepsiList = $jenisKontrasepsi->getAllRecord();
	$tempatPelayananKbList = $tempatPelayananKb->getAllRecord();
	$alasanTidakKbList = $alasanTidakKb->getAllRecord();
	$tingkatKesejahteraanList = $tingkatKesejahteraan->getAllRecord();
?>

<div id="panel-keluarga-kb" class="easyui-panel" title=" " style="padding: 10px">
	<div id="panel-search" class="easyui-panel" title="Pencarian" data-options="collapsible: true">		
		<table width="100%">				
			<tr>
				<td align="right">Kecamatan</td>
				<td>:</td>
				<td>
					<select id="Kecamatan1" name="Kecamatan1" onchange="<?php echo ( $_SESSION[ 'group_id' ] != 1 ) ? 'getKelurahanByKecamatanId1();' : ''; ?>">
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
					<select onchange="<?php echo ( $_SESSION[ 'group_id' ] != 1 ) ? 'getRwByKelurahan1();' : ''; ?>" id="Kelurahan1" name="Kelurahan1">
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
					<select onchange="getRtByRw1();" id="Rw1" name="Rw1">
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
					<select id="Rt1" name="Rt1">
						<option value="0">--Pilih--</option>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right">No. KKI</td>
				<td>:</td>
				<td><input type="text" name="NoKKI1" id="NoKKI1" style="width: 150px;" /></td>
				<td align="right">Nama Kepala Keluarga</td>
				<td>:</td>
				<td><input type="text" name="NamaKK1" id="NamaKK1" style="width: 200px;" /></td>
				<td align="right">Periode (Bulan/Tahun)</td>
				<td>:</td>
				<td>
					<select id="Bulan1" name="Bulan1">
						<option value="0">--Pilih--</option>
						<?php
							if ( count( $bulanList ) > 0 ) {
								for ( $i=0; $i < count( $bulanList ); $i++ ) {
									echo '<option value="' . $bulanList[ $i ][ 'BulanId' ] . '">' . $bulanList[ $i ][ 'Bulan' ] . '</option>';
								}
							}
						?>
					</select> /
					<select id="Tahun1" name="Tahun1">
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
	</div>

	<table class="easyui-datagrid" title="Tabel Keluarga" id="tbl-keluarga-kb" data-options="singleSelect: true, collapsible: true, tools:'#tools', rownumbers: true, pagination: true" style="height: 360px; padding: 10px;">
		<thead>
			<tr>
				<th field="KeluargaId" width="80">ID</th>
				<th field="NoKKI" width="150">No. KKI</th>
				<th field="Bulan" width="80">Bulan</th>
				<th field="Tahun" width="80">Tahun</th>
				<th field="KepalaKeluarga" width="200">Nama KK</th>
				<th field="NamaIstri" width="200">Nama Istri</th>
				<th field="JenisKontrasepsi" width="150">Jenis Kontrasepsi</th>
				<th field="TempatPelayanan" width="150">Tempat Pelayanan KB</th>
				<th hidden="true" field="JenisKontrasepsiId">Tempat Pelayanan KB</th>
				<th hidden="true" field="TempatPelayananKBId">Tempat Pelayanan KB</th>
			</tr>
		</thead>
	</table>	
</div>

<div id="tools">
	<a href="javascript:void(0);" class="icon-add" onclick="crud('insert');"></a>
	<a href="javascript:void(0);" class="icon-edit" onclick="crud('update');"></a>
	<a href="javascript:void(0);" class="icon-remove" onclick="del();"></a>
</div>

<div id="win-form" class="easyui-window" title="Form Input" data-options="modal: true, closed: true" style="width: 735px; height: 500px; padding: 10px">
	<div id="p" class="easyui-panel" title="Keluarga KB" style="width:700px;height:180px;padding:10px;">  
		<table width="100%">		
			<tr>
				<td width="30%" align="right">No. KKI</td>
				<td width="1%">:</td>
				<td>
					<input type="hidden" name="KeluargaId" id="KeluargaId" />
					<input type="text" name="NoKKI" id="NoKKI" style="width: 150px;" disabled />
					&nbsp;<a id="link-cari" href="javascript:void(0);" onclick="openSearchWindow();">Cari</a>
				</td>
			</tr>
			<tr>
				<td width="30%" align="right">Tahun</td>
				<td width="1%">:</td>
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
				<td width="30%" align="right">Bulan</td>
				<td width="1%">:</td>
				<td>
					<input type="hidden" name="NamaBulan" id="NamaBulan" />
					<select onchange="getNamaBulanById(this.value);" id="Bulan" name="Bulan">
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
				<td width="30%" align="right">Nama KK</td>
				<td width="1%">:</td>
				<td><input type="text" name="NamaKk" id="NamaKk" style="width: 200px;" disabled /></td>			
			</tr>
			<tr>
				<td width="30%" align="right">Nama Istri</td>
				<td width="1%">:</td>
				<td><input type="text" name="NamaIstri" id="NamaIstri" style="width: 200px;" disabled /></td>			
			</tr>
		</table>
	</div>

	<div id="p" class="easyui-panel" title="Kepesertaan KB" style="width:700px;height:160px;padding:10px;">  
		<table width="100%">
			<tr>
				<td colspan="3">
					<input type="checkbox" name="IkutKb" id="IkutKb" onclick="$('#NamaKontrasepsi').val('');" /> Ikut KB</td>				
			</tr>
			<tr>
				<td width="30%" align="right">Jenis Kontrasepsi yang digunakan</td>
				<td width="1%">:</td>
				<td>
					<input type="hidden" type="NamaKontrasepsi" id="NamaKontrasepsi" />
					<input type="radio" name="JenisKontrasepsi" id="JenisKontrasepsi" onclick="$('#NamaKontrasepsi').val('');" value="0" checked />Kosong
					<?php
						if ( count( $jenisKontrasepsiList ) > 0 ) {
							for ( $i=0; $i < count( $jenisKontrasepsiList ); $i++ ) {
								echo '<input type="radio" onclick="getNamaKontrasepsiById(this.value);" id="JenisKontrasepsi" name="JenisKontrasepsi" value="' . $jenisKontrasepsiList[ $i ][ 'JenisKontrasepId' ] . '" />' . $jenisKontrasepsiList[ $i ][ 'Jenis' ];
							}
						}
					?>
				</td>			
			</tr>
			<tr>
				<td width="30%" align="right">Tgl. menggunakan KB</td>
				<td width="1%">:</td>
				<td><input type="text" id="" name="" class="easyui-datebox" /></td>			
			</tr>
			<tr>
				<td width="30%" align="right">Tempat Pelayanan</td>
				<td width="1%">:</td>
				<td>
					<input type="hidden" type="NamaTempatPelayanan" id="NamaTempatPelayanan" />
					<input type="radio" name="TempatPelayanan" id="TempatPelayanan" onclick="$('#NamaTempatPelayanan').val('');" value="0" checked />Kosong
					<?php
						if ( count( $tempatPelayananKbList ) > 0 ) {
							for ( $i=0; $i < count( $tempatPelayananKbList ); $i++ ) {
								echo '<input type="radio" onclick="getNamaTempatPelayananById(this.value);" id="TempatPelayanan" name="TempatPelayanan" value="' . $tempatPelayananKbList[ $i ][ 'TempatPelayananKBId' ] . '" />' . $tempatPelayananKbList[ $i ][ 'Nama' ];
							}
						}
					?>
				</td>			
			</tr>
			<tr>
				<td width="30%" align="right">Alasan tidak ikut KB</td>
				<td width="1%">:</td>
				<td>
					<select id="Alasan" name="Alasan">
						<option value="0">--Pilih--</option>
						<?php
							if ( count( $alasanTidakKbList ) > 0 ) {
								for ( $i=0; $i < count( $alasanTidakKbList ); $i++ ) {
									echo '<option value="' . $alasanTidakKbList[ $i ][ 'ID' ] . '">' . $alasanTidakKbList[ $i ][ 'Alasan' ] . '</option>';
								}
							}
						?>
					</select>
				</td>			
			</tr>
		</table>
	</div>

	<div id="p" class="easyui-panel" title="Indikator KS" style="width:700px;height:70px;padding:10px;">  
		<table width="100%">
			<tr>
				<td width="30%" align="right">Indikator KS</td>
				<td width="1%">:</td>
				<td>
					<select id="Tingkat" name="Tingkat">
						<?php							
							if ( count( $tingkatKesejahteraanList ) > 0 ) {
								for ( $i=0; $i < count( $tingkatKesejahteraanList ); $i++ ) {
									echo '<option value="' . $tingkatKesejahteraanList[ $i ][ 'ID' ] . '">' . $tingkatKesejahteraanList[ $i ][ 'Tingkat' ] . '</option>';
								}
							}							
						?>						
					</select>
				</td>
			</tr>			
		</table>
	</div><br />
	<center><button id="simpan">Simpan</button></center>
</div>

<div id="win-search" class="easyui-window" title="Pencarian Data Keluarga" data-options="modal: true, closed: true" style="height: 520px; padding: 5px">
	<div id="panel-search" class="easyui-panel" title="Pencarian" data-options="collapsible: true" style="">		
		<table width="100%">				
			<tr>
				<td align="right">Kecamatan</td>
				<td>:</td>
				<td>
					<select id="Kecamatan2" name="Kecamatan" onchange="<?php echo ( $_SESSION[ 'group_id' ] != 1 ) ? 'getKelurahanByKecamatanId2();' : ''; ?>">
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
					<select onchange="<?php echo ( $_SESSION[ 'group_id' ] != 1 ) ? 'getRwByKelurahan2();' : ''; ?>" id="Kelurahan2" name="Kelurahan">
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
					<select onchange="getRtByRw2();" id="Rw2" name="rw">
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
				<td align="right">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="9" align="center"><button id="btn-search2">Cari</button></td>
			</tr>
		</table>
	</div>

	<table id="tbl-keluarga" class="easyui-datagrid" title="Tabel Keluarga" data-options="rownumbers: true, singleSelect: true, pagination: true, collapsible: true" style="height:330px" title="Load data" iconCls="">
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
	$(function() {
		// default loading
		if ($("#Kecamatan1").val() != "" && $("#Kelurahan1").val() != "") {
			$("#tbl-keluarga-kb").datagrid({
				url: "model/keluarga-kb/get-all-keluarga-kb-json.php",
				queryParams: { Kecamatan: $("#Kecamatan1").val(), Kelurahan: $("#Kelurahan1").val() }
			});
		}

		if ($("#Kecamatan2").val() != "" && $("#Kelurahan2").val() != "") {
			$("#tbl-keluarga").datagrid({
				url: "model/keluarga/get-all-keluarga-json.php",
				queryParams: { Kecamatan: $("#Kecamatan2").val(), Kelurahan: $("#Kelurahan2").val() }
			});
		}

		$("#tbl-keluarga").datagrid({
			onDblClickRow: function(rowIndex, rowData) {
				$("#win-search").window("close");
				$("#KeluargaId").val(rowData.KeluargaId);
				$("#NamaKk").val(rowData.KepalaKeluarga);
				$("#NamaIstri").val(rowData.NamaIstri);
				$("#NoKKI").val(rowData.NoKKI);
			}
		});

		$("#btn-search1").unbind("click").bind("click", function() {
			$("#tbl-keluarga-kb").datagrid("load", {
				search: "true",
				NoKKI: $("#NoKKI1").val(),
				Kecamatan: $("#Kecamatan1").val(),
				Kelurahan: $("#Kelurahan1").val(),
				Rw: $("#Rw1").val(),
				Rt: $("#Rt1").val(),
				NamaKK: $("#NamaKK1").val(),
				Bulan: $("#Bulan1").val(),
				Tahun: $("#Tahun1").val()
			});		
		});

		$("#btn-search2").unbind("click").bind("click", function() {
			$("#tbl-keluarga").datagrid("load", {
				search: "true",
				NoKKI: $("#NoKKI2").val(),
				Kecamatan: $("#Kecamatan2").val(),
				Kelurahan: $("#Kelurahan2").val(),
				Rw: $("#Rw2").val(),
				Rt: $("#Rt2").val(),
				NamaKK: $("#NamaKK2").val()
			});		
		});
	});
	
	function openSearchWindow() {
		$('#win-search').window('open');
		$("#tbl-keluarga").datagrid({
			url: "model/keluarga/get-all-keluarga-json.php"
		});
	}

	function getNamaBulanById(id) {
		$.ajax({
			url: "model/bulan/get-nama-bulan-by-id-json.php",
			data: { BulanId: id },			
			success: function(data) {
				$("#NamaBulan").val(data.Bulan);
			},
			error: function() {

			}
		});
	}

	function getNamaKontrasepsiById(id) {
		$.ajax({
			url: "model/jenis-kontrasepsi/get-nama-kontrasepsi-by-id-json.php",
			data: { KontrasepId: id },			
			success: function(data) {
				$("#NamaKontrasepsi").val(data.Jenis);
			},
			error: function() {

			}
		});
	}

	function getNamaTempatPelayananById(id) {
		$.ajax({
			url: "model/tempat-pelayanan-kb/get-nama-tempat-pelayanan-by-id-json.php",
			data: { TempatPelayananId: id },			
			success: function(data) {
				$("#NamaTempatPelayanan").val(data.Nama);
			},
			error: function() {

			}
		});
	}

	function del() {
		var row = $("#tbl-keluarga-kb").datagrid("getSelected");

		if (row == null) {
			$.messager.alert("Peringatan", "Anda belum memilih data yang akan dihapus!", "warning");			
			return false;
		}

		$.messager.confirm("Konfirmasi", "Hapus data MDK dengan No. KKI: " + row.NoKKI + "?", function(r) {
			if (r) {
				$.ajax({
					url: "model/keluarga-kb/delete-keluarga-kb.php",
					data: { Tahun: row.Tahun, BulanId: row.BulanId, KeluargaId: row.KeluargaId },
					success: function(data) {
						$("#tbl-keluarga-kb").datagrid("reload");
					},
					error: function() {

					}
				});
			}		
		});
	}

	function crud(flag) {
		if (flag == "update") {
			var row = $("#tbl-keluarga-kb").datagrid("getSelected");

			if (row == null) {
				$.messager.alert("Peringatan", "Anda belum memilih data yang akan dirubah!", "warning");			
				return false;
			}

			$("#win-form").window({
				title: "Form Edit"
			}).window("open");
			
			$("#link-cari").hide();
			$("#KeluargaId").val(row.KeluargaId);
			$("#NoKKI").val(row.NoKKI);
			$("#Tahun").val(row.Tahun);
			$("#Bulan").val(row.BulanId);
			$("#NamaKk").val(row.KepalaKeluarga);
			$("#NamaIstri").val(row.NamaIstri);
			$("[name=JenisKontrasepsi]:radio").filter("[value='" + row.JenisKontrasepsiId + "']").attr("checked", true);
			$("[name=TempatPelayanan]:radio").filter("[value='" + row.TempatPelayananKBId + "']").attr("checked", true);			

			$("#simpan").unbind("click").bind("click", function() {
				// validasi, cek input
				var parm = {
					BulanId: $("#Bulan").val(),
					Tahun: $("#Tahun").val(),
					KeluargaId: $("#KeluargaId").val(),
					JenisKontrasepsiId: $("[name=JenisKontrasepsi]:radio:checked").val(),
					TempatPelayananKBId: $("[name=TempatPelayanan]:radio:checked").val()
				};

				$.ajax({
					type: "post",
					url: "model/keluarga-kb/update-keluarga-kb.php",
					data: parm,
					success: function(data) {
						if (data == "sukses") {
							$.messager.alert("Informasi", "Data berhasil dirubah!", "info");			
							$("#tbl-keluarga-kb").datagrid("reload");
						}
						
						$("#win-form").window("close");
					},
					error: function(xhr, status, error) {
						console.log(xhr.statusText);
						console.log(status);
						console.log(error);
					}
				})
			});
		} else {
			$("#link-cari").show();
			$("#NoKKI").val("");
			$("#Tahun").val("0");
			$("#Bulan").val("0");
			$("#NamaKk").val("");
			$("#NamaIstri").val("");
			$("#NamaTempatPelayanan").val("0");
			$("#JenisKontrasepsi").val("0");
			$("[name=JenisKontrasepsi]:radio").filter("[value=0]").attr("checked", true);
			$("[name=TempatPelayanan]:radio").filter("[value=0]").attr("checked", true);

			$("#win-form").window({
				title: "Form Input"
			}).window("open");

			$("#simpan").unbind("click").bind("click", function() {
				// validasi, cek input
				var parm = {
					BulanId: $("#Bulan").val(),
					Tahun: $("#Tahun").val(),
					KeluargaId: $("#KeluargaId").val(),
					JenisKontrasepsiId: $("[name=JenisKontrasepsi]:radio:checked").val(),
					TempatPelayananKBId: $("[name=TempatPelayanan]:radio:checked").val()
				};

				$.ajax({
					type: "post",
					url: "model/keluarga-kb/save-keluarga-kb.php",
					data: parm,
					success: function(data) {
						if (data == "sukses") {
							$.messager.alert("Informasi", "Data berhasil disimpan!", "info");
							$("#tbl-keluarga-kb").datagrid("reload");
						}
						
						$("#win-form").window("close");
					},
					error: function() {
						alert("AJAX Error!");
					}
				})
			});
		}
	}

	function getKelurahanByKecamatanId1() {
		$.ajax({
			url: "model/kelurahan/get-kelurahan-by-kecamatan-json.php",
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
			url: "model/rw/get-rw-by-kelurahan-json.php",
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
			url: "model/rt/get-rt-by-rw-json.php",
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
			url: "model/kelurahan/get-kelurahan-by-kecamatan-json.php",
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
			url: "model/kelurahan/get-rw-by-kelurahan-json.php",
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
			url: "model/rt/get-rt-by-rw-json.php",
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