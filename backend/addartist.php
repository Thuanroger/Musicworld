<?php
include '../backend/dal/Artist.php';
?>
<div class="container-fluid">


    <div class="row py-5">
        <div class="col-lg-10 mx-auto text-white text-center">
            <h1 class="display-4 fw-bold">Artist</h1>

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
                    <form action="Admin.php?page=addartist&id=<?php echo $obj->artistId; ?>" method="POST" enctype="multipart/form-data">

                    <label  class="fs-5 fw-bold text-secondary">FirstName</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" value="<?php echo $obj->firstName; ?>" name="Firstname" class="form-control border-0">
                        </div>

                        <label  class="fs-5 fw-bold text-secondary">MiddleName</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" value="<?php echo $obj->middleName; ?>" name="Middlename" class="form-control border-0">
                        </div>

                        <label  class="fs-5 fw-bold text-secondary">LastName</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" value="<?php echo $obj->lastName; ?>" name="Lastname" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Picture</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="file" placeholder="" aria-describedby="button-addon2" value="<?php echo $obj->artistId; ?>" name="Picture" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Address</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" value="<?php echo $obj->address; ?>" name="Address"class="form-control border-0"/>
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Birthday</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="date" placeholder="" aria-describedby="button-addon2" value="<?php echo $obj->birthday; ?>" name="Birthday"class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Status</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" value="<?php echo $obj->status; ?>"  name="Status" value="" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Flag</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" value="<?php echo $obj->flag; ?>"  name="Flag" value="" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Type</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="Type" value="<?php echo $obj->type; ?>" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Level</label>
                        <div class="bg-light rounded rounded-3 mb-4">
<select name="Level" id="" required aria-describedby="button-addon2" value="<?php echo $obj->level; ?>" class="form-control form-control-lg border-0">
    <option selected value="0">Select</option>
    <option selected value="1">Hot</option>
    <option value="2">Normal</option>
<!--                                <scrip>alert("Upload file mp3 thanh cong.")<scrip></scrip>-->
</select>
</div>
                        <label  class="fs-5 fw-bold text-secondary">Description</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2"  name="Description" value="<?php echo $obj->description; ?>" class="form-control border-0"/>
                        </div>


                        <div class="text-center ">
                            <input type="submit" class="btn btn-success mb-1" id="InsertId" name="updatef" value="Update"/>
                          
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


     

        if (!empty($_POST['updatef'])) {
            $son = new Artist();
            $son->songId = $_GET['id'];
            $son->firstName = $_POST['Firstname'];
            $son->middleName = $_POST['Middlename'];
            $son->lastName = $_POST['Lastname'];
            $son->birthday = $_POST['Birthday'];
            $son->address = $_POST['Address'];
            $son->status = $_POST['Status'];
            $son->type = $_POST['Type'];
            $son->picture = "$newFileName";
            $son->level = $_POST['Level'];
            $son->flag = $_POST['Flag'];
            $son->description = $_POST['Description'];
            $son->updateArtist();
            echo '<script>alert("Update success.")</script>';
        }
        ?>
    <?php } else {
        ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow"  style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addartist" method="POST" enctype="multipart/form-data">
                    <label  class="fs-5 fw-bold text-secondary">FirstName</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2"  name="Firstname"class="form-control border-0">
                        </div>

                        <label  class="fs-5 fw-bold text-secondary">MiddleName</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="Middlename" class="form-control border-0">
                        </div>

                        <label  class="fs-5 fw-bold text-secondary">LastName</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="Lastname"  class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Picture</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="file" placeholder="" aria-describedby="button-addon2"  name="Picture" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Address</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <textarea type="text" placeholder="" aria-describedby="button-addon2" name="Address" class="form-control border-0"></textarea>
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Birthday</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="date" placeholder="" aria-describedby="button-addon2" name="Birthday" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Status</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="Status" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Type</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="Type"class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Flag</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="Flag" class="form-control border-0">
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
                        <label  class="fs-5 fw-bold text-secondary">Description</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <textarea type="text" placeholder="" aria-describedby="button-addon2" name="Description"class="form-control border-0"></textarea>
                        </div>


                        <div class="text-center ">
                            <input type="submit"  value="Save" class="btn btn-success mb-1" id="InsertId" name="Insertf"/>
                            
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
    $son = new Artist();
    $son->firstName = $_POST['Firstname'];
    $son->middleName = $_POST['Middlename'];
    $son->lastName = $_POST['Lastname'];
    $son->birthday = $_POST['Birthday'];
    $son->address = $_POST['Address'];
    $son->status = $_POST['Status'];
    $son->type = $_POST['Type'];
    $son->picture = "$newFileName";
    $son->level = $_POST['Level'];
    $son->flag = $_POST['Flag'];
    $son->description = $_POST['Description'];
    $son->addArtist();
    echo '<script>alert("Save success.")</script>';
}
?>