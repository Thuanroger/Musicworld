
<?php
include '../backend/dal/Song.php';
?>
<div class="container">
    <div class="row py-5">
        <div class="col-lg-12 mx-auto">
            <div class="p-5 rounded shadow "
                 style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                <h2 class="mb-5">Table Song</h2>

                <div class="p-1 bg-light rounded rounded-3 shadow-sm mb-4">
                    <div class="input-group">
                        <input type="search" placeholder="Search..." aria-describedby="button-addon1" class="form-control border-0 bg-light">
                        <div class="input-group-append">
                            <button id="button-addon1" type="submit" class="btn btn-link text-primary"><strong><i class="bi bi-search"></i></strong></button>
                        </div>
                    </div>
                </div>
                <form  class="col-lg-8"name="get_Song" action="<?php echo $_SERVER['PHP_SELF'] ?>?page=listsong" method="POST" enctype="multipart/form-data">
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
                                </th class="">
                                <th scope="col">SongId</th>
                                <th scope="col">SongName</th>
                                <th scope="col">Length</th>
                                <th scope="col">Picture</th>
                                <th scope="col">UrlSong</th>
                                <th scope="col">Status</th>
                                <th scope="col">Level</th>
                                <th scope="col">Flag</th>
                                <th scope="col">Description</th>
                                <th>Add</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $pageNo = 1;
                            $pageS = 4;

                            if (!empty($_POST['reset'])) {
                                $pageNo = $_POST['PageNo'];
                                $pageS = $_POST['PageSize'];
                            }
                            $getdb = new Song();
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
                                    <td> <?php echo $obj->songId ?></td>
                                    <td> <?php echo $obj->songName ?></td>
                                    <td> <?php echo $obj->length ?></td>
                                    <td>  <?php echo $obj->picture ?></td>
                                    <td> <?php echo $obj->urlSong ?></td>
                                    <td> <?php echo $obj->status ?></td>
                                    <td> <?php echo $obj->level ?></td>
                                    <td> <?php echo $obj->flag ?></td>
                                    <td> <?php echo $obj->description ?></td>
                                    <td>
                                        <div style='display:flex;'>
                                            <a href="Admin.php?page=addsong&id=<?php echo $obj->songId; ?>" class='btn btn-info mr-1' id='updatef'><i class='i bi-arrow-repeat'></i></a>
                                            <a href="../backend/delete/delsong.php?id=<?php echo $obj->songId; ?>" class='btn btn-danger mr-1' id='deletef'><i class='bi bi-trash'></i></a>
                                        </div>
                                    </td>
                                </tr>                                            
                                <tr class="spacer"><td colspan="100"></td> </tr>
<?php } ?>


                        </tbody>
                    </table>
<?php
if (!empty($_POST['reset'])) {
    echo "Page : " . $pageNo . " " . "Size: " . $pageS;
}
;
?>
                </div>

            </div>
        </div>
    </div>
</div>
