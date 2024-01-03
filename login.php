<?php
session_start();
include_once 'controller/authenticationController.php';

$auth_cont = new AuthenticationController();
$members = $auth_cont->MemberLists();

if (isset($_POST['submit'])) {
    if (empty($_POST['email'])) {
        $emailError = "You need to fill your email";
    } elseif (empty($_POST['password'])) {
        $passwordError = "You need to fill your password";
    } else {
        $loginSuccessful = false;
        foreach ($members as $member) {
            if ($_POST['email'] == $member['email'] && password_verify($_POST['password'], $member['password'])) {
                $_SESSION['id'] = $member['id'];
                $loginSuccessful = true;
                break; // No need to continue checking after a successful login
            }
        }

        if ($loginSuccessful) {
            header('Location: index.php');
            exit;
        } else {
            $passwordError = "Invalid Email Or Password";
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
            <h2 class="intro-text text-center">Login
                <strong>form</strong>
            </h2>
            <hr>

            <form role="form" method="post">
                <div class="row">
                    <div class="form-group col-lg-4">
                        <label>Email Address</label>
                        <input type="email" name="email" id="email" maxlength="255" class="form-control">
                        <small class="text-danger"><?php if (isset($emailError)) echo $emailError; ?></small>
                    </div>
                    <div class="form-group col-lg-4">
                        <label>Password</label>
                        <input type="password" name="password" id="password" maxlength="255" class="form-control">
                        <small class="text-danger"><?php if (isset($passwordError)) echo $passwordError; ?></small>
                    </div>

                    <div class="form-group col-lg-12">
                        <button type="submit" name="submit" id="login" class="btn btn-default">Submit</button>
                    </div>
                </div>
            </form>

            <h5>Don't have an account? <a href="register.php">Register!</a></h5>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>