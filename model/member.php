<?php
include_once 'vendor/db/db.php';

class Member
{
    public function memberAccRegister($data)
    {
        // 1. db connect
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 2. Hash the password
        $hashedPassword = password_hash($data[3], PASSWORD_DEFAULT);
        $hashedCPassword = password_hash($data[4], PASSWORD_DEFAULT);


        // 3. Write SQL
        $sql = "INSERT INTO members (fname, lname, email, password, cpassword) VALUES (:fname, :lname, :email, :password, :cpassword)";
        $statement = $con->prepare($sql);
        try {
            $statement->execute([
                ':fname' => $data[0],
                ':lname' => $data[1],
                ':email' => $data[2],
                ':password' => $hashedPassword, // Store the hashed password
                ':cpassword' => $hashedCPassword
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
