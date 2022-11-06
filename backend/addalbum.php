<?php
include '../backend/dal/Album.php';
?>
<div class="container">


    <div class="row py-5">
        <div class="col-lg-10 mx-auto text-white text-center">
            <h1 class="display-4 fw-bold">Album</h1>

        </div>
    </div>

    <?php
    if (!empty($_GET['id'])) {
    ?>
        <?php
        //                            include '../backend/dal/Song.php';
        $pageNo = 1;
        $pageS = 1;
        if (!empty($_POST['reset'])) {
            $pageNo = $_POST['PageNo'];
            $pageS = $_POST['PageSize'];
        }
        $get = new Song();
        $obj = $get->getSong($_GET['id']);
        ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">

                    <form action="Admin.php?page=addalbum&id=<?php echo $obj->albumId; ?>" method="POST" enctype="multipart/form-data">



                        <label class="fs-5 fw-bold text-secondary">AlbumName</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="Albumname" value="<?php echo $obj->albumName; ?>" class="form-control border-0">
                        </div>

                        <label class="fs-5 fw-bold text-secondary">Picture</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="file" placeholder="" name="Picture" aria-describedby="button-addon2" name="Picture" value="<?php echo $obj->picture; ?>" class="form-control border-0">
                        </div>

                        <label class="fs-5 fw-bold text-secondary">PublisherId</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="number" placeholder="" aria-describedby="button-addon2" name="PublisherId" value="<?php echo $obj->publisherId; ?>" class="form-control border-0">
                        </div>
                        <!-- p-1 -->
                        <label class="fs-5 fw-bold text-secondary">Status</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="Status" value="<?php echo $obj->status; ?>" class="form-control border-0">
                        </div>
                        <label class="fs-5 fw-bold text-secondary">Level</label>
                        <div class="bg-light rounded rounded-3 mb-4">

                            <select name="Level" id="" required aria-describedby="button-addon2" value="<?php echo $obj->level ?>" class="form-control form-control-lg border-0">
                                <option selected value="0">Select</option>
                                <option selected value="1">Hot</option>
                                <option value="2">Normal</option>
                                <!--                                <scrip>alert("Upload file mp3 thanh cong.")<scrip></scrip>-->
                            </select>
                        </div>
                        <label class="fs-5 fw-bold text-secondary">Flag</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" value="<?php echo $obj->flag; ?>" name="Flag" class="form-control border-0">
                        </div>
                        <label class="fs-5 fw-bold text-secondary">Description</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" value="<?php echo $obj->description; ?>" name="Desciption" class="form-control border-0" />
                        </div>


                        <div class="text-center ">
                            <input type="submit" class="btn btn-success mb-1" id="updateId" name="updatetf" value="Update" />
                            <!-- <button type="submit" class="btn btn-primary mb-1" id="UpdateId" name="Updatef">Update</button>
                            <button type="submit" class="btn btn-secondary mb-1" id="ShowId" name="Showf">Show</button>
                            <button type="button" class="btn btn-info mb-1" id="ResetId" name="Resetf">Reset</button>
                            <button type="submit" class="btn btn-danger mb-1" id="DeleteId" name="Delete">Delete</button> -->
                        </div>

                    </form>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $message = '';
        $message2 = '';
        if (!empty($_POST['updatef']) && $_POST['updatef'] == 'Update') {
            if ((isset($_FILES['Picture'])) && $_FILES['Picture']['error'] === UPLOAD_ERR_OK) {

                // Thong tin chi tiet cua file
                $fileTmpPath = $_FILES['Picture']['tmp_name'];

                echo $fileTmpPath;
                $fileName = $_FILES['Picture']['name'];
                $fileSize = $_FILES['Picture']['size'];
                $fileType = $_FILES['Picture']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                // thiet dat file name
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;


                // kiem tra phan mo rong cua file
                $allowedfileExtensions = array('jpg', 'gif', 'png');

                if (in_array($fileExtension, $allowedfileExtensions)) {
                    // thu muc file uploaded
                    $uploadFileDir = './image/';
                    $dest_path = $uploadFileDir . $newFileName;

                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        //        $message = '<script>alert("Upload file thanh cong.")</script>';
                    } else {
                        $message = 'Kiem tra xem thu muc co quyen ghi.';
                    }
                } else {
                    $message = 'Chi cho phep cac loai file: ' . implode(',', $allowedfileExtensions);
                }


                $path = $uploadFileDir . '/' . $newFileName;
            } else {
                $message = 'Co loi trong luc upload<br>';
                $message .= 'Error:' . $_FILES['Picture']['error'];
            }
        }


        echo $message;



        //  echo $message;
        if (!empty($_POST['updatef'])) {
            $son = new  Album();
            $son->albumId = $_GET['id'];
            $son->albumName = $_POST['Albumname'];
            $son->picture = "$newFileName";
            $son->level = $_POST['Level'];
            $son->flag = $_POST['Flag'];
            $son->description = $_POST['Description'];
            $son->updateAlbum();
            echo '<script>alert("Update success.")</script>';
        }
        ?>
    <?php } else {
    ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">

                    <form action="Admin.php?page=addalbum" method="POST" enctype="multipart/form-data">



                        <label class="fs-5 fw-bold text-secondary">AlbumName</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="Albumname" class="form-control border-0">
                        </div>

                        <label class="fs-5 fw-bold text-secondary">Picture</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2"  name="Picture" class="form-control border-0">
                        </div>

                        <label class="fs-5 fw-bold text-secondary">PublisherId</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="PublisherId" class="form-control border-0">
                        </div>
                        <!-- p-1 -->
                        <label class="fs-5 fw-bold text-secondary">Status</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <label class="fs-5 fw-bold text-secondary">Level</label>
                        <div class="bg-light rounded rounded-3 mb-4">

                            <select name="Level" id="" required aria-describedby="button-addon2" class="form-control form-control-lg border-0">
                                <option selected value="0">Select</option>
                                <option selected value="1">Hot</option>
                                <option value="2">Normal</option>
                                <!--                                <scrip>alert("Upload file mp3 thanh cong.")<scrip></scrip>-->
                            </select>
                        </div>
                        <label class="fs-5 fw-bold text-secondary">Description</label>
                        <div class="bg-light rounded-3 mb-4">
                            <textarea type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0"></textarea>
                        </div>


                        <div class="text-center ">
                            <input type="submit" class="btn btn-success mb-1" id="InsertId" name="Insertf" value="Save" />
                            <!-- <button type="submit" class="btn btn-primary mb-1" id="UpdateId" name="Updatef">Update</button>
                            <button type="submit" class="btn btn-secondary mb-1" id="ShowId" name="Showf">Show</button>
                            <button type="button" class="btn btn-info mb-1" id="ResetId" name="Resetf">Reset</button>
                            <button type="submit" class="btn btn-danger mb-1" id="DeleteId" name="Delete">Delete</button> -->
                        </div>

                    </form>
                </div>
            </div>
        </div>
    <?php };
    ?>


</div>
<?php
$message = '';
$message2 = '';
if (!empty($_POST['Insertf']) && $_POST['Insertf'] == 'Save') {
    if ((isset($_FILES['Picture'])) && $_FILES['Picture']['error'] === UPLOAD_ERR_OK) {

        // Thong tin chi tiet cua file
        $fileTmpPath = $_FILES['Picture']['tmp_name'];

        echo $fileTmpPath;
        $fileName = $_FILES['Picture']['name'];
        $fileSize = $_FILES['Picture']['size'];
        $fileType = $_FILES['Picture']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // thiet dat file name
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;


        // kiem tra phan mo rong cua file
        $allowedfileExtensions = array('jpg', 'gif', 'png');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // thu muc file uploaded
            $uploadFileDir = './image/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                //        $message = '<script>alert("Upload file thanh cong.")</script>';
            } else {
                $message = 'Kiem tra xem thu muc co quyen ghi.';
            }
        } else {
            $message = 'Chi cho phep cac loai file: ' . implode(',', $allowedfileExtensions);
        }


        $path = $uploadFileDir . '/' . $newFileName;
    } else {
        $message = 'Co loi trong luc upload<br>';
        $message .= 'Error:' . $_FILES['Picture']['error'];
    }
}

echo $message;


//  echo $message;
if (!empty($_POST['Insertf'])) {
    $son = new Album();
   
    $son->albumName = $_POST['Albumname'];
    $son->picture = "$newFileName";
    $son->publisherId = $_POST['PublisherId'];
    $son->level = $_POST['Level'];
    $son->flag = $_POST['Flag'];
    $son->description = $_POST['Description'];
    $son->addAlbum();
    echo '<script>alert("Save success.")</script>';
}
?>