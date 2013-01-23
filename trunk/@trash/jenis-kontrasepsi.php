<div id="panel-jenis-kontrasepsi" class="easyui-panel" title=" " style="padding: 10px;">
	<div id="panel-search" class="easyui-panel" title="Pencarian" data-options="collapsible: true">		
		<table align="center" width="30%">				
			<tr>
				<td align="left">Jenis Kontrasepsi</td>
				<td>:</td>
				<td><input type="text" id="cari-jenis-kontrasepsi" name="cari-jenis-kontrasepsi" /></td>
				<td><button id="btn-search">Cari</button></td>
			</tr>				
		</table>
	</div>

	<table class="easyui-datagrid" title="Tabel Jenis Kontrasepsi" id="tbl-jenis-kontrasepsi" data-options="singleSelect: true, collapsible: true, url: 'model/get-all-jenis-kontrasepsi-json.php', rownumbers: true, pagination: true, tools:'#tools'" style="height: 360px; padding: 10px;" iconCls="" >
		<thead>
			<tr>
				<th data-options="field: 'JenisKontrasepId', width: 80">ID</th>
				<th data-options="field: 'Jenis', width: 250">Jenis Kontrasepsi</th>				
			</tr>
		</thead>
	</table>	
</div>

<div id="tools">
	<a href="javascript:void(0);" class="icon-add" onclick="crud('insert');"></a>
	<a href="javascript:void(0);" class="icon-edit" onclick="crud('update');"></a>
	<a href="javascript:void(0);" class="icon-remove" onclick="del();"></a>
</div>

<div id="win-form" class="easyui-window" title="Form Input" data-options="modal: true, closed: true" style="width: 350px; height: 120px; padding: 10px">
	<table width="100%">		
		<tr>
			<td align="right">Jenis Kontrasepsi</td>
			<td>:</td>
			<td>
				<input type="hidden" name="JenisKontrasepId" id="JenisKontrasepId" />
				<input type="text" name="Jenis" id="Jenis" style="width: 150px;" />				
			</td>
		</tr>					
		<tr>
			<td colspan="3" align="center"><button id="simpan">Simpan</button></td>			
		</tr>
	</table>
</div>

<script type="text/javascript">
	$(function() {
		$("#btn-search").unbind("click").bind("click", function() {
			$("#tbl-jenis-kontrasepsi").datagrid("load", {
				search: "true",
				Jenis: $("#cari-jenis-kontrasepsi").val()
			});		
		});
	});

	function del() {
		var row = $("#tbl-jenis-kontrasepsi").datagrid("getSelected");

		if (row == null) {
			alert("Anda belum memilih data yang akan dihapus!");
			return false;
		}

		if (confirm("Hapus data dengan Jenis: " + row.Jenis + "?")) {
			$.ajax({
				url: "model/delete-jenis-kontrasepsi.php",
				data: { id: row.id },
				success: function(data) {
					$("#tbl-jenis-kontrasepsi").datagrid("reload");
				},
				error: function() {

				}
			})
		}		
	}

	function crud(flag) {
		$("#Jenis").val("");
		
		if (flag == "update") {
			var row = $("#tbl-jenis-kontrasepsi").datagrid("getSelected");

			if (row == null) {
				alert("Anda belum memilih data yang akan dirubah!");
				return false;
			}

			$("#win-form").window({
				title: "Form Edit"
			}).window("open");
						
			$("#JenisKontrasepId").val(row.JenisKontrasepId);
			$("#Jenis").val(row.Jenis);

			$("#simpan").unbind("click").bind("click", function() {
				// validasi, cek input
				var parm = {
					JenisKontrasepId: $("#JenisKontrasepId").val(),
					Jenis: $("#Jenis").val()
				};

				$.ajax({
					type: "post",
					url: "model/update-jenis-kontrasepsi.php",
					data: parm,
					success: function(data) {
						if (data == "sukses") {
							alert("Data berhasil diupdate!");
							$("#tbl-jenis-kontrasepsi").datagrid("reload");							
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
			$("#win-form").window({
				title: "Form Input"
			}).window("open");

			$("#simpan").unbind("click").bind("click", function() {
				// validasi, cek input
				var parm = {					
					Jenis: $("#Jenis").val()
				};

				$.ajax({
					type: "post",
					url: "model/save-jenis-kontrasepsi.php",
					data: parm,
					success: function(data) {
						if (data == "sukses") {
							alert("Data berhasil disimpan!");	
							$("#tbl-jenis-kontrasepsi").datagrid("reload");
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
</script>