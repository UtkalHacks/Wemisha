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

      .panel-label { color: white; font-size: 22px; font-family: Bookman Old Style; padding-top: 10px;}

      .approval-area { height: 340px; width:800px ; background-color: rgba(0,0,0,0);
                         overflow: auto; position: fixed;}

       .approval-area::-webkit-scrollbar { width: 8px; }

        .approval-area::-webkit-scrollbar-thumb { background-color: rgba(255,0,0,0.7); outline: 0; 
                                                  border-radius: 50px;
                                                  box-shadow: 0 4px 10px rgba(0,0,0,0.5); }

      .btn  { border-radius:5px; width:200px; margin-top:15px; margin-left:50px; padding:8px;
              font-weight:none;
              border-width:2px;  color: white; cursor: pointer; font-size: 15px; font-family: Verdana;
                border-color: rgba(255,0,0,1.0);  text-decoration: none;background-color: rgba(0,0,0,0.6); transition: .5s; }

        .btn:hover { background-color: rgba(255,0,0,1.0); transition: .3s ease;}

        .textbox  { border-radius:5px; background-color:rgba(0,0,0,0.95); height:25px; color: white;
              font-family: Bookman Old Style; margin-top:15px; margin-left: 5px;
                font-size: 16px; width: 200px; border-color:rgba(0,0,0,0.85); transition: .3s;}
        


      .request { height:55px; width: 780px; background-color: rgba(0,0,0,0.7); margin-top: 10px; 
                  margin-left: 10px;  border-color: rgba(255,0,0,1.0); 
                  border-radius: 5px;}

      .request:hover { background-color: rgba(0,0,0,0.9); transition: 0.5s; }

      .btn:hover { background-color: rgba(255,0,0,1.0); transition: .3s ease;}

      .btn  { border-radius:5px; width:200px; margin-top:15px; margin-left:50px; padding:8px;
              font-weight:none;
              border-width:2px;  color: white; cursor: pointer; font-size: 15px; font-family: Verdana;
              border-color: rgba(255,0,0,1.0);  text-decoration: none;background-color: rgba(0,0,0,0.6); 
              transition: .5s; }
     
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
                         <center><p>Approval Section</p></center>
                       </td>
                       <td style='padding-left:10px;'>
                          <input class="btn" type="submit" value="Home" name="btn_home">
                       </td>
                    </tr>
                 </table>
              </form>

              <?php
                if(isset($_POST['btn_home']))
                   echo '<script type="text/javascript"> location.href="./Admin_Home.php"</script>';

                if(isset($_POST['btn_logout']))
                   echo '<script type="text/javascript"> location.href="./Admin_Logout.php"</script>';

             ?>
           
        </div>
        <div class="approval-area">
              
            <?php
          
          $query="select f_name,m_name,l_name,d_id from hod_details where reg_status=0";
          $result=mysqli_query($con,$query);
          if($result)
           {
              $row_count=mysqli_num_rows($result);
              if($row_count>0)
                {
                  while($row=mysqli_fetch_assoc($result))
                  {
                    $name=$row['f_name']." ".$row['m_name']." ".$row['l_name'];
                    $d_id=$row['d_id'];
                    
                    echo "<div class='request'> 
                              <form>
                                 <table style='color:white; font-size:18px; font-family:Bookman Old Style;'>
                                    <tr>
                                      <td style='padding-left:60px; padding-top:15px;'>$d_id</td>
                                      <td style='padding-left:30px; padding-top:15px;'>$name</td>
                                    </tr>
                                 </table>
                              </form>
                            </div>";
                    }
                  }
                }
           
         ?>


        </div>
        <div style="background-color:rgba(0,0,0,0.65); height:70px; width:800px; margin-top:340px">
          <form method="post">
             <table>
                <tr>
                   <td style="padding-left:20px;"><input  class="textbox" type="text" name="txt_approve" placeholder="Enter Department ID "></td>
                   <td style="padding-left:10px;"><input  class="btn" type="submit" value="Approve" name="btn_approve"></td>
                   <td><input class="btn" type="submit" value="Or Approve All" name="btn_approve_all"></td>
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
          if(isset($_POST['btn_approve']))
          {
            $approval_id=test_input($_POST['txt_approve']);
            
            if($approval_id=="")
              { 
                echo '<script type="text/javascript"> alert("Please enter the Department ID.") </script>';
                mysqli_close($con);
                echo '<script type="text/javascript"> location.href="./Admin_Approve.php"</script>';
              }

            else
            {
               
               $query="select * from hod_details where d_id='$approval_id'";
               $result=mysqli_query($con,$query); 
               if($result)
                 {
                   $row_count=mysqli_num_rows($result);
                   if($row_count!=1)
                     {
                       echo '<script type="text/javascript"> alert("This Department ID does not exist.") </script>';
                       mysqli_close($con);
                       echo '<script type="text/javascript"> location.href="./Admin_Approve.php"</script>';
                    }
                  }
               
               $query="update hod_details set reg_status=1 where d_id='$approval_id'";
               $result=mysqli_query($con,$query);
            
               if($result)
                   echo '<script type="text/javascript"> alert("HOD Approved.") </script>';
            
            
               mysqli_close($con);
               echo '<script type="text/javascript"> location.href="./Admin_Approve.php"</script>';
            }
          }
       ?>

       <?php
          if(isset($_POST['btn_approve_all']))
          {
            $query="update hod_details set reg_status=1 where 1";
            $result=mysqli_query($con,$query);
            if($result)
                   echo '<script type="text/javascript"> alert("All HODs have been Approved.") </script>';
            
            mysqli_close($con);
            echo '<script type="text/javascript"> location.href="./Admin_Approve.php"</script>';
          }
       ?>