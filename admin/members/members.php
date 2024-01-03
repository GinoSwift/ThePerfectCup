<?php
include_once __DIR__ . '/../layouts/nav.php';
include_once __DIR__ . '/../controller/MemberController.php';
$member_cont = new MemberController();
$members = $member_cont->getMembers();
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header  p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 ">
                        <h6 class="text-white text-capitalize ps-3">Members List table</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($members as $member) : ?>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0 text-sm"><?= $count++ ?></h6>
                                        </td>
                                        <td>
                                            <h6 class="mb-0 text-sm"><?= $member['fname'] ?></h6>
                                        </td>
                                        <td>
                                            <h6 class="mb-0 text-sm"><?= $member['lname'] ?></h6>
                                        </td>
                                        <td>
                                            <h6 class="mb-0 text-sm"><?= $member['email'] ?></h6>
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