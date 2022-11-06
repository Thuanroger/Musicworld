
<?php
include '../backend/dal/Album.php';
?>
<div class="container-fluid">
    <div class="row py-5">
        <div class="col-lg-12 mx-auto">
            <div class="p-5 rounded shadow "
                 style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                <h2 class="mb-5">Table Album</h2>

                <!-- <div class="p-1 bg-light rounded rounded-3 shadow-sm mb-4">
                    <div class="input-group">
                        <input type="search" placeholder="Search..." aria-describedby="button-addon1" class="form-control border-0 bg-light">
                        <div class="input-group-append">
                            <button id="button-addon1" type="submit" class="btn btn-link text-primary"><strong><i class="bi bi-search"></i></strong></button>
                        </div>
                    </div>
                </div> -->
                <!-- <form  class="col-lg-8" name="get_Album" action="<?php echo $_SERVER['PHP_SELF'] ?>?page=listalbum" method="POST" enctype="multipart/form-data">
                    <div class="form-row mb-4 align-items-center"> -->
                        <!--      <label class="fs-5 fw-bold text-secondary mr-0" for="inlineFormInput">Page No</label>-->
                        <!-- <div class="col-sm-4">
                            <input type="number" class="form-control form-control-lg mb-2 border-0" name="PageNo" id="PageNoid" placeholder="Page No">
                        </div> -->
                        <!--      <label class="fs-5 fw-bold text-secondary mr-0" for="inlineFormInputGroup">Page Size</label> -->
                        <!-- <div class="col-sm-4"> 
                            <input type="number" class="form-control form-control-lg  mb-2 border-0" name="PageSize" id="Pagesizeid" placeholder="Page Size">
                        </div>

                        <div class="col-sm-3 text-center">
                            <input type="submit" class="btn btn-info mb-2 form-control-lg fs-5 fw-bold" id="ResetId" name="reset" value="Reset" />
                        </div>
                    </div>
                </form> -->
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
                                    <th scope="col">AlbumName</th>
                                    <th scope="col">Picture</th>
                                    <th scope="col">PublisherId</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Flag</th>
                                    <th scope="col">Description</th>
                                <th>Add</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                             $page = 0;
                             $getdb = new Album();
                             $limit = 7;
                             $total_results = $getdb->getcount();
                             $total_pages = ceil($total_results / $limit);
 
                             if (!isset($_GET['pageno'])) {
                                 $page = 1;
                             } else {
                                 $page = $_GET['pageno'];
                             }
                            $getdb = new Album();
                            $arr = $getdb->getAllRecords($page,8, $totalRecords);
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
                                    <td> <?php echo $obj->albumId ?></td>
                                    <td> <?php echo $obj->albumName ?></td>
                                    <td><img src="../backend/image/<?php echo $obj->picture ?>" width="60px"/></td>
                                    <td>  <?php echo $obj->publisherId ?></td>
                                    <td> <?php echo $obj->status ?></td>
                                    <td> <?php echo $obj->level ?></td>
                                    <td> <?php echo $obj->flag ?></td>
                                    <td> <?php echo $obj->description ?></td>
                                    <td>
                                        <div style='display:flex;'>
                                            <a href="Admin.php?page=addalbum&id=<?php echo $obj->albumId; ?>" class='btn btn-info mr-1' id='updatef'><i class='i bi-arrow-repeat'></i></a>
                                            <a href="../backend/delete/delalbum.php?id=<?php echo $obj->albumId; ?>&name=<?php echo $obj->albumName; ?>" class='btn btn-danger mr-1' id='deletef'><i class='bi bi-trash'></i></a>
                                        </div>
                                    </td>
                                </tr>                                            
                                <tr class="spacer"><td colspan="100"></td> </tr>
<?php } ?>


                        </tbody>
                    </table>
                </div>
                <div class="">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] ?>?page=listsong&<?php if ($page > 1) {
                                                                                                                echo 'pageno=' . ($page - 1);
                                                                                                            } ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <?php
                            for ($pag = 1; $pag <= $total_pages; $pag++) { ?>
                                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] ?>?page=listalbum&<?php echo "pageno=$pag"; ?>"><?php echo $pag; ?></a></li>
                            <?php } ?>
                            <li class="page-item">
                                <a class="page-link" href="Admin.php?page=listalbum&<?php if ($page > 1) {
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
