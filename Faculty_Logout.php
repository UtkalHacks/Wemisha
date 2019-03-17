<?php
             session_start();

             if(isset($_SESSION['fac_id']))
                 {
                  session_destroy();
                  echo '<script type="text/javascript"> location.href="./Faculty_Login.php" </script>';
                 }
 ?> 