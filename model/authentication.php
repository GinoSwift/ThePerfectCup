<?php
include_once __DIR__ . '/../vendor/db/db.php';

class Authentication
{
    public function getMemberLists()
    {
        // 1. db connect
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 2. Write SQL  
        $sql = "SELECT * FROM members";
        $statement = $con->prepare($sql);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function getMembersByID($id)
    {
        // 1. db connect
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 2. Write SQL  
        $sql = "SELECT * FROM members WHERE id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function changePassword($id, $password)
    {
        //1. db connect
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql 
        $sql = "UPDATE members SET password=:password,cpassword=:cpassword  where id=:id";
        $statement = $con->prepare($sql);

        try {
            $statement->execute([
                ':id' => $id,
                ':password' => $password,
                ':cpassword' => $password
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
