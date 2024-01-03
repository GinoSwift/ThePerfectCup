<?php
include_once __DIR__ . '/../vendor/db.php';

class Member
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
}
