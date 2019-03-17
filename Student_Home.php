<?php
  require "Connection.php";
  require "Input_Validate.php";
?>
<?php
   session_start();
   if(!($_SESSION['roll_no']))
      {
       echo '<script type="text/javascript"> alert("Please login to continue.") </script>';
       echo '<script type="text/javascript"> location.href="./Student_Login.php" </script>';
      }
?>
<!DOCTYPE html>
<html>

  <head>
    <title>FRIENDZY | Student Home</title>
    <style type="text/css">
        .profile {  height:510px; width: 300px; background-color: rgba(0,0,0,0.8); margin-left: 10px; }

        .main-section { height:510px; width: 725px; background-color: rgba(0,0,0,0.6); margin-left: 320px; margin-top: -510px; overflow: auto; position: fixed;}

        .post-area { height:510px; width: 300px; background-color: rgba(0,0,0,0.8); margin-left:1055px; margin-top: -510px; overflow: hidden; }

        .post-area::-webkit-scrollbar { width: 6px; }

        .post-area::-webkit-scrollbar-thumb { background-color: rgba(255,0,0,0.7); outline: 0; border-radius: 50px;
                                       box-shadow: 0 4px 10px rgba(0,0,0,0.5); }

        .profile-pic { background-color: rgba(0,0,0,0.8); margin-left: 85px; padding: 0px; height: 130px; width: 130px;
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

         .post { height:auto; width: 700px; background-color: rgba(0,0,0,0.7); margin-top: 10px; 
                  margin-left: 10px;  border-color: rgba(255,0,0,1.0); border-radius: 25px;
                  margin-bottom: 20px;}

         .details { color:white; padding-left:10px; padding-top:10px; font-size:18px; font-family:Bookman Old Style;
                    padding-bottom: 30px;}


        .request-tab {  height: 50px; width:725px ; background-color: rgba(0,0,0,0.55);}

        .show-post { height: 460px; width:725px ; background-color: rgba(0,0,0,0);
                         overflow: auto; position: fixed;}

        .show-post::-webkit-scrollbar { width: 8px; }

        .show-post::-webkit-scrollbar-thumb { background-color: rgba(255,0,0,0.7); outline: 0; 
                                                  border-radius: 50px;
                                                  box-shadow: 0 4px 10px rgba(0,0,0,0.5); }

        .tab-items li{ margin: 0px; margin-top: 0px; }

        .tab-fix { background-color: rgba(0,0,0,0.7);  padding: 16px 140px 16px 140px;}

        .tab-hov{ padding: 16px 145px 16px 140px; }

        .tab-hov:hover{ background-color: rgba(0,0,0,0.6); padding: 16px 145px 16px 140px;
                        transition: .5s ease; }

        .request { height:70px; width: 700px; background-color: rgba(0,0,0,0.7); margin-top: 10px; 
                  margin-left: 10px;  border-color: rgba(255,0,0,1.0); 
                  border-radius: 5px;}

         .request:hover { background-color: rgba(0,0,0,0.9); transition: 0.5s; }


    </style>
	<link rel="stylesheet" type="text/css" href="./css/homestyle.css">

  </head>

  <body>
    <header>
	   <nav>
	      <h1>FRIENDZY</h1>
		  <ul id="list">
		     <li> <a class="colblack" href="#">Home</a> </li>
			 <li> <a class="colred" href="#">Student Corner</a> </li>
			 <li> <a class="colblack" href="#">Faculty Corner</a> </li>
			 <li> <a class="colblack" href="#">HOD Corner</a> </li>
			 <li> <a class="colblack" href="#">Admin Corner</a> </li>
		  </ul>
	   </nav>
	</header>

  <?php
    
    $roll_no=$_SESSION['roll_no'];
    $query="select * from student_details where roll_no='$roll_no'";
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
         $roll_no=$row['roll_no'];
         $img=$row['profile_pic'];
         $roll_id=substr($roll_no,2,3);
       }
    }

    $query="select d_name from department_details where d_id='$roll_id'";
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
       	  <p id="lbl" align="center">Student profile</p>
          <div class="profile-pic">
           <img src=<?php echo $img;?> height="132" width="132">
          </div>
          <p id="details"><?php echo $name;?></p>
          <p id="details"><?php echo $email;?></p>
          <p id="details">+91 <?php echo $phone;?></p>
          <p id="details"><?php echo $department;?></p>
          
          <form action="./Student_View.php">
               <button class="btn" type="submit" >View Complete Profile</button>
          </form>
          
          <form action="./Student_Settings.php">
              <button class="btn" type="submit" >Settings</button>
          </form>
          
       </div>
       <div class="main-section">
         <div class="request-tab">
            <nav>
              <ul class="tab-items">
                 <li><a class="tab-fix" href="#">Timeline</a></li>
                 <li><a class="tab-hov" href="./Student_Post.php">My Posts</a></li>
              </ul>
            </nav>
         </div>
        <div class="show-post">

          <?php

          $query="select * from post_details where 1 order by p_no desc";
          $result=mysqli_query($con,$query);

          if($result)
          {
            while($row=mysqli_fetch_assoc($result))
            {
              $id=$row['p_id'];
              $p_image=$row['p_image'];
              $p_text=$row['p_text'];
              $date_time=$row['date_time'];
              $p_no=$row['p_no'];


              if(strlen($id)==8)
                 $query1="select * from student_details where roll_no='$id'";
              else if(strlen($id)==6)
                 $query1="select * from faculty_details where f_id='$id'";
              else if(strlen($id)==3)
                 $query1="select * from hod_details where d_id='$id'";
              
              $result1=mysqli_query($con,$query1);
              if($result1)
              {
                $row1=mysqli_fetch_assoc($result1);
                $p_name=$row1['f_name']." ".$row1['m_name']." ".$row1['l_name'];
              }
              
              
              if($p_image=="")
                echo "<div class='post'> 
                       <form>
                        <table>
                          <tr class='details'>
                              <td style='padding-left:10px;'><p >$p_no</p></td>
                              <td style='padding-left:10px;'><p >$p_name</p></td>
                              <td style='padding-left:100px;'><p >$id</p></td>
                              <td style='padding-left:100px;'<p >$date_time</p></td>
                          </tr>
                        </table>
                       </form>

                       <p style='color:white; padding:10px; font-family:Times New Roman; font-size:17px;'>$p_text</p>
                    </div>";
              else
                echo "<div class='post'> 
                       <form>
                        <table>
                          <tr class='details'>
                              <td style='padding-left:10px;'><p >$p_no</p></td>
                              <td style='padding-left:10px;'><p >$p_name</p></td>
                              <td style='padding-left:100px;'><p >$id</p></td>
                              <td style='padding-left:100px;'<p >$date_time</p></td>
                          </tr>
                        </table>
                       </form>

                       <p style='color:white; padding:10px; font-family:Times New Roman; font-size:17px;'>$p_text</p>
                       <img src='$p_image' height='400' width='500' style='margin-left:100px; padding-bottom:10px'>
                    </div>";
            }
          }
             
          ?>
 
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

            <form action="./Student_Accept_Request.php">
               <input class="btn" type="submit" value="Chat Requests">
            </form>
            
            <form action="./Student_Chat.php">
               <input class="btn" type="submit" value="Open Chat Center">
            </form>

            <form action="./Student_Logout.php">
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
           echo '<script type="text/javascript"> location.href="./Student_Home.php"</script>';
        }
      else
        { 
            $file_type=$_FILES['select_image']['type'];
            if(($file_tmp!="") and (!($file_type=="image/jpeg" or $file_type=="image/jpg" or $file_type=="image/png")))
               {
                echo '<script type="text/javascript"> alert("Please select an image with jpg , jpeg and png formats only.") </script>';
                mysqli_close($con);
                echo '<script type="text/javascript"> location.href="./Student_Home.php"</script>';
               }
            else
              { 
                
                if($file_tmp!="")
                {
                  $file_name=$_FILES['select_image']['name'];
                  $file_size=$_FILES['select_image']['size'];
                  if($file_size>500000)
                    { 
                      echo '<script type="text/javascript"> alert("Please select an image with size less than 500 Kb.") </script>';
                      mysqli_close($con);
                      echo '<script type="text/javascript"> location.href="./Student_Home.php"</script>'; 
                    }

                  $image_base64=base64_encode(file_get_contents($file_tmp));
                  $p_image='data:image/'.$image_file_type.';base64,'.$image_base64;
                }
                else
                  $p_image="";

            
 
                 
                 date_default_timezone_set('Asia/Calcutta');
                 $date_time=date("d/m/Y H:i:s");

                 $query="insert into post_details (p_text,p_image,p_id,date_time) values ('{$p_text}','{$p_image}','{$roll_no}','{$date_time}') ";
                 $result=mysqli_query($con,$query);

                  if($result)
                        {
                           mysqli_close($con);
                           echo '<script type="text/javascript"> location.href="./Student_Home.php"</script>';
                        }
                  
                    
              }
        }
      
    }
    
  ?>
