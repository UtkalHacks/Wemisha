<?php
  require "Connection.php";
  require "Input_Validate.php";
?>

<html>

 <head>
    <title>FRIENDZY | Faculty Status</title>

    <style type="text/css">
      
      .form { height: 350; width: 450px; background-color: rgba(0,0,0,0.6); float: right; margin-right: 100px; 
      	      margin-top: 20px;  box-shadow: 0 4px 10px 4px rgba(19,35,47,0.3); transition: .5s ease;}

      #tstat { padding-top: 15%; padding-left: 10%; padding-bottom:0%;}
     
    </style>
	<link rel="stylesheet" type="text/css" href="./css/homestyle.css">
  <link rel="stylesheet" type="text/css" href="./css/formstyle.css">
  </head>
  <body>
    <header>
	   <nav>
	      <h1>FRIENDZY</h1>
		  <ul id="list">
		   <li> <a class="colblack" href="./webhome.php">Home</a> </li>
       <li> <a class="colblack" href="./Student_Login.php">Student Corner</a> </li>
       <li> <a class="colred" href="#">Faculty Corner</a> </li>
       <li> <a class="colblack" href="./HOD_Login.php">HOD Corner</a> </li>
       <li> <a class="colblack" href="./Admin_Login.php">Admin Corner</a> </li>
      </ul>
	   </nav>
	</header>
	
	<div class="divider"></div>
       
       
	<div class="backimg">

		<div class="form">
       
           <div class="tab">
              <nav>
                <ul id="formtabs">
                   <li> <a class="colhov" href="./Faculty_Login.php">Log In</a> </li>
                   <li> <a class="colhov" href="./Faculty_SignUp.php">Sign Up</a> </li>
                   <li> <a class="colgrey" href="#">Status</a></li>
                </ul>
              </nav>
           </div>
           <div class="divider2"></div>

           <form name="stud_view_reg" action="" method="post" onsubmit="">
               <table id="tstat">
               <tr><td id="label">Faculty ID:</td><td><input class="textbox" type="text" name="txt_view"></td></tr>
               </table>
              <p align="center"><input class="btn" type="submit" value="Check" name="btn_check"></p>
    
           </form>

		</div>

   </div>
	<div class="divider"></div>
	
	<footer></footer>
  </body>

</html>

<?php
            if(isset($_POST['btn_check']))
              {
                 $view=test_input($_POST['txt_view']);

                 if($view==null)
                    echo '<script type="text/javascript"> alert("Please enter a Faculty ID to check Registration Status.") </script>';
                 
                 else
                   {
                      $query="select f_id,reg_status from faculty_details where f_id='$view'";
                      $result=mysqli_query($con,$query); 
                      if ($result)
                         {
                           $row_count=mysqli_num_rows($result);
                           if($row_count==1)
                            {
                              $row=mysqli_fetch_assoc($result);
                              if($row['reg_status']==1)
                                 {
                                  echo '<script type="text/javascript"> alert("Your Registration is Approved. You can now login to your Profile.") </script>';
                                  
                                 }
                              else
                                 echo '<script type="text/javascript"> alert("Your Registration has not been approved yet.") </script>';
                            }

                           else
                              echo '<script type="text/javascript"> alert("Sorry Faculty ID does not exist.") </script>';


                          }
                      
                    }
                  
                  mysqli_close($con);
              }


       ?>