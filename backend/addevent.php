<?php
include '../backend/dal/Events.php';
?>
<div class="container-fluid">


    <div class="row py-5">
        <div class="col-lg-10 mx-auto text-white text-center">
            <h1 class="display-4 fw-bold">Events</h1>

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
        $get = new Song();
        $obj = $get->getSong($_GET['id']);
        ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addevent&id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">

                        <label class="fs-5 fw-bold text-secondary">EventName</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="text" placeholder="" name="SongName" aria-describedby="button-addon2" name="EventName" value="<?php echo $obj->eventName; ?>" class="form-control border-0">
                        </div>

                        <label class="fs-5 fw-bold text-secondary">MusicTypeId</label>
                        <div class="bg-light rounded rounded-3 mb-4">
                            <input type="number" placeholder="" aria-describedby="button-addon2" name="MusicTypeId" value="<?php echo $obj->musicId; ?>" name="Length" class="form-control border-0">
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


        //  echo $message;
        if (!empty($_POST['updatef'])) {
            $son = new Events();
            $son->eventId = $_GET['id'];
            $son->eventName = $_POST['EventName'];
            $son->musicId = $_POST['MusicTypeId'];
            $son->description = $_POST['Description'];
            $son->updateEvents();
            echo '<script>alert("Update success.")</script>';
        }
        ?>
    <?php } else {
    ?>
        <div class="row mb-5">
            <div class="col-lg-8 mx-auto">
                <div class="p-5 rounded shadow" style="border-radius: 1rem;background-color: rgba(255, 255, 255, 0.58);">
                    <form action="Admin.php?page=addevent" method="POST" enctype="multipart/form-data">

                        <label class="fs-5 fw-bold text-secondary">EventName</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="text" placeholder="" aria-describedby="button-addon2" name="EventName" class="form-control border-0">
                        </div>

                        <label class="fs-5 fw-bold text-secondary">MusicTypeId</label>
                        <div class="bg-light rounded-3 mb-4">
                            <input type="number" placeholder="" aria-describedby="button-addon2" name="MusicTypeId" class="form-control border-0">
                        </div>
                    
                        <label class="fs-5 fw-bold text-secondary">Description</label>
                        <div class="bg-light rounded-3 mb-4">
                            <textarea type="text" placeholder="" aria-describedby="button-addon2" name="Description" class="form-control border-0"></textarea>
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
//  echo $message;
if (!empty($_POST['Insertf'])) {
    $son = new Events();
    $son->eventName = $_POST['EventName'];
    $son->musicId = $_POST['MusicTypeId'];
 
    $son->description = $_POST['Description'];
    $son->addEvents();
    echo '<script>alert("Save success.")</script>';
}
?>