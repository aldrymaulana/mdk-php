<?php
	session_start();

	require_once 'lib/conn.inc.php';
	require_once 'lib/custom.inc.php';

	checkSession();
?>

<script type="text/javascript">	
	swfobject.embedSWF(
	  "open-flash-chart.swf", "chart_1",
	  "100%", "100%", "9.0.0", "expressInstall.swf",
	  {"data-file":
	  	"<?php 
	  		if ( $_SESSION[ 'group_id' ] == 1 ) echo 'chart/jml-mdk-per-kecamatan.php'; 
	  		else if ( $_SESSION[ 'group_id' ] == 3 ) echo 'chart/jml-mdk-per-rw.php';
	  	?>", "loading":"Sedang diproses, harap menunggu..."} 
	);

	swfobject.embedSWF(
	  "open-flash-chart.swf", "chart_2",
	  "100%", "100%", "9.0.0", "expressInstall.swf",
	  {"data-file":"chart/jml-mdk-per-kelurahan.php", "loading":"Sedang diproses, harap menunggu..."} 
	);

	swfobject.embedSWF(
	  "open-flash-chart.swf", "chart_3",
	  "100%", "100%", "9.0.0", "expressInstall.swf",
	  {"data-file":"chart/jml-jenis-kontrasepsi-kota.php", "loading":"Sedang diproses, harap menunggu..."} 
	);

	// pop-up window u/ menampilkan chart per rt
	function getDetail(id) {
		$("#chart-win").window("open");
		swfobject.embedSWF(
		  "open-flash-chart.swf", "win-chart-1",
		  "100%", "90%", "9.0.0", "expressInstall.swf",
		  {"data-file":"chart/jml-mdk-per-rt.php?rwId="+id, "loading":"Sedang diproses, harap menunggu..."} 
		);
	}

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

<div class="easyui-accordion" data-options="fit:true,border:false">
	<div title="
		<?php 
			if ( $_SESSION[ 'group_id' ] == 1 ) {
				echo 'Jml. Data Peserta KB Per Kecamatan'; 
			} else if ( $_SESSION[ 'group_id' ] == 3 ) {				
				echo 'Jml. Data Peserta KB Per RW ' . $_SESSION[ 'nama' ];
			}
		?>" style="padding:10px;">					
		<div id="chart_1"></div>
	</div>

	<?php
		if ( $_SESSION[ 'group_id' ] == 1 ) {
	?>				
	<div title="Jml. Data Peserta KB Per Kelurahan" style="padding:10px">
		<div id="chart_2"></div>
	</div>	
	<div title="Jml. Pemakaian Alat Konstrasepsi Berdasarkan Jenis" style="padding:10px">
		<div id="chart_3"></div>
	</div>
	<?php
		}
	?>
</div>

<div class="easyui-window" title="Jml. Data Peserta KB Per RT <?php echo $_SESSION[ 'nama' ]; ?>" data-options="minimizable: false, closed:true, modal: true" style="width: 700px; height: 500px;" id="chart-win">
	<div id="win-chart-1"></div>
</div>
