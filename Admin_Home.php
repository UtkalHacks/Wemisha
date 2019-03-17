<?php
   session_start();
   if(!($_SESSION['admin_id']))
      {
       echo '<script type="text/javascript"> alert("Please login to continue.") </script>';
       echo '<script type="text/javascript"> location.href="./Admin_Login.php" </script>';
      }
?>
<!DOCTYPE html>
<html>

  <head>
    <title>FRIENDZY | Admin Home</title>

    <style type="text/css">
      .workarea { background-color: rgba(0,0,0,0.7); height: 490px; width: 800px; margin-left: 300px;
                  margin-top: 10px;}

      .panel { background-color: rgba(0,0,0,0.85); height: 80px; width: 800px; }

      .panel-label { color: white; font-size: 22px; font-family: Bookman Old Style; padding-top: 10px;}

      .request { height:70px; width: 780px; background-color: rgba(0,0,0,0.7); margin-top: 10px; 
                  margin-left: 10px;  border-color: rgba(255,0,0,1.0); 
                  border-radius: 5px;}

      .request:hover { background-color: rgba(0,0,0,0.9); transition: 0.5s; }

      .btn:hover { background-color: rgba(255,0,0,1.0); transition: .3s ease;}

      .btn  { border-radius:5px; width:200px; margin-top:15px; margin-left:50px; padding:8px;
              font-weight:none;
              border-width:2px;  color: white; cursor: pointer; font-size: 15px; font-family: Verdana;
                border-color: rgba(255,0,0,1.0);  text-decoration: none;background-color: rgba(0,0,0,0.6); transition: .5s; }
     
    </style>
   
    <link rel='stylesheet' type='text/css' href='./css/homestyle.css' >
	
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
        <div class="workarea">  
           <div class="panel">
               <form action="" method="post">
                 <table style='color:white; font-size:18px; font-family:Bookman Old Style;'>
                    <tr>
                       <td>
                          <input class="btn" type="submit" value="Logout" name="btn_logout">
                       </td>
                       <td style='font-size:20px; padding-left:30px; margin-top:10px;'>
                         <center><p>Admin Control Panel</p></center>
                       </td>
                       <td style='padding-left:10px;'>
                          <input class="btn" type="submit" value="Home" name="btn_home">
                       </td>
                    </tr>
                 </table>
              </form>
           </div>

           <?php
                if(isset($_POST['btn_home']))
                   echo '<script type="text/javascript"> location.href="./Admin_Home.php"</script>';

                if(isset($_POST['btn_logout']))
                   echo '<script type="text/javascript"> location.href="./Admin_Logout.php"</script>';

           ?>

           <div class='request'> 
              <form action="./Admin_Approve.php" method="post">
                 <table style='color:white; font-size:18px; font-family:Bookman Old Style;'>
                    <tr>
                       <td style='padding-left:100px; padding-top:15px;'>Approval Section</td>
                       <td style='padding-left:150px;'>
                          <input class="btn" type="submit" value="Select" name="btn_select_approve">
                       </td>
                    </tr>
                 </table>
              </form>
           </div>

           <div class='request'> 
              <form action="./Admin_Manage_Dep.php" method="post">
                 <table style='color:white; font-size:18px; font-family:Bookman Old Style;'>
                    <tr>
                       <td style='padding-left:100px; padding-top:15px;'>Manage Departments</td>
                       <td style='padding-left:110px;'>
                         <input class="btn" type="submit" value="Select" name="btn_manage_dep">
                       </td>
                    </tr>
                 </table>
              </form>
           </div>

           <div class='request'> 
              <form action="./Admin_Manage_HOD.php" method="post">
                 <table style='color:white; font-size:18px; font-family:Bookman Old Style;'>
                    <tr>
                       <td style='padding-left:100px; padding-top:15px;'>Manage HOD Profiles</td>
                       <td style='padding-left:110px;'>
                          <input class="btn" type="submit" value="Select" name="btn_manage_hod">
                       </td>
                    </tr>
                 </table>
              </form>
           </div>

           <div class='request'> 
              <form action="./Admin_Change_User_ID.php" method="post">
                 <table style='color:white; font-size:18px; font-family:Bookman Old Style;'>
                    <tr>
                       <td style='padding-left:100px; padding-top:15px;'>Change User ID</td>
                       <td style='padding-left:157px;'>
                          <input class="btn" type="submit" value="Select" name="btn_change_user_id">
                       </td>
                    </tr>
                 </table>
              </form>
           </div>

           <div class='request'> 
              <form action="./Admin_Change_Password.php" method="post">
                 <table style='color:white; font-size:18px; font-family:Bookman Old Style;'>
                    <tr>
                       <td style='padding-left:100px; padding-top:15px;'>Change Password</td>
                       <td style='padding-left:140px;'>
                          <input class="btn" type="submit" value="Select" name="btn_change_pass">
                       </td>
                    </tr>
                 </table>
              </form>
           </div>
        </div>
  </div>
	

  <div class="divider"></div>

	<footer></footer>
  </body>


  </html>
