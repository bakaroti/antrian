<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="./img/logo-rs2.png" type="image/x-icon">
  <title>Rumah Sakit</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  {{--
  <link href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"> --}}



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
      font-size: 45px;
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
      gap: px;
    }

    .weather-container p {
      font-size: 20px;
      font-weight: bold;
    }

    .weather-container span {
      color: rgb(255, 230, 0);
    }
  </style>
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

    {{-- <div class="container">
      <div class="row justify-content-center">
        <!-- Menggunakan justify-content-center untuk mengatur posisi horizontal di tengah -->
        <div class="col-md-6">
          <label for="polieSelect" class="form-label" style="color: #fff; font-weight: bold;">Pilih Poli</label>
          <select id="polieSelect" class="form-select">
            @foreach ($polies as $poly)
            <option value="{{ $poly->initial }}">{{ $poly->nama }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-6">
          <button id="tambah-antrian" class="btn btn-primary">Ambil Nomor Antrian</button>
        </div>
      </div>
      <div class="row justify-content-center mt-3">
        <!-- Menggunakan justify-content-center untuk mengatur posisi horizontal di tengah -->
        <div class="col text-light">Nomor antrian kamu : <span id="nomorAntrian"></span></div>
      </div>
    </div> --}}

    <div class="contaier">
      <div class="row">
        <div class="col-md-6 mt-5">
          <div class="card" style="height:420px;">
            <div class="card-body">
              <label for="polieSelect" class="form-label fw-bold fs-5 pb-2">Pilih Poli</label>
              <select id="polieSelect" class="form-select" style="text-transform: uppercase;">
                @foreach ($polies as $poly)
                <option value="{{ $poly->initial }}">{{ $poly->nama }}</option>
                @endforeach
              </select>
              <div class="text-center fw-bold fs-2" style="text-transform: uppercase; padding-top:100px;">
                <span id="selectedValue"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 mt-5 ">
          <div class="row">
            <div class="col-12 ">
              <button id="tambah-antrian" class="btn btn-dark w-100 fs-4 fw-bold" style="height: 70px;">Ambil Nomor
                Antrian</button>
            </div>
            <div class="col-12 pt-4 ">
              <div class="card" style=" height: 325px;">
                <div class="card-header">
                  <div class="col text-light fw-bold text-center text-dark" style="font-size:24px;">Nomor antrian
                    kamu
                  </div>
                </div>
                <div class="card-body">
                  <div class="text-center fw-bold" style="text-transform: uppercase; padding-top:65px; font-size: 70px">
                    <span id="nomorAntrian"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Running Text Section -->
    <div class="running-text-container bg-dark text-light py-3">
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
      const selectElement = document.getElementById('polieSelect');
        const spanElement = document.getElementById('selectedValue');
        selectElement.addEventListener('change', function () {
          const nama = selectElement.options[selectElement.selectedIndex].text;
          spanElement.textContent = nama;
        });
    </script>
</body>
@include('tiket/script')