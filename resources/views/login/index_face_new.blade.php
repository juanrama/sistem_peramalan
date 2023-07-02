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
				<form action="/login-face-check">
					<div class="d-flex justify-content-center">
						<img src="http://admin:LabIoT123@203.6.149.118:89/ISAPI/Streaming/channels/102/httpPreview" width="75%" />
					  </div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn mt-4">
							Login
						</button>
					</div>
				</form>
			</div>
	</div>

	

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

    <script type="text/javascript">
        // seleksi elemen video
        var video = document.querySelector("#video-webcam");
    
        // minta izin user
        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;
    
        // jika user memberikan izin
        if (navigator.getUserMedia) {
            // jalankan fungsi handleVideo, dan videoError jika izin ditolak
            navigator.getUserMedia({ video: true });
        }
    
        // fungsi ini akan dieksekusi jika  izin telah diberikan
        function handleVideo(stream) {
            video.srcObject = stream;
        }
    
        // fungsi ini akan dieksekusi kalau user menolak izin
        function videoError(e) {
            // do something
            alert("Izinkan menggunakan webcam untuk demo!")
        }
    </script>

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