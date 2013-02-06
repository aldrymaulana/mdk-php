<script type="text/javascript">	
	swfobject.embedSWF(
	  "open-flash-chart.swf", "chart_1",
	  "100%", "100%", "9.0.0", "expressInstall.swf",
	  {"data-file":"chart/jml-mdk-per-kelurahan.php"} 
	);

	swfobject.embedSWF(
	  "open-flash-chart.swf", "chart_2",
	  "100%", "100%", "9.0.0", "expressInstall.swf",
	  {"data-file":"chart/jml-mdk-per-kecamatan.php"} 
	);
	
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
</script>

<!--<div id="chart_1"></div>-->
<div class="easyui-accordion" data-options="fit:true,border:false">
	<div title="Jml. Data MDK Per Kelurahan" style="padding:10px;">					
		<div id="chart_1"></div>
	</div>					
	<div title="Jml. Data MDK Per Kecamatan" style="padding:10px">
		<div id="chart_2"></div>
	</div>
</div>
