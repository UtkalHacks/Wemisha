<?php
             session_start();

             if(isset($_SESSION['roll_no']))
                 {
                  session_destroy();
                  echo '<script type="text/javascript"> location.href="./Student_Login.php" </script>';
                 }
 ?> 