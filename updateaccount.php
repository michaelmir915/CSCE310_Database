<<<<<<< HEAD
<?php
include 'navbar.php';
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Define variables and initialize with empty values
$username = $_SESSION["username"];
$accNum = $_SESSION["acc"];
$new_password = $confirm_password = $first_Name = $last_Name = $email = $area_code = $phone_number = $cc_number = $cc_exp = $cc_cvc = "";
$sys_err = $new_password_err = $confirm_password_err = $first_Name_err = $last_Name_err = $email_err = $area_code_err = $phone_number_err = $cc_number_err = $cc_exp_err = $cc_cvc_err = "";
 

$sql = "SELECT * FROM user_hotel WHERE ACCOUNT_NUMBER = $accNum";
$resultUser = mysqli_query($link, $sql);
if(mysqli_num_rows($resultUser) != 1){
    echo "<tr><th>internal error</th></tr><br>";
} else {
    if($row = mysqli_fetch_assoc($resultUser)){
        $first_Name = $row['FIRST_NAME'];
        $last_Name = $row['LAST_NAME'];
        $email = $row['USER_EMAIL'];
        $area_code = $row['USER_AREA_CODE'];
        $phone_number = $row['USER_NUMBER'];
    }
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    if($row = mysqli_fetch_assoc($resultUser)){
        $new_password = trim($_POST['new_password']);
        $first_Name = trim($_POST["first_Name"]);
        $last_Name = trim($_POST["last_Name"]);
        $email = trim($_POST["email"]);
        $area_code = trim($_POST["area_code"]);
        $phone_number = trim($_POST["phone_number"]);
        $cc_number = trim($_POST["cc_number"]);
        $cc_exp = trim($_POST["cc_exp"]);
        $cc_cvc = $_POST["cc_cvc"];

        $hash_password = hash('sha256', $new_password);

        if(empty($first_Name)){
            $first_Name = $row['FIRST_NAME'];
        }
        if(empty($last_Name)){
            $last_Name = $row['LAST_NAME'];
        }
        if(empty($email)){
            $email = $row['USER_EMAIL'];
        }
        if(empty($area_code)){
            $area_code = $row['USER_AREA_CODE'];
        }
        if(empty($phone_number)){
            $phone_number = $row['USER_NUMBER'];
        }

        // Prepare an update statement
        $sql = "UPDATE user_hotel SET password = '$hash_password', FIRST_NAME = '$first_Name', LAST_NAME = '$last_Name', USER_EMAIL = '$email', USER_AREA_CODE = $area_code, USER_NUMBER = $phone_number  WHERE ACCOUNT_NUMBER = $accNum";

        $result = mysqli_query($link, $sql);

        if(!$result){
            echo "Update failed: " . mysqli_error($conn);
        }

        if(!empty($cc_number) || !empty($cc_exp) || !empty($cc_cvc)){
            $sql = "SELECT * FROM guest WHERE USERNAME = '$username'";
            $result = mysqli_query($link, $sql);

            if(mysqli_num_rows($result) == 0){
                $sql = "INSERT INTO guest (USERNAME, CC_NUMBER, CC_CCV, CC_EXP) VALUES ('$username', '$cc_number', $cc_cvc, '$cc_exp')";
                $result = mysqli_query($link, $sql);

            } else {
                $sql = "UPDATE guest SET CC_NUMBER = '$cc_number', CC_CCV = $cc_cvc, CC_EXP = '$cc_exp' WHERE USERNAME = $username";
            
                $result = mysqli_query($link, $sql);
            }
        }
    }

    // Close connection
    mysqli_close($link);

    if($result){
        header("location: welcome.php");
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Account</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Update Account Info</h2>
        <p>Please fill out this form to update your account's info</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>Username</label>
                <span class="form-control"> <?php echo $username; ?> </span>
            </div>
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_Name" class="form-control <?php echo (!empty($first_Name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $first_Name; ?>">
                <span class="invalid-feedback"><?php echo $first_Name_err; ?></span>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_Name" class="form-control <?php echo (!empty($last_Name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $last_Name; ?>">
                <span class="invalid-feedback"><?php echo $last_Name_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Area Code</label>
                <input type="text" name="area_code" class="form-control <?php echo (!empty($area_code_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $area_code; ?>">
                <span class="invalid-feedback"><?php echo $area_code_err; ?></span>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone_number" class="form-control <?php echo (!empty($phone_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone_number; ?>">
                <span class="invalid-feedback"><?php echo $phone_number_err; ?></span>
            </div>
            <div class="form-group">
                <label>Credit Card Number</label>
                <input type="text" name="cc_number" class="form-control <?php echo (!empty($cc_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cc_number; ?>">
                <span class="invalid-feedback"><?php echo $cc_number_err; ?></span>
            </div>
            <div class="form-group">
                <label>Credit Experation Date</label>
                <input type="text" name="cc_exp" class="form-control <?php echo (!empty($cc_exp_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cc_exp; ?>">
                <span class="invalid-feedback"><?php echo $cc_exp_err; ?></span>
            </div>
            <div class="form-group">
                <label>Credit Card CVC</label>
                <input type="text" name="cc_cvc" class="form-control <?php echo (!empty($cc_cvc_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cc_cvc; ?>">
                <span class="invalid-feedback"><?php echo $cc_cvc_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>