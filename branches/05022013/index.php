<!DOCTYPE html>  
<html>  
  <head>  
    <meta charset="UTF-8">  
    <title>MDK Tool</title>  
    <link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.3.2/themes/default/easyui.css">  
    <link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.3.2/themes/icon.css">  
    <link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.3.2/demo/demo.css">  
    <script type="text/javascript" src="js/jquery-easyui-1.3.2/jquery-1.8.0.min.js"></script>  
    <script type="text/javascript" src="js/jquery-easyui-1.3.2/jquery.easyui.min.js"></script> 
    <script type="text/javascript" src="js/jquery-easyui-1.3.2/locale/easyui-lang-id.js"></script> 
  </head>  

  <body>  
    <center>
      <h2>Aplikasi MDK</h2>
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
      function submitForm() {
        var parm = {
          username: $("#username").val(),
          password: $("#password").val()
        };

        $.ajax({
          url: "model/login/check-login.php",
          data: parm,
          success: function(data) {
            if (data == 'sukses') {
              window.location.replace("http://10.3.23.90/mdk-php/main.php")
            } else {
              $.messager.alert("Error", "Login gagal!", "error");
            }
          },
          error: function() {

          }
        });
      }  

      function clearForm(){  
        $('#ff').form('clear');  
      }  
    </script>  
  </body>  
</html>  