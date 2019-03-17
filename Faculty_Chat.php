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
    <title>FRIENDZY | Faculty Chat</title>
    <style type="text/css">
        .profile {  height:510px; width: 300px; background-color: rgba(0,0,0,0.8); margin-left: 10px; }

        .main-section { height:510px; width: 725px; background-color: rgba(0,0,0,0.4); margin-left: 320px; margin-top: -510px; overflow: auto; position: fixed;}

        .post-area { height:510px; width: 300px; background-color: rgba(0,0,0,0.8); margin-left:1055px; margin-top: -510px; }

        .profile-pic { background-color: rgba(0,0,0,0.8); margin-left: 85px; padding: 0px; height: 130px;             width: 130px;
        	             border-radius: 100px; border-color: rgba(255,0,0,1.0); border-width: 5px;
                       text-decoration: none; overflow: hidden;
        	           background-repeat: no-repeat; background-size: cover; position:relative; }

        #lbl { color: white; font-family: Bookman Old Style; font-size: 22px; margin-top: 0px;
               padding-top: 10px;}

        .details { color:white; padding-left:10px; padding-top:10px; font-size:16px; font-family:Bookman Old Style;
                    padding-bottom: 10px;}

        .post { height:auto; width: 690px; background-color: rgba(0,0,0,0.85); margin-top: 10px; margin-bottom: 10px; 
                margin-left: 10px;  
                border-color: rgba(255,0,0,1.0); border-radius: 5px;}


        .accept-request { margin-top: 0px; height: 70px; width: 725px; background-color: rgba(0,0,0,0.7);}

        #details { color: white; text-align: center; font-family: Bookman Old Style; font-size: 17px;}

        .btn  { border-radius:5px; width:200px; margin-top:15px; margin-left:50px; padding:8px;
              font-weight:none;
	            border-width:2px;  color: white; cursor: pointer; font-size: 15px; font-family: Verdana;
                border-color: rgba(255,0,0,1.0);  text-decoration: none;background-color: rgba(0,0,0,0.6); transition: .5s; }

        .btn:hover { background-color: rgba(255,0,0,1.0); transition: .3s ease;}

        .request-tab {  height: 50px; width:725px ; background-color: rgba(0,0,0,0.8);}

        .chat-request { height: 390px; width: 725px; background-color: rgba(0,0,0,0); }

        .textbox  { border-radius:5px; background-color:rgba(0,0,0,0.95); height:25px; color: white;
              font-family: Bookman Old Style; margin-top:15px; margin-left: 5px;
                font-size: 16px; width: 200px; border-color:rgba(0,0,0,0.85); transition: .3s;}

        .chat-request { height: 380px; width: 725px; background-color: rgba(0,0,0,0); overflow: auto;}

        .chat-request::-webkit-scrollbar { width: 6px; }

        .chat-request::-webkit-scrollbar-thumb { background-color: rgba(255,0,0,0.7); outline: 0; border-radius: 50px;
                                       box-shadow: 0 4px 10px rgba(0,0,0,0.5); }

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
          
          
          <form action="./Faculty_Settings.php">
              <button class="btn" type="submit" >Settings</button>
          </form>
          
       </div>
       <div class="main-section">

        <div class="request-tab">
            <center style="color:white; font-family:Bookman Old Style; font-size:18px; padding-top:15px;"><?php echo "Chat Center - ".$name." - Friends"?></center>
         </div>

         <div class="chat-request">

          <?php

          $query="select * from request_details where (sender='$fac_id' or reciever ='$fac_id') and request='1'";
          $result=mysqli_query($con,$query);
          if($result)
            { 
               $row_count=mysqli_num_rows($result);
               if($row_count>0)
                { 
                   while($row=mysqli_fetch_assoc($result))
                    { 
                       
                             
                           if($row['sender']==$fac_id)
                              $id=$row['reciever'];
                           else if($row['reciever']==$fac_id)
                              $id=$row['sender'];
                          
                           
                           $len=strlen($id);
                           if($len==8)
                               $query="select * from student_details where roll_no='$id'";
                           else if($len==6)
                               $query="select * from faculty_details where f_id='$id'";  

                           $result1=mysqli_query($con,$query);
                           if($result1)
                             { 
                                $row1=mysqli_fetch_assoc($result1);
                                $chat_name=$row1['f_name']." ".$row1['m_name']." ".$row1['l_name'];
                                echo "<div class='post'> 
                                       <form>
                                         <table>
                                           <tr class='details'>
                                             <td style='padding-left:10px;'><p>$id</p></td>
                                             <td style='padding-left:10px;'><p>$chat_name</p></td>
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
         <div class="accept-request">
             <form  method="post">
             <table>
                <tr>
                
                   <td><input  class="textbox" type="text" name="txt_roll_fid" placeholder="Roll No/Faculty ID"></td>
                   <td><input class="btn" type="submit" value="Open Chat" name="btn_open"></td>
                   <td><input class="btn" type="submit" value="Send Request" name="btn_send_request"></td>
                  
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
            <form action="./Faculty_Home.php">
               <input class="btn" type="submit" value="Close Chat Center">
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
  if(isset($_POST['btn_send_request']))
    { 
        $reciever_id=test_input($_POST['txt_roll_fid']);
        $sender_id=$fac_id;
        $request="0";
        if($reciever_id=="")
          { 
             echo '<script type="text/javascript"> alert("Please Enter Roll No/Faculty ID to send a request.") </script>';
             mysqli_close($con);
             echo '<script type="text/javascript"> location.href="./Faculty_Chat.php"</script>';
          }

        $len=strlen($reciever_id);
        if($len==8)
          $query="select * from student_details where roll_no='$reciever_id'";
        else if($len==6)
          $query="select * from faculty_details where f_id='$reciever_id'";  
        else
          {
            echo '<script type="text/javascript"> alert("Wrong Roll No/Faculty ID.") </script>';
            mysqli_close($con);
            echo '<script type="text/javascript"> location.href="./Faculty_Chat.php"</script>';
          }     

        $result=mysqli_query($con,$query);
        if($result)
          { 
             $row_count=mysqli_num_rows($result);
             if($row_count==0)
              { 
                 echo '<script type="text/javascript"> alert("This Roll No/Faculty ID does not exist.") </script>';
                 mysqli_close($con);
                 echo '<script type="text/javascript"> location.href="./Faculty_Chat.php"</script>';
              }
          }
        

        $query="select * from request_details where sender='$sender_id' and reciever='$reciever_id'";
        $result=mysqli_query($con,$query);
        if($result)
          { 
             $row_count=mysqli_num_rows($result);
             if($row_count==1)
             {
               $row=mysqli_fetch_assoc($result);
               $req_id=$row['request'];
               if($req_id=="0")
                 echo '<script type="text/javascript"> alert("Request already sent. Please wait until the reciever accepts it.") </script>';
               else if($req_id=="1")
                 echo '<script type="text/javascript"> alert("Request already accepted. You can chat now.") </script>';
             }
            else
            {
              if($reciever_id==$sender_id)
                {
                  echo '<script type="text/javascript"> alert("You cannot send request to yourself.") </script>';
                  mysqli_close($con);
                  echo '<script type="text/javascript"> location.href="./Faculty_Chat.php"</script>';
                }
               else
                {
                   $query1="select * from request_details where sender='$reciever_id' and reciever='$sender_id'";
                   $result1=mysqli_query($con,$query1);
                   if($query1)
                       {
                         $row_count=mysqli_num_rows($result1);
                         if($row_count==1)
                            { 
                              $row1=mysqli_fetch_assoc($result1);
                              $req_id=$row1['request'];
                              if($req_id=="0")
                                     echo '<script type="text/javascript"> alert("You have recieved request. Please accept.") </script>';
                              else if($req_id=="1")
                                     echo '<script type="text/javascript"> alert("Request already accepted. You can chat now.") </script>';

                              
                              mysqli_close($con);
                              echo '<script type="text/javascript"> location.href="./Student_Chat.php"</script>';
                            }
                            
                        }


                   $query1="insert into request_details(sender,reciever,request) values('{$sender_id}','{$reciever_id}','{$request}')";
                   $result1=mysqli_query($con,$query1);
                   if($query1)
                       echo '<script type="text/javascript"> alert("Chat Request Sent. Reciever will appear in your chat center once he/she accepts your request.") </script>';
                }  
              
            }
            mysqli_close($con);
            echo '<script type="text/javascript"> location.href="./Faculty_Chat.php"</script>';
          }
     
    }
?>


<?php
  if(isset($_POST['btn_open']))
  {
    $roll_fid=test_input($_POST['txt_roll_fid']);
    
    if($roll_fid=="")
    {
         echo '<script type="text/javascript"> alert("Please enter Roll No/Faculty ID to open the chat.") </script>';
         mysqli_close($con);
         echo '<script type="text/javascript"> location.href="./Faculty_Chat.php"</script>';
    }
   else
    {
        $len=strlen($roll_fid);
        if($len==8)
          $query="select * from student_details where roll_no='$roll_fid'";
        else if($len==6)
          $query="select * from faculty_details where f_id='$roll_fid'";  
         
        else
          {
            echo '<script type="text/javascript"> alert("Wrong Roll No/Faculty ID.") </script>';
            mysqli_close($con);
            echo '<script type="text/javascript"> location.href="./Faculty_Chat.php"</script>';
          }     

        $result=mysqli_query($con,$query);
        if($result)
          { 
             $row_count=mysqli_num_rows($result);
             if($row_count==0)
              { 
                 echo '<script type="text/javascript"> alert("This Roll No/Faculty ID does not exist.") </script>';
                 mysqli_close($con);
                 echo '<script type="text/javascript"> location.href="./Faculty_Chat.php"</script>';
              }
          }
         if($roll_fid==$fac_id)
          {
            echo '<script type="text/javascript"> alert("You cannot open chat with yourself.") </script>';
            mysqli_close($con);
            echo '<script type="text/javascript"> location.href="./Faculty_Chat.php"</script>';
          }  

         $query="select * from request_details where (sender='$roll_fid' and reciever ='$fac_id') or (reciever ='$roll_fid' and sender ='$fac_id') ";
         $result=mysqli_query($con,$query);
         if($result)
          { 
            $row_count=mysqli_num_rows($result);
            if($row_count==0)
            {
                 echo '<script type="text/javascript"> alert("Please send a request or wait for the other person to send. You can chat once requests are accepted.") </script>';
                 mysqli_close($con);
                 echo '<script type="text/javascript"> location.href="./Faculty_Chat.php"</script>';
            }
            $row=mysqli_fetch_assoc($result);
            if($row['request']=="0")
              { 
                 echo '<script type="text/javascript"> alert("Chat Request is not accepted yet.") </script>';
                 mysqli_close($con);
                 echo '<script type="text/javascript"> location.href="./Faculty_Chat.php"</script>';
              }
             else if($row['request']=="1")
              { 
                $_SESSION['chat_id']=$roll_fid;
                mysqli_close($con);
                echo '<script type="text/javascript"> location.href="./Faculty_Open_Chat.php"</script>';
              }
          }
    }
  }
?>

<?php

     if(isset($_POST['btn_post']))
     { 

      $p_text=test_input($_POST['post_text']);
      
      $file_tmp=$_FILES['select_image']['tmp_name'];
      
      
      if(($p_text=="" and $file_tmp==""))
        { 
           echo '<script type="text/javascript"> alert("Please write something or select an image to post.") </script>';
           mysqli_close($con);
           echo '<script type="text/javascript"> location.href="./Faculty_Chat.php"</script>';
        }
      else
        { 
            $file_type=$_FILES['select_image']['type'];
            if(($file_tmp!="") and (!($file_type=="image/jpeg" or $file_type=="image/jpg" or $file_type=="image/png")))
               {
                echo '<script type="text/javascript"> alert("Please select an image with jpg , jpeg and png formats only.") </script>';
                mysqli_close($con);
                echo '<script type="text/javascript"> location.href="./Faculty_Chat.php"</script>';
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