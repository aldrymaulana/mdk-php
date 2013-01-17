<div id="panel-keluarga-kb" class="easyui-panel" title=" " style="padding: 10px">
	<div id="panel-search" class="easyui-panel" title="Pencarian" data-options="collapsible: true">
		<form name="" id="">
			<table width="100%">
				<tr>
					<td align="right">Negara</td>
					<td>:</td>
					<td><input type="text" /></td>
					<td align="right">Provinsi</td>
					<td>:</td>
					<td><input type="text" /></td>
					<td align="right">Kota</td>
					<td>:</td>
					<td><input type="text" /></td>
				</tr>
				<tr>
					<td align="right">Kecamatan</td>
					<td>:</td>
					<td>
						<select id="">
							<option value="0">--Pilih--</option>
						</select>
					</td>
					<td align="right">Kelurahan</td>
					<td>:</td>
					<td>
						<select id="">
							<option value="0">--Pilih--</option>
						</select>
					</td>
					<td align="right">RW / RT</td>
					<td>:</td>
					<td>
						<select id="">
							<option value="0">--Pilih--</option>
						</select> / 
						<select id="">
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
						</select> /
						<select id="">
							<option value="0">--Pilih--</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="9" align="center"><button id="btn-search">Cari</button></td>
				</tr>
			</table>
		</form>
	</div>

	<table class="easyui-datagrid" title="Tabel Keluarga" data-options="singleSelect: true, collapsible: true, url: 'model/get-all-keluarga-kb-json.php', tools:'#tools'">
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
				<input type="text" name="" id="" />
				&nbsp;<a href="javascript:void(0);" onclick="$('#win-search').window('open');">Cari</a>
			</td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>:</td>
			<td>
				<select id="" name="">
					<option value="0">--Pilih--</option>
				</select>
			</td>			
		</tr>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td>
				<select id="" name="">
					<option value="0">--Pilih--</option>
				</select>
			</td>			
		</tr>		
		<tr>
			<td>Nama KK</td>
			<td>:</td>
			<td><input type="text" name="" id="" /></td>			
		</tr>
		<tr>
			<td>Nama Istri</td>
			<td>:</td>
			<td><input type="text" name="" id="" /></td>			
		</tr>
		<tr>
			<td>Jenis Kontrasepsi</td>
			<td>:</td>
			<td><input type="text" name="" id="" /></td>			
		</tr>
		<tr>
			<td>Tempat Pelayanan</td>
			<td>:</td>
			<td><input type="text" name="" id="" /></td>			
		</tr>
		<tr>
			<td colspan="3" align="center"><button id="">Simpan</button></td>			
		</tr>
	</table>
</div>

<div id="win-search" class="easyui-window" title="Pencarian Data Keluarga" data-options="modal: true, closed: true" style="width: 835px; height: 520px; padding: 5px">
	<div id="panel-search" class="easyui-panel" title="Pencarian" data-options="collapsible: true" style="width: 810px;">
		<form name="" id="">
			<table width="100%">
				<tr>
					<td align="right">Negara</td>
					<td>:</td>
					<td><input type="text" /></td>
					<td align="right">Provinsi</td>
					<td>:</td>
					<td><input type="text" /></td>
					<td align="right">Kota</td>
					<td>:</td>
					<td><input type="text" /></td>
				</tr>
				<tr>
					<td align="right">Kecamatan</td>
					<td>:</td>
					<td>
						<select id="">
							<option value="0">--Pilih--</option>
						</select>
					</td>
					<td align="right">Kelurahan</td>
					<td>:</td>
					<td>
						<select id="">
							<option value="0">--Pilih--</option>
						</select>
					</td>
					<td align="right">RW / RT</td>
					<td>:</td>
					<td>
						<select id="">
							<option value="0">--Pilih--</option>
						</select> / 
						<select id="">
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
						</select> /
						<select id="">
							<option value="0">--Pilih--</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="9" align="center"><button id="btn-search">Cari</button></td>
				</tr>
			</table>
		</form>
	</div>

	<table id="tbl-keluarga" class="easyui-datagrid" title="Tabel Keluarga" data-options="rownumbers: true, singleSelect: true, url: 'model/get-all-keluarga-json.php', pagination: false, pageSize: 10" title="Load data" iconCls="icon-save">
		<thead>
			<tr>
				<th field="KeluargaId" width="80">ID</th>
				<th field="NoKKI" width="150">No. KKI</th>
				<th field="KepalaKeluarga" width="250">Nama KK</th>
				<th field="NamaIstri" width="250">Nama Istri</th>				
				<th>Aksi</th>
			</tr>
		</thead>
	</table>
</div>