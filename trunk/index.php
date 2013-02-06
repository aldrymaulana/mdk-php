<!DOCTYPE html>  
<html>  
  <head>  
    <meta charset="UTF-8">  
    <title>Dinas BPMPPKB Kota Cimahi</title>  
    <link rel="icon" type="image/png" href="img/cimahi-kecil.png">      
    <link rel="shortcut icon" type="image/ico" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.3.2/themes/default/easyui.css">  
    <link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.3.2/themes/icon.css">  
    <link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.3.2/demo/demo.css">  
    <script type="text/javascript" src="js/jquery-easyui-1.3.2/jquery-1.8.0.min.js"></script>  
    <script type="text/javascript" src="js/jquery-easyui-1.3.2/jquery.easyui.min.js"></script> 
    <script type="text/javascript" src="js/jquery-easyui-1.3.2/locale/easyui-lang-id.js"></script> 
  </head>  

  <body>  
    <center>
      <h2>Aplikasi Pengelolaan Data Peserta KB</h2>
    </center>
    <center>
      <div style="margin:10px 0;"></div>  
      <div class="easyui-panel" title="Form Login" style="width:400px">  
        <div style="padding:10px 0 10px 60px">  
          <form id="ff" method="post">  
            <table>  
              <tr>  
                <td align="right">Username</td>
                <td>:</td>
                <td><input class="easyui-validatebox" type="text" name="username" id="username" data-options="required:true"></input></td>  
              </tr>  
              <tr>  
                <td align="right">Password</td>  
                <td>:</td>
                <td><input class="easyui-validatebox" type="password" name="password" id="password" data-options="required:true"></input></td>  
              </tr>           
              <tr>  
                <td align="right">Tahun</td>  
                <td>:</td>
                <td>
                  <select name="tahun" id="tahun">
                    <?php
                      $tahunAwal = 2010;
                      $tahunAkhir = date( 'Y' );
                      for ( $i=$tahunAwal; $i <= $tahunAkhir; $i++ ) {
                        if ( $tahunAkhir == $i ) {
                          echo '<option value=' . $i . ' selected>' . $i . '</option>';
                        } else {
                          echo '<option value=' . $i . '>' . $i . '</option>';
                        }
                      }
                    ?>
                  </select>
                  <span id="loading">
                    <img src="img/ajax-loader.gif" />
                  </span>
                </td>  
              </tr>                 
            </table>  
          </form>  
        </div>  
        <div style="text-align:center;padding:5px">  
          <a href="javascript:void(0)" class="easyui-linkbutton" onclick="submitForm()">Masuk</a>  
          <a href="javascript:void(0)" class="easyui-linkbutton" onclick="clearForm()">Ulang</a>  
        </div>  
      </div>      
    </center>

    <script>      
      $(document).ready(function() {        
        /*$("#loader")
          .hide()
          .ajaxStart(function() {
            $(this).show()
          })
          .ajaxStop(function() {
            $(this).hide()
          });*/
        $("#loading").hide();
      });

      function submitForm() {
        var parm = {
          username: $("#username").val(),
          password: $("#password").val(),
          tahun: $("#tahun").val()
        };

        $.ajax({
          url: "model/login/check-login.php",
          data: parm,
          success: function(data) {
            if (data == 'sukses') {              
              $("#loading").show();
              setTimeout(function() {
                window.location.replace("http://10.3.23.90/mdk-php/main.php")
              }, 1000);
            } else {
              $.messager.alert("Error", "Login gagal!", "error");
            }
          },
          error: function() {}
        });
      }  

      function clearForm(){  
        $('#ff').form('clear');  
      }  
    </script>  
  </body>  
</html>  