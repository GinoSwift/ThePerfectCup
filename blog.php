<?php
// Assuming you have a variable $currentPage that represents the current page
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the next and previous pages
$nextPage = $currentPage + 1;
$prevPage = $currentPage - 1;

require_once 'nav.php';
require_once 'controller/BlogController.php';
$blog_cont = new BlogController();
$blogs = $blog_cont->getBlogs();

// Assuming you want to display a fixed number of blogs per page
$blogsPerPage = 3;
$startIndex = ($currentPage - 1) * $blogsPerPage;
$visibleBlogs = array_slice($blogs, $startIndex, $blogsPerPage);
?>

<div class="container">
    <div class="row">
        <div class="box" id="blogs">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">Perfect Cup
                    <strong>blog</strong>
                </h2>
                <hr>
            </div>
            <?php foreach ($visibleBlogs as $blog) : ?>
                <div class="col-lg-12 text-center">
                    <img class="img-responsive img-border img-full" src="admin/uploads/<?= $blog['image'] ?>" alt="">
                    <h2><?= $blog['name'] ?>
                        <br>
                        <small><?= $blog['date'] ?></small>
                    </h2>
                    <p><?= $blog['context'] ?></p>
                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#mymodal">See More</button>
                    <hr>
                </div>
                <hr>
                <!-- Modal 1 -->
                <div id="mymodal" class="modal fade" role="dialog">
                    <!-- Modal content -->
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col-lg-12 text-center">
            <ul class="pager">
                <?php if ($prevPage > 0) : ?>
                    <li class="previous"><a href="?page=<?= $prevPage ?>">&larr; Older</a></li>
                <?php endif; ?>
                <?php if ($startIndex + $blogsPerPage < count($blogs)) : ?>
                    <li class="next"><a href="?page=<?= $nextPage ?>">Newer &rarr;</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<!-- /.container -->

<?php require_once 'footer.php' ?>