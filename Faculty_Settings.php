<?php
  require "Connection.php";
  require "Input_Validate.php";
?>
<?php
   session_start();
   if(!($_SESSION['fac_id']))
      {
       echo '<script type="text/javascript"> alert("Please login to continue.") </script>';
       echo '<script type="text/javascript"> location.href="./Faculty_Login.php" </script>';
      }
?>
<!DOCTYPE html>
<html>

  <head>
    <title>FRIENDZY | Student Home</title>
    <style type="text/css">
        .profile {  height:510px; width: 300px; background-color: rgba(0,0,0,0.8); margin-left: 10px; }

        .main-section { height:510px; width: 725px; background-color: rgba(0,0,0,0.2); margin-left: 320px; margin-top: -510px; overflow: auto; position: fixed;}

        .post-area { height:510px; width: 300px; background-color: rgba(0,0,0,0.8); margin-left:1055px; margin-top: -510px; }

        .profile-pic { background-color: rgba(0,0,0,0.8); margin-left: 85px; padding: 0px; height: 130px;             width: 130px;
        	             border-radius: 100px; border-color: rgba(255,0,0,1.0); border-width: 5px;
                       text-decoration: none; overflow: hidden;
        	           background-repeat: no-repeat; background-size: cover; position:relative; }

        #lbl { color: white; font-family: Bookman Old Style; font-size: 22px; margin-top: 0px;
               padding-top: 10px;}


        .accept-request { margin-top: 0px; height: 70px; width: 725px; background-color: rgba(0,0,0,0.8);}

        #details { color: white; text-align: center; font-family: Bookman Old Style; font-size: 17px;}

        .btn  { border-radius:5px; width:200px; margin-top:15px; margin-left:50px; padding:8px;
              font-weight:none;
	            border-width:2px;  color: white; cursor: pointer; font-size: 15px; font-family: Verdana;
                border-color: rgba(255,0,0,1.0);  text-decoration: none;background-color: rgba(0,0,0,0.6); transition: .5s; }

        .btn:hover { background-color: rgba(255,0,0,1.0); transition: .3s ease;}

        .request-tab {  height: 50px; width:725px ; background-color: rgba(0,0,0,0.8);}

        .chat-request { height: 320px; width: 620px; background-color: rgba(0,0,0,0.7); 
                        margin:50px; border-radius: 10px;}


        .textbox  { border-radius:5px; background-color:rgba(0,0,0,0.95); height:25px; color: white;
              font-family: Bookman Old Style; margin-top:15px; margin-left: 5px;
                font-size: 16px; width: 200px; border-color:rgba(0,0,0,0.85); transition: .3s;}

        .details { color:white; padding-left:10px; padding-top:10px; font-size:18px; font-family:Bookman Old Style;
                    padding-bottom: 30px;}

        .post { height:auto; width: 690px; background-color: rgba(0,0,0,0.7); margin-top: 10px; 
                  margin-left: 10px;  border-color: rgba(255,0,0,1.0); border-radius: 5px;
                  margin-bottom: 10px;}

        .post:hover { background-color: rgba(0,0,0,0.9); transition: .3s ease; }

        .post-box { margin-top: 25px; float: left; margin-right: 0px; margin-left: 25px;
                    height: 150px; width:240px; background-color: rgba(0,0,0,0.6); color:white;
                    font-family: Bookman Old Style; font-size: 15px; border-color: black;
                    border-radius: 5px; }

        .post-box::-webkit-scrollbar { width: 6px; }

        .post-box::-webkit-scrollbar-thumb { background-color: rgba(255,0,0,0.7); outline: 0; border-radius: 50px;
                                       box-shadow: 0 4px 10px rgba(0,0,0,0.5); }
    </style>
	<link rel="stylesheet" type="text/css" href="./css/homestyle.css">

  </head>

  <body>
    <header>
	   <nav>
	      <h1>FRIENDZY</h1>
		  <ul id="list">
		     <li> <a class="colblack" href="#">Home</a> </li>
			 <li> <a class="colblack" href="#">Student Corner</a> </li>
			 <li> <a class="colred" href="#">Faculty Corner</a> </li>
			 <li> <a class="colblack" href="#">HOD Corner</a> </li>
			 <li> <a class="colblack" href="#">Admin Corner</a> </li>
		  </ul>
	   </nav>
	</header>

  <?php
    
    $fac_id=$_SESSION['fac_id'];
    $query="select * from faculty_details where f_id='$fac_id'";
    $result=mysqli_query($con,$query);
    if($result)
    {
       $row_count=mysqli_num_rows($result);
       if($row_count==1)
       {
         $row=mysqli_fetch_assoc($result);
         $name=$row['f_name']." ".$row['m_name']." ".$row['l_name'];
         $email=$row['email'];
         $phone=$row['phone'];
         $fac_id=$row['f_id'];
         $img=$row['profile_pic'];
         $f_id=substr($fac_id,0,3);
       }
    }

    $query="select d_name from department_details where d_id='$f_id'";
    $result=mysqli_query($con,$query);
    if($result)
    {
       $row_count=mysqli_num_rows($result);
       if($row_count==1)
       {
         $row=mysqli_fetch_assoc($result);
         $department=$row['d_name'];
       }
    }


  ?>

	<div class="divider"></div>
	<div class="backimg">
       <div class="profile">
       	  <p id="lbl" align="center">Faculty profile</p>
          <div class="profile-pic">
            <img src=<?php echo $img;?> height="132" width="132">
          </div>
          <p id="details"><?php echo $name;?></p>
          <p id="details"><?php echo $email;?></p>
          <p id="details">+91 <?php echo $phone;?></p>
          <p id="details"><?php echo $department;?></p>
          
          <form action="./Faculty_View.php">
               <button class="btn" type="submit" >View Complete Profile</button>
          </form>
          
          
          <form action="./Faculty_Home.php">
              <button class="btn" type="submit" >My Timeline</button>
          </form>
          
       </div>
       <div class="main-section">

        <div class="request-tab">
            <center style="color:white; font-family:Bookman Old Style; font-size:18px; padding-top:15px;"><?php echo "Settings Panel - ".$name?></center>
         </div>

         <div class="chat-request">

           <form action="" method="post">
                 <table style='color:white; font-size:18px; font-family:Bookman Old Style; padding-top:50px;'>
                    <tr >
                       <td style="padding-top:20px; padding-left:120px;">
                          Current Password
                       </td>
                       <td style="padding-left:20px;">
                         <input class="textbox" type="password"  name="txt_cur_uid">
                       </td>
                    </tr>
                    <tr >
                       <td style="padding-top:20px; padding-left:120px;">
                          New Password
                       </td>
                       <td style="padding-left:20px;">
                         <input class="textbox" type="password"  name="txt_new_uid">
                       </td>
                    </tr>
                    <tr >
                       <td style="padding-top:20px; padding-left:120px;">
                          Confirm Password
                       </td>
                       <td style="padding-left:20px;">
                         <input class="textbox" type="password"  name="txt_c_new_uid">
                       </td>
                    </tr>
                    <tr >
                       <td style="padding-left:20px;">
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

       
       <div class="post-area">
            <form action="" method="post" enctype='multipart/form-data'>
               <textarea class="post-box" name="post_text" placeholder="Write Here" cols="30"></textarea>
               <table>
                  <tr>
                     <td style="color:white; font-family:Bookman Old Style; font-size:18px; padding-top:10px; padding-left:40px;"><center>  Upload image</center></td>
                  </tr>
                  <tr>
                     <td><input type="file" class="btn" name='select_image'></td>
                  </tr>
                  <tr>
                    <td><input class="btn" type="submit" value="Post" name="btn_post"></td>
                  </tr>
              </table>
         
              
            </form>

            <form action="./Faculty_Accept_Request.php">
               <input class="btn" type="submit" value="Chat Requests">
            </form>

            <form action="./Faculty_Chat.php">
               <input class="btn" type="submit" value="Open Chat Center">
            </form>

            <form action="./Faculty_Logout.php">
              <button class="btn" type="submit" >Logout</button>
            </form>
       </div>

	</div>
	<div class="divider"></div>

	<footer></footer>
  </body>


  </html>

<?php

     if(isset($_POST['btn_post']))
     { 

      $p_text=test_input($_POST['post_text']);
      
      $file_tmp=$_FILES['select_image']['tmp_name'];
      
      
      if(($p_text=="" and $file_tmp==""))
        { 
           echo '<script type="text/javascript"> alert("Please write something or select an image to post.") </script>';
           mysqli_close($con);
           echo '<script type="text/javascript"> location.href="./Faculty_Settings.php"</script>';
        }
      else
        { 
            $file_type=$_FILES['select_image']['type'];
            if(($file_tmp!="") and (!($file_type=="image/jpeg" or $file_type=="image/jpg" or $file_type=="image/png")))
               {
                echo '<script type="text/javascript"> alert("Please select an image with jpg , jpeg and png formats only.") </script>';
                mysqli_close($con);
                echo '<script type="text/javascript"> location.href="./Faculty_Settings.php"</script>';
               }
            else
              { 
                
                if($file_tmp!="")
                {
                  $file_name=$_FILES['select_image']['name'];
                  $file_size=$_FILES['select_image']['size'];

                  $image_base64=base64_encode(file_get_contents($file_tmp));
                  $p_image='data:image/'.$image_file_type.';base64,'.$image_base64;
                }
                else
                  $p_image="";

            
 
                 
                 date_default_timezone_set('Asia/Calcutta');
                 $date_time=date("d/m/Y H:i:s");

                 $query="insert into post_details (p_text,p_image,p_id,date_time) values ('{$p_text}','{$p_image}','{$fac_id}','{$date_time}') ";
                 $result=mysqli_query($con,$query);

                  if($result)
                        {
                           mysqli_close($con);
                           echo '<script type="text/javascript"> location.href="./Faculty_Home.php"</script>';
                        }
                  
                    
              }
        }
      
    }
    
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
         echo '<script type="text/javascript"> location.href="./Faculty_Settings.php"</script>';
      }
    else
      { 
         $query="select * from faculty_details where f_id='$fac_id' and password='$id'";
         $result=mysqli_query($con,$query); 
         if($result)
         {
          $row_count=mysqli_num_rows($result);
          if($row_count!=1)
          {
            echo '<script type="text/javascript"> alert("Current Password is wrong.") </script>';
            mysqli_close($con);
            echo '<script type="text/javascript"> location.href="./Faculty_Settings.php"</script>';
          }
         }

         if(!($new_id==$c_new_id))
         {
           echo '<script type="text/javascript"> alert("New Passwords does not match.") </script>';
           mysqli_close($con);
           echo '<script type="text/javascript"> location.href="./Faculty_Settings.php"</script>';
         }
         $query="update faculty_details set password='$new_id' where f_id='$fac_id'";
         $result=mysqli_query($con,$query);
         if($result)
           {
            session_destroy();
            echo '<script type="text/javascript"> alert("Password Changed Sucessfully. Please Login with your new password.") </script>';
           }
            
         mysqli_close($con);
         echo '<script type="text/javascript"> location.href="./Faculty_Login.php"</script>';
         
      }
  }
?>