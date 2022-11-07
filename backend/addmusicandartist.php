<?php
include '../backend/dal/Musicandartist.php';
?>
<div class="container">


    <div class="row py-5">
        <div class="col-lg-8 mx-auto text-white text-center">
            <h1 class="display-4 fw-bold">Music and Artist</h1>

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
        $get = new Musicandartist();
        $obj = $get->getMusicandartist($_GET['id']);
        ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow"  style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addaddmusicandartist&id=<?php echo $obj->msA; ?>" method="POST" enctype="multipart/form-data">

                            
                        <label  class="fs-5 fw-bold text-secondary">MusicTypeId</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="number" placeholder="" name="MusicTypeId" value="<?php echo $obj->musicTypeId; ?>" aria-describedby="button-addon2" class="form-control border-0">
                        </div>

                        <label  class="fs-5 fw-bold text-secondary">ArtistId</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="number" name="ArtistId" value="<?php echo $obj->artistId; ?>" placeholder="" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                  
                        <label  class="fs-5 fw-bold text-secondary">Description</label>
                        <div class="bg-light rounded-3 mb-4">
                            <textarea type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0"></textarea>
                        </div>

                            <input type="text" placeholder="" aria-describedby="button-addon2" value="<?php echo $obj->description; ?>" class="form-control border-0" name="Description"/>
                        </div>


                        <div class="text-center ">
                            <input type="submit" class="btn btn-success mb-1 w-25 fs-5 fw-bold" id="InsertId" name="updatef" value="Update"/>
                          
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
      
        if (!empty($_POST['updatef'])) {
            $son = new Musicandartist();
            $son->msA = $_GET['id'];
            $son->musicTypeId = $_POST['MusicTypeId'];
            $son->artistId = $_POST['ArtistId'];
            $son->description = $_POST['Description'];
            $son->updateMusicandartist();
            echo '<script>alert("Update success.")</script>';
        }
        ?>
    <?php } else {
        ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow"  style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addinstrucment" method="POST" enctype="multipart/form-data">

                    <label  class="fs-5 fw-bold text-secondary">MusicTypeId</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="number" placeholder="" name="MusicTypeId"  aria-describedby="button-addon2" class="form-control border-0">
                        </div>

                        <label  class="fs-5 fw-bold text-secondary">ArtistId</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="number" name="ArtistId" placeholder="" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                  
                        <label  class="fs-5 fw-bold text-secondary">Description</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <textarea type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0" name="Description"></textarea>
                        </div>


                        <div class="text-center ">
                            <input type="submit" class="btn btn-success mb-1 w-25 fs-5 fw-bold" id="InsertId" name="Insertf" value="Save"/>
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
    $son = new Musicandartist();
    $son->musicTypeId = $_POST['MusicTypeId'];
    $son->artistId = $_POST['ArtistId'];
    $son->description = $_POST['Description'];
    $son->addMusicandartist();
    echo '<script>alert("Save success.")</script>';
}
?>

<?php
if (!empty($_GET['del'])) {
    $del = $_GET['del'];
    echo "<script>alert('Delete Songid" . $_GET['del'] . "succes!');</script>";
}
?>
<div class="container-fluid">
    <div class="row py-5">
        <div class="col-lg-12 mx-auto">
            <div class="p-5 rounded shadow " style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                <h2 class="mb-5"></h2>
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
                                    <th scope="col">MusicTypeId</th>
                                    <th scope="col">ArtistId</th>
                                    <th scope="col">Flag</th>
                                    <th scope="col">Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                             $page = 0;
                             $getdb = new Musicandartist();
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
                                <tr scope='row' >
                                    <th scope="row">
                                        <label class="control control--checkbox">
                                            <input type="checkbox" />
                                            <div class="control__indicator"></div>
                                        </label>
                                    </th>
                               

                                    <td> <?php echo $obj->msA?></td>
                                    <td> <?php echo $obj->musicTypeId?></td>
                                    <td> <?php echo $obj->artistId?></td>
                                    <td> <?php echo $obj->flag?></td>
                                    <td> <?php echo $obj->description ?></td>
                                    <td  >
                                        <div class="text-center" style='display:flex;'>
                                            <a href="Admin.php?page=addmusicandartist&id=<?php echo $obj->msA; ?>" class='btn btn-info mr-1' id='updatef'><i class='i bi-arrow-repeat'></i></a>
                                            <a href="../backend/delete/delmusicandadtist.php?del=<?php echo $obj->msA; ?>" class='btn btn-danger' id='deletef'><i class='bi bi-trash'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <!-- <tr class="spacer">
                                    <td colspan="100"></td>
                                </tr> -->
                            <?php } ?>


                        </tbody>
                    </table>
                </div>
                <div class="">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] ?>?page=addmusicandartist&<?php if ($page > 1) {
                                                                                                                echo 'pageno=' . ($page - 1);
                                                                                                            } ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <?php
                            for ($pag = 1; $pag <= $total_pages; $pag++) { ?>
                                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] ?>?page=addmusicandartist&<?php echo "pageno=$pag"; ?>"><?php echo $pag; ?></a></li>
                            <?php } ?>
                            <li class="page-item">
                                <a class="page-link" href="Admin.php?page=addmusicandartist&<?php if ($page > 1) {
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
