<script>
    // Function to update the real-time clock
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds}`;
        document.getElementById('clock').textContent = timeString;
    }

    // Update the clock every second
    setInterval(updateClock, 1000);

    // Function to fetch weather data from the API
    function getWeatherData() {
        const apiKey = '97961ef723922459c139ba3221c81568'; // Replace this with your actual API key
        const city = 'Tangerang'; // Replace this with your desired city
        const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;

        // Mapping of weather conditions to Font Awesome icons
        const weatherIcons = {
            '01d': 'sun', // clear sky (day)
            '01n': 'moon', // clear sky (night)
            '02d': 'cloud-sun', // few clouds (day)
            '02n': 'cloud-moon', // few clouds (night)
            '03d': 'cloud', // scattered clouds (day)
            '03n': 'cloud', // scattered clouds (night)
            '04d': 'cloud', // broken clouds (day)
            '04n': 'cloud', // broken clouds (night)
            '09d': 'cloud-showers-heavy', // shower rain (day)
            '09n': 'cloud-showers-heavy', // shower rain (night)
            '10d': 'cloud-sun-rain', // rain (day)
            '10n': 'cloud-moon-rain', // rain (night)
            '11d': 'bolt', // thunderstorm (day)
            '11n': 'bolt', // thunderstorm (night)
            '13d': 'snowflake', // snow (day)
            '13n': 'snowflake', // snow (night)
            '50d': 'smog', // mist (day)
            '50n': 'smog' // mist (night)
        };

        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const weatherContainer = document.getElementById('weatherContainer');
                const weatherIconCode = data.weather[0].icon; // Get the weather icon code from the API response
                const weatherIcon = weatherIcons[weatherIconCode]; // Get the corresponding Font Awesome icon

                // Description cuaca dalam bahasa Indonesia sesuai dengan kode cuaca dari API
                let description = '';
                switch (weatherIconCode) {
                    case '01d':
                        description = 'Cerah (Siang)';
                        break;
                    case '01n':
                        description = 'Cerah (Malam)';
                        break;
                    case '02d':
                        description = 'Berawan (Siang)';
                        break;
                    case '02n':
                        description = 'Berawan (Malam)';
                        break;
                    case '03d':
                    case '03n':
                        description = 'Berawan';
                        break;
                    case '04d':
                    case '04n':
                        description = 'Berawan Tebal';
                        break;
                    case '09d':
                    case '09n':
                        description = 'Hujan Lebat';
                        break;
                    case '10d':
                        description = 'Hujan (Siang)';
                        break;
                    case '10n':
                        description = 'Hujan (Malam)';
                        break;
                    case '11d':
                    case '11n':
                        description = 'Badai Petir';
                        break;
                    case '13d':
                    case '13n':
                        description = 'Salju';
                        break;
                    case '50d':
                    case '50n':
                        description = 'Kabut';
                        break;
                    default:
                        description = 'Tidak Tersedia';
                }

                weatherContainer.innerHTML = `
            <h2>Cuaca di ${data.name}</h2>
            <p><i class="fas fa-${weatherIcon}"></i> Suhu :<span> ${data.main.temp} °C </span><br> Deskripsi : ${description}</p>
          `;
            })
            .catch(error => console.error('Error fetching weather data:', error));
    }

    // Call the function to fetch weather data
    getWeatherData();
</script>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
    function fetchFirstPatient() {
        $.ajax({
            url: "/nomor-antrian",
            type: "GET",
            dataType: "json",
            success: function(data) {
                // Update the patient info on the page
                if (data) {
                    $("#poly_id").text(data.poly_id);
                    $("#queue_number").text(data.queue_number);
                    $("#initial_poli").text(data.initial_poli);
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
</script> --}}
