<?php
session_start();
include_once 'controller/authenticationController.php';

$auth_cont = new AuthenticationController();
$id = $_GET['id'];
$passwords = $auth_cont->MemberLists();

if (isset($_POST['submit'])) {
    if (empty($_POST['repassword'])) {
        $rePwErr = "Please retype your password";
        $errCondition = true;
    }

    if (empty($_POST['npassword'])) {
        $newPwErr = "Please fill your new password";
        $errCondition = true;
    }

    if (empty($_POST['cpassword'])) {
        $cPwErr = "Please confirm your new password";
        $errCondition = true;
    }

    foreach ($passwords as $password) {
        // Check if the new password and confirm password match
        if ($_POST['npassword'] == $_POST['cpassword']) {
            // Check if the retype password matches the current password
            if (password_verify($_POST['repassword'], $password['password'])) {
                // Change the password
                $status = $auth_cont->changePw($id, password_hash($_POST['npassword'], PASSWORD_DEFAULT));

                if ($status) {
                    // Set a session variable for success message
                    $_SESSION['success_message'] = 'Password changed successfully!';
                    // Redirect to another page (change this to your desired page)
                    header("Location: index.php");
                    exit();
                }
            }
        }
    }
}

?>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/business-casual.css" rel="stylesheet">

<!-- Fonts -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

<div class="row">
    <div class="box">
        <div class="col-lg-12">
            <hr>
            <h2 class="intro-text text-center">Change Password
                <strong>form</strong>
            </h2>
            <hr>

            <!-- Display success or error message if they exist in the session -->

            <form role="form" method="post">
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>Retype Password</label>
                        <input type="password" name="repassword" id="repassword" maxlength="255" class="form-control">
                        <?php if (isset($rePwErr) && $errCondition) echo '<span class="text-danger">' . $rePwErr . '</span>' ?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>New Password</label>
                        <input type="password" name="npassword" id="npassword" maxlength="255" class="form-control">
                        <?php if (isset($newPwErr) && $errCondition) echo '<span class="text-danger">' . $newPwErr . '</span>' ?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Confirm Password</label>
                        <input type="password" name="cpassword" id="cpassword" maxlength="255" class="form-control">
                        <?php if (isset($cPwErr) && $errCondition) echo '<span class="text-danger">' . $cPwErr . '</span>' ?>
                    </div>

                    <div class="form-group col-lg-12">
                        <button type="submit" name="submit" class="btn btn-default">Submit</button>
                    </div>
                </div>
            </form>

            <h5><a href="index.php">Back 2 Home!</a></h5>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>