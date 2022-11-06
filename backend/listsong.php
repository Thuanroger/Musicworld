<?php
include '../backend/dal/Song.php';
if (!empty($_GET['del'])) {
    $del = $_GET['del'];
    echo "<script>alert('Delete Songid" . $_GET['del'] . "succes!');</script>";
}
?>

<div class="container-fluid">
    <div class="row py-5">
        <div class="col-lg-12 mx-auto">
            <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                <h2 class="mb-5">Table Song</h2>

                <!-- <div class="p-1 bg-light rounded rounded-3 shadow-sm mb-4">
                    <div class="input-group">
                        <input type="search" placeholder="Search..." aria-describedby="button-addon1" class="form-control border-0 bg-light">
                        <div class="input-group-append">
                            <button id="button-addon1" type="submit" class="btn btn-link text-primary"><strong><i class="bi bi-search"></i></strong></button>
                        </div>
                    </div>
                </div> -->
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
                                <th scope="col" style="width:230px;">UrlSong</th>
                                <th scope="col">Status</th>
                                <th scope="col">Level</th>
                                <th scope="col">Flag</th>
                                <th scope="col">Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                            <?php
                            $page = 0;
                            $getdb = new Song();
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
                                    <td> <?php echo $obj->songId ?></td>
                                    <td> <?php echo $obj->songName ?></td>
                                    <td> <?php echo $obj->length ?></td>
                                    <td> <img src="../backend/image/<?php echo $obj->picture ?>" width="60px" /> </td>
                                    <td> <audio style="width:230px;" controls>
                                            <source src="../backend/music/<?php echo $obj->urlSong ?>">
                                        </audio> </td>
                                    <td> <?php echo $obj->status ?></td>
                                    <td> <?php echo $obj->level ?></td>
                                    <td> <?php echo $obj->flag ?></td>
                                    <td> <?php echo $obj->description ?></td>
                                    <td>
                                        <div class="text-center" style='display:flex;'>
                                            <a href="Admin.php?page=addsong&id=<?php echo $obj->songId; ?>" class='btn btn-info mr-1' id='updatef'><i class='i bi-arrow-repeat'></i></a>
                                            <a href="../backend/delete/delsong.php?id=<?php echo $obj->songId; ?>&name=<?php echo  $obj->songName; ?>" class='btn btn-danger' id='deletef'><i class='bi bi-trash'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <!-- <tr class="spacer">
                                    <td colspan="100"></td>
                                </tr> -->
                            <?php } ?>
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
                                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] ?>?page=listsong&<?php echo "pageno=$pag"; ?>"><?php echo $pag; ?></a></li>
                            <?php } ?>
                            <li class="page-item">
                                <a class="page-link" href="Admin.php?page=listsong&<?php if ($page > 1) {
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