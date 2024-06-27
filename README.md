<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Project

Follow the steps to run the project:

**1.** Clone this repository.

```terminal
git clone https://github.com/murilorr90/questionnaire
```

**2.** Navigate to the project directory, create a copy of .env.example file with your database/app settings and run:

```terminal
php artisan key:generate
```

**3.**  Create all database schema and data
```terminal
php artisan migrate && php artisan db:seed
```

**4.**  Run the project
```terminal
php artisan serve
```

**5.** You can access the crud in [this link](http://localhost:8000) or try the API with 2 URL's:
<br>
GET /api/questionnaire
<br>
POST /api/recommendation

**Congratulations!**

## Contributing

Made by Murilo for Manual Code Challenge.
