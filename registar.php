<?php session_start(); ?>

<!DOCTYPE html>
<html>
   <head>
      <title>helloworld</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <?php include "layouts/stylesheets.php" ?>
      <script type="text/javascript">
         jQuery(document).ready(function() {
            //$('#username').keyup(function(){$('#pass').html(passwordStrength($('#password').val(),$('#username').val()))})
            $('#password').keyup(function(){$('#pass').html(passwordStrength($('#password').val(),$('#username').val()))})
         });
      </script>
   </head>
   <body>
      <div class="container">
         <?php include "layouts/header.php" ?>
         <section class="round">
            <?php include "layouts/flash_messages.php" ?>
            <?php

            // UTILIZADOR JÃ ESTÁ COM LOGIN FEITO
            if (isset($_SESSION['user'])) {
               print_msg_and_redirect('notice', 'Já se encontra com o login efectuado.', 'index.php');
            }
            // SE FOR UM PEDIDO DE INICIAR O LOGIN, MOSTRA FORM DE LOGIN
            else {
               ?>
               <form name="registo" method="post" action="registar.php" enctype="multipart/form-data" onsubmit="return validar();">
                  <table>
                      <tr>
                          <td>
                              <b>Efectue o seu Registo</b>
                          </td>
                      </tr>
                     <tr>
                        <td>Nome:</td>
                        <td><input type="text" name="name"><img src="files/images/pin.png"/></td>
                        <td></td>
                     </tr>
                     <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" onkeyup="verifica('username');"><img src="files/images/pin.png"/></td>
                        <td style="width: 25%;"><span style="color: red;" id='username'></span></td>
                     </tr>
                     <tr>
                        <td>Email:</td>
                        <td><input type="text" name="email" onkeyup="verifica('email');"><img src="files/images/pin.png"/></td>
                        <td><span style="color: red;" id='email'></span></td>
                     </tr>
                     <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password"><img src="files/images/pin.png"/></td>
                        <td><span style="color: red;" id='pass'></span></td>
                     </tr>
                     <tr>
                        <td>Confirme a Password:</td>
                        <td><input type="password" name="password_confirm" onkeyup="compara();"><img src="files/images/pin.png"/></td>
                        <td><span style="color: red;" id='pass2'></span></td>
                     </tr>
                     <tr>
                        <td>Foto:
                           <input type="file" name="poster"/></br>
                        </td>
                        <!--<td><input type="file" name="foto"/></td>-->
                       <!-- <td><input type="submit" name="register" id="register" value="Registar"></td-->
                     </tr>
                  </table>
                  <td><input type="image" src="files/images/check.png" value="submit" name="regista" title="Efectue o seu Registo"><img src="files/images/clear.png" onclick=document.registo.reset() style="cursor:hand" title="Limpar Campos"></td>
               </form>
               <?php

            }
            ?>
         </section>
         <?php include "layouts/footer.php" ?>
      </div>

      <script type="text/javascript">
         var verif="";
         function verifica(st){
            var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
               xmlhttp=new XMLHttpRequest();
            }
            else{// code for IE6, IE5
               xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
               if (xmlhttp.readyState==4 && xmlhttp.status==200){
                  document.getElementById(st).innerHTML=xmlhttp.responseText;
                  verif=xmlhttp.responseText;
               }
            }
            xmlhttp.open("GET","verifica.php?"+st+"="+document.forms["registo"][st].value,true);
            xmlhttp.send();
         }

         function compara(){
            var pass=document.forms["registo"]["password"].value;
            var pass2=document.forms["registo"]["password_confirm"].value;
            if(pass!=pass2){
               document.getElementById("pass2").innerHTML="As passwords são diferentes.";
            }
            else{
               document.getElementById("pass2").innerHTML="";
            }
            verif=document.getElementById("pass2").innerHTML;
         }

         function validar(){
            var nome=document.forms["registo"]["name"].value;
            var user=document.forms["registo"]["username"].value;
            var mail=document.forms["registo"]["email"].value;
            var pass=document.forms["registo"]["password"].value;
            var pass2=document.forms["registo"]["password_confirm"].value;
            if(pass.length<6){
               alert("A password deve ter pelo menos 6 caracteres!");
               return false;
            }
            if(nome==null || nome=="" || user==null || user=="" ||
               mail==null || mail=="" || pass==null || pass=="" ||
               pass2==null || pass2==""){
               alert("Todos os campos têm de ser preenchidos!");
               return false;
            }
            if(pass!=pass2){
               alert("Passwords diferentes!");
               return false;
            }
            var atpos=mail.indexOf("@");
            var dotpos=mail.lastIndexOf(".");
            if(atpos<1 || dotpos<atpos+2 || dotpos+2>=mail.length){
               alert("E-mail inválido!");
               return false;
            }
            if(verif!=""){
               alert("O formulário ainda contém erros!");
               return false;
            }
         }
      </script>
   </body>
</html>

<?php

// SE ?â UM PEDIDO PARA REGISTAR UM NOVO UTILIZADOR NA BD
if (!empty($_POST['regista'])) {
   include("connect.php");
  ?>