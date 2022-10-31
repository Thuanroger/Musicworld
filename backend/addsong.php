<div class="container-fluid">


    <div class="row py-5">
        <div class="col-lg-10 mx-auto text-white text-center">
            <h1 class="display-4 fw-bold">Song</h1>

        </div>
    </div>
    <div class="row mb-5">
        <div class="col-lg-8 mx-auto">
            <div class="p-5 rounded shadow"  style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                <form action="Admin.php?page=addsong" method="POST" enctype="multipart/form-data">

                    <label  class="fs-5 fw-bold text-secondary">SongName</label>
                    <div class="bg-light rounded rounded-3 mb-4">
                        <input type="text" placeholder="" name="SongName" aria-describedby="button-addon2" class="form-control border-0">
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
                    <!-- p-1 -->
                    <!-- <label  class="fs-5 fw-bold text-secondary">Level</label>
                    <div class="bg-light rounded-3 mb-4">
                        <input type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0">
                    </div> -->
                    <label  class="fs-5 fw-bold text-secondary">Level</label>
                    <div class="bg-light rounded rounded-3 mb-4">

                        <select name="Level" id="" required aria-describedby="button-addon2" class="form-control form-control-lg border-0">
                            <option selected value="0">Select</option>
                            <option selected value="1">Hot</option>
                            <option value="2">Normal</option>
<!--                                <scrip>alert("Upload file mp3 thanh cong.")<scrip></scrip>-->
                        </select>
                    </div>
                    <!-- <label  class="fs-5 fw-bold text-secondary">Status</label>
                    <div class="bg-light rounded-3 mb-4">
                        <textarea type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0"></textarea>
                    </div> -->
                    <label  class="fs-5 fw-bold text-secondary">Description</label>
                    <div class="bg-light rounded rounded-3 mb-4">
                        <textarea type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0" name="Description"></textarea>
                    </div>


                    <div class="text-center ">
                        <input type="submit" class="btn btn-success mb-1 w-25 fs-5 fw-bold" id="InsertId" name="Insertf" value="Save"/>
                        <!-- <button type="submit" class="btn btn-primary mb-1" id="UpdateId" name="Updatef">Update</button>
                        <button type="submit" class="btn btn-secondary mb-1" id="ShowId" name="Showf">Show</button>
                        <button type="button" class="btn btn-info mb-1" id="ResetId" name="Resetf">Reset</button>
                        <button type="submit" class="btn btn-danger mb-1" id="DeleteId" name="Delete">Delete</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
<?php
include '../backend/dal/Song.php';

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
            $uploadFileDir = 'C:/xampp/htdocs/Eproject_1/File_saved/musicpicture/';
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
            $uploadFileDir = 'C:/xampp/htdocs/Eproject_1/File_saved/musicfile/';
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
    $son->picture = "../File_saved/musicpicture/$newFileName";
    $son->urlSong = "../File_saved/musicfile/$newFileNamemp3";
    $son->level = $_POST['Level'];
    $son->description = $_POST['Description'];
    $son->addSong();
    echo '<script>alert("Save success.")</script>';
}
?>