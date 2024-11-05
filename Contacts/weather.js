document.getElementById('search-btn').addEventListener('click', function(event) {
    // Предотвращаем стандартное поведение кнопки отправки
    event.preventDefault();

    const city = document.getElementById('city-input').value.trim();

    // Проверяем, введён ли город
    if (!city) {
        alert('Пожалуйста, введите название города.');
        return;
    }

    // Определяем API ключи
    const weatherApiKey = '2bde616c073248a5b00120453240411'; // WeatherAPI
    const yandexWeatherApiKey = 'da4225ca-efe4-45ac-958a-791f8ca1ea6d'; // Yandex Weather
    const openWeatherMapApiKey = 'a41a4264017e9de58434bdcb23a7d86f'; // OpenWeatherMap

    // Функция для получения данных о погоде
    function fetchWeather(apiUrl, fallback) {
        return fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Ошибка сети');
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    throw new Error(data.error);
                }
                // Сохраняем данные о погоде в сессии
                saveWeatherData(data);
            })
            .catch(error => {
                console.error('Ошибка:', error);
                if (fallback) {
                    fallback();
                } else {
                    alert('Ошибка получения данных о погоде. Попробуйте позже.');
                }
            });
    }

    // Функция для сохранения данных о погоде и перенаправления
    function saveWeatherData(data) {
        // Создаем скрытую форму для отправки данных о погоде
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'process.php';

        // Сохраняем данные о погоде в скрытых полях
        Object.keys(data).forEach(key => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = JSON.stringify(data[key]);
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit(); // Отправляем форму
    }

    // Первый запрос к WeatherAPI
    const weatherApiUrl = `https://api.weatherapi.com/v1/current.json?key=${weatherApiKey}&q=${encodeURIComponent(city)}&lang=ru`;
    fetchWeather(weatherApiUrl, () => {
        // Если WeatherAPI не сработал, пробуем Яндекс Погоду
        const yandexApiUrl = `https://api.weather.yandex.ru/v2/informers?lat=55.7558&lon=37.6173&lang=ru&apikey=${yandexWeatherApiKey}`;
        fetchWeather(yandexApiUrl, () => {
            // Если Яндекс Погода не сработала, пробуем OpenWeatherMap
            const openWeatherMapUrl = `https://api.openweathermap.org/data/2.5/weather?q=${encodeURIComponent(city)}&appid=${openWeatherMapApiKey}&units=metric&lang=ru`;
            fetchWeather(openWeatherMapUrl);
        });
    });
});