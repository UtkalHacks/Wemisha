<?php
  require "Connection.php";
  require "Input_Validate.php";
?>
<html>

 <head>
    <title>FRIENDZY | Student Sign Up</title>

    <style type="text/css">

      .form { height: 450px; width: 450px; background-color: rgba(0,0,0,0.6); float: right; margin-right: 100px;
      	      margin-top: 20px;  box-shadow: 0 4px 10px 4px rgba(19,35,47,0.3); transition: .5s ease;}

      .fix{position: fixed; overflow: auto;}

      .signup_form{  margin-top: 55px; overflow: auto; height: 400px;}

      .signup_form::-webkit-scrollbar { width: 8px; }

      .signup_form::-webkit-scrollbar-thumb { background-color: rgba(255,0,0,0.7); outline: 0;
                                              border-radius: 50px;
                                       box-shadow: 0 4px 10px rgba(0,0,0,0.5); }

      #treg { padding-top: 10%; padding-left: 8%; padding-bottom:10%; }

      

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
			 <li> <a class="colred" href="#">Student Corner</a> </li>
			 <li> <a class="colblack" href="./Faculty_Login.php">Faculty Corner</a> </li>
			 <li> <a class="colblack" href="./HOD_Login.php">HOD Corner</a> </li>
			 <li> <a class="colblack" href="./Admin_Login.php">Admin Corner</a> </li>
		  </ul>
	   </nav>
	</header>

	<div class="divider"></div>


	<div class="backimg">




    <div class="form">

           <div class="fix">
           <div class="tab">
              <nav>
                <ul id="formtabs">
                   <li> <a class="colhov" href="./Student_Login.php">Log In</a> </li>
                   <li> <a class="colgrey" href="#">Sign Up</a> </li>
                   <li> <a class="colhov" href="./Student_Status.php">Status</a></li>
                </ul>
              </nav>
           </div>
           <div class="divider2"></div>
         </div>

           <div class="signup_form">
           <form name="form_stud_reg" id="reg" action="" method="post">
               <table id="treg">
                  <h3 style="color:white"><center>Requied fields are marked with (<span class="req">*</span>)</center></h3>
                  <tr><td id="label">First Name:<span class="req">*</span></td><td><input class="textbox" type="text" name="txt_f_name"></td></tr>
                  <tr><td id="label">Middle Name:</td><td><input class="textbox" type="text" name="txt_m_name"></td></tr>
                  <tr><td id="label">Last Name:<span class="req">*</span></td><td><input class="textbox" type="text" name="txt_l_name"></td></tr>
                  <tr><td id="label">Roll No:<span class="req">*</span></td><td><input class="textbox" type="text" name="txt_roll_no"></td></tr>
                  <tr><td id="label">Email:</td><td><input class="textbox" type="email" name="txt_email"></td></tr>
                  <tr><td id="label">Phone No (+91):</td><td><input class="textbox" type="number" name="txt_phone"></td></tr>
                  <tr><td id="label">I am:<span class="req">*</span></td><td style="color:white">Male<input type="radio" name="r1" value="Male">   Female<input type="radio" name="r1" value="Female">   Others<input type="radio" name="r1" value="Others"></tr>
                  <tr><td id="label">Password:<span class="req">*</span></td><td><input class="textbox" type="password" name="txt_pass"></td></tr>
                  <tr><td id="label">Retype Password:<span class="req">*</span></td><td><input class="textbox" type="password" name="txt_c_pass"></td></tr>
                  <tr><td><input class="btn" type="submit" value="Sign Up" name="btn_sign_up"></td>
                      <td><input class="btn" type="reset" value="Clear"></td></tr>
                  </table>
           </form>
           </div>

		  </div>

   </div>
	<div class="divider"></div>

	<footer></footer>
  </body>

</html>

<?php
               
                if(isset($_POST['btn_sign_up'])) 
                {
                   
                   $f_name=test_input($_POST['txt_f_name']);
                   $m_name=test_input($_POST['txt_m_name']);
                   $l_name=test_input($_POST['txt_l_name']);
                   $roll_no=test_input($_POST['txt_roll_no']);
                   $email=test_input($_POST['txt_email']);
                   $phone=test_input($_POST['txt_phone']);
                   $gender=test_input($_POST['r1']);
                   $password=test_input($_POST['txt_pass']);
                   $c_password=test_input($_POST['txt_c_pass']);

                   $reg_status=0;
                   $check_id=0;

                   $len=strlen($roll_no);
           

                   if($f_name==null||$l_name==null||$roll_no==null||$gender==null||$password==null||$c_password==null)
                   {
                    echo '<script type="text/javascript"> alert("Please fill all the Required fields.") </script>';
                   }

                   else if($password!=$c_password)
                   {
                     echo '<script type="text/javascript"> alert("Passwords do not match.") </script>';
                   }
                   
                   else
                   {
                         $query="select * from student_details where roll_no='$roll_no'";
                         $result=mysqli_query($con,$query);
                         
                         if ($result)
                           {
                              $row_count=mysqli_num_rows($result);
                              if($row_count==1)
                                 $check_id=1;
                           }

                         if($check_id==1)
                             echo '<script type="text/javascript"> alert("Registration with the given Roll No already exist.") </script>';
                         
                         else
                          {
                            $query="insert into student_details(f_name,m_name,l_name,roll_no,email,phone,gender,reg_status,password) values('{$f_name}','{$m_name}','{$l_name}','{$roll_no}','{$email}','{$phone}','{$gender}','{$reg_status}','{$password}')";
                            if (mysqli_query($con,$query))
                                echo '<script type="text/javascript"> alert("Your Registration has been sent to your respective HOD for Approval. Once approved you cal login with your Roll No and Password. You can check your Registration Status from the Status Tab Section.") </script>';
                          }
                         mysqli_close($con);
                   }

                }

            ?>