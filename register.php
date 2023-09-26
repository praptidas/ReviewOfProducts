<?php
$servername="localhost";
$username="root";
$password="";
$db="register_data";
$conn=new mysqli($servername,$username,$password,$db);
// define variables and set to empty values
$fname =$lname = $email = $mobile= $pass = $cpass ="";
$fnameerr= $lnameerr= $emailerr= $mobileerr= $passerr= $cpasserr= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST['fname'])){
        $fnameerr = "First name is required";
    }
    else{
        $fname =$_POST['fname'];
        if(!preg_match("/^[a-zA-Z]*$/",$fname)){
            $fnameerr = "Only alphabets are allowed";
        }
    }

    if(empty($_POST['lname'])){
        $lnameerr = "Last name is required";
    }
    else{
        $lname =$_POST['lname'];
        if(!preg_match("/^[a-zA-Z ]*$/",$lname)){
            $lnameerr = "Only alphabets are allowed";
        }
    }
    
    if(empty($_POST['email'])){
    $emailerr = "Email is required";
    }
    else{
        $email =$_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailerr = "Invalid Email format";
        }
    }

    if(empty($_POST['mobile'])){
        $mobileerr="Mobile no. is required";
    }
    else{
        $mobile=$_POST['mobile'];
        if(!preg_match("/^[0-9]*$/",$mobile)){
            $mobileerr="only numbers are allowed";
        }
        else if(strlen($mobile)!=10){
            $mobileerr="Enter 10 digits mobile no.";
        }
        
    }

    if(empty($_POST['pass'])){
        $passerr="Enter password";
    }
    else{
        $pass = $_POST['pass'];
        $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&+=])[A-Za-z\d@#$%^&+=]{8,}$/';
        // Check if the password matches the pattern
        if (!preg_match($pattern, $pass)) {
            $passerr= "Password must contain at least 8 characters with at least one uppercase letter, one lowercase letter, one digit, and one special character (@, #, $, %, ^, &, +, =).";
        }
    }

    if (empty($_POST['cpass'])) {
        $cpasserr = "Confirm your password";
    } 
    else {
        $cpass = $_POST['cpass'];
        if ($cpass != $pass) {
            $cpasserr = "Passwords do not match";
        }
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="register.css">
    <style>
        .error{
            color:#FF0001;
        }
    </style>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div class="main">
        <div class ="register">
            <h2>Register here</h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="part">
                    <label>First Name : </label>
                    <span class="error">*<?php echo $fnameerr ; ?></span>
                    <br>
                    <input type="text" name="fname" id="name" placeholder="Enter your First Name">
                    <br><br>
                    <label>Last Name : </label>
                    <span class="error">*<?php echo $lnameerr ; ?></span>
                    <br>
                    <input type="text" name="lname" id="name" placeholder="Enter your Last Name">
                    <br><br>
                    <label>E-mail :<label>
                    <span class="error">*<?php echo $emailerr ; ?></span>
                    <br>
                    <input type="email" name="email" id="name" placeholder="Enter e-mail">
                    <br><br>
                    <label>Mobile number : </label>
                    <span class="error">*<?php echo $mobileerr ; ?></span>
                    <br>
                    <input type="number" name="mobile" id="name" placeholder="Enter ph no.">
                    
                    <br><br>
                    <label>Password :</label>
                    <span class="error"><?php echo $passerr ; ?></span>
                    <br>
                    <input type="password" name="pass" id="name" placeholder="Enter Strong password">
                    <br><br>
                    <label>Confirm Password : </label>
                    <span class="error"><?php echo $cpasserr ; ?></span>
                    <br>
                    <input type="password" name="cpass" id="name" placeholder="Reenter the password">
                    </div>
                    <input type="submit" id="submit"name="submit">
                </form>
            
        </div>
    </div>
</body>
</html>

<!--code for sql connection
<?php

if($conn->connect_error)
{
    die("connection failed".$conn->connect_error);
}
else if($pass==$cpass){
    $sql=" insert into user_data(fname,lname, email,phno, pass,cpass) values('$fname','$lname', '$email' ,'$mobile', '$pass' , '$cpass') ";
    mysqli_query($conn, $sql);
}
else{
    echo "Password is not matched";
}
?>


