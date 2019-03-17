<?php
  require "Connection.php";
  require "Input_Validate.php";
?>
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

      .change { height: 310px; width: 700px; background-color: rgba(0,0,0,0.65); margin: 50px;
                border-radius: 10px;}

      .panel-label { color: white; font-size: 22px; font-family: Bookman Old Style; padding-top: 10px;}

      .request { height:70px; width: 780px; background-color: rgba(0,0,0,0.7); margin-top: 10px; 
                  margin-left: 10px;  border-color: rgba(255,0,0,1.0); 
                  border-radius: 5px;}

      .textbox  { border-radius:5px; background-color:rgba(0,0,0,0.95); height:25px; color: white;
              font-family: Bookman Old Style; margin-top:15px; margin-left: 5px;
                font-size: 16px; width: 200px; border-color:rgba(0,0,0,0.85); transition: .3s;}

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
                       <td style='font-size:20px; padding-left:50px; margin-top:10px;'>
                         <center><p>Change User ID</p></center>
                       </td>
                       <td style='padding-left:20px;'>
                          <input class="btn" type="submit" value="Home" name="btn_home">
                       </td>
                    </tr>
                 </table>
              </form>
           </div>
           <div class="change">

             <form action="" method="post">
                 <table style='color:white; font-size:18px; font-family:Bookman Old Style; padding-top:50px;'>
                    <tr >
                       <td style="padding-top:20px; padding-left:150px;">
                          Current User ID
                       </td>
                       <td style="padding-left:20px;">
                         <input class="textbox" type="text"  name="txt_cur_uid">
                       </td>
                    </tr>
                    <tr >
                       <td style="padding-top:20px; padding-left:150px;">
                          New User ID
                       </td>
                       <td style="padding-left:20px;">
                         <input class="textbox" type="text"  name="txt_new_uid">
                       </td>
                    </tr>
                    <tr >
                       <td style="padding-top:20px; padding-left:150px;">
                          Confirm User ID
                       </td>
                       <td style="padding-left:20px;">
                         <input class="textbox" type="text"  name="txt_c_new_uid">
                       </td>
                    </tr>
                    <tr >
                       <td style="padding-left:40px;">
                          <input class="btn" type="submit"  value="Change" name="btn_change">
                       </td>
                       <td style="padding-left:20px;">
                         <input class="btn" type="reset" value="Clear" name="btn_clear">
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


<?php
                if(isset($_POST['btn_home']))
                   echo '<script type="text/javascript"> location.href="./Admin_Home.php"</script>';

                if(isset($_POST['btn_logout']))
                   echo '<script type="text/javascript"> location.href="./Admin_Logout.php"</script>';

?>


<?php
  if(isset($_POST['btn_change']))
  {
    $id=test_input($_POST['txt_cur_uid']);
    $new_id=test_input($_POST['txt_new_uid']);
    $c_new_id=test_input($_POST['txt_c_new_uid']);

    if($id=="" || $c_new_id==""|| $c_new_id=="")
      { 
         echo '<script type="text/javascript"> alert("Please enter all the fields.") </script>';
         mysqli_close($con);
         echo '<script type="text/javascript"> location.href="./Admin_Change_User_ID.php"</script>';
      }
    
    else
      { 
         $query="select * from admin_security where user_id='$id'";
         $result=mysqli_query($con,$query); 
         if($result)
         {
          $row_count=mysqli_num_rows($result);
          if($row_count!=1)
          {
            echo '<script type="text/javascript"> alert("Current User ID is wrong.") </script>';
            mysqli_close($con);
            echo '<script type="text/javascript"> location.href="./Admin_Change_User_ID.php"</script>';
          }
         }

         if(!($new_id==$c_new_id))
         {
           echo '<script type="text/javascript"> alert("New User IDs does not match.") </script>';
           mysqli_close($con);
           echo '<script type="text/javascript"> location.href="./Admin_Change_User_ID.php"</script>';
         }
         $query="update admin_security set user_id='$new_id' where user_id='$id'";
         $result=mysqli_query($con,$query);
         if($result)
            echo '<script type="text/javascript"> alert("User ID Changed Sucessfully. Please Login with your new User ID.") </script>';
         mysqli_close($con);
         echo '<script type="text/javascript"> location.href="./Admin_Login.php"</script>';
         
      }
  }
?>
