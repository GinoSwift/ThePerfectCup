<?php
session_start();

include_once 'controller/memberController.php';
include_once 'controller/authenticationController.php';

$member_cont = new MemberController();
$auth_cont = new AuthenticationController();
if (isset($_POST['submit'])) {
    if (empty($_POST['fname'])) {
        $fnameErr = "Please fill your first name!";
        $errCondition = true;
    } else {
        $fname = $_POST['fname'];
    }
    // die(var_dump($fname));

    if (empty($_POST['lname'])) {
        $lnameErr = "Please fill your last name!";
        $errCondition = true;
    } else {
        $lname = $_POST['lname'];
    }

    if (empty($_POST['email'])) {
        $emailErr = "Please fill your email!";
        $errCondition = true;
    } else {
        $email = $_POST['email'];
    }

    if (empty($_POST['password'])) {
        $passErr = "Fill your password!";
        $errCondition = true;
    } else {
        $password = $_POST['password'];
    }

    if (empty($_POST['cpassword'])) {
        $cpassErr = "Confirm your password!";
        $errCondition = true;
    } else {
        $cpassword = $_POST['cpassword'];
    }

    $status = $member_cont->newMembers($fname, $lname, $email, $password, $cpassword);
    if ($status) {
        $otp = $auth_cont->sendMail($_POST['email']);
        $_SESSION['otp'] = $otp;
        echo "<script>location.href= 'otp.php'</script>";
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
            <h2 class="intro-text text-center">Registration
                <strong>form</strong>
            </h2>
            <hr>

            <form role="form" method="post">
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>First Name</label>
                        <input type="text" name="fname" id="fname" maxlength="25" class="form-control">
                        <?php if (isset($fnameErr) && $errCondition) echo '<span class="text-danger">' . $fnameErr . '</span>' ?>

                    </div>
                    <div class="form-group col-lg-4">
                        <label>Last Name</label>
                        <input type="text" name="lname" id="lname" maxlength="25" class="form-control">
                        <?php if (isset($lnameErr) && $errCondition) echo '<span class="text-danger">' . $lnameErr . '</span>' ?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Email Address</label>
                        <input type="email" name="email" id="email" maxlength="25" class="form-control">
                        <?php if (isset($emailErr) && $errCondition) echo '<span class="text-danger">' . $emailErr . '</span>' ?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Password</label>
                        <input type="tel" name="password" id="password" maxlength="10" class="form-control">
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                        <?php if (isset($passErr) && $errCondition) echo '<span class="text-danger">' . $passErr . '</span>' ?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Confirm Password</label>
                        <input type="tel" name="cpassword" id="cpassword" maxlength="10" class="form-control">
                        <?php if (isset($cpassErr) && $errCondition) echo '<span class="text-danger">' . $cpassErr . '</span>' ?>
                    </div>

                    <div class="form-group col-lg-12">
                        <button name="submit" id="register" class="btn btn-default">Submit</button>
                    </div>
                </div>
            </form>
            <h5>Already have an account? <a href="login.php">Log In!</a> </h5>
        </div>
    </div>
</div>

<?php require_once 'footer.php' ?>