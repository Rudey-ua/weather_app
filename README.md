# Weather Subscription Service

## 🚀 Quick Start

1. **Start Docker Containers**:

   ```bash
   ./vendor/bin/sail up -d
   ```

2. **Run Migrations**

   ```bash
   ./vendor/bin/sail artisan migrate
   ```

3. **Open the App**:
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

<img width="779" alt="image" src="https://github.com/user-attachments/assets/f44b11d4-1c34-46ff-b670-dc4ac21af8fe" />

<img width="1159" alt="Google Chrome 2025-05-18 21 33 44" src="https://github.com/user-attachments/assets/43051bbf-bea6-414a-a9d4-9ad2e3f8935a" />

<img width="1145" alt="image" src="https://github.com/user-attachments/assets/693308d5-fb7b-41e3-b3d6-3c6f4de885d3" />
