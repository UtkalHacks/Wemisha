<?php
  require "Connection.php";
  require "Input_Validate.php";
?>
<?php
   session_start();
   if(!($_SESSION['department_id']))
      {
       echo '<script type="text/javascript"> alert("Please login to continue.") </script>';
       echo '<script type="text/javascript"> location.href="./HOD_Login.php" </script>';
      }
?>
<!DOCTYPE html>
<html>

  <head>
    <title>FRIENDZY | HOD Approve Post</title>
    <style type="text/css">
        .profile {  height:510px; width: 300px; background-color: rgba(0,0,0,0.8); margin-left: 10px; }

        .main-section { height:510px; width: 725px; background-color: rgba(0,0,0,0.6); margin-left: 320px; margin-top: -510px;  position: fixed;}

        .post-area { height:510px; width: 300px; background-color: rgba(0,0,0,0.8); margin-left:1055px; margin-top: -510px; }

        .profile-pic { background-color: rgba(0,0,0,0.8); margin-left: 85px; padding: 0px; height: 130px;             width: 130px;
        	             border-radius: 100px; border-color: rgba(255,0,0,1.0); border-width: 5px;
                       text-decoration: none; overflow: hidden;
        	           background-repeat: no-repeat; background-size: cover; position:relative; }

        #lbl { color: white; font-family: Bookman Old Style; font-size: 22px; margin-top: 0px;
               padding-top: 10px;}

        #details { color: white; text-align: center; font-family: Bookman Old Style; font-size: 17px;}

        .btn  { border-radius:5px; width:200px; margin-top:15px; margin-left:50px; padding:8px;
              font-weight:none;
	            border-width:2px;  color: white; cursor: pointer; font-size: 15px; font-family: Verdana;
                border-color: rgba(255,0,0,1.0);  text-decoration: none;background-color: rgba(0,0,0,0.6); transition: .5s; }

        .btn:hover { background-color: rgba(255,0,0,1.0); transition: .3s ease;}

        .post-box { margin-top: 25px; float: left; margin-right: 0px; margin-left: 25px;
                    height: 150px; width:240px; background-color: rgba(0,0,0,0.6); color:white;
                    font-family: Bookman Old Style; font-size: 15px; border-color: black;
                    border-radius: 5px; }

        .post-box::-webkit-scrollbar { width: 6px; }

        .post-box::-webkit-scrollbar-thumb { background-color: rgba(255,0,0,0.7); outline: 0; border-radius: 50px;
                                       box-shadow: 0 4px 10px rgba(0,0,0,0.5); }

        .textbox  { border-radius:5px; background-color:rgba(0,0,0,0.85); height:25px; color: white;
              font-family: Bookman Old Style; margin-top:15px; margin-left: 5px;
                font-size: 16px; width: 200px; border-color:rgba(0,0,0,0.85); transition: .3s;}

        .request { height:55px; width: 700px; background-color: rgba(0,0,0,0.7); margin-top: 10px; 
                  margin-left: 10px;  border-color: rgba(255,0,0,1.0); 
                  border-radius: 5px;}

        .request:hover { background-color: rgba(0,0,0,0.9); transition: 0.5s; }


        

        .request-tab {  height: 50px; width:725px ; background-color: rgba(0,0,0,0.55);}

        .approval-area { height: 380px; width:725px ; background-color: rgba(0,0,0,0);
                         overflow: auto; position: fixed;}

        .approval-area::-webkit-scrollbar { width: 8px; }

        .approval-area::-webkit-scrollbar-thumb { background-color: rgba(255,0,0,0.7); outline: 0; 
                                                  border-radius: 50px;
                                                  box-shadow: 0 4px 10px rgba(0,0,0,0.5); }

        .tab-items li{ margin: 0px; }

        .tab-fix { background-color: rgba(0,0,0,0.7);  padding: 16px 100px 16px 100px;}

        .tab-hov{ padding: 16px 115px 16px 116px; }

        .tab-hov:hover{ background-color: rgba(0,0,0,0.6); padding: 16px 115px 16px 116px;
                        transition: .5s ease; }
    </style>
	<link rel="stylesheet" type="text/css" href="./css/homestyle.css">

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

  <?php
    
    $id=$_SESSION['department_id'];
    $query="select * from hod_details where d_id='$id'";
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
         $img=$row['profile_pic'];
       }
    }
    $query="select d_name from department_details where d_id='$id'";
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
          <p id="lbl" align="center">HOD profile</p>
          <div class="profile-pic">
           <img src=<?php echo $img;?> height="132" width="132">
          </div>
          <p id="details"><?php echo $name;?></p>
          <p id="details"><?php echo $email;?></p>
          <p id="details">+91 <?php echo $phone;?></p>
          <p id="details"><?php echo $department;?></p>
          
          <form action="./HOD_View.php">
               <button class="btn" type="submit" >View Complete Profile</button>
          </form>
          
          <form action="./HOD_Settings.php">
              <button class="btn" type="submit" >Settings</button>
          </form>
          
       </div>
       <div class="main-section">
         <div class="request-tab">
            <nav>
              <ul class="tab-items">
                 <li><a class="tab-hov" href="./HOD_Approve_Request.php">Approve Student</a></li>
                 <li><a class="tab-fix" href="#">Approve Faculty</a></li>
              </ul>
            </nav>
         </div>
         <div class="approval-area">

          <?php
          
          $query="select f_name,m_name,l_name,f_id from faculty_details where reg_status=0";
          $result=mysqli_query($con,$query);
          if($result)
           {
              $row_count=mysqli_num_rows($result);
              if($row_count>0)
                {
                  while($row=mysqli_fetch_assoc($result))
                  {
                    $name=$row['f_name']." ".$row['m_name']." ".$row['l_name'];
                    $fac_id=$row['f_id'];
                    $f_id=substr($fac_id,0,3);
                    if($f_id==$_SESSION['department_id'])
                    {
                      echo "<div class='request'> 
                              <form>
                                 <table style='color:white; font-size:18px; font-family:Bookman Old Style;'>
                                    <tr>
                                      <td style='padding-left:60px; padding-top:15px;'>$fac_id</td>
                                      <td style='padding-left:30px; padding-top:15px;'>$name</td>
                                    </tr>
                                 </table>
                              </form>
                            </div>";
                    }
                  }
                }
           }
         ?>

         </div>
         <div style="background-color:rgba(0,0,0,0.6); height:70px; width:725px; margin-top:390px">
          <form method="post">
             <table>
                <tr>
                   <td><input class="textbox" type="text" name="txt_approve" placeholder="Enter faculty id "></td>
                   <td><input class="btn" type="submit" value="Approve" name="btn_approve"></td>
                   <td><input class="btn" type="submit" value="Or Approve All" name="btn_approve_all"></td>
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
            
            <form action="./HOD_HOME.php">
               <input class="btn" type="submit" value="Back to Timeline">
            </form>

            <form action="./HOD_Logout.php">
              <button class="btn" type="submit" >Logout</button>
            </form>


       </div>

	</div>
	<div class="divider"></div>

	<footer></footer>
  </body>


  </html>

<?php
          if(isset($_POST['btn_approve']))
          {
            $approval_fac_id=test_input($_POST['txt_approve']);
            
            if($approval_fac_id=="")
              { 
                echo '<script type="text/javascript"> alert("Please enter the Faculty ID.") </script>';
                mysqli_close($con);
                echo '<script type="text/javascript"> location.href="./HOD_Approve_Post.php"</script>';
              }

            else
            {
              
               $query="update faculty_details set reg_status=1 where f_id='$approval_fac_id'";
               $result=mysqli_query($con,$query);
            
               if($result)
                   echo '<script type="text/javascript"> alert("Faculty Approved.") </script>';
            
               else
                   echo '<script type="text/javascript"> alert("Faculty ID  does not exist.") </script>';
            
               mysqli_close($con);
               echo '<script type="text/javascript"> location.href="./HOD_Approve_Post.php"</script>';
            }
          }
       ?>

       <?php
          if(isset($_POST['btn_approve_all']))
          {
            $query="update faculty_details set reg_status=1 where 1";
            $result=mysqli_query($con,$query);
            
               if($result)
                   echo '<script type="text/javascript"> alert("All Faculties have been Approved.") </script>';
            
               else
                   echo '<script type="text/javascript"> alert("Faculties already approved.") </script>';
            
               mysqli_close($con);
               echo '<script type="text/javascript"> location.href="./HOD_Approve_Post.php"</script>';
          }
       ?>