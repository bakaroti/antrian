<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="./img/logo-rs2.png" type="image/x-icon">
  <title>Rumah Sakit</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <style>
    body {
      background-image: url("https://github.com/bakaroti/RS/blob/main/img/bg3.png?raw=true");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .video-container {
      position: relative;
      padding-bottom: 60%;
      height: 0;
    }

    .video-container iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }

    /* Custom CSS for Running Text */
    .running-text-container {
      overflow: hidden;
      position: relative;
      background-color: #0545bdad;
      color: #fff;
      padding: 8px 0;
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
    }

    .running-text {
      animation: running-text-animation 25s linear infinite;
      white-space: nowrap;
      font-weight: 555;
      font-size: 20px;
    }

    @keyframes running-text-animation {
      0% {
        transform: translateX(100%);
      }

      100% {
        transform: translateX(-100%);
      }
    }

    /* Custom CSS for Real-Time Clock */
    .real-time-clock {
      position: absolute;
      top: 20px;
      right: 80px;
      color: #ffffff;
      font-size: 42px;
      font-weight: bold;
    }

    .weather-container {
      position: absolute;
      top: 70px;
      right: 80px;
      color: #ffffff;
      font-size: 14px;
      /* Adjust the font size as per your preference */
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      gap: 10px;
    }

    .weather-container p {
      font-size: 20px;
      font-weight: bold;
    }

    .weather-container span {
      color: rgb(255, 230, 0);
    }
  </style>
  @vite('resources/css/app.css')
</head>

<body>
  <div class="container py-4">
    <div class="row align-items-center">
      <div class="col-1">
        <!-- Hospital Logo -->
        <img src="https://github.com/bakaroti/RS/blob/main/img/logo-rs2.png?raw=true" alt="Hospital Logo"
          style="max-width: 90px;">
      </div>
      <div class="col-md-10">
        <!-- Hospital Name -->
        <h1 class="mt-3" style="color: #fff; font-weight: bold;">Rumah Sakit Haji</h1>
        <!-- Hospital Address -->
        <p style="font-size: 18px; font-weight: bold; color: #fff;">Jl. Villa Melati Mas Raya No.5, Jelupang, Serpong
          Utara, South Tangerang City, Banten 15323</p>
      </div>
      <!-- Real-Time Clock -->
      <div class="col-md-1 text-end">
        <div class="real-time-clock" id="clock"></div>
        <div class="weather-container" id="weatherContainer"></div>
      </div>
    </div>
  </div>
  <div class="container py-5">
    <div class="row gap-3 mb-3">
      <div class="col-5">
        <div class="shadow card text-center">
          <div class="card-header">
            <h5 class="card-title" style="font-size: 2rem;">Nomor Antrian</h5>
          </div>
          <div class="card-body">
            <div class="badge badge-primary" style="font-size: 3rem; color: black;"
              id="poly{{ $poly[0]->initial ?? '-none' }}">{{ (isset($poly[0]->patient[0]) && $poly[0]->status) ?
              $poly[0]->patient[0]->antrian : '-' }}</div>
            <h5 class="d-block">Poli : <span id="nama-poly{{ $poly[0]->initial ?? '-none' }}">{{ $poly[0]->nama ?? '-'
                }}</span></h5>
          </div>
        </div>
      </div>
      <div class="col-5">
        <iframe width="650" height="210" src="https://www.youtube.com/embed/VIDEO_ID" frameborder="0"
          allowfullscreen></iframe>
      </div>
    </div>
    <div class="row gap-3">
      <div class="col-5">
        <div class="shadow card text-center">
          <div class="card-header">
            <h5 class="card-title" style="font-size: 2rem;">Nomor Antrian</h5>
          </div>
          <div class="card-body">
            <div class="badge badge-primary" style="font-size: 3rem; color: black;"
              id="poly{{ $poly[1]->initial ?? '-none' }}">{{ (isset($poly[1]->patient[0]) && $poly[1]->status) ?
              $poly[1]->patient[0]->antrian : '-' }}</div>
            <h5 class="d-block">Poli : <span id="nama-poly{{ $poly[1]->initial ?? '-none' }}">{{ $poly[1]->nama ?? '-'
                }}</span></h5>
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="shadow card text-center">
          <div class="card-header">
            <h5 class="card-title" style="font-size: 2rem;">Nomor Antrian</h5>
          </div>
          <div class="card-body">
            <div class="badge badge-primary" style="font-size: 3rem; color: black;"
              id="poly{{ $poly[2]->initial ?? '-none' }}">{{ (isset($poly[2]->patient[0]) && $poly[2]->status) ?
              $poly[2]->patient[0]->antrian : '-' }}</div>
            <h5 class="d-block">Poli : <span id="nama-poly{{ $poly[2]->initial ?? '-none' }}">{{ $poly[2]->nama ?? '-'
                }}</span></h5>
          </div>
        </div>
      </div>
      <div class="col-3">
        <div class="shadow card text-center">
          <div class="card-header">
            <h5 class="card-title" style="font-size: 2rem;">Nomor Antrian</h5>
          </div>
          <div class="card-body">
            <div class="badge badge-primary" style="font-size: 3rem; color: black;"
              id="poly{{ $poly[3]->initial ?? '-none' }}">{{ (isset($poly[3]->patient[0]) && $poly[3]->status) ?
              $poly[3]->patient[0]->antrian : '-' }}</div>
            <h5 class="d-block">Poli : <span id="nama-poly{{ $poly[3]->initial ?? '-none' }}">{{ $poly[3]->nama ?? '-'
                }}</span></h5>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    <!-- Running Text Section -->
    <div class="running-text-container">
      <div class="container">
        <div class="running-text">
          Running text example - This is a horizontally scrolling running text. This text will keep moving from right to
          left in an infinite loop.
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"
      integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script>
      let speech = new SpeechSynthesisUtterance();
      speech.lang = 'id-ID';
      speech.rate = 0.7;
    </script>

    <script>
      function speak(data) {
        if(data !== 'testing, 1, 2, 3, testing'){

          const ruangan = document.querySelector('#nama-poly' + data.poly_initial).innerHTML;
          
          speech.text = data.id ? 'Nomor urut, ' + data.antrian + ', Masuk Keruangan poly , ' + ruangan : ' ';
        } else {
          speech.text = data;
        }
            window.speechSynthesis.speak(speech);
            console.log(window.speechSynthesis.getVoices());
      }
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
            Echo.channel(`show-nomor`)
                .listen('ShowNomor', (e) => {

                  var data = e.data;
                  if (data !== 'testing'){

                    speak(data);
                    // console.log('helo gaes');
                    // console.log(e.data);
                    
                    document.querySelector('#poly' + data.poly_initial).innerHTML = data.id ? data.antrian : data.value;
                  }
                  else {
                    speak('testing, 1, 2, 3, testing');
                  }
                    // var n = 1;
                    // e.data.forEach(function(nomor){
                    //     // console.log(tes);
                    //     if(nomor != null){
                    //         console.log(nomor.nomor_antrian);
                    //         document.querySelector('#nomor'+n).innerHTML = nomor.poly_initial + nomor.nomor_antrian;
                    //     } else {
                    //         document.querySelector('#nomor'+n).innerHTML = '-';
                    //         // console.log('no');
                    //     }
                    //     n++;
                    // });

                });
        });
    </script>


    @vite('resources/js/app.js')

    @include('Monitor.script')
</body>

</html>