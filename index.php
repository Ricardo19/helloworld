<?php session_start(); ?>
<!--?php include 'functions.php'; ?-->

<!DOCTYPE html>
<html>
   <head>
      <title>helloworld</title>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <?php include "layouts/stylesheets.php" ?>
   </head>
   <body>
      <div class="container">
         <?php include "layouts/header.php" ?>
         <section class="round">
            <?php include "layouts/flash_messages.php" ?>

            <?php

            //SE O UTILIZADOR ESTÁ COM LOGIN FEITO
            if (isset($_SESSION['user'])) {
               $username = $_SESSION['user'];
               ?>
               <h4>Bem-vindo <b><?php echo $username; ?></b></h4>
               <?php

               if (isset($_SESSION['admin'])) {
                  ?>
                  <a href="conta_Pessoal_Admin.php" class="signup_button round">Perfil pessoal</a>
                  <?php

               }
               else {
                  ?>
                  <a href="conta_Pessoal_User.php" class="signup_button round">Perfil pessoal</a>

                  <?php

               }
            }
            else {
               ?>
<?php } ?>
         </section>
<?php include "layouts/footer.php" ?>
          
           <table style="border: 1px solid #000000;">
           <tr>
               <td>
                   
               </td>
           </tr>
           
       </table>
      </div>
   </body>
</html>