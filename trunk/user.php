<div id="panel-user" class="easyui-panel" title=" " style="padding: 10px;">
	<div id="panel-search" class="easyui-panel" title="Pencarian" data-options="collapsible: true">		
		<table align="center" width="25%">				
			<tr>
				<td align="left">Username</td>
				<td>:</td>
				<td><input type="text" id="cari-username" name="cari-username" /></td>
				<td><button id="btn-search">Cari</button></td>
			</tr>				
		</table>
	</div>

	<table class="easyui-datagrid" title="Tabel User" id="tbl-user" data-options="singleSelect: true, collapsible: true, url: 'model/user/get-all-user-json.php', rownumbers: true, pagination: true, tools:'#tools'" style="height: 360px; padding: 10px;" iconCls="" >
		<thead>
			<tr>
				<th data-options="field: 'id', width: 80">ID</th>
				<th data-options="field: 'username', width: 250">Username</th>
				<th data-options="hidden: true, field: 'password'"></th>
			</tr>
		</thead>
	</table>	
</div>

<div id="tools">
	<a href="javascript:void(0);" class="icon-add" onclick="crud('insert');"></a>
	<a href="javascript:void(0);" class="icon-edit" onclick="crud('update');"></a>
	<a href="javascript:void(0);" class="icon-remove" onclick="del();"></a>
</div>

<div id="win-form-user" class="easyui-window" title="Form Input" data-options="modal: true, closed: true" style="width: 400px; height: 170px; padding: 10px">
	<table width="100%">		
		<tr>
			<td align="right">Username</td>
			<td>:</td>
			<td>
				<input type="hidden" name="id" id="id" />
				<input type="text" name="username" id="username" style="width: 150px;" />				
			</td>
		</tr>		
		<tr>
			<td align="right">Password</td>
			<td>:</td>
			<td><input type="password" name="password" id="password" style="width: 200px;" /></td>			
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
				username: $("#cari-username").val()
			});		
		});
	});

	function del() {
		var row = $("#tbl-user").datagrid("getSelected");

		if (row == null) {
			alert("Anda belum memilih data yang akan dihapus!");
			return false;
		}

		if (confirm("Hapus data dengan Username: " + row.username + "?")) {
			$.ajax({
				url: "model/user/delete-user.php",
				data: { id: row.id },
				success: function(data) {
					$("#tbl-user").datagrid("reload");
				},
				error: function() {

				}
			})
		}		
	}

	function crud(flag) {
		$("#username").val("");
		$("#password").val("");
		$("#konfirmasi").val("");

		if (flag == "update") {
			var row = $("#tbl-user").datagrid("getSelected");

			if (row == null) {
				alert("Anda belum memilih data yang akan dirubah!");
				return false;
			}

			$("#win-form-user").window({
				title: "Form Edit"
			}).window("open");
						
			$("#id").val(row.id);
			$("#username").val(row.username);

			$("#simpan").unbind("click").bind("click", function() {
				// validasi, cek input
				var parm = {
					id: $("#id").val(),
					username: $("#username").val(),
					password: $("#password").val()					
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
					id: $("#id").val(),
					username: $("#username").val(),
					password: $("#password").val()	
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