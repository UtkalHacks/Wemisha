<?php
  require "Connection.php";
  require "Input_Validate.php";
  session_start();
?>
<html>

 <head>
    <title>FRIENDZY | HOD Login</title>

    <style type="text/css">

      .form { height: 350; width: 450px; background-color: rgba(0,0,0,0.6); float: right; margin-right: 100px;
      	      margin-top: 20px;  box-shadow: 0 4px 10px 4px rgba(19,35,47,0.3); transition: .5s ease;}

       #tlog { padding-top: 10%; padding-left: 10%; padding-bottom:10%;}

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
       <li> <a class="colblack" href="./Faculty_Login.php">Faculty Corner</a> </li>
       <li> <a class="colred" href="#">HOD Corner</a> </li>
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
                   <li> <a class="colgrey" href="#">Log In</a> </li>
                   <li> <a class="colhov" href="./HOD_SignUp.php">Sign Up</a> </li>
                   <li> <a class="colhov" href="./HOD_Status.php">Status</a></li>
                </ul>
              </nav>
           </div>
           <div class="divider2"></div>

           <form name="form_hod_login" id="login" action="./HOD_Login.php" method="post" onsubmit="">
               <table id="tlog">
                  <tr><td id="label">Department ID<span class="req">*</span></td>
                       <td><input type="text" class="textbox" name="txt_dep_id"></td>
                  </tr>
                  <tr><td id="label">Password<span class="req">*</span></td>
                      <td><input type="password" class="textbox" name="txt_pass"></td>
                  </tr>
                  <tr><td><input class="btn" type="submit" style="" value="Log In" name="btn_login"></td>
                      <td><input class="btn" type="reset" style="" value="Clear"></td>
                  </tr>
               </table>
           </form>

		</div>

   </div>
	<div class="divider"></div>

	<footer></footer>
  </body>

</html>


<?php
     if(isset($_POST['btn_login']))
        {
                  
           $dep_id=$_POST['txt_dep_id'];
           $password=$_POST['txt_pass'];

           if($dep_id=="" || $password=="")
                echo '<script type="text/javascript"> alert("Department ID and/or Password cannot be empty.") </script>';
           else
             {
                 $query="select reg_status from hod_details WHERE d_id='$dep_id' AND password='$password'";
                 $result=mysqli_query($con,$query);  
                 if($result)
                     { 
                       $row_count=mysqli_num_rows($result);
 
                       if($row_count==1)
                         {

                            $row=mysqli_fetch_assoc($result);
                            $status=$row['reg_status'];
                            if($status==1)
                             {
                               $_SESSION['department_id']=$dep_id;
                               mysqli_close($con);
                               header("location:HOD_Home.php");
                             }
                            else if($status==0)
                              echo '<script type="text/javascript"> alert("Your Registraion is still pending for approval. Once approved you can login with your Department ID and Passwowd.") </script>';
                         }                       
                       else
                          echo '<script type="text/javascript"> alert("Invalid Details.") </script>';
                    }
              }
         }

?>