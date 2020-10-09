<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="<?= BASEURL ?>/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="<?= BASEURL ?>/public/vendor/jquery/bootstrap.min.js"></script>
    <script src="<?= BASEURL ?>/public/vendor/jquery/jquery-1.10.2.min.js"></script>
    <script src="<?= BASEURL ?>/public/vendor/jquery/jquery-ui.js"></script>
  <!-- Custom styles for this template-->
  <link href="<?= BASEURL ?>/public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="post" action="">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name='username' class="username form-control form-control-user" id="exampleFirstName username" placeholder="Name">
                    <div class="messegeUser"></div>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name='phone' class="phone form-control form-control-user" id="exampleLastName" placeholder="Phone">
                    <div class="messegePhone"></div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" name='email' class="email form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                  <div class="messegeEmail"></div>
                </div>
                <div class="form-group">
                  <input type="text" name='des' class="form-control form-control-user" id="exampleInputEmail" placeholder="information">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name='pass' class="form-control form-control-user password" id="exampleInputPassword" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name='pass1' class="form-control form-control-user cpassword" id="exampleRepeatPassword" placeholder="Repeat Password">
                  </div>
                </div>
                <input type="submit" value="Submit" name='register' class='btn btn-primary btn-user btn-block'>
                <hr>
                <a href="" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?= BASEURL ?>/index.php?controller=user&action=forgot">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?= BASEURL ?>/index.php?controller=user&action=login">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= BASEURL ?>/public/vendor/jquery/jquery.min.js"></script>
  <script src="<?= BASEURL ?>/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= BASEURL ?>/public/js/main/checkuser.js"></script>
  <script src="<?= BASEURL ?>/public/js/main/password.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?= BASEURL ?>/public/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= BASEURL ?>/public/vendor/jquery/sb-admin-2.min.js"></script>
  <script>
  $('.password').passwordStrength();
  </script>
</body>

</html>
