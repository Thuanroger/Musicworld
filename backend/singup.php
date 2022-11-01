<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../backend/css/form.css">
</head>

<body>
    <!--formden.js communicates with FormDen server to validate fields and submit via AJAX -->
    <script type="text/javascript" src="https://formden.com/static/cdn/formden.js"></script>
    <!-- Special version of Bootstrap that is isolated to content wrapped in .bootstrap-iso -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
    <!--Font Awesome (added because you use icons in your prepend/append)-->
    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
    <!-- Inline CSS based on choices in "Settings" tab -->
    <style>
        .bootstrap-iso .formden_header h2,
        .bootstrap-iso .formden_header p,
        .bootstrap-iso form {
            font-family: Arial, Helvetica, sans-serif;
            color: black
        }

        .bootstrap-iso form button,
        .bootstrap-iso form button:hover {
            color: white !important;
        }

        .asteriskField {
            color: red;
        }
        #error{
            border-color: red;
        }
    </style>
    <!-- HTML Form (wrapped in a .bootstrap-iso div) -->

    <div class="background-radial-gradient overflow-hidden">
        <div class="overlay overflow-hidden">
            <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
                <div class="row gx-lg-5 align-items-center mb-5">
                    <div class="col-lg-5 mb-5 mb-lg-0" style="z-index: 10">
                        <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(221, 38%, 87%)">
                           Turn on <br />
                            <span style="color: hsl(40, 16%, 96%)">the feeling with music</span>
                        </h1>
                        <p class="mb-4 opacity-70" style="color: hsl(214, 33%, 96%)">
                            “Music… will help dissolve your perplexities and purify your character and sensibilities,
                            and in time of care and sorrow, will keep a fountain of joy alive in you.”
                            <br><strong><i>Dietrich Bonhoeffer </i></strong>
                        </p>
                    </div>

                    <div class=" col-lg-7 mb-5 mb-lg-0 position-relative">

                        <div class="card bg-glass" style="border-radius: 1rem;">
