<?php
include_once __DIR__ . '/../model/Blog.php';

class BlogController extends Blog
{
    public function getBlogs()
    {
        return $this->getBlogLists();
    }
}
