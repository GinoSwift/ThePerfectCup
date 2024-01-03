<?php
include_once __DIR__ . '/../vendor/db.php';

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

    public function getBlogInfo($id)
    {
        // 1. db connect
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 2. write sql
        $sql = "SELECT * FROM blogs WHERE id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function createBlogs($name, $date, $fileName, $context)
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "INSERT INTO blogs(name,date,image,context) VALUES (:name,:date,:image,:context)";
        $statement = $con->prepare($sql);
        try {
            $statement->execute([
                ':name' => $name,
                ':context' => $context,
                // ':video' => $video,
                ':image' => $fileName,
                ':date' => $date
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateBlogInfo($id, $name, $date, $fileName, $context)
    {
        //1. db connect
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql 
        $sql = "UPDATE blogs SET name=:name,date=:date,image=:image,context=:context WHERE id=:id";
        $statement = $con->prepare($sql);

        try {
            $statement->execute([
                ':id' => $id,
                ':name' => $name,
                ':date' => $date,
                // ':video' => $video,
                ':image' => $fileName,
                ':context' => $context
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteBlogInfo($id)
    {
        //1. db connect
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql 
        $sql = "DELETE FROM blogs WHERE id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
}
