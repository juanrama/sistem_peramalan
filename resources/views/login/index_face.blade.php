<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <title>SMART CCTV</title>
  </head>
  <body>
    <nav
      class="navbar fixed-tip navbar-expand-sm navbar-dark"
      style="background-color: blue"
    >
      <div class="container">
        <a href="#" class="navbar-brand mb-0 h1">
          <img
            class="d-line-block align-top"
            src="templates/image/logo.png"
            width="40"
            height="40"
          />
        </a>
        <button
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          class="navbar-toggler"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toogle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a href="#" class="nav-link active"> Home </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link"> About </a>
            </li>
            <li>
              <!-- <div class="brand">
                <div class="firstname">Internet of Things</div>
                <div class="lastname">Laboratory</div>
              </div> -->
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main style="background-color: black">
      <div class="fcontainer">
        <div class="d-flex flex-column mb-3">
          <div class="d-flex justify-content-center">
            <div style="color: white" id="name-final"></div>
          </div>
          <div>
            <div class="d-flex justify-content-center">
              <img src="http://127.0.0.1:5000/video" width="50%" />
            </div>
        </div>
        </div>
      </div>
    </main>
    <div class="web"></div>
  </body>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript">
    // seleksi elemen video
    var video = document.querySelector("#video-webcam");

    // minta izin user
    navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

    // jika user memberikan izin
    if (navigator.getUserMedia) {
        // jalankan fungsi handleVideo, dan videoError jika izin ditolak
        navigator.getUserMedia({ video: true }, handleVideo, videoError);
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

    <script>
        function updateNameFinal() {
          $.getJSON("http://127.0.0.1:5000/name_final", function(data) {
            $("#name-final").text(data.name_final);
          });
        }

        // Call the updateNameFinal function every 1 second
        setInterval(updateNameFinal, 1000);
    </script>
</html>