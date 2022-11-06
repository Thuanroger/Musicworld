<?php
include '../backend/dal/Yearsong.php';
?>
<div class="container">


    <div class="row py-5">
        <div class="col-lg-8 mx-auto text-white text-center">
            <h1 class="display-4 fw-bold">Year Song</h1>

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
        $get = new Instruments();
        $obj = $get->getInstruments($_GET['id']);
        ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addyearsong&id=<?php echo $obj->$_GET['id']; ?>" method="POST" enctype="multipart/form-data">


                        <label class="fs-5 fw-bold text-secondary">YearName</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" name="YearName" value="<?php echo $obj->yearName; ?>" aria-describedby="button-addon2" class="form-control border-0">
                        </div>

                        <label class="fs-5 fw-bold text-secondary">SongId</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="number" placeholder="" name="SongId" value="<?php echo $obj->songId; ?>" aria-describedby="button-addon2" class="form-control border-0">
                        </div>

                        <label class="fs-5 fw-bold text-secondary">Views</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="number" placeholder="" name="Views" value="<?php echo $obj->views; ?>" aria-describedby="button-addon2" class="form-control border-0">
                        </div>

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
            $son = new Yearsong();
            $son->yearSongId = $_GET['id'];
            $son->songId = $_POST['SongId'];
            $son->views = $_POST['Views'];
            $son->yearName = $_POST['YearName'];
            $son->description = $_POST['Description'];
            $son->updateYearsong();
            echo '<script>alert("Update success.")</script>';
        }
        ?>
    <?php } else {
    ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addyearsong" method="POST" enctype="multipart/form-data">

                        < <label class="fs-5 fw-bold text-secondary">YearName</label>
                            <div class="bg-light rounded-3 mb-4">
                                <input type="text" placeholder="" name="YearName" aria-describedby="button-addon2" class="form-control border-0">
                            </div>

                            <label class="fs-5 fw-bold text-secondary">SongId</label>
                            <div class="bg-light rounded-3 mb-4">
                                <input type="number" placeholder="" name="SongId" aria-describedby="button-addon2" class="form-control border-0">
                            </div>

                            <label class="fs-5 fw-bold text-secondary">Views</label>
                            <div class="bg-light rounded-3 mb-4">
                                <input type="number" placeholder="" name="Views" aria-describedby="button-addon2" class="form-control border-0">
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
    $son = new Yearsong();
    $son->songId = $_POST['SongId'];
    $son->views = $_POST['Views'];
    $son->yearName = $_POST['YearName'];
    $son->description = $_POST['Description'];
    $son->addYearsong();
    echo '<script>alert("Save success.")</script>';
}
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
                <form class="col-lg-8" name="get_Song" action="<?php echo $_SERVER['PHP_SELF'] ?>?page=addyearsong" method="POST" enctype="multipart/form-data">
                    <div class="form-row mb-4 align-items-center">
                        <!--      <label class="fs-5 fw-bold text-secondary mr-0" for="inlineFormInput">Page No</label>-->
                        <div class="col-sm-4">
                            <input type="number" class="form-control form-control-lg mb-2 border-0" name="PageNo" id="PageNoid" placeholder="Page No">
                        </div>
                        <!--      <label class="fs-5 fw-bold text-secondary mr-0" for="inlineFormInputGroup">Page Size</label> -->
                        <div class="col-sm-4">
                            <input type="number" class="form-control form-control-lg  mb-2 border-0" name="PageSize" id="Pagesizeid" placeholder="Page Size">
                        </div>

                        <div class="col-sm-3 text-center">
                            <input type="submit" class="btn btn-info mb-2 form-control-lg fs-5 fw-bold" id="ResetId" name="reset" value="Reset" />
                        </div>
                    </div>
                </form>
                <div class="table-responsive custom-table-responsive">

                    <table class="table custom-table">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <label class="control control--checkbox">
                                        <input type="checkbox" class="js-check-all" />
                                        <div class="control__indicator"></div>
                                    </label>
                                    <th scope="col">Id
                                </th>
                                <th scope="col">YearName</th>
                                <th scope="col">SongId</th>
                                <th scope="col">Views</th>
                                <th scope="col">Flag</th>
                                <th scope="col">Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $pageNo = 1;
                            $pageS = 1;

                            if (!empty($_POST['reset'])) {
                                $pageNo = $_POST['PageNo'];
                                $pageS = $_POST['PageSize'];
                            }
                            $getdb = new Yearsong();
                            $arr = $getdb->getAllRecords($pageNo, $pageS, $totalRecords);
                            //                            $strTbl = "";
                            //
                            //                            $stt = 1;

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
                                    <td> <?php echo $obj->yearSongId ?></td>
                                    <td> <?php echo $obj->yearName ?></td>
                                    <td> <?php echo $obj->songId ?></td>
                                    <td> <?php echo $obj->views ?></td>
                                    <td> <?php echo $obj->flag ?></td>
                                    <td> <?php echo $obj->description ?></td>
                                    <td>
                                        <div class="text-center" style='display:flex;'>
                                            <a href="Admin.php?page=addyearsong&id=<?php echo $obj->yearSongId; ?>" class='btn btn-info mr-1' id='updatef'><i class='i bi-arrow-repeat'></i></a>
                                            <a href="../backend/delete/delyearsong.php?del=<?php echo $obj->yearSongId; ?>&name=<?php echo  $obj->yearName; ?>" class='btn btn-danger' id='deletef'><i class='bi bi-trash'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer">
                                    <td colspan="100"></td>
                                </tr>
                            <?php } ?>


                        </tbody>
                    </table>
                    <?php
                    if (!empty($_POST['reset'])) {
                        echo "Page : " . $pageNo . " " . "Size: " . $pageS;
                    };
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>