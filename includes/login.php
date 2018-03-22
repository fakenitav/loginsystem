<?php
session_start();
if(isset($_POST['submit']))
    {
        include_once 'dbh.php';
        $uid=mysqli_real_escape_string($conn, $_POST['uid']);
        $pwd=mysqli_real_escape_string($conn, $_POST['pwd']);

        //Checking if inputs are empty
        if(empty($uid) || empty($pwd))
        {
            header("Location: ../index.php?Login=Empty");
        }
        else {
          $sql="SELECT * FROM users where user_uid='$uid';";
          $result=mysqli_query($conn,$sql);
          $resultCheck=mysqli_num_rows($result);
              if($resultCheck < 1)
                  {
                      header("Location: ../index.php?Login=Error");
                      exit();
                  }
              else
                  {
                      if ($row=mysqli_fetch_assoc($result))
                          {
                          if ($pwd!=$row['user_pwd'])
                            {
                            header("Location: ../index.php?Login=Wrong Password");
                            exit();
                            }
                           else if($pwd==$row['user_pwd'])
                             {
                               //Login the user here
                               $_SESSION['u_id']=$row['user_id'];
                               $_SESSION['u_first']=$row['user_first'];
                               $_SESSION['u_last']=$row['user_last'];
                               $_SESSION['u_email']=$row['user_email'];
                               $_SESSION['u_uid']=$row['user_uid'];
                               header("Location: ../wall.php?Login=Success");
                               exit();
                             }
                          }
                      }
                  }
              }
else {
  header("Location: ../index.php?Login=Error");
  exit();
}
 ?>
