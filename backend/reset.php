<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../backend/css/form.css">

</head>

<body>
  <div class="background-radial-gradient overflow-hidden">
    <style>

    </style>
    <div class="overlay overflow-hidden">
      <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <div class="row gx-lg-5 align-items-center mb-5">
          <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
            <h1 class="my-5 display-5 fw-bold ls-tight" style="color:  hsl(218, 81%, 95%)">
              The best offer <br />
              <span style="color:  hsl(40, 16%, 96%)">for your music</span>
            </h1>
            <p class="mb-4 opacity-70" style="color: hsl(214, 33%, 96%)">
              “Music… will help dissolve your perplexities and purify your character and sensibilities,
              and in time of care and sorrow, will keep a fountain of joy alive in you.”
              <br><strong><i>Dietrich Bonhoeffer </i></strong>
            </p>
          </div>

          <div class=" col-lg-6 mb-5 mb-lg-0 position-relative">
            <div class="card bg-glass" style="border-radius: 1rem;">
              <div class="card-body px-4 py-5 px-md-5">
                <form action='<?php echo $_SERVER['PHP_SELF'] ?>' method='POST' class="needs-validation" id="myForm" novalidate>

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                    <span class="h1 fw-bold mb-0">Logo</span>
                  </div>

                  <h3 class="fw-normal mb-3 pb-3 " style="letter-spacing: 1px;">
                    Forgot Password?</h3>
                  <div id="resetalert" class="alert alert-success bg-soft-primary border-0" role="alert">

                    You can reset your password.
                  </div>
                  <!-- <i class="bi bi-box-arrow-in-right"></i> -->
                  <div class="form-outline form-group mb-4">
                    <label class="form-label"><strong>Password</strong></label>
                    <div class="input-group">
                      <input type="password" id="id_password" class="form-control form-control-md"
                        placeholder="Create a password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" />
                      <span class="input-group-text" id="basic-addon2"> <i class="far fa-eye" id="togglePassword"
                          style="cursor: pointer;"></i></span>
                          <div class="invalid-feedback">Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character.</div>
                                        </div>

                    </div>

                 
                  <div class="form-outline form-group mb-4">
                    <label class="form-label"><strong>Confirm
                        Password</strong></label>
                    <div class="input-group">
                      <input type="password" id="confirm_password" class="form-control form-control-md"
                        placeholder="Confirm password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" />
                      <span class="input-group-text" id="basic-addon2"><i class="far fa-eye" id="togglePassword2"
                          style=" cursor: pointer;"></i></span>
                         <div  id="cPwdInvalid" class="invalid-feedback"></div>
                    </div>

                  </div>

                  <div class="pt-1 mb-4">
                      <input class="btn btn-dark btn-lg btn-block" type="submit" name="resetpass" id="freset" value="Reset" disabled/>
                  </div>

                  <a class="small text-muted" href="#!" style="text-decoration: none;">Sign in</a>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!"
                      style="color: #393f81; text-decoration: none;">Sign up here</a></p>
                  <a href="#!" class="small text-muted">Terms of use.</a>
                  <a href="#!" class="small text-muted">Privacy policy</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
     <!-- Extra JavaScript/CSS added manually in "Settings" tab -->
    <!-- Include jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const togglePassword2 = document.querySelector("#togglePassword2")
    const password = document.querySelector('#id_password');
    const confirmpassword = document.querySelector("#confirm_password");

    togglePassword.addEventListener('click', function (e) {
      // toggle the type attribute
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      // toggle the eye slash icon
      this.classList.toggle('fa-eye-slash');
    });
    togglePassword2.addEventListener('click', function (e) {
      //toggle the type attribute
      const type = confirmpassword.getAttribute('type') === 'password' ? 'text' : 'password';
      confirmpassword.setAttribute('type', type);
      //toggle the type slash icon
      this.classList.toggle('fa-eye-slash');
    })
  </script>
   <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script>
        $(document).ready(function () {
               $('#id_password,#confirm_password').on('keyup', function () {
             if($('#id_password').val() != '' && $('#confirm_password').val() !='' && $('#confirm_password').val() == $('#id_password').val()){
                $("#freset").attr("disabled",false);
            $('#cPwdValid').show();
            $('#cPwdInvalid').hide();
             //$('#cPwdValid').html.css('color', 'green');
          } else {
            $("#freset").attr("disabled",true);
            $('#cPwdValid').hide();
            $('#cPwdInvalid').show();
            $('#cPwdInvalid').html('The confirmation password do not match.').css('color', 'red');
            }
        });
             let currForm1 = document.getElementById('myForm');
          // Validate on submit:
          currForm1.addEventListener('submit', function(event) {
            if (currForm1.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
               $('#resetalert').html('Reset password fail!');
                $('#resetalert').classList.remove('alert-success');
                 $('#resetalert').classList.add('alert-danger');
                
             
            }
            currForm1.classList.add('was-validated');
          }, false);
          // Validate on input:
          currForm1.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener(('input'), () => {
              if (input.checkValidity()) {
                input.classList.remove('is-invalid')
                input.classList.add('is-valid');
              } else {
                input.classList.remove('is-valid')
                input.classList.add('is-invalid');
              }
              var is_valid = $('.form-control').length === $('.form-control.is-valid').length;
              $("#freset").attr("disabled", !is_valid);
            });
          });
        });
      
        
  </script>

</body>

</html>