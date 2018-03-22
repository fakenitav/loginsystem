<?php
if (isset($_POST['submit'])) {
  include_once 'dbh.php';
  $fname=mysqli_real_escape_string($conn, $_POST['fname']);
  $lname=mysqli_real_escape_string($conn, $_POST['lname']);
  $email=mysqli_real_escape_string($conn, $_POST['email']);
  $uid=mysqli_real_escape_string($conn, $_POST['uid']);
  $pwd=mysqli_real_escape_string($conn, $_POST['pwd']);

    //Check for valid characters
    if(!preg_match("/^[a-zA-Z]*$/",$first) || !preg_match("/^[a-zA-Z]*$/",$last))
     {
       header("Location: ../create.php?Login=Invalid");
       exit();
     }
    else {
      $sql="SELECT * FROM users where user_id='$uid';";
      $result=mysqli_query($conn,$sql);
      $resultCheck=mysqli_num_rows($result);
        if( $resultCheck > 0 )
          {
            header("Location: ../create.php?Login=UsernameTaken");
            exit();
          }
        else {
          $sql="INSERT INTO users (user_first,user_last,user_email,user_uid,user_pwd) VALUES ('$fname','$lname','$email','$uid','$pwd');";
          $result=mysqli_query($conn,$sql);
          header("Location: http://localhost/loginsystem/index.php?Signup=Success");
          exit();
        }
    }
}
else {
  header('Location: ../create.php');
  exit();
}
?>
