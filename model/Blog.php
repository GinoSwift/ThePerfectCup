<?php
include_once __DIR__ . '/../vendor/db/db.php';

class Blog
{
    public function getBlogLists()
    {
        // 1. db connect
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 2. write sql
        $sql = "SELECT * FROM blogs";
        $statement = $con->prepare($sql);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}
