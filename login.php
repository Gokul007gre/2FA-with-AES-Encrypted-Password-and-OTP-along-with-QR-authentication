<?php
// Start the session
session_start();
?>
<?php
  require 'C:\wamp64\www\isaa webpage\vendor/autoload.php';
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
require 'C:\wamp64\www\isaa webpage\vendor\phpmailer/phpmailer/src/Exception.php';
require 'C:\wamp64\www\isaa webpage\vendor\phpmailer/phpmailer/src/PHPMailer.php';
require 'C:\wamp64\www\isaa webpage\vendor\phpmailer/phpmailer/src/SMTP.php';
  
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
$email = $_POST['email'];
$password = $_POST['password'];



//local variables
$ky="";
$iv="";

$sql = "select *from credentials where email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  //output data of each row
  while($row = $result->fetch_assoc()) {
    $ky=$row["kys"];
    $iv=$row["iv"];
  }
}

$sql = "select password from userinfo where email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $pass=$row["password"];
  }
}

//Define cipher 
$cipher = "aes-256-cbc";
//Decrypt data 
$decrypted_data = openssl_decrypt($pass, $cipher, $ky, 0, $iv);


$encrypted_data = openssl_encrypt($password, $cipher, $ky, 0, $iv);  



$sql2 = "select * from userinfo where email = '$email' and password='$encrypted_data'";
$result = mysqli_query($conn, $sql2);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){
            $to=$email;
            $_SESSION['username']=$email;
            $otp = rand(100000,999999);
            $encotp = password_hash($otp, PASSWORD_DEFAULT);
            $subject = 'OTP DO NOT SHARE';
            $msg="<b>Hello ".$to." kindly use the given OTP for Login to our Website. Do not share OTP. ".$otp."</b>";
            $msg=wordwrap($msg,70);
            if (mysqli_query($conn,"INSERT INTO `otp` (`username`, `code`, `time`) VALUES ('$to', '$encotp', current_timestamp())")) 
            {
              echo "Success";
              $mail = new PHPMailer(true);
              $mail->isSMTP();
              $mail->Mailer = "smtp";
              $mail->SMTPDebug = 1;
              $mail->SMTPAuth = true;
              $mail->SMTPSecure='ssl';
              $mail->Port = 465;
              $mail->Host = 'smtp.gmail.com';   
              $mail->Username = 'twofactor61@gmail.com';
              $mail->Password = 'g_mail password';
              $mail->IsHTML(true);   
              $mail->setFrom('twofactor61@gmail.com');
              $mail->addReplyTo('twofactor61@gmail.com', 'Gokul VS');
              $mail->addAddress($to);
              $mail->Subject = 'OTP Verification -Do Not Share';
              $mail->msgHTML($msg);
              if($mail->Send())
              {
                  header("Location:verifyOTP.php", true, 301);
              }
              else
              {
                header("Location:error.html", true, 301);
              }
            }
              
        }  
        else{  
            header("Location:error.html", true, 301); 
        }    
?>
