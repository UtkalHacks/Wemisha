<?php
  require "Connection.php";
  require "Input_Validate.php";
  session_start();
?>
<!DOCTYPE html>
<html>

 <head>
    <title>FRIENDZY | Admin Login</title>

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
       <li> <a class="colblack" href="./HOD_Login.php">HOD Corner</a> </li>
       <li> <a class="colred" href="#">Admin Corner</a> </li>
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
                </ul>
              </nav>
           </div>
           <div class="divider2"></div>

           <form name="form_stud_login" id="login" action="./Admin_Login.php" method="post" onsubmit="">
               <table id="tlog">
                  <tr>
                    <td id="label">User ID<span class="req">*</span></td>
                    <td><input type="text" class="textbox" name="txtuser"></td>
                  </tr>
                  <tr>
                    <td id="label">Password<span class="req">*</span></td>
                    <td><input type="password" class="textbox" name="txtpass"></td>
                  </tr>
                  <tr>
                    <td><input class="btn" type="submit" style="" value="Log In" name="btn_login"></td>
                    <td><input class="btn" type="reset" style="" value="Clear" name="btn_clear"></td>
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
                    
                    
                    $username=test_input($_POST['txtuser']);
                    $password=test_input($_POST['txtpass']);

                    if($username=="" || $password=="")
                       echo '<script type="text/javascript"> alert("User ID and/or Password cannot be empty.") </script>';
                    else
                    {
                     $query="select * from admin_security WHERE user_id='$username' AND password='$password'";
                     $result=mysqli_query($con,$query);   
                     $row_count=mysqli_num_rows($result);
                      
                     if($row_count==1)
                       {
                        $_SESSION['admin_id']=1;
                        mysqli_close($con);
                        header("location:Admin_Home.php");
                       }                       
                     else
                       {
                        echo '<script type="text/javascript"> alert("Invalid Details.") </script>';
                        echo '<script type="text/javascript"> location.href="./Admin_Login.php"</script>';
                       }
                     }
                    }
           ?>