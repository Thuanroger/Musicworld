<?php
include '../backend/dal/Songandartist.php';
?>
<div class="container">


    <div class="row py-5">
        <div class="col-lg-10 mx-auto text-white text-center">
            <h1 class="display-4 fw-bold">Song and Artist</h1>

        </div>
    </div>

    <?php
    if (!empty($_GET['id'])) {
    ?>
        <?php



        $get = new Songandartist();
        $obj = $get->getSongandartist($_GET['id']);
        ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addsongandartist&id=<?php echo $obj->$_GET['id']; ?>" method="POST" enctype="multipart/form-data">
                        <label class="fs-5 fw-bold text-secondary">SongId</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="number" placeholder="" name="SongId" value="<?php echo $obj->songId; ?>" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <label class="fs-5 fw-bold text-secondary">ArtistId</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="number" placeholder="" name="ArtistId" value="<?php echo $obj->artistId; ?>" aria-describedby="button-addon2" class="form-control border-0">
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
            $son = new Songandartist();
            $son->saId = $_GET['id'];
            $son->artistId = $_POST['ArtistId'];
            $son->songId = $_POST['SongId'];
            $son->description = $_POST['Description'];
            $son->updateSongandartist();
            echo '<script>alert("Update success.")</script>';
        }
        ?>
    <?php } else {
    ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addsongandartist" method="POST" enctype="multipart/form-data">

                        <label class="fs-5 fw-bold text-secondary">SongId</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="number" placeholder="" name="SongId" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <label class="fs-5 fw-bold text-secondary">ArtistId</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="number" placeholder="" name="ArtistId" aria-describedby="button-addon2" class="form-control border-0">
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
    $son = new Songandartist();
    $son->artistId = $_POST['ArtistId'];
    $son->songId = $_POST['SongId'];
    $son->description = $_POST['Description'];
    $son->addSongandartist();
    echo '<script>alert("Save success.")</script>';
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
                                <th scope="col">SongId</th>
                                <th scope="col">ArtistId</th>
                                <th scope="col">Flag</th>
                                <th scope="col">Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                         
                            $getdb = new Songandartist();
                            $arr = $getdb->getAllRecords($page,7, $totalRecords);

                         
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
                                    <td> <?php echo $obj->saId ?></td>
                                    <td> <?php echo $obj->songId ?></td>
                                    <td> <?php echo $obj->artistId ?></td>
                                    <td> <?php echo $obj->flag ?></td>
                                    <td> <?php echo $obj->description ?></td>
                                    <td>
                                        <div class="text-center" style='display:flex;'>
                                            <a href="Admin.php?page=addsongandartist&id=<?php echo $obj->saId; ?>" class='btn btn-info mr-1' id='updatef'><i class='i bi-arrow-repeat'></i></a>
                                            <a href="../backend/delete/delsongandartist.php?del=<?php echo $obj->saId; ?>" class='btn btn-danger' id='deletef'><i class='bi bi-trash'></i></a>
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

            </div>
        </div>
    </div>
</div>