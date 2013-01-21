<div id="panel-keluarga" class="easyui-panel" title=" " style="padding: 10px">
	<div id="panel-search" class="easyui-panel" title="Pencarian" data-options="collapsible: true">
		<form name="" id="">
			<table width="100%">				
				<tr>
					<td align="right">Kecamatan</td>
					<td>:</td>
					<td>
						<select id="kecamatan" name="KecamatanId" onchange="getKelurahanByKecamatanId();">
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
						<select onchange="getRwByKelurahan();" id="kelurahan" name="KelurahanId">
							<option value="0">--Pilih--</option>							
						</select>
					</td>
					<td align="right">RW / RT</td>
					<td>:</td>
					<td>
						<select onchange="getRtByRw();" id="rw" name="rw">
							<option value="0">--Pilih--</option>
						</select> / 
						<select id="rt" name="rt">
							<option value="0">--Pilih--</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">No. KKI</td>
					<td>:</td>
					<td><input type="text" /></td>
					<td align="right">Nama Kepala Keluarga</td>
					<td>:</td>
					<td><input type="text" /></td>
					<td align="right">Periode (Bulan/Tahun)</td>
					<td>:</td>
					<td>
						<select id="">
							<option value="0">--Pilih--</option>
							<?php
								if ( count( $bulanList ) > 0 ) {
									for ( $i=0; $i < count( $bulanList ); $i++ ) {
										echo '<option value="' . $bulanList[ $i ][ 'BulanId' ] . '">' . $bulanList[ $i ][ 'Bulan' ] . '</option>';
									}
								}
							?>
						</select> /
						<select id="">
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
					<td colspan="9" align="center"><button id="btn-search">Cari</button></td>
				</tr>
			</table>
		</form>
	</div>

	<table class="easyui-datagrid" title="Tabel Keluarga" data-options="singleSelect: true, collapsible: true, url: 'model/get-all-keluarga-json.php', rownumbers: true, pagination: true" style="height: 360px; padding: 10px;" iconCls="" >
		<thead>
			<tr>
				<th data-options="field: 'KeluargaId', width: 80">ID</th>
				<th data-options="field: 'NoKKI', width: 150">No. KKI</th>
				<th data-options="field: 'KepalaKeluarga', width: 250">Nama KK</th>
				<th data-options="field: 'NamaIstri', width: 250">Nama Istri</th>				
			</tr>
		</thead>
	</table>
</div>