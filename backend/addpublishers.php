<?php
include '../backend/dal/Publishers.php';
?>
<div class="container">


    <div class="row py-5">
        <div class="col-lg-8 mx-auto text-white text-center">
            <h1 class="display-4 fw-bold">Publishers</h1>

        </div>
    </div>

    <?php
    if (!empty($_GET['id'])) {
    ?>
        <?php

        $pageNo = 1;
        $pageS = 1;
        if (!empty($_POST['reset'])) {
            $pageNo = $_POST['PageNo'];
            $pageS = $_POST['PageSize'];
        }
        $get = new Publishers();
        $obj = $get->getPublishers($_GET['id']);
        ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addpublishers&id=<?php echo $obj->$_GET['id']; ?>" method="POST" enctype="multipart/form-data">


                        <label class="fs-5 fw-bold text-secondary">PublisherName</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" name="PublisherName" value="<?php echo $obj->publisherName; ?>" aria-describedby="button-addon2" class="form-control border-0">
                        </div>

                        <label class="fs-5 fw-bold text-secondary">YearPub</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="number" placeholder="" name="YearPub" value="<?php echo $obj->yearPub; ?>" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <!-- p-1 -->
                        <label class="fs-5 fw-bold text-secondary">Description</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" value="<?php echo $obj->description; ?>" class="form-control border-0" name="Description" />
                        </div>

                        <div class="text-center ">
                            <input type="submit" class="btn btn-success mb-1 w-25 fs-5 fw-bold" id="InsertId" name="updatef" value="Update" />

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php

        if (!empty($_POST['updatef'])) {
            $son = new Publishers();
            $son->publisherid = $_GET['id'];
            $son->publisherName = $_POST['PublisherName'];
            $son->yearPub = $_POST['YearPub'];
            $son->description = $_POST['Description'];
            $son->updatePublishers();
            echo '<script>alert("Update success.")</script>';
        }
        ?>
    <?php } else {
    ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addpublishers" method="POST" enctype="multipart/form-data">


                        <label class="fs-5 fw-bold text-secondary">PublisherName</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" name="PublisherName" aria-describedby="button-addon2" class="form-control border-0">
                        </div>

                        <label class="fs-5 fw-bold text-secondary">YearPub</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="number" placeholder="" name="YearPub" aria-describedby="button-addon2" class="form-control border-0">
                        </div>

                        <label class="fs-5 fw-bold text-secondary">Description</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <textarea type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0" name="Description"></textarea>
                        </div>


                        <div class="text-center ">
                            <input type="submit" class="btn btn-success mb-1 w-25 fs-5 fw-bold" id="InsertId" name="Insertf" value="Save" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php };
    ?>
</div>
<?php

if (!empty($_POST['Insertf'])) {
    $son = new Publishers();
    $son->publisherName = $_POST['PublisherName'];
    $son->yearPub = $_POST['YearPub'];
    $son->description = $_POST['Description'];
    $son->addPublishers();
    echo '<script>alert("Save success.")</script>';
}
?>

<?php

?>

<div class="container-fluid">
    <div class="row py-5">
        <div class="col-lg-12 mx-auto">
            <div class="p-5 rounded shadow " style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                <h2 class="mb-5"></h2>

                <div class="p-1 bg-light rounded rounded-3 shadow-sm mb-4">
                    <div class="input-group">
                        <input type="search" placeholder="Search..." aria-describedby="button-addon1" class="form-control border-0 bg-light">
                        <div class="input-group-append">
                            <button id="button-addon1" type="submit" class="btn btn-link text-primary"><strong><i class="bi bi-search"></i></strong></button>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive custom-table-responsive">

                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <label class="control control--checkbox">
                                        <input type="checkbox" class="js-check-all" />
                                        <div class="control__indicator"></div>
                                    </label>
                                </th class="">
                                <th scope="col">Id</th>
                                <th scope="col">PublisherName</th>
                                <th scope="col">YearPub</th>
                                <th scope="col">Flag</th>
                                <th scope="col">Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $page = 0;
                            $getdb = new Publishers();
                            $limit = 8;
                            $total_results = $getdb->getcount();
                            $total_pages = ceil($total_results / $limit);

                            if (!isset($_GET['pageno'])) {
                                $page = 1;
                            } else {
                                $page = $_GET['pageno'];
                            }
                            $arr = $getdb->getAllRecords($page, 8, $totalRecords);
                            for ($i = 0; $i < count($arr); $i++) {
                                $obj = $arr[$i];
                            ?>
                                <tr scope='row'>
                                    <th scope="row">
                                        <label class="control control--checkbox">
                                            <input type="checkbox" />
                                            <div class="control__indicator"></div>
                                        </label>
                                    </th>

                                    <td> <?php echo $obj->publisherid ?></td>
                                    <td> <?php echo $obj->publisherName ?></td>
                                    <td> <?php echo $obj->yearPub ?></td>
                                    <td> <?php echo $obj->flag ?></td>
                                    <td> <?php echo $obj->description ?></td>
                                    <td>
                                        <div class="text-center" style='display:flex;'>
                                            <a href="Admin.php?page=addpublishers&id=<?php echo $obj->$publisherid; ?>" class='btn btn-info mr-1' id='updatef'><i class='i bi-arrow-repeat'></i></a>
                                            <a href="../backend/delete/delpublishers.php?del=<?php echo $obj->$publisherid; ?>&name=<?php echo  $obj->$publisherName; ?>" class='btn btn-danger' id='deletef'><i class='bi bi-trash'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer">
                                    <td colspan="100"></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                </div>
                <div class="">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] ?>?page=addpublishers&<?php if ($page > 1) {
                                                                                                                echo 'pageno=' . ($page - 1);
                                                                                                            } ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <?php
                            for ($pag = 1; $pag <= $total_pages; $pag++) { ?>
                                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] ?>?page=addpublishers&<?php echo "pageno=$pag"; ?>"><?php echo $pag; ?></a></li>
                            <?php } ?>
                            <li class="page-item">
                                <a class="page-link" href="Admin.php?page=addpublishers&<?php if ($page > 1) {
                                                                                        echo 'pageno=' . ($page + 1);
                                                                                    } ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                            <li class="page-item ml-4 btn btn-info">Page : <?php echo $page; ?></li>
                            <li class="page-item ml-1 btn btn-info">Total : <?php echo  $total_results; ?></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<img src="" alt="">