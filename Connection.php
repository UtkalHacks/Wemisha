<?php
      $con=mysqli_connect("localhost","root","");
      if(!$con)
        echo '<script type="text/javascript"> alert("Connection Failed.") </script>';
      mysqli_select_db($con,"data_ucp");
?>