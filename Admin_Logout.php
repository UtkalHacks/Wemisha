<?php
             session_start();

             if(isset($_SESSION['admin_id']))
                 {
                  session_destroy();
                  echo '<script type="text/javascript"> location.href="./Admin_Login.php" </script>';
                 }
 ?> 