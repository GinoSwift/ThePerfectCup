<?php
session_start();
include_once 'controller/memberController.php';
include_once 'controller/authenticationController.php';
$auth_cont = new AuthenticationController();
$members = $auth_cont->MemberLists();
if (isset($_POST['submit'])) {
    if ($_POST['otp'] == $_SESSION['otp']) {
        foreach ($members as $member) {
            $_SESSION['id'] = $member['id'];
        }
        header('location:index.php');
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
            <h2 class="intro-text text-center">OTP
                <strong>form</strong>
            </h2>
            <hr>

            <form role="form" method="post">
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>OTP</label>
                        <input type="otp" name="otp" id="otp" maxlength="255" class="form-control">
                        <small class="text-danger"><?php if (isset($otpError)) echo $otpError; ?></small>
                    </div>

                    <div class="form-group col-lg-12">
                        <button type="submit" name="submit" id="login" class="btn btn-default">Submit</button>
                    </div>
                </div>
            </form>
            <h5>Didn't receive OTP code? <a href="register.php">Resend!</a></h5>

        </div>

    </div>
</div>
</div>

<?php require_once 'footer.php'; ?>