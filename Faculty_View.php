<?php
  require "Connection.php";
?>
<?php
   session_start();
   if(!($_SESSION['fac_id']))
      {
       echo '<script type="text/javascript"> alert("Please login to continue.") </script>';
       echo '<script type="text/javascript"> location.href="./faculty_Login.php" </script>';
      }
?>
<!DOCTYPE html>
<html>

  <head>
    <title>FRIENDZY | Faculty View</title>
	<link rel="stylesheet" type="text/css" href="./css/homestyle.css">

	<style type="text/css">

    .view-form { height: 500px; width: 550px; background-color: rgba(0,0,0,0.8);
                 margin-left: 425px; margin-top: 5px; overflow: auto; position: fixed;}

    .view-form::-webkit-scrollbar { width: 8px; }

    .view-form::-webkit-scrollbar-thumb { background-color: rgba(255,0,0,0.7); outline: 0;
    	                                  border-radius: 50px;
                                          box-shadow: 0 4px 10px rgba(0,0,0,0.5); }

    .profile-pic { background-color: rgba(0,0,0,0.8); margin-left: 200px; margin-top: 0px; height: 130px;           width: 130px; border-radius: 100px; border-color: rgba(255,0,0,1.0); border-width: 5px;
                   text-decoration: none;
        	       overflow: hidden;
        	       background-repeat: no-repeat; background-size: cover; position:relative; }

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
		   <li> <a class="colblack" href="./webhome.php">Home</a> </li>
			 <li> <a class="colblack" href="./Student_Login.php">Student Corner</a> </li>
			 <li> <a class="colred" href="#">Faculty Corner</a> </li>
			 <li> <a class="colblack" href="./HOD_Login.php">HOD Corner</a> </li>
			 <li> <a class="colblack" href="./Admin_Login.php">Admin Corner</a> </li>
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
         $f_name=$row['f_name'];
         $m_name=$row['m_name'];
         $l_name=$row['l_name'];
         $email=$row['email'];
         $phone=$row['phone'];
         $gender=$row['gender'];
         $fid=substr($fac_id,0,3);
         $img=$row['profile_pic'];
       }
    }
    
    $query="select d_name from department_details where d_id='$fid'";
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

    mysqli_close($con);

  ?>


	<div class="divider"></div>
	<div class="backimg">
      <div class="view-form" >
         <p id="lbl" align="center">View Faculty Profile</p>
         <div class="profile-pic" >
            <img src=<?php echo $img;?> height="132" width="132">
         </div>
         <form name="" action="" method="post">
           <table class="view-details">
              <tr>
                <td id="label">First Name:</td>
                <td id="label"><?php echo $f_name;?></td>
              </tr>
              <tr>
                <td id="label">Middle Name:</td>
                <td id="label"><?php echo $m_name;?></td>
              </tr>
              <tr>
                <td id="label">Last Name:</td>
                <td id="label"><?php echo $l_name;?></td>
              </tr>
              <tr>
                <td id="label">Faculty ID:</td>
                <td id="label"><?php echo $fac_id;?></td>
              </tr>
              <tr>
                <td id="label">Email:</td>
                <td id="label"><?php echo $email;?></td>
              </tr>
                  <tr><td id="label">Phone No (+91):</td>
                  <td id="label"><?php echo $phone;?></td>
              </tr>
              <tr>
                <td id="label">Gender:</td>
                <td id="label"><?php echo $gender;?></td>
              </tr>
              <tr>
                <td id="label">Department:</td>
                <td id="label"><?php echo $department;?></td>
              </tr>





           </table>
         </form>
         <p >
         	<form action="./Faculty_Edit.php" method="post" onsumit="">
         	     <input class="btn" type="submit" value="Edit Details">
             </form>
         </p>
         <p >
         	<form action="./Faculty_Home.php" method="post" onsumit="">
         	     <input class="btn" type="submit" value="Back to Profile">
             </form>
         </p>

      </div>

	</div>
	<div class="divider"></div>

	<footer></footer>
  </body>


  </html>
