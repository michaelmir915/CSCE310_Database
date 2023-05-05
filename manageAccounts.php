<?php
include 'navbar.php';

//Manager Force Login
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || is_null($_SESSION["id"]) || $_SESSION["acc"]===0){
    header("location: login.php");
    exit;
}

//Decalre Variables
$empid = $empPay = $empNotes = $empHours = $accountid = $manager = $location = $fire = $hire = $empemail = $position = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $empid = trim($_POST['empid']);
    $empPay = trim($_POST["pay"]);
    $empNotes = trim($_POST["notes"]);
    $empHours = trim($_POST["hours"]);
    $accountid = trim($_POST["accid"]);
    $location = trim($_POST["location"]);
    $empemail = trim($_POST["empemail"]);
    $position = trim($_POST["position"]);

    $manager = trim($_POST["manager"]);
    if(empty($manager)){
        $manager = NULL;
    }
    $fire = trim($_POST["fire"]);
    //fire someone
    if(!empty($fire)){
        $sql = "DELETE FROM employee WHERE EMPLOYEE_NUMBER = $empid";
        $result = mysqli_query($link, $sql);

        $sql2 = "UPDATE user_hotel SET EMPLOYEE_NUMBER = NULL WHERE ACCOUNT_NUMBER = $accountid";
        $result2 = mysqli_query($link, $sql2);
        if(!$result2){
            echo "<tr><th>internal error</th></tr><br>";
        }
    } else { //Updating
        $sql = "SELECT * FROM employee WHERE EMPLOYEE_NUMBER = $empid";
        $result = mysqli_query($link, $sql);
        //previous info if there is any
        if($row = mysqli_fetch_assoc($result)){
            if(empty($empid)){
                $empid = $row["EMPLOYEE_NUMBER"];
            }
            if(empty($empPay)){
                $empPay = $row["EMPLOYEE_PAY"];
            }
            if(empty($empNotes)){
                $empNotes = $row["EMPLOYEE_NOTES"];
            }
            if(empty($empHours)){
                $empHours = $row["EMPLOYEE_STANDARD_HOURS"];
            }
            if(empty($location)){
                $location = $row["LOCATION_NUM"];
            }
            if(empty($empemail)){
                $empemail = $row["EMPLOYEE_EMAIL"];
            }
            if(empty($position)){
                $position = $row["POSITION"];
            }
        }

        //hiring
        if(mysqli_num_rows($result) == 0){
            $hire = date("m/d/Y");
            $sql = "INSERT INTO employee (EMPLOYEE_NUMBER, IS_MANAGER, POSITION, EMPLOYEE_PAY, EMPLOYEE_HIRE_DATE, EMPLOYEE_NOTES, EMPLOYEE_STANDARD_HOURS, LOCATION_NUM, EMPLOYEE_EMAIL) VALUES ($empid, $manager, '$position', $empPay, $hire, '$empNotes', '$empHours', $location, '$empemail')";
            $result = mysqli_query($link, $sql);

            $sql2 = "UPDATE user_hotel SET EMPLOYEE_NUMBER = $empid WHERE ACCOUNT_NUMBER = $accountid";
            $result2 = mysqli_query($link, $sql2);
            if(!$result2){
                echo "<tr><th>internal error</th></tr><br>";
            }
        //Updating
        } else {
            $sql = "UPDATE employee SET POSITION = '$position', EMPLOYEE_PAY = $empPay, EMPLOYEE_NOTES = '$empNotes', EMPLOYEE_STANDARD_HOURS = '$empHours', LOCATION_NUM = $location, EMPLOYEE_EMAIL = '$empemail' WHERE EMPLOYEE_NUMBER = $empid";
            $result = mysqli_query($link, $sql);
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
        <h2>Change Employee Roster Information</h2>
        <p>Fill Out Relevent Fields to Change their data, if changing personal add thier personal account info</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>Employee ID number</label>
                <input type="text" name="empid" class="form-control " value="">
            </div>
            <div class="form-group">
                <label>Account ID number</label>
                <input type="text" name="accid" class="form-control " value="">
            </div>
            <div class="form-group">
                <label>Position</label>
                <input type="text" name="position" class="form-control " value="">
            </div>
            <div class="form-group">
                <label>Pay</label>
                <input type="text" name="pay" class="form-control " value="">
            </div>
            <div class="form-group">
                <label>Hours</label>
                <input type="text" name="hours" class="form-control " value="">
            </div>
            <div class="form-group">
                <label>Notes</label>
                <input type="text" name="notes" class="form-control " value="">
            </div>
            <div class="form-group">
                <label>Location Number</label>
                <input type="text" name="location" class="form-control " value="">
            </div>
            <div class="form-group">
                <label>Employee Email</label>
                <input type="text" name="empemail" class="form-control " value="">
            </div>
            <div class="form-group">
                <label>Make Manager</label>
                <input type="text" name="manager" class="form-control " value="">
            </div>
            <div class="form-group">
                <label>Fire</label>
                <input type="text" name="fire" class="form-control " value="">
            </div>
            
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="updateAccountEmployee.php">Edit My Info</a>
            </div>
            <div>
            <?php
                $sql = "SELECT * FROM user_hotel INNER JOIN employee ON user_hotel.EMPLOYEE_NUMBER = employee.EMPLOYEE_NUMBER";
                $result = mysqli_query($link, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "User Name: " . $row["USERNAME"] . "<br>";
                    echo "First Name: " . $row["FIRST_NAME"] . "<br>";
                    echo "Last Name: " . $row["LAST_NAME"] . "<br>";
                    echo "User email: " . $row["USER_EMAIL"] . "<br>";
                    echo "Employee email: " . $row["EMPLOYEE_EMAIL"] . "<br>";
                    echo "Is Manager: " . $row["IS_MANAGER"] . "<br>";
                    echo "Location Number: " . $row["LOCATION_NUM"] . "<br>";
                    echo "Hire Date: " . $row["EMPLOYEE_HIRE_DATE"] . "<br>";
                    echo "Payment: " . $row["EMPLOYEE_PAY"] . "<br>";
                    echo "Notes: " . $row["EMPLOYEE_NOTES"] . "<br>";
                    echo "<br>";
                }
            ?>
            </div>
        </form>
    </div>    
</body>
</html>