<?php
             session_start();

             if(isset($_SESSION['department_id']))
                 {
                  session_destroy();
                  echo '<script type="text/javascript"> location.href="./HOD_Login.php" </script>';
                 }
 ?> 