<?php
  session_start();

  require_once 'lib/custom.inc.php';

  checkSession();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Aplikasi MDK</title>
		<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.3.2/themes/default/easyui.css">
		<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.3.2/themes/icon.css">
		<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.3.2/demo/demo.css">
		<script type="text/javascript" src="js/jquery-easyui-1.3.2/jquery-1.8.0.min.js"></script>
		<script type="text/javascript" src="js/jquery-easyui-1.3.2/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="js/jquery-easyui-1.3.2/locale/easyui-lang-id.js"></script>		
		<script type="text/javascript" src="js/custom.js"></script>
	</head>
	<body>	
		<div style="margin:10px 0;"></div>
		<div class="easyui-layout" style="width:100%; height:700px;">
			<div data-options="region:'north'" style="height:50px">JUDUL</div>
			<div data-options="region:'south',split:true" style="height:50px;">FOOTER</div>
			<div data-options="region:'west',split:true" title="Panel Menu" style="width:200px;">
				<div class="easyui-accordion" data-options="fit:true,border:false">
					<div title="MDK" style="padding:10px;">					
						<ul id="menu-tree" class="easyui-tree" data-options="url:'json/menu-tree.json',animate:true,dnd:true"></ul>		
					</div>					
					<div title="Sistem" style="padding:10px">
						<ul id="menu-sistem-tree" class="easyui-tree" data-options="url:'json/menu-sistem-tree.json',animate:true,dnd:true"></ul>
					</div>
				</div>
			</div>
			<div id="content" class="easyui-tabs" data-options="region:'center',title:'Dashboard',iconCls:'icon-ok'"></div>
		</div>

		<script>
			$(function() {
				$("#menu-tree").tree({
					onClick: function(node) {
						switch (node.text) {
							case "Keluarga" : {
								addTab($("#content"), node.text, "keluarga.php");
							} break;
							
							case "Keluarga KB" : {
								addTab($("#content"), node.text, "keluarga-kb.php");
							} break;							
						}
					}
				});

				$("#menu-sistem-tree").tree({
					onClick: function(node) {
						switch (node.text) {
							case "User" : {
								addTab($("#content"), node.text, "user.php");
							} break;							

							case "Logout" : {
								$.messager.confirm("Konfirmasi", "Keluar dari aplikasi?", function(r) {
									if (r) {
										addTab($("#content"), node.text, "logout.php");
									}
								});								
							} break;
						}
					}
				})
			});			
		</script>
	</body>
</html>