<!--                            background-color: rgba(255, 255, 255, 0.58);-->
                            <div class="card-body px-4 py-5 px-md-5">
                                <form id="myForm" class="needs-validation" novalidate>
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0">Logo</span>
                                    </div>
                                    <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;"><i
                                            class="bi bi-box-arrow-in-right"></i> Sign up for free to start listening
                                    </h3>
                                    <div class="row ">
                                        <div class="form-outline form-group col-sm-12 mb-4">
                                            <label class="form-label" for=""><strong>What should we call
                                                    you?</strong></label>
                                            <input type="text" id="UserId"class="form-control form-control-md" placeholder="Enter a profile name" pattern="^(?=[a-zA-Z0-9._]{8,20}$)(?!.*[_.]{2})[^_.].*[^_.]$" required/>
                                               
                                                <div class="invalid-feedback">Only contains alphanumeric characters, underscore and dot. <br>Number of characters must be between 8 to 20.</div>
                                        </div>
                                        <!-- <div class="form-outline form-group col-sm-7 mb-4">
                                            <label class="form-label" for=""><strong>What's your
                                                    avatar?</strong></label>
                                            <input type="file" id="fileId" class="form-control form-control-md"
                                                placeholder="Enter your profile picture"  data-filesize="5242880" data-filesize-error="Max 5MB"   required/>
                                                <div class="valid-feedback"> Upload file success!</div>
                                                <div class="invalid-feedback">Invalid file type! </div>
                                        </div> -->
                                    </div>
                                    
                                        <label class="form-label" for="form2Example27"><strong>What's your
                                                name?</strong></label>
                                        <div class="form-group form-outline   mb-4">
                                            <label class="form-label" for="">FirstName</label>
                                            <input type="text" id="FirstNameId"
                                                class="form-control form-control-md" placeholder="FirstName" required  pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$" />
                                            <div id="CheckName" class="invalid-feedback" style="color:red ;"> It should only contain letters, can be several words with spaces, and has a minimum of three characters, but a maximum at top 30 characters.</div>
                                        </div>
                                        <div class="form-outline form-group  mb-4">
                                            <label class="form-label" for="form2Example27">MiddleName</label>
                                            <input type="text" id="MiddleNameId"
                                                class="form-control form-control-md" placeholder="Middlename"  pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$"/>
                                                <div id="CheckName" class="invalid-feedback" style="color:red ;"> It should only contain letters, can be several words with spaces, and has a minimum of three characters, but a maximum at top 30 characters.</div>
                                        </div>
                                        <div class="form-outline  form-group  mb-4">
                                            <label class="form-label" for="form2Example27">LastName</label>
                                            <input type="text" id="LastNameId"
                                                class="form-control form-control-md" placeholder="Lastname"  required  pattern="^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$"/>
                                                <div id="CheckName" class="invalid-feedback" style="color:red ;"> It should only contain letters, can be several words with spaces, and has a minimum of three characters, but a maximum at top 30 characters.</div>
                                        </div>
                                        
                                        
                                    
                                    <div class="form-outline  form-group mb-4">
                                        <label class="form-label" for=""><strong>What's your email?</strong></label>
                                        <input type="email" id="EmailId" class="form-control form-control-md"
                                            placeholder="Enter your email" required  pattern='^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$'/>
                                            <div class="invalid-feedback">Email invalidate!</div>
                                    </div>
                                    <div class="form-outline form-group mb-4">
                                        <label class="form-label" ><strong>Password</strong></label>
                                        <div class="input-group">
                                            <input type="password" id="id_password" class="form-control form-control-md"
                                            placeholder="Create a password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"/>
                                            <span class="input-group-text" id="basic-addon2"> <i class="far fa-eye" id="togglePassword" style= "cursor: pointer;"></i></span>
                                            <div class="invalid-feedback">Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character.</div>
                                        </div>
                                        
                                    </div>
                                    <div class="form-outline form-group mb-4">
                                        <label class="form-label" ><strong>Confirm Password</strong></label>
                                                <div class="input-group">
                                                    <input type="password" id="confirm_password" class="form-control form-control-md" placeholder="Confirm password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" />
                                                <span class="input-group-text" id="basic-addon2"><i class="far fa-eye"  id="togglePassword2" style=" cursor: pointer;"></i></span> 
                                                <div  id="cPwdInvalid" class="invalid-feedback"></div>
                                                
                                                </div>
                                       
                                    </div>
                                    <div class="row ">

                                        <div class="form-outline col-sm-6 mb-4">
                                            <!-- <div class="bootstrap-iso"> -->

                                            <!-- <form action="https://formden.com/post/MlKtmY4x/" class="" method="post"> -->

                                            <label class="form-label" for="form2Example27"><strong>What's your date of
                                                    birth?</strong></label>

                                            <div class=" input-group " style="border-bottom-right-radius:10px ;">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <i class="fa fa-calendar">
                                                    </i>
                                                </span>
                                                <input class="form-control form-control-md" id="date" name="date"
                                                    placeholder="MM/DD/YYYY" type="text" required  pattern="^(1[0-2]|0?[1-9])/(3[01]|[12][0-9]|0?[1-9])/(?:[0-9]{2})?[0-9]{2}$"  style="border-bottom-right-radius:0.25rem ; border-top-right-radius:0.25rem ;"/>
                                                    <div  id="DateInvalid" class="invalid-feedback"></div>
                                                    <div  class="invalid-feedback">Invalid date</div>
                                            </div>

                                        </div>
                                        <div class="form-outline col-sm-6 mb-4">
                                            <label class="form-label" for="form2Example27"><strong>What's your
                                                    gender?</strong></label>

                                            <select class="form-select" name="" id="selectgender" required
                                                class="form-control form-control-md">
                                                <option selected value="Male">Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Non_binary ">February</option>
                                                <option value="Other">Other</option>
                                                <option value="Prefer not to say">Prefer not to say</option>
                                            </select>
                                             <div  class="invalid-feedback">Please select a valid state.</div>
                                        </div>
                                        
                                    <div class=" form-check mb-4">
                                        <input class="form-check-input me-2 "  id="validationFormCheck1"type="checkbox" value=""
                                            id="form2Example3cg" required/>
                                        <div class="invalid-feedback">Example invalid feedback text</div>
                                        <label class="form-check-label" for="validationFormCheck1">
                                            I agree all statements in <u class="text-body"></u>Terms of
                                                    service</u>
                                        </label>
                                        <small  class="invalid-feedback">
                                            You must agree before submitting.
                                        </small>
                                    </div>
                                    <div class="pt-1 mb-4 form-group">
                                            <input id="submitBtn" class="btn btn-dark btn-lg btn-block" type="submit" disabled placeholder="Sign up" />
                                    </div>

                                        <a class="small text-muted" href="resetpassword.php" style="text-decoration: none;">Forgot
                                        password?</a>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">have an account? <a href="loginstandand.php"
                                            style="color: #393f81;text-decoration: none;">Sign in here</a></p>
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
    </div>
    
    <!-- Section: Design Block -->
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
        $(document).ready(function () {
            var date_input = $('input[name="date"]'); //our date input has the name "date"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            })
        })
    </script>
    <script>
         const togglePassword = document.querySelector('#togglePassword');
    const togglePassword2=document.querySelector("#togglePassword2")
    const password = document.querySelector('#id_password');
    const confirmpassword=document.querySelector("#confirm_password");
    
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
    togglePassword2.addEventListener('click',function(e){
        //toggle the type attribute
        const type=confirmpassword.getAttribute('type')==='password'?'text':'password';
        confirmpassword.setAttribute('type',type);
        //toggle the type slash icon
        this.classList.toggle('fa-eye-slash');
    })
    </script>
    <script>

        //GGet the current year
        var d = new Date();
        var YearNow=d.getFullYear();
    
     $(document).ready(function(){
        // Check if passwords match
        
        $('#UserId,#fileId,#FirstNameId,#LastNameId,#MiddleNameId,#id_password,#confirm_password').on('keyup', function () {
          
          if ($('#UserId').val() != '' && $('#FirstNameId').val() != '' && $('#LastNameId').val() != '' && $('#MiddleNameId').val() != '' && $('#EmailId').val() != '' ) {
            $("#submitBtn").attr("disabled",false);
            
            // $('#cPwdValid').show();
            // $('#cPwdInvalid').hide();
             //$('#cPwdValid').html.css('color', 'green');
          } else {
            $("#submitBtn").attr("disabled",true);
            // $('#cPwdValid').hide();
            // $('#cPwdInvalid').show();
            // $('#cPwdInvalid').html('The confirmation password do not match.').css('color', 'red');
            }
           
            if($('#id_password').val() != '' && $('#confirm_password').val() !='' && $('#confirm_password').val() == $('#id_password').val()){
                $("#submitBtn").attr("disabled",false);
            $('#cPwdValid').show();
            $('#cPwdInvalid').hide();
             //$('#cPwdValid').html.css('color', 'green');
          } else {
            $("#submitBtn").attr("disabled",true);
            $('#cPwdValid').hide();
            $('#cPwdInvalid').show();
            $('#cPwdInvalid').html('The confirmation password do not match.').css('color', 'red');
            }
            //
           
          });
          $('#date').on('keyup',function(){
            console.log(YearNow)
            var Split = $('#date').val().split("/");
            console.log( $('#date').val())
            if( $('#date').val() !=''){
                $("#submitBtn").attr("disabled",false);
            }else{
                $("#submitBtn").attr("disabled",true);
            }
            if (parseInt(Split[2]) <= 1900  || parseInt(Split[2]) >= YearNow ) 
                {   
                    $("#submitBtn").attr("disabled",true);
                    $('#DateInvalid').show();
                    $('#DateInvalid').html('Invalid year, must be less than current year.').css('color', 'red');
                    
                    return false;
                }else{
                    $("#submitBtn").attr("disabled",false);
                    $('#DateInvalid').hide();
                }
          });
        let currForm1 = document.getElementById('myForm');
          // Validate on submit:
          currForm1.addEventListener('submit', function(event) {
            if (currForm1.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
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
              $("#submitBtn").attr("disabled", !is_valid);
            });
          });
        });
      </script>
<!--     <input class="form-control form-control-md" name="date"
     placeholder="MM/DD/YYYY" type="datetime" required pattern="^(?:0[1-9]|[12]\d|3[01])([\/.-])(?:0[1-9]|1[0-2])\1(?:19|20)\d\d$" />-->
</body>

</html>