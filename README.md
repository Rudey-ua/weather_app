# Weather Subscription Service

## 🚀 Quick Start

### 🔽 Clone the repository

```bash
git clone https://github.com/Rudey-ua/weather_app.git
cd weather_app
```

1. **Copy `.env` file**:

   ```bash
   cp .env.example .env
   ```

   Then configure the following values in `.env`:

    * `WEATHER_API_KEY=your_openweather_api_key`
    * `MAIL_MAILER=log` *(for local testing, or use SMTP below)*

   To use real email sending, update mail settings:

   ```env
   MAIL_MAILER=smtp
   MAIL_SCHEME=null
   MAIL_HOST=127.0.0.1
   MAIL_PORT=2525
   MAIL_USERNAME=null
   MAIL_PASSWORD=null
   MAIL_FROM_ADDRESS="hello@example.com"
   MAIL_FROM_NAME="${APP_NAME}"
   ```

2. **Install dependencies (Docker-only setup)**:

   ```bash
   docker run --rm \
       -u "$(id -u):$(id -g)" \
       -v $(pwd):/var/www/html \
       -w /var/www/html \
       laravelsail/php83-composer:latest \
       composer install
   ```

3. **Start Docker Containers**:

   ```bash
   ./vendor/bin/sail up -d
   ```

4. **Generate application key**:

   ```bash
   ./vendor/bin/sail artisan key:generate
   ```

5. **Run Migrations manually**:

   ```bash
   ./vendor/bin/sail artisan migrate
   ```

6. **Open the App**:
   Visit `http://localhost`

## 📦 Project Structure

* `routes/api.php` – API endpoints following Swagger specification
* `routes/web.php` – route for HTML subscription page
* `routes/console.php` – scheduled commands and cron job registration
* `app/Http/Controllers` – RESTful controllers handling HTTP requests
* `app/Mail` – mailable classes for subscription and weather update emails
* `app/Jobs` – queued jobs for dispatching weather emails
* `app/Services` – business logic layer (e.g., weather fetching, formatting)
* `app/Repositories` – data access layer for managing subscriptions
* `resources/views/emails` – Blade templates for HTML emails

✅ **Extra points features implemented:**

* Deployed API: [https://weather-app-main-k6q3gx.laravel.cloud](https://weather-app-main-k6q3gx.laravel.cloud)
* Public HTML subscription page is connected to the backend and sends real requests

<img width="887" alt="image" src="https://github.com/user-attachments/assets/2ecaff24-8ee8-4297-9d04-7958c981361b" />

<img width="1159" alt="Google Chrome 2025-05-18 21 33 44" src="https://github.com/user-attachments/assets/43051bbf-bea6-414a-a9d4-9ad2e3f8935a" />

<img width="1145" alt="image" src="https://github.com/user-attachments/assets/693308d5-fb7b-41e3-b3d6-3c6f4de885d3" />
