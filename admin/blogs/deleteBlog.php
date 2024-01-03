<?php
include_once __DIR__ . '../../controller/BlogController.php';

$id = $_POST['id'];
$blog_cont = new BlogController();
$deleteBlog = $blog_cont->deleteBlog($id);
if (isset($deleteBlog)) {
    echo "success";
} else {
    echo "You can't delete as it has related data";
}
