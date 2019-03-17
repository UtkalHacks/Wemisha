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


      .view { height: 200px; width: 780px; margin: 10px; background-color: rgba(0,0,0,0.7); border-radius: 5px;
              overflow: auto; }

      .view::-webkit-scrollbar { width: 8px; }

      .view::-webkit-scrollbar-thumb { background-color: rgba(255,0,0,0.7); outline: 0; border-radius: 50px;
                                       box-shadow: 0 4px 10px rgba(0,0,0,0.5); }

      .add-remove { height: 170px; width: 780px; background-color: rgba(0,0,0,0.6); margin: 20px 10px 10px 10px;
                    border-radius: 5px;}

      .panel-label { color: white; font-size: 22px; font-family: Bookman Old Style; padding-top: 10px;}

      .request { height:50px; width: 750px; background-color: rgba(0,0,0,0.35); margin: 10px; 
                   border-color: rgba(255,0,0,1.0); 
                  border-radius: 5px;}

      .request:hover { background-color: rgba(0,0,0,0.9); transition: 0.5s; }

      .textbox  { border-radius:5px; background-color:rgba(0,0,0,0.95); height:25px; color: white;
              font-family: Bookman Old Style; margin-top:15px; margin-left: 5px;
                font-size: 16px; width: 200px; border-color:rgba(0,0,0,0.85); transition: .3s;}

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
                         <center><p>Manage Departments</p></center>
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

           <div class="view">
              <?php
                  $query="select * from department_details where 1";
                  $result=mysqli_query($con,$query);
                  if($result)
                  {
                    $row_count=mysqli_num_rows($result);
                    if($row_count>0)
                     { 
                      while($row=mysqli_fetch_assoc($result))
                        {
                           $d_name=$row['d_name'];
                           $d_id=$row['d_id'];
                    
                           echo "<div class='request'> 
                                <form>
                                 <table style='color:white; font-size:18px; font-family:Bookman Old Style;'>
                                    <tr>
                                      <td style='padding-left:60px; padding-top:15px;'>$d_id</td>
                                      <td style='padding-left:30px; padding-top:15px;'>$d_name</td>
                                    </tr>
                                 </table>
                              </form>
                            </div>";
                        }
                   }
                  }
              ?>
           </div>

           <div class="add-remove">
             <form method="post">
              <center style="color:white; font-size:17px; font-family: Bookman Old Style; padding-top:10px;">Add or Remove Departments</center>
             <table>
                <tr>
                   <td style="padding-left:20px;"><input  class="textbox" type="text" name="txt_id" placeholder="Department ID "></td>
                   <td style="padding-left:10px;"><input  class="textbox" type="text" name="txt_name" placeholder="Department Name "></td>
                   <td><input class="btn" type="submit" value="Add/Edit" name="btn_add_edit"></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td style="padding-left:150px;"><input  class="textbox" type="text" name="txt_id2" placeholder="Department ID ">
                    <td><input class="btn" type="submit" value="Remove" name="btn_remove"></td>
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
 
     if(isset($_POST['btn_add_edit']))
      { 

        $txt_id=test_input($_POST['txt_id']);
        $txt_name=test_input($_POST['txt_name']);

        if($txt_id=="" )
        {
          echo '<script type="text/javascript"> alert("Department ID and/or Department Name cannot be empty.") </script>';
          mysqli_close($con);
          echo '<script type="text/javascript"> location.href="./Admin_Manage_Dep.php"</script>';
        }
        if($txt_name=="" )
        {
          echo '<script type="text/javascript"> alert("Department ID and/or Department Name cannot be empty.") </script>';
          mysqli_close($con);
          echo '<script type="text/javascript"> location.href="./Admin_Manage_Dep.php"</script>';
        }

        $query="select * from department_details where 1";
        $result=mysqli_query($con,$query);
        if($result)
          { 
            $row_count=mysqli_num_rows($result);
           
            if($row_count>0)
            {
              while($row=mysqli_fetch_assoc($result))
              {
                 if($txt_id==$row['d_id'])
                   {
                     
                      $query="update department_details set d_name='$txt_name' where d_id='$txt_id'";
                      $result=mysqli_query($con,$query);
                      if($result)
                         { 
                           echo '<script type="text/javascript"> alert("Department Edited Successfully.") </script>';
                           mysqli_close($con);
                           echo '<script type="text/javascript"> location.href="./Admin_Manage_Dep.php"</script>';
                         }
                      
                   
                   }

              }

             
             

                $query="insert into department_details(d_id,d_name) values('{$txt_id}','{$txt_name}')";
                $result=mysqli_query($con,$query);
                if($result)
                    { 
                           echo '<script type="text/javascript"> alert("Department Added Successfully.") </script>';
                           mysqli_close($con);
                           echo '<script type="text/javascript"> location.href="./Admin_Manage_Dep.php"</script>';
                    }

           

            }
          }
      }

  ?>

  <?php
     if(isset($_POST['btn_remove']))
       {
        $d_id=test_input($_POST['txt_id2']);
        
        if($d_id=="")
        {
          echo '<script type="text/javascript"> alert("Department ID cannot be blank.") </script>';
          mysqli_close($con);
          echo '<script type="text/javascript"> location.href="./Admin_Manage_Dep.php"</script>';
        }

        $x=0;
        $query="select * from department_details where 1";
        $result=mysqli_query($con,$query);
        if($result)
          { 
            $row_count=mysqli_num_rows($result);
            if($row_count>0)
            {
              while($row=mysqli_fetch_assoc($result))
              {
                 if($d_id==$row['d_id'])
                   $x=1;
              }
              if($x==0)
              {
                echo '<script type="text/javascript"> alert("Department ID does not exist.") </script>';
                mysqli_close($con);
                echo '<script type="text/javascript"> location.href="./Admin_Manage_Dep.php"</script>';
              }
           }



           $query="delete from department_details where d_id='$d_id'";
           $result=mysqli_query($con,$query);
           if($result)
             {
               echo '<script type="text/javascript"> alert("Department Removed Successfully.") </script>';
               mysqli_close($con);
               echo '<script type="text/javascript"> location.href="./Admin_Manage_Dep.php"</script>';
             }
          }
        }

 
  ?>
