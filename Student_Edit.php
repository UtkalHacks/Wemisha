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
    <title>FRIENDZY | Student Edit</title>
	<link rel="stylesheet" type="text/css" href="./css/homestyle.css">

	<style type="text/css">

    .view-form { height: 500px; width: 500px; background-color: rgba(0,0,0,0.8);
                 margin-left: 450px; margin-top: 5px; overflow: auto; position: fixed;}

    .view-form::-webkit-scrollbar { width: 8px; }

    .view-form::-webkit-scrollbar-thumb { background-color: rgba(255,0,0,0.7); outline: 0;
    	                                  border-radius: 50px;
                                          box-shadow: 0 4px 10px rgba(0,0,0,0.5); }

    .profile-pic{background-color: rgba(0,0,0,0.8); margin-left: 180px; margin-top: 0px; height: 130px;   
                 width: 130px; border-radius: 100px; border-color: rgba(255,0,0,1.0); border-width: 5px;
                 text-decoration: none; background-repeat: no-repeat; background-size: cover;
        	       background-image: url(""); overflow: hidden;
        	        }

    #lbl { color: white; font-family: Bookman Old Style; font-size: 22px; margin-top: 0px; padding-top: 10px;}

    .view-details { padding-top: 10%; padding-left: 10%; padding-bottom:0%; }

    .textbox  { border-radius:5px; background-color:rgba(0,0,0,0.85); height:25px; color: white;
    	        font-family: Bookman Old Style;
                font-size: 16px; width: 180px; border-color:rgba(0,0,0,0.85); transition: .3s;}

    #label { text-align:left; font-weight:none; color: white; font-family: Bookman Old Style;
    	     padding: 15px; font-size: 18px;}

    .btn  { border-radius:5px; width:200px; margin-top:0px; margin-left:27%; padding:5px;
    	    font-weight:bold; border-width:2px;  color: white; cursor: pointer; font-size: 17px;
    	    font-family: Bookman Old Text; border-color: rgba(255,0,0,1.0);  text-decoration: none;
    	    background-color: rgba(0,0,0,0.6); transition: .5s; }

    .btn:hover { background-color: rgba(255,0,0,1.0); transition: .3s ease;}


	</style>
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
         $f_name=$row['f_name'];
         $m_name=$row['m_name'];
         $l_name=$row['l_name'];
         $email=$row['email'];
         $phone=$row['phone'];
         $gender=$row['gender'];
         $img=$row['profile_pic'];
       }
    }
    
  ?>


	<div class="divider"></div>
	<div class="backimg">
      <div class="view-form" >
         <p id="lbl" align="center">Edit Student Profile</p>
         <div class="profile-pic" >
              <img src=<?php echo $img;?> height="132" width="132">
         </div>
       </br>
         <form method="post" action="" enctype='multipart/form-data'>
            <table>
              <tr>
                <td><input type="file" class="btn" name='Select'></td>
                <td><input type="submit" class="btn" name="btn_upload" value="Upload"></td>
              </tr>
              <tr>
                <td id="label" style="padding-left:14.5%;">Remove picture</td>
                <td><input type="submit" class="btn" name="btn_remove" value="Remove"></td>
              </tr>
            </table>
          </form>
          <?php
             if(isset($_POST['btn_upload']))
                {
                   

                   $name=$_FILES['Select']['name'];
                   $targer_dir="uplaods/";
                   $targer_file=$targer_dir.basename($_FILES['Select']['name']);

                   $image_file_type=strtolower(pathinfo($targer_file,PATHINFO_EXTENSION));

                   $extention_arr=array("jpg","jpeg","png");

                   if(in_array($image_file_type,$extention_arr))
                     {
      
                        $image_base64=base64_encode(file_get_contents($_FILES['Select']['tmp_name']));
                        $image='data:image/'.$image_file_type.';base64,'.$image_base64;

                        $query="update student_details set profile_pic='$image' where roll_no='$roll_no'";
                        $result=mysqli_query($con,$query);

                        if($result)
                        {
                           echo '<script type="text/javascript"> alert("Profile Picture Uploaded Successfully.") </script>';
                           mysqli_close($con);
                           echo '<script type="text/javascript"> location.href="./Student_Edit.php"</script>';
                        }
                     }
                    else
                      echo '<script type="text/javascript"> alert("Please select an image with jpg , jpeg and png formats only.") </script>';
                
                }
  
         ?>


         <?php
            if(isset($_POST['btn_remove']))
            {
                
               if($img!="")
                   {
                     $query="update student_details set profile_pic='' where roll_no='$roll_no'";
                     $result=mysqli_query($con,$query);
                     if($result)
                        {
                           echo '<script type="text/javascript"> alert("Profile Picture Deleted Successfully.") </script>';
                           mysqli_close($con);
                           echo '<script type="text/javascript"> location.href="./Student_Edit.php"</script>';
                           
                        } 
                      else
                        echo '<script type="text/javascript"> alert("Problem Deleting.") </script>';
                    }
                else
                   echo '<script type="text/javascript"> alert("Profile Picture does not exist.") </script>';

            }


         ?>
          <form method="post">
           <table class="view-details">
              <tr>
              	<td id="label">First Name:</td>
              	<td><input class="textbox" type="text" name="txt_f_name" value=<?php echo $f_name;?>></td>
              </tr>
              <tr>
              	<td id="label">Middle Name:</td>
              	<td><input class="textbox" type="text" name="txt_m_name" value=<?php echo $m_name;?>></td>
              </tr>
              <tr>
              	<td id="label">Last Name:</td>
              	<td><input class="textbox" type="text" name="txt_l_name" value=<?php echo $l_name;?>></td>
              </tr>
              <tr>
              	<td id="label">Email:</td>
              	<td><input class="textbox" type="email" name="txt_email" value=<?php echo $email;?>></td>
              </tr>
                  <tr><td id="label">Phone No (+91):</td>
                  <td><input class="textbox" type="number" name="txt_phone" value=<?php echo $phone;?>></td>
              </tr>
              <tr>
                <td id="label">Gender:</td>
                <td><input class="textbox" type="text" name="txt_gender" value=<?php echo $gender;?>></td>
              </tr>
           </table>
           <input class="btn" type="submit" value="Save Details" name="btn_save">
         </form>
         
         <p ><form action="./Student_Home.php" method="post" onsumit="">
         	     <input class="btn" type="submit" value="Back to profile">
             </form>
         </p>

      </div>

	</div>
	<div class="divider"></div>

	<footer></footer>
  </body>

  </html>

             

<?php

        

  
     if(isset($_POST['btn_save']))
       {
         $f_name=test_input($_POST['txt_f_name']);
         $m_name=test_input($_POST['txt_m_name']);
         $l_name=test_input($_POST['txt_l_name']);
         $email=test_input($_POST['txt_email']);
         $phone=test_input($_POST['txt_phone']);
         $gender=test_input($_POST['txt_gender']);

         $query="update student_details set f_name='$f_name',m_name='$m_name',l_name='$l_name',email='$email',phone='$phone',gender='$gender' where roll_no='$roll_no'";
         $result=mysqli_query($con,$query);
         if($result)
           {
             echo '<script type="text/javascript"> alert("Details Saved Successfully.") </script>';
             echo '<script type="text/javascript"> location.href="./Student_View.php"</script>';
           }
         else
           echo '<script type="text/javascript"> alert("Problem Saving.") </script>';
       }

       mysqli_close($con);

?>