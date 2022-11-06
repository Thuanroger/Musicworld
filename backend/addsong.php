<?php
include '../backend/dal/Song.php';
?>
<div class="container">


    <div class="row py-5">
        <div class="col-lg-7 mx-auto text-white text-center">
            <h1 class="display-4 fw-bold">Song</h1>

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
                <div class="p-5 rounded shadow"  style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addsong&id=<?php echo $obj->songId; ?>" method="POST" enctype="multipart/form-data">

                        <label  class="fs-5 fw-bold text-secondary">SongName</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="text" placeholder="" name="SongName" aria-describedby="button-addon2" value="<?php echo $obj->songName; ?>" class="form-control border-0">
                        </div>

                        <label  class="fs-5 fw-bold text-secondary">Length</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" value="<?php echo $obj->length; ?>" name="Length" class="form-control border-0">
                        </div>

                        <label  class="fs-5 fw-bold text-secondary">Picture</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="file" placeholder="" name="Picture" aria-describedby="button-addon2" value="<?php echo $obj->picture; ?>" class="form-control border-0">
                        </div>
                        <label  class="fs-5 round fw-bold text-secondary">UrlSong</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="file" placeholder="" name="UrlSong" aria-describedby="button-addon2" value="<?php echo $obj->urlSong; ?>" class="form-control border-0">
                        </div>
                        <!-- p-1 -->
                        <!-- <label  class="fs-5 fw-bold text-secondary">Level</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0">
                        </div> -->
                        <label  class="fs-5 fw-bold text-secondary">Level</label>
                        <div class="bg-light rounded rounded-3 mb-4">

                            <select name="Level" id="" required aria-describedby="button-addon2" value="<?php echo $obj->level ?>" class="form-control form-control-lg border-0">
                                <option selected value="0">Select</option>
                                <option selected value="1">Hot</option>
                                <option value="2">Normal</option>
    <!--                                <scrip>alert("Upload file mp3 thanh cong.")<scrip></scrip>-->
                            </select>
                        </div>
                        <label  class="fs-5 round fw-bold text-secondary">Flag</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="number" placeholder="" name="Flag" aria-describedby="button-addon2" value="<?php echo $obj->flag; ?>" class="form-control border-0">
                        </div>
                        <!-- <label  class="fs-5 fw-bold text-secondary">Status</label>
                        <div class="bg-light rounded-3 mb-4">
                            <textarea type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0"></textarea>
                        </div> -->
                        <label  class="fs-5 fw-bold text-secondary">Description</label>
                        <div class="bg-light rounded rounded-3 mb-4">
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


        if (isset($_POST['updatef']) && $_POST['updatef'] == 'Update') {
            if (isset($_FILES['UrlSong']) && $_FILES['UrlSong']['error'] === UPLOAD_ERR_OK) {

                // Thong tin chi tiet cua file
                $fileTmpPath = $_FILES['UrlSong']['tmp_name'];

                echo $fileTmpPath;
                $fileName = $_FILES['UrlSong']['name'];
                $fileSize = $_FILES['UrlSong']['size'];
                $fileType = $_FILES['UrlSong']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                // thiet dat file name
                $newFileNamemp3 = md5(time() . $fileName) . '.' . $fileExtension;


                // kiem tra phan mo rong cua file
                $allowedfileExtensions = array('mp3');

                if (in_array($fileExtension, $allowedfileExtensions)) {
                    // thu muc file uploaded
                    $uploadFileDir = './music/';
                    $dest_path = $uploadFileDir . $newFileNamemp3;

                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
//        $message2 = '<script>alert("Upload file mp3 thanh cong.")</script>';
                    } else {
                        $message2 = 'Kiem tra xem thu muc co quyen ghi.';
                    }
                } else {
                    $message2 = 'Chi cho phep cac loai file: ' . implode(',', $allowedfileExtensions);
                }


                $path = $uploadFileDir . '/' . $newFileNamemp3;
            } else {
                $message2 = 'Co loi trong luc upload<br>';
                $message2 .= 'Error:' . $_FILES['UrlSong']['error'];
            }
        }


//  echo $message;
        if (!empty($_POST['updatef'])) {
            $son = new Song();
            $son->songId = $_GET['id'];
            $son->songName = $_POST['SongName'];
            $son->length = $_POST['Length'];
            $son->picture = "$newFileName";
            $son->urlSong = "$newFileNamemp3";
            $son->level = $_POST['Level'];
            $son->flag = $_POST['Flag'];
            $son->description = $_POST['Description'];
            $son->updateSong();
            echo '<script>alert("Update success.")</script>';
            header("Location: /Eproject/backend/Admin.php?page=listsong");
        }
        ?>
    <?php } else {
        ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow"  style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addsong" method="POST" enctype="multipart/form-data">
                        <label  class="fs-5 fw-bold text-secondary">SongName</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="text" placeholder="" name="SongName" value="" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Length</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="Length" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Picture</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="file" placeholder="" name="Picture" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <label  class="fs-5 round fw-bold text-secondary">UrlSong</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="file" placeholder="" name="UrlSong" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Level</label>
                        <div class="bg-light rounded rounded-3 mb-4">

                            <select name="Level" id="" required aria-describedby="button-addon2" class="form-control form-control-lg border-0">
                                <option selected value="0">Select</option>
                                <option selected value="1">Hot</option>
                                <option value="2">Normal</option>
    <!--                                <scrip>alert("Upload file mp3 thanh cong.")<scrip></scrip>-->
                            </select>
                        </div>
                        <label  class="fs-5 round fw-bold text-secondary">Flag</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="number" placeholder="" name="Flag" aria-describedby="button-addon2" class="form-control border-0">
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
if (isset($_POST['Insertf']) && $_POST['Insertf'] == 'Save') {
    if (isset($_FILES['UrlSong']) && $_FILES['UrlSong']['error'] === UPLOAD_ERR_OK) {
        // Thong tin chi tiet cua file
        $fileTmpPath = $_FILES['UrlSong']['tmp_name'];
        echo $fileTmpPath;
        $fileName = $_FILES['UrlSong']['name'];
        $fileSize = $_FILES['UrlSong']['size'];
        $fileType = $_FILES['UrlSong']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        // thiet dat file name
        $newFileNamemp3 = md5(time() . $fileName) . '.' . $fileExtension;
        // kiem tra phan mo rong cua file
        $allowedfileExtensions = array('mp3');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // thu muc file uploaded
            $uploadFileDir = './music/';
            $dest_path = $uploadFileDir . $newFileNamemp3;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
//        $message2 = '<script>alert("Upload file mp3 thanh cong.")</script>';
            } else {
                $message2 = 'Kiem tra xem thu muc co quyen ghi.';
            }
        } else {
            $message2 = 'Chi cho phep cac loai file: ' . implode(',', $allowedfileExtensions);
        }
        $path = $uploadFileDir . '/' . $newFileNamemp3;
    } else {
        $message2 = 'Co loi trong luc upload<br>';
        $message2 .= 'Error:' . $_FILES['UrlSong']['error'];
    }
}
//  echo $message;
if (!empty($_POST['Insertf'])) {
    $son = new Song();
    $son->songName = $_POST['SongName'];
    $son->length = $_POST['Length'];
    $son->picture = "$newFileName";
    $son->urlSong = "$newFileNamemp3";
    $son->level = $_POST['Level'];
    $son->flag = $_POST['Flag'];
    $son->description = $_POST['Description'];
    $son->addSong();
    echo '<script>alert("Save success.")</script>';
    header("Location: /Eproject/backend/Admin.php?page=listsong");
}
?>