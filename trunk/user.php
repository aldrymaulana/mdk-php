<?php
	session_start();

	require_once 'model/group/group-service.php';	

	$group = new GroupService();
	$groupList = $group->getAllRecord();
?>

<div id="panel-user" class="easyui-panel" title=" " style="padding: 10px;">
	<div id="panel-search" class="easyui-panel" title="Pencarian" data-options="collapsible: true">		
		<table align="center" width="25%">				
			<tr>
				<td align="left">User ID</td>
				<td>:</td>
				<td><input type="text" id="cari-username" name="cari-username" /></td>
				<td><button id="btn-search">Cari</button></td>
			</tr>				
		</table>
	</div>

	<table class="easyui-datagrid" title="Tabel User" id="tbl-user" data-options="singleSelect: true, collapsible: true, url: 'model/user/get-all-user-json.php', rownumbers: true, pagination: true, tools:'#tools'" style="height: 360px; padding: 10px;" iconCls="" >
		<thead>
			<tr>
				<th data-options="field: 'UserId', width: 80">User ID</th>
				<th data-options="field: 'Nama', width: 250">Nama</th>
				<th data-options="field: 'NamaGroup', width: 250">Group</th>
				<th data-options="hidden: true, field: 'Password'"></th>
			</tr>
		</thead>
	</table>	
</div>

<div id="tools">
	<a href="javascript:void(0);" class="icon-add" onclick="crud('insert');"></a>
	<a href="javascript:void(0);" class="icon-edit" onclick="crud('update');"></a>
	<a href="javascript:void(0);" class="icon-remove" onclick="del();"></a>
</div>

<div id="win-form-user" class="easyui-window" title="Form Input" data-options="modal: true, closed: true" style="width: 400px; height: 200px; padding: 10px">
	<table width="100%">		
		<tr>
			<td align="right">User ID</td>
			<td>:</td>
			<td>
				<input type="text" name="UserId" id="UserId" style="width: 150px;" />				
			</td>
		</tr>		
		<tr>
			<td align="right">Nama</td>
			<td>:</td>
			<td>				
				<input type="text" name="Nama" id="Nama" style="width: 150px;" />				
			</td>
		</tr>		
		<tr>
			<td align="right">Group</td>
			<td>:</td>
			<td>				
				<select name="GroupId" id="GroupId">				
					<option value="0">--Pilih--</option>
					<?php
						if ( count( $groupList ) > 0 ) {
							for ( $i=0; $i < count( $groupList ); $i++ ) {
								echo '<option value="' . $groupList[ $i ][ 'GroupId' ] . '">' . $groupList[ $i ][ 'Nama' ] . '</option>';
							}
						}
					?>
				</select>
			</td>
		</tr>		
		<tr>
			<td align="right">Password</td>
			<td>:</td>
			<td><input type="password" name="Password" id="Password" style="width: 200px;" /></td>			
		</tr>
		<tr>
			<td align="right">Konfirmasi Password</td>
			<td>:</td>
			<td><input type="password" name="konfirmasi" id="konfirmasi" style="width: 200px;" /></td>			
		</tr>		
		<tr>
			<td colspan="3" align="center"><button id="simpan">Simpan</button></td>			
		</tr>
	</table>
</div>

<script type="text/javascript">
	$(function() {
		$("#btn-search").unbind("click").bind("click", function() {
			$("#tbl-user").datagrid("load", {
				search: "true",
				UserId: $("#cari-username").val()
			});		
		});
	});

	function del() {
		var row = $("#tbl-user").datagrid("getSelected");

		if (row == null) {
			alert("Anda belum memilih data yang akan dihapus!");
			return false;
		}

		if (confirm("Hapus data dengan Username: " + row.UserId + "?")) {
			$.ajax({
				url: "model/user/delete-user.php",
				data: { UserId: row.UserId },
				success: function(data) {
					$("#tbl-user").datagrid("reload");
				},
				error: function() {

				}
			})
		}		
	}

	function crud(flag) {
		$("#UserId").val("");
		$("#Nama").val("");
		$("#Password").val("");

		if (flag == "update") {
			var row = $("#tbl-user").datagrid("getSelected");

			if (row == null) {
				alert("Anda belum memilih data yang akan dirubah!");
				return false;
			}

			$("#win-form-user").window({
				title: "Form Edit"
			}).window("open");
						
			$("#UserId").val(row.UserId);
			$("#Nama").val(row.Nama);

			$("#simpan").unbind("click").bind("click", function() {
				// validasi, cek input
				var parm = {
					UserId: $("#UserId").val(),
					Nama: $("#Nama").val(),
					Pass: $("#Password").val(),
					GroupId: $("#GroupId").val()					
				};

				$.ajax({
					type: "post",
					url: "model/user/update-user.php",
					data: parm,
					success: function(data) {
						if (data == "sukses") {
							alert("Data berhasil diupdate!");
							$("#tbl-user").datagrid("reload");							
						}
						
						$("#win-form-user").window("close");
					},
					error: function(xhr, status, error) {
						console.log(xhr.statusText);
						console.log(status);
						console.log(error);
					}
				})
			});
		} else {			
			$("#win-form-user").window({
				title: "Form Input"
			}).window("open");

			$("#simpan").unbind("click").bind("click", function() {
				// validasi, cek input
				var parm = {
					UserId: $("#UserId").val(),
					Nama: $("#Nama").val(),
					Pass: $("#Password").val(),
					GroupId: $("#GroupId").val()
				};

				$.ajax({
					type: "post",
					url: "model/user/save-user.php",
					data: parm,
					success: function(data) {
						if (data == "sukses") {
							alert("Data berhasil disimpan!");	
							$("#tbl-user").datagrid("reload");
						}
						
						$("#win-form-user").window("close");
					},
					error: function() {
						alert("AJAX Error!");
					}
				})
			});
		}
	}
</script>