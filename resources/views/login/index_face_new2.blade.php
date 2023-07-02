<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sistem Analitik|Halaman Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/logins/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/logins/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/logins/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/logins/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/logins/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/logins/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/logins/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/logins/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/logins/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/logins/css/util.css">
	<link rel="stylesheet" type="text/css" href="/logins/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('/logins/images/uns-gedung.jpg');">
			<div class="d-flex justify-content-center">
                {{ $name_final }}
              </div>
		</div>
	</div>

	<form action="/login-face">
		<div class="container-login100-form-btn">
			<button class="login100-form-btn mt-2">
				Login
			</button>
		</div>
		</form>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="/logins/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/logins/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/logins/vendor/bootstrap/js/popper.js"></script>
	<script src="/logins/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/logins/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/logins/vendor/daterangepicker/moment.min.js"></script>
	<script src="/logins/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/logins/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/logins/js/main.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	@if (session('loginError'))
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Maaf',
          text: 'Username atau password yang dimasukkan salah',
        })
      </script>
      @endif

</body>
</html>