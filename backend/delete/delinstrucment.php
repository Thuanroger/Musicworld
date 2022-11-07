<?php

include '../dal/Instruments.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
  <?php
  if (isset($_REQUEST['del']) and $_REQUEST['del'] != "" &&  isset($_REQUEST['name']) and $_REQUEST['name'] != "") {
    $id = $_GET['del'];
    $name = $_GET['name'];
    $delete = new Instruments();
    $delete->songId = $id;
    $delete->flag = 1;
    $delete->updateInstruments1();

    if ($delete->updateInstruments1()) {
      echo "<div id='resetalert' class='alert alert-success bg-soft-primary border-0 w-25 ms-1 mt-1' role='alert'>You delete  " . $del . " success.</div>
      <div class='ms-1'> <a href='/backend/Admin.php?page=addinstrucment'class='btn btn-info mb-1 ml-2 mt-1' id=''>Back</a></div>";
      // header("Location: /Eproject/backend/Admin.php?page=listsong");
    }
  }
  ?>
</body>

</html>