<?php
// Start the session
session_start();
?>
<?php
$servername = "localhost";
$username = "root";
$password = "DB_PASSWORD";
$dbname = "nis";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
$text=$_POST['qrcode_text'];
if(!empty($text)){
    $arr=explode(" ",$text);
    
    $sql2 = "select * from userinfo where email = '$arr[0]' and password='$arr[1]'";
    $result = mysqli_query($conn, $sql2);  
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
          $count = mysqli_num_rows($result);  
    if($count==1){
    unset($_POST);
      header("Location:home.html", true, 301);
    }
    else{
        unset($_POST);
        header("Location:error.html", true, 301);
    }
  
  }
  else{
    header("Location:error.html", true, 301);
  }
?>
