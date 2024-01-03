<?php
include_once __DIR__ . '/../layouts/nav.php';
include_once __DIR__ . '/../controller/BlogController.php';
$blog_cont = new BlogController();
$blogs = $blog_cont->getBlogs();
?>
<div class="container">

    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header  p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 ">
                        <h6 class="text-white text-capitalize ps-3">Blogs List table</h6>
                    </div>
                </div>
                <div class="mt-2 mx-3">
                    <a href="addBlog.php" class="right-0 btn btn-primary">Add Blog</a>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                                    <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Video</th> -->
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">About</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($blogs as $blog) : ?>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 text-sm"><?= $count++ ?></h6>
                                        </td>
                                        <td>
                                            <h6 class="mb-0 text-sm"><?= $blog['name'] ?></h6>
                                        </td>
                                        <td>
                                            <h6 class="mb-0 text-sm"><?= $blog['date'] ?></h6>
                                        </td>
                                        <td id="<?= $blog['id'] ?>">
                                            <a href="editBlog.php?id=<?= $blog['id'] ?>" class="btn btn-info">Edit</a> <a href="" class="btn btn-danger deleteBlog">Delete</a>
                                        </td>
                                        <td>
                                            <img src="../uploads/<?= $blog['image'] ?>" width="50px" height="50px" class="img-fluid" alt="">
                                        </td>
                                        <td>
                                            <h6 class="mb-0 text-sm"><?= $blog['context'] ?></h6>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once __DIR__ . '/../layouts/footer.php';
?>