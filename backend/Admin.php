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

        <title>Collapsible sidebar using Bootstrap 4</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
              integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="../backend/css/admin.css">
        <!-- <link rel="stylesheet" href="styledash.css"> -->
        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
                integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
        crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
                integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
        crossorigin="anonymous"></script>

        <style>

            .media-support-user-img img {     height: 40px;
                                              width: 40px;
                                              line-height: 40px; }
            .order-card {
                color: rgb(16, 14, 14);
            }

            .bg-c-blue {
                background: linear-gradient(45deg,#4099ff,#73b4ff);
            }

            .bg-c-green {
                background: linear-gradient(45deg,#2ed8b6,#59e0c5);
            }

            .bg-c-yellow {
                background: linear-gradient(45deg,#FFB64D,#ffcb80);
            }

            .bg-c-pink {
                background: linear-gradient(45deg,#FF5370,#ff869a);
            }


            .card {
                border-radius: 5px;
                -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
                box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
                border: none;
                margin-bottom: 30px;
                -webkit-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
            }

            .card .card-block {
                padding: 25px;
            }

            .order-card i {
                font-size: 26px;
            }

            .f-left {
                float: left;
            }

            .f-right {
                float: right;
            }
        </style>
    </head>

    <body>

        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Admin System</h3>
                    <div class="components" style="display:flex;">
                        <h4 id="AvaAdmin" name="AvaAdmin"> <i class="bi bi-person-square mr-1"></i></h4>
                        <p name="Adminame" id="Adminame" class="text-white">
                            <?php
                            if (isset($_SESSION['userlogin'])) {
                                echo $_SESSION['userlogin'];
                            } else {
                                echo 'Hello Admin!';
                            }
                            session_destroy()
                            ?></p>
                    </div>

                </div>
                <p class="text-white font-weight-bold text-uppercase px-3 pb-4 mb-0">MusicWorld</p>
                <div class="list-unstyled components" id="homeSub" role="pilllist">
                    <p class="text-white font-weight-bold text-uppercase px-3 pb-4 mb-0">Main</p>

                    <ul class="nav flex-column" id="homeSub">



                        <li role="presentation"> <a href="Admin.php" aria-controls="home" data-toggle="">Dashboard</a> </li>
                        <!-- <li role="presentation"> <a href="#home" aria-controls="home" data-toggle="pill">Dashboard</a> </li> -->
                        <li class="">

                            <a href="#homeSubmenuSong" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">Song</a>
                            <ul class="collapse list-unstyled" id="homeSubmenuSong">
                                <div class="sidebar-submenu">
                                    <ul class="nav flex-column" role="" id="homeSubmenuSong"> 
                                        <!-- role="pilllist" -->
                                        <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home"  data-toggle="pill">Home</a></li> -->
                                        <li role="presentation"><a href="Admin.php?page=addsong" aria-controls="addsong" id="addsongid"
                                                                   data-toggle="">Add song</a></li>
                                        <li role="presentation"><a href="Admin.php?page=listsong" aria-controls="listsong" id='listsongid'
                                                                   data-toggle="">List Song</a></li>
                                        <li role="presentation"><a href="#delsong" aria-controls="delsong"
                                                                   data-toggle="">Infomation</a></li>
                                    </ul>
                                </div>
                                <!-- <li role="presentation" class="active"><a href="#home" aria-controls="home"  data-toggle="pill">Home</a></li> -->

                            </ul>
                        </li>
                        <li class="">
                            <a href="#songSubmenu" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">Song</a>
                            <ul class="collapse list-unstyled " id="songSubmenu">
                                <li>
                                    <a href="#">Home 1</a>
                                </li>
                                <li>
                                    <a href="#">Home 2</a>
                                </li>
                                <li>
                                    <a href="#">Home 3</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">About</a>
                            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                               class="dropdown-toggle">Pages</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu">
                                <li>
                                    <a href="#">Page 1</a>
                                </li>
                                <li>
                                    <a href="#">Page 2</a>
                                </li>
                                <li>
                                    <a href="#">Page 3</a>
                                </li>
                            </ul>
                        </li>
                        <li role="presentation"> <a href="#Portfolio" aria-controls="Portfolio" data-toggle="pill">Portfolio</a>
                        </li>
                        <li role="presentation"> <a href="#Contact" aria-controls="Contact" data-toggle="pill">Contact</a>
                        </li>
                    </ul>



                </div>


                <ul class="list-unstyled components">
                    <p class="text-gray font-weight-bold text-uppercase px-3  pb-4 mb-0">Chart</p>
                    <li class="nav-item">
                        <a href="#" class="">
                            <!-- nav-link text-dark font-italic -->
                            <i class="bi bi-graph-down"> </i>
                            <!-- mr-3 text-primary fa-fw -->
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
                    <li>
                        <a href="../backend/loginstandand.php" class="article"><i class="bi bi-box-arrow-left mr-2"></i>Sign out</a>
                    </li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-expand-lg rounded rounded-3" style="background-color:rgba(255, 255, 255, 0.58);">
                    <div class="container-fluid">


                        <button type="button" id="sidebarCollapse" class="navbar-btn rounded rounded-3 mr-1"
                                style="background-color: rgba(255, 255, 255, 0.58);">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>

                        <div class="input-group ml-auto rounded rounded-3 border border-light mr-1"
                             style="width:75%;background-color: rgba(255, 255, 255, 0.58);">
                            <input type="search" placeholder="Search..." aria-describedby="button-addon1"
                                   class="form-control bg-transparent text-dark">
                            <div class="input-group-append">
                                <button id="button-addon1" type="submit" class="btn btn-link text-primary"><strong><i
                                            class="bi bi-search"></i></strong></button>
                            </div>
                        </div>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-align-justify"></i>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Page</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Page</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Page</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Page</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Show all tab -->
                <div class="tab-content">

                    <?php
                    function display($name) {
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




                    //nếu không tồn tại biến $_GET["page"] = "register"
                    ?>

                    <!--                <div class="tab-pane fade show active" id="home">
                    <?php // include('dashboad.php');  ?>
                    
                                     Song table 
                                     Add,delete,update a song 
                                    <div class="tab-pane fade" id="addsong">
                    <?php // include('addsong.php');  ?>
                                    </div>
                                     List Song 
                                    <div class="tab-pane fade" id="listsong">
                    <?php //  include('listsong.php');  ?>
                                        
                                        
                                    </div>
                                     <div class="tab-pane fade" id="settings">This is Settings content</div> 
                                    <div class="tab-pane fade" id="Portfolio">, consectetur adipisicing elit, sed</div>
                                    <div class="tab-pane fade" id="Contact">sectetur adipisicing elit, sed d</div>-->
                </div>

            </div>

            <!-- jQuery CDN - Slim version (=without AJAX) -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
            <!-- Popper.JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
                    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
            crossorigin="anonymous"></script>
            <!-- Bootstrap JS -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
                    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
            crossorigin="anonymous"></script>

            <script type="text/javascript">
                $(document).ready(function () {
                    $('#sidebarCollapse').on('click', function () {
                        $('#sidebar').toggleClass('active');
                        $(this).toggleClass('active');
                    });
                });
            </script>
    </body>

</html>