<?php
include '../backend/dal/Usersystem.php';
?>
<div class="container">


    <div class="row py-5">
        <div class="col-lg-8 mx-auto text-white text-center">
            <h1 class="display-4 fw-bold">Admin</h1>

        </div>
    </div>

    <?php
    if (!empty($_GET['id'])) {
    ?>
        <?php

        $get = new Usersystem();
        $obj = $get->getUsersystem($_GET['id']);
        ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addadmi&id=<?php echo $obj->$_GET['id']; ?>" method="POST" enctype="multipart/form-data">


                              
                    <label  class="fs-5 fw-bold text-secondary">UserSystemName</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" name="UserSystemName" value="<?php echo $obj->userSystemName; ?>" aria-describedby="button-addon2" class="form-control border-0">
                        </div>

                        <label  class="fs-5 fw-bold text-secondary">Password</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="password" placeholder="" name="Password" value="" aria-describedby="button-addon2" class="form-control border-0">
                        </div>

                        <label  class="fs-5 fw-bold text-secondary">Gmail</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="email" placeholder="" name="Gmail" value="<?php echo $obj->gmail; ?>" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <!-- p-1 -->
                        <label  class="fs-5 fw-bold text-secondary">Phone</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="number" placeholder="" name="Phone" value="<?php echo $obj->phone; ?>" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Role</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" name="Role" value="<?php echo $obj->role; ?>" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Status</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" name="Status" value="<?php echo $obj->status; ?>" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Picture</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" name="Picture" value="<?php echo $obj->picture; ?>" aria-describedby="button-addon2" class="form-control border-0">
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
            $son = new Usersystem();
            $son->userSystemId = $_GET['id'];
            $son->userSystemName = $_POST['UserSystemName'];
            $son->gmail = $_POST['Gmail'];
            $son->phone = $_POST['Phone'];
            $son->password = $_POST['Password'];
            $son->picture = $newFileName;
            $son->role = $_POST['Role'];
            $son->status = $_POST['Status'];
            $son->description = $_POST['Description'];
            $son->updateUsersystem();
            echo '<script>alert("Update success.")</script>';
        }
        ?>
    <?php } else {
    ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addadmi" method="POST" enctype="multipart/form-data">

                    <label  class="fs-5 fw-bold text-secondary">UserSystemName</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" name="UserSystemName"  aria-describedby="button-addon2" class="form-control border-0">
                        </div>

                        <label  class="fs-5 fw-bold text-secondary">Password</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="password" placeholder="" name="Password"  aria-describedby="button-addon2" class="form-control border-0">
                        </div>

                        <label  class="fs-5 fw-bold text-secondary">Gmail</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="email" placeholder="" name="Gmail"  aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <!-- p-1 -->
                        <label  class="fs-5 fw-bold text-secondary">Phone</label>
                        <div class="p-1 bg-light rounded-3 mb-4">
                            <input type="number" placeholder="" name="Phone" value="" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Role</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" name="Role" value="" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Status</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" name="Status" value="" aria-describedby="button-addon2" class="form-control border-0">
                        </div>
                        <label  class="fs-5 fw-bold text-secondary">Picture</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" name="Picture" value=" " aria-describedby="button-addon2" class="form-control border-0">
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
</div>
<?php
$message="";
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
if (!empty($_POST['Insertf'])) {
    $son = new Usersystem();
    $son->userSystemId = $_GET['id'];
            $son->userSystemName = $_POST['UserSystemName'];
            $son->gmail = $_POST['Gmail'];
            $son->password = $_POST['Password'];
            $son->phone = $_POST['Phone'];
            $son->picture = $newFileName;
            $son->role = $_POST['Role'];
            $son->status = $_POST['Status'];
            $son->description = $_POST['Description'];
    $son->addUsersystem();
    echo '<script>alert("Save success.")</script>';
}
?>

<?php

?>

<div class="container">
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
                                    <th scope="col">UserSystemName</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Gmail</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Picture</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Flag</th>
                                    <th scope="col">Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                             $page = 0;
                             $getdb = new Usersystem();
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

                                    <td> <?php echo $obj->userSystemId ?></td>
                                    <td> <?php echo $obj->userSystemName ?></td>
                                    <td> <?php echo md5($obj->password) ?></td>
                                    <td> <?php echo $obj->gmail ?></td>
                                    <td> <?php echo $obj->phone ?></td>
                                    <td> <?php echo $obj->role ?></td>
                                    <td> <img src="../backend/image/<?php echo $obj->picture ?>" width="60px" /></td>
                                    <td> <?php echo $obj->status ?></td>
                                    <td> <?php echo $obj->flag ?></td>
                                    <td> <?php echo $obj->description ?></td>
                                    <td>
                                        <div class="text-center" style='display:flex;'>
                                            <a href="Admin.php?page=addadmi&id=<?php echo $obj->$publisherid; ?>" class='btn btn-info mr-1' id='updatef'><i class='i bi-arrow-repeat'></i></a>
                                            <a href="../backend/delete/deladmin.php?del=<?php echo $obj->$publisherid; ?>&name=<?php echo  $obj->$publisherName; ?>" class='btn btn-danger' id='deletef'><i class='bi bi-trash'></i></a>
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
                <div class="mt-1">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] ?>?page=addadmi&<?php if ($page > 1) {
                                                                                                                echo 'pageno=' . ($page - 1);
                                                                                                            } ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <?php
                            for ($pag = 1; $pag <= $total_pages; $pag++) { ?>
                                <li class="page-item"><a class="page-link" href="<?php echo $_SERVER['PHP_SELF'] ?>?page=addadmi&<?php echo "pageno=$pag"; ?>"><?php echo $pag; ?></a></li>
                            <?php } ?>
                            <li class="page-item">
                                <a class="page-link" href="Admin.php?page=addadmi&<?php if ($page > 1) {
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
