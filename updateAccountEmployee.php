<?php
// Initialize the session
session_start();
 
//Employee Force Login
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || is_null($_SESSION["id"])){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $_SESSION["username"];
$accNum = $_SESSION["acc"];
$empid = $_SESSION["id"];
$new_password = $confirm_password = $first_Name = $last_Name = $email = $area_code = $phone_number = $postion = $pay = $adress = $empEmail = $hours = "";
$sys_err = $new_password_err = $confirm_password_err = $first_Name_err = $last_Name_err = $email_err = $area_code_err = $phone_number_err = $other_err = "";

$sql = "SELECT * FROM user_hotel WHERE USERNAME = '$username'";
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

$sql2 = "SELECT * FROM 	employee WHERE EMPLOYEE_NUMBER = $empid";
$resultEmp = mysqli_query($link, $sql2);
if(mysqli_num_rows($resultEmp) != 1){
    echo "<tr><th>internal error</th></tr><br>";
} else {
    if($row2 = mysqli_fetch_assoc($resultEmp)){
        $postion = $row2['POSITION'];
        $pay = $row2['EMPLOYEE_PAY'];
        $adress = $row2['EMPLOYEE_ADRESS'];
        $empEmail = $row2['EMPLOYEE_EMAIL'];
        $hours = $row2['EMPLOYEE_STANDARD_HOURS'];
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

        if(empty($postion)){
            $postion = $row2['POSITION'];
        }
        if(empty($adress)){
            $adress = $row2['EMPLOYEE_ADRESS'];
        }
        if(empty($empEmail)){
            $empEmail = $row2['EMPLOYEE_EMAIL'];
        }
        if(empty($hours)){
            $hours = $row2['EMPLOYEE_STANDARD_HOURS'];
        }

        //grab current employee data
        $sql = "SELECT * FROM employee WHERE EMPLOYEE_NUMBER = $empid";
        $result = mysqli_query($link, $sql);

        $sql = "UPDATE employee SET POSITION = '$postion', EMPLOYEE_ADRESS = '$adress', EMPLOYEE_EMAIL = '$empEmail', EMPLOYEE_STANDARD_HOURS = '$hours' WHERE EMPLOYEE_NUMBER = $empid";
        $result = mysqli_query($link, $sql);

        if(!$result){
            echo "Update failed: " . mysqli_error($conn);
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
                <label>Position</label>
                <span class="form-control"> <?php echo $postion; ?> </span>
            </div>
            <div class="form-group">
                <label>Pay</label>
                <span class="form-control"> <?php echo $pay; ?> </span>
            </div>
            <div class="form-group">
                <label>Employee Address</label>
                <input type="text" name="adress" class="form-control <?php echo (!empty($other_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $adress; ?>">
                <span class="invalid-feedback"><?php echo $other_err; ?></span>
            </div>
            <div class="form-group">
                <label>Employee Email</label>
                <input type="text" name="empEmail" class="form-control <?php echo (!empty($other_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $empEmail; ?>">
                <span class="invalid-feedback"><?php echo $other_err; ?></span>
            </div>
            <div class="form-group">
                <label>Hours</label>
                <span class="form-control"> <?php echo $hours; ?> </span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>