<?php
include_once __DIR__ . '/../model/Blog.php';

class BlogController extends Blog
{
    public function getBlogs()
    {
        return $this->getBlogLists();
    }

    public function getBlog($id)
    {
        return $this->getBlogInfo($id);
    }

    public function createBlog($name, $date, $image, $context)
    {
        if (isset($image) && $image['error'] == 0) {
            $fileName = $image['name'];
            $tempFile = $image['tmp_name'];

            $timeStamp = time();
            $fileName = $timeStamp . $fileName;
            if (move_uploaded_file($tempFile, '../uploads/' . $fileName)) {
                return $this->createBlogs($name, $date, $fileName, $context);
            }
        }
    }

    public function editBlog($id, $name, $date, $image, $context)
    {
        if (isset($image) && $image['error'] == 0) {
            $fileName = $image['name'];
            $tempFile = $image['tmp_name'];

            $timeStamp = time();
            $fileName = $timeStamp . $fileName;
            if (move_uploaded_file($tempFile, '../uploads/' . $fileName)) {
                return $this->updateBlogInfo($id, $name, $date, $fileName, $context);
            }
        }
    }

    public function deleteBlog($id)
    {
        return $this->deleteBlogInfo($id);
    }
}
