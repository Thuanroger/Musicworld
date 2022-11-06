<?php
if (session_id() === '')
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>MusicWorld</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../backend/css/admin.css" />
    <!-- <link rel="stylesheet" href="styledash.css"> -->
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../backend/css/db.css" />
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <h3>Musicworld</h3>
                <div class="components" style="display:flex;">
                    <h4 id="AvaAdmin" name="AvaAdmin"> <i class="bi bi-person-square mr-1"></i></h4>
                    <p name="Adminame" id="Adminame" class="text-white">
                        <?php
                        if (isset($_SESSION['userlogin'])) {
                            echo "Hi " . $_SESSION['userlogin'] . " !";
                        } else {
                            echo 'Hi Admin!';
                        }
                        session_destroy()
                        ?></p>
                </div>

            </div>
            <!-- <p class="text-white font-weight-bold text-uppercase px-3 pb-4 mb-0"></p> -->
            <div class="list-unstyled components" id="homeSub" role="pilllist">
                <!-- <p class="text-white font-weight-bold text-uppercase px-3 pb-4 mb-0">Main</p> -->

                <ul class="nav flex-column" id="homeSub">



                    <li role="presentation"> <a href="Admin.php" aria-controls="home" data-toggle="">Dashboard</a> </li>
                    <!-- <li role="presentation"> <a href="#home" aria-controls="home" data-toggle="pill">Dashboard</a> </li> -->
                    <li class="">

                        <a href="#homeSubmenuSong" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Song</a>
                        <ul class="collapse list-unstyled" id="homeSubmenuSong">
                            <div class="sidebar-submenu">
                                <ul class="nav flex-column" role="" id="homeSubmenuSong">
                                    <!-- role="pilllist" -->
                                    <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home"  data-toggle="pill">Home</a></li> -->
                                    <li role="presentation"><a href="Admin.php?page=addsong" aria-controls="addsong" id="addsongid" data-toggle="">Add song</a></li>
                                    <li role="presentation"><a href="Admin.php?page=listsong" aria-controls="listsong" id='listsongid' data-toggle="">List song</a></li>
                                    <li role="presentation"><a href="#delsong" aria-controls="delsong" data-toggle="">Infomation</a></li>
                                </ul>
                            </div>
                        </ul>
                    </li>
                    <li class="">

                        <a href="#homeSubmenuArtist" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Artist</a>
                        <ul class="collapse list-unstyled" id="homeSubmenuArtist">
                            <div class="sidebar-submenu">
                                <ul class="nav flex-column" role="" id="homeSubmenuArtist">
                                    <!-- role="pilllist" -->
                                    <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home"  data-toggle="pill">Home</a></li> -->
                                    <li role="presentation"><a href="Admin.php?page=addartist" aria-controls="addartist" id="addartistf" data-toggle="">Add Artist</a></li>
                                    <li role="presentation"><a href="Admin.php?page=listartist" aria-controls="listartist" id='listartistf' data-toggle="">List Artist</a></li>
                                    <li role="presentation"><a href="#delsong" aria-controls="delartist" data-toggle="">Infomation</a></li>
                                </ul>
                            </div>
                        </ul>
                    </li>


                    <li class="">

                        <a href="#homeSubmenuAlbum" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Album</a>
                        <ul class="collapse list-unstyled" id="homeSubmenuAlbum">
                            <div class="sidebar-submenu">
                                <ul class="nav flex-column" role="" id="homeSubmenuAlbum">
                                    <!-- role="pilllist" -->
                                    <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home"  data-toggle="pill">Home</a></li> -->
                                    <li role="presentation"><a href="Admin.php?page=addalbum" aria-controls="addalbum" id="addalbumf" data-toggle="">Add album</a></li>
                                    <li role="presentation"><a href="Admin.php?page=listalbum" aria-controls="listalbum" id='listalbumf' data-toggle="">List album</a></li>
                                    <li role="presentation"><a href="#delsong" aria-controls="delalbum" data-toggle="">Infomation</a></li>
                                </ul>
                            </div>
                        </ul>
                    </li>
                    <li class="">

                        <a href="#musictype" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Music type</a>
                        <ul class="collapse list-unstyled" id="musictype">
                            <div class="sidebar-submenu">
                                <ul class="nav flex-column" role="" id="musictype">
                                    <!-- role="pilllist" -->
                                    <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home"  data-toggle="pill">Home</a></li> -->
                                    <li role="presentation"><a href="Admin.php?page=addmusictype" aria-controls="addsong" id="addmusictypeid" data-toggle="">Add</a></li>
                                    <li role="presentation"><a href="Admin.php?page=listmusictype" aria-controls="listsong" id='listmusictypeid' data-toggle="">List</a></li>
                                    <li role="presentation"><a href="#delsong" aria-controls="delsong" data-toggle="">Infomation</a></li>
                                </ul>
                            </div>
                        </ul>
                    </li>

                    <li class="">

                        <a href="#homeSubmenuEvent" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Event</a>
                        <ul class="collapse list-unstyled" id="homeSubmenuEvent">
                            <div class="sidebar-submenu">
                                <ul class="nav flex-column" role="" id="homeSubmenuEvent">
                                    <!-- role="pilllist" -->
                                    <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home"  data-toggle="pill">Home</a></li> -->
                                    <li role="presentation"><a href="Admin.php?page=addevent" aria-controls="addevent" id="addevent" data-toggle="">Add</a></li>
                                    <li role="presentation"><a href="Admin.php?page=listevent" aria-controls="listevent" id='listevent' data-toggle="">List</a></li>
                                    <li role="presentation"><a href="#delsong" aria-controls="delsong" data-toggle="">Infomation</a></li>
                                </ul>
                            </div>
                        </ul>
                    </li>
                    <li class="">

                        <a href="#News" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">News</a>
                        <ul class="collapse list-unstyled" id="News">
                            <div class="sidebar-submenu">
                                <ul class="nav flex-column" role="" id="News">
                                    <!-- role="pilllist" -->
                                    <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home"  data-toggle="pill">Home</a></li> -->
                                    <li role="presentation"><a href="Admin.php?page=addnews" aria-controls="addnew" id="addsongid" data-toggle="">Add</a></li>
                                    <li role="presentation"><a href="Admin.php?page=listnews" aria-controls="listnew" id='listsongid' data-toggle="">List</a></li>
                                    <li role="presentation"><a href="#delsong" aria-controls="delsong" data-toggle="">Infomation</a></li>
                                </ul>
                            </div>
                        </ul>
                    </li>
                    <!-- <li class="">

                        <a href="#instruments" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Instruments</a>
                        <ul class="collapse list-unstyled" id="instruments">
                            <div class="sidebar-submenu">
                                <ul class="nav flex-column" role="" id="instruments">
                                    role="pilllist" -->
                                    <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home"  data-toggle="pill">Home</a></li> -->
                                    <!-- <li role="presentation"><a href="" aria-controls="add" id="addinstruments" data-toggle="">Add</a></li>
                                    <li role="presentation"><a href="Admin.php?page=listinstrucment" aria-controls="list" id='listinstruments' data-toggle="">List</a></li>
                                    <li role="presentation"><a href="#delsong" aria-controls="delsong" data-toggle="">Infomation</a></li>
                                </ul>
                            </div>
                        </ul>
                    </li> -->
                    <li role="presentation"> <a href="Admin.php?page=addinstrucment" aria-controls="Contact" data-toggle="">Instruments</a></li>
                    <li role="presentation"> <a href="Admin.php?page=addmusicandartist" aria-controls="Contact" data-toggle="">Musictype and Artist</a></li>
                    <li role="presentation"> <a href="Admin.php?page=addalbumandsong" aria-controls="Contact" data-toggle="">Album and Song</a></li>
                    <li role="presentation"> <a href="Admin.php?page=addsongandartist" aria-controls="Contact" data-toggle="">Song and Artist</a></li>
                    <!-- <li role="presentation"> <a href="Admin.php?page=addeventandmusic" aria-controls="Contact" data-toggle="">Event and Musictype</a></li> -->
                    <li role="presentation"> <a href="Admin.php?page=addpublishers" aria-controls="Contact" data-toggle="">Publishers</a></li>
                    <li role="presentation"> <a href="Admin.php?page=addyearsong" aria-controls="Contact" data-toggle="">Year Song</a> </li>
                    <li role="presentation"> <a href="Admin.php?page=listcomment" aria-controls="Contact" data-toggle="">Commets</a> </li>
                    <li class="nav-item">
                        <a href="#" class="">
                            <i class="bi bi-graph-down"> </i>
                            Area charts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="">
                            <i class="bi bi-bar-chart-line"> </i>
                            Bar charts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="">
                            <i class="bi bi-pie-chart"> </i>
                            Pie charts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="">
                            <i class="bi bi-graph-up-arrow"> </i>
                            Line charts
                        </a>
                    </li>
                </ul>
                <ul class="list-unstyled CTAs">
                    <li>
                        <a href="#" class="download">MusicWorld.com</a>
                    </li>
                    <?php

                    if (isset($_SESSION['userlogin'])) {
                        echo  '  <li> <a href="../backend/loginstandand.php" class="article"><i class="bi bi-box-arrow-left mr-2"></i>Sign out</a>    </li>';
                    } else {
                        echo ' <li> <a href="../backend/loginstandand.php" class="article"><i class="bi bi-box-arrow-in-right mr-2"></i>Sign in</a>    </li>';
                    }
                    ?>
                </ul>
        </nav>
        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg rounded rounded-3" style="background-color:rgba(255, 255, 255, 0.58);">
                <div class="container-fluid">


                    <button type="button" id="sidebarCollapse" class="navbar-btn rounded rounded-3 mr-1" style="background-color: rgba(255, 255, 255, 0.58);">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <div class="input-group ml-auto rounded rounded-3 border border-light mr-1" style="width:75%;background-color: rgba(255, 255, 255, 0.58);">
                        <input type="search" placeholder="Search..." aria-describedby="button-addon1" class="form-control bg-transparent text-dark">
                        <div class="input-group-append">
                            <button id="button-addon1" type="submit" class="btn btn-link text-primary"><strong><i class="bi bi-search"></i></strong></button>
                        </div>
                    </div>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="Admin.php?page=addadmi">Admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Admin.php?page=adminuser">User</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Show all tab -->
            <div class="tab-content">

                <?php
                function display($name)
                {
                    $display = $name . '.php';
                    include $display;
                }
                //nếu tồn tại biến $_GET["page"] = "register" thì gọi trang đăng ký:
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    display($page);
                } else {
                    include 'dashboad.php';
                }
                ?>
            </div>

        </div>

        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                    $(this).toggleClass('active');
                });
            });
        </script>
</body>

</html>