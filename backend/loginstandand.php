<!DOCTYPE html>
<?php
session_start();

function redirect($url, $statusCode = 303) {

    header('Location: ' . $url, true, $statusCode);
    die();
}

//        include '../backend/common/main.php';
include '../backend/dal/Usersystem.php';

if (!empty($_POST['signin'])) {
    $u = $_POST['username'];
    $p = $_POST['password'];
    $check = new Usersystem();
    $obj = $check->getUserSystemwithpassword($u, $p);
    if (!empty($obj)) {
        $_SESSION['userlogin'] = $_POST['username'];

        redirect('./Admin.php', $statusCode = 303);
    } else {
//        echo "<script>alert('User available!');</script>";
    }
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign In</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../backend/css/form.css">

    </head>
    <body>
        <div class="background-radial-gradient overflow-hidden">
            <div class="overlay overflow-hidden container">
                <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
                    <!-- <div class="row gx-lg-5 align-items-center mb-5"> -->
                        <!-- <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                            <h1 class="my-5 display-5 fw-bold ls-tight" style="color:  hsl(218, 81%, 95%)">
                                The best offer <br />
                                <span style="color:  hsl(40, 16%, 96%)">for your music</span>
                            </h1>
                            <p class="mb-4 opacity-70" style="color: hsl(214, 33%, 96%)">
                                “Music… will help dissolve your perplexities and purify your character and sensibilities,
                                and in time of care and sorrow, will keep a fountain of joy alive in you.”
                                <br><strong><i>Dietrich Bonhoeffer </i></strong>
                            </p>
                        </div> -->

                        <!-- <div class=" col-lg-6 mb-5 mb-lg-0 position-relative">-->
                            <div class="card bg-glass col-lg-6 mx-auto" style="border-radius: 1rem;">
                                <div class="card-body px-4 py-5 px-md-5">

                                    <form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='POST' >
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                            <span class="h1 fw-bold mb-0">Logo</span>
                                        </div>


                                        <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; "><i class="bi bi-box-arrow-in-right"></i>
                                            Sign into Admin System</h3>
                                        <?php
                                        if (!empty($_POST['signin'])) {
                                            if (empty($obj)) {
                                                echo "<div id='resetalert' class='alert alert-danger bg-soft-danger border-0' role='alert'>

                    Wrong Username or Password.
                  </div>";
                                            }
                                        }
                                        ?>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for=""><strong>Username</strong></label>
                                            <input type="text" class="form-control form-control-md" id='fusername'  name='username' placeholder="Username or Email"/>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" ><strong>Password</strong></label>
                                            <div class="input-group">
                                                <input type="password" id="fpassword" name='password' class="form-control form-control-md"
                                                       placeholder="Password" />
                                                <span class="input-group-text" id="basic-addon2"> <i class="far fa-eye" id="togglePassword" style= "cursor:togglePassword pointer;"></i></span>
                                            </div>
                                        </div>
                                        <div class="pt-1 mb-4">
                                            <input class="btn btn-dark btn-lg btn-block" type="submit" name='signin' value="Sign in">
                                        </div>
                                        <a class="small text-muted" href="resetpassword.php" target='_self' style="text-decoration: none;">Forgot password?</a>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="./singup.php" target='_self'
                                                                                                                  style="color: #393f81; text-decoration: none;">Sign up here</a></p>
                                        <a href="#" class="small text-muted">Terms of use.</a>
                                        <a href="#" class="small text-muted">Privacy policy</a>
                                    </form>
                                </div>
                            </div>
                       <!--  </div>
                    </div> -->
                </div>
            </div>
        </div>

        <script>

            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#fpassword');
            togglePassword.addEventListener('click', function (e) {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                this.classList.toggle('fa-eye-slash');
            });

        </script>
    </body>
</html>
