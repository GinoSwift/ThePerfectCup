<?php
include_once __DIR__ . '/../layouts/nav.php';
include_once __DIR__ . '/../controller/BlogController.php';
$blog_cont = new BlogController();
$id = $_GET['id'];
$blog = $blog_cont->getBlog($id);
$errorCondition = false;
if (isset($_POST['submit'])) {

    if (empty($_POST['name'])) {
        $nameErr = "Please enter your name";
        $errorCondition = true;
    } else {
        $name = $_POST['name'];
    }

    if (empty($_POST['date'])) {
        $dateErr = "Please choose a date";
        $errorCondition = true;
    } else {
        $date = $_POST['date'];
    }

    // if (empty($_POST['video'])) {
    //     $videoErr = "Please embed video link";
    //     $errorCondition = true;
    // } else {
    // $video = $_POST['video'];
    // }

    if (empty($_POST['context'])) {
        $contextErr = "Please enter your context";
        $errorCondition = true;
    } else {
        $context = $_POST['context'];
    }

    if (empty($_FILES['image'])) {
        $imageErr = "Please add your image";
        $errorCondition = true;
    }

    if (!empty($_FILES['image']['name'])) {
        $fileName = $_FILES['image']['name'];
        $extension = explode('.', $fileName);
        $fileType = end($extension);
        $allowedTypes = ['jpg', 'jpeg', 'png', 'svg'];
        $fileSize = $_FILES['image']['size'];

        if (in_array($fileType, $allowedTypes)) {
            if ($fileSize > 5000000) {
                $imageError = 'File size must be less than 5 MB';
            } else {
                $image = $_FILES['image'];
            }
        } else {
            $imageError = 'Only File Types such as JPG,JPEG,PNG and SVG are allowed';
        }
    }

    if (!$errorCondition) {
        if (isset($image)) {
            $status = $blog_cont->editBlog($id, $name, $date, $image, $context);
            // var_dump($status);
            if ($status) {
                echo "<script>location.href='blog.php'</script>";
            }
        }
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header  p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 ">
                        <h6 class="text-white text-capitalize ps-3">Edit Blogs List table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group mx-5">
                            <label for="name" class="form-label"><b>Name*</b></label>
                            <input type="text" name="name" value="<?= $blog['name'] ?>" class="form-control border border-dark px-1 rounded">
                            <?php if (isset($nameErr) && $errorCondition) echo '<span class="text-danger">' . $nameErr . '</span>' ?>
                        </div>

                        <div class="form-group mx-5 my-3">
                            <label for="date" class="form-label"><b>Date*</b></label>
                            <input type="date" name="date" value="<?= $blog['date'] ?>" class="form-control border border-dark px-1 rounded">
                            <?php if (isset($dateErr) && $errorCondition) echo '<span class="text-danger">' . $dateErr . '</span>' ?>
                        </div>

                        <div class="form-group mx-5 mb-3">
                            <label for="image" class="form-label"><b>Featured Image*</b></label>
                            <img src="../uploads/<?= $blog['image']; ?>" class=" my-2 d-block" alt="" height="80px" width="80px">
                            <input type="file" name="image" class="form-control border border-dark px-1 rounded">
                            <?php if (isset($imageErr) && $errorCondition) echo '<span class="text-danger">' . $imageErr . '</span>' ?>
                        </div>

                        <div class="form-group mx-5 mb-3">
                            <label for="" class="form-label"><b>About*</b></label>
                            <textarea name="context" class="form-control border border-dark px-1 rounded" id="" cols="30" rows="10"><?= $blog['context'] ?></textarea>
                            <?php if (isset($contextErr) && $errorCondition) echo '<span class="text-danger">' . $contextErr . '</span>' ?>
                        </div>
                </div>

                <button type="submit" name="submit" class="btn btn-dark mx-5">UPDATE</button>

                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php
include_once __DIR__ . '/../layouts/footer.php';
?>