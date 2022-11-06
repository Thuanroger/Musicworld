<?php
include '../backend/dal/News.php';
?>
<div class="container-fluid">


    <div class="row py-5">
        <div class="col-lg-10 mx-auto text-white text-center">
            <h1 class="display-4 fw-bold">News</h1>

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
        $get = new News();
        $obj = $get->getNews($_GET['id']);
        ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addsong&id=<?php echo $obj->newsId; ?>" method="POST" enctype="multipart/form-data">
                        <label class="fs-5 fw-bold text-secondary">Reference</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="Reference" value="<?php echo $obj->reference; ?>" class="form-control border-0">
                        </div>
                        <label class="fs-5 fw-bold text-secondary">Content</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="Content" value="<?php echo $obj->content; ?>" class="form-control border-0">
                        </div>
                        <label class="fs-5 fw-bold text-secondary">Status</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="Status" value="<?php echo $obj->status; ?>" class="form-control border-0">
                        </div>
                        <label class="fs-5 fw-bold text-secondary">Picture</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="file" placeholder="" name="Picture" aria-describedby="button-addon2" value="<?php echo $obj->picture; ?>" class="form-control border-0">
                        </div>
                        <!-- <label  class="fs-5 fw-bold text-secondary">Status</label>
                        <div class="bg-light rounded-3 mb-4">
                            <textarea type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0"></textarea>
                        </div> -->
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
            $son = new News();
            $son->newsId = $_GET['id'];
            $son->reference = $_POST['Reference'];
            $son->content = $_POST['Content'];
            $son->picture = "$newFileName";
            $son->status = $_POST['Status'];
            $son->description = $_POST['Description'];
            $son->updateNews();
            echo '<script>alert("Update success.")</script>';
        }
        ?>
    <?php } else {
    ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addsong" method="POST" enctype="multipart/form-data">

                        <label class="fs-5 fw-bold text-secondary">Reference</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0">
                        </div>

                        <label class="fs-5 fw-bold text-secondary">Content</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0">
                        </div>

                        <label class="fs-5 fw-bold text-secondary">Status</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <label class="fs-5 fw-bold text-secondary">Picture</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="file" placeholder="" name="Picture" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <!-- <label  class="fs-5 fw-bold text-secondary">Status</label>
                        <div class="bg-light rounded-3 mb-4">
                            <textarea type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0"></textarea>
                        </div> -->
                        <label class="fs-5 fw-bold text-secondary">Description</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <textarea type="text" placeholder="" aria-describedby="button-addon2" class="form-control border-0" name="Description"></textarea>
                        </div>


                        <div class="text-center ">
                            <input type="submit" class="btn btn-success mb-1 w-25 fs-5 fw-bold" id="InsertId" name="Insertf" value="Save" />
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
    $son = new News();
    $son->reference = $_POST['Reference'];
    $son->content = $_POST['Content'];
    $son->picture = "$newFileName";
    $son->status = $_POST['Status'];
    $son->description = $_POST['Description'];
    $son->addNews();
    echo '<script>alert("Save success.")</script>';
}
?>