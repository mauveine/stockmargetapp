<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel + Jetstream

Steps to be done to make the code workable:
- With PHP8.1 run `composer install`
- Copy `.env` file from `.env.example` and fill the empty fields from the bottom
- `./vendor/bin/sail up -d`
- Have the `queue` service working in the background. Example: `sail artisan queue:work`
- Run the migration: `sail artisan migrate:fresh --seed`
- Run the scout script for faster model loading: `sail artisan scout:import "App\Models\NasdaqListedCompany"`
- Login with the user `stock@example.com` , password: `password`

### Testing
For testing purposes, there needs to be a different database created.

Copy the `.env.example` into `.env.testing` and change the values accordingly

Make sure to run the migration script to fill the database first: 
`sail artisan migrate:fresh --seed --env=testing`

To test the only classes that are needed, run the following commands:
```
sail artisan test --filter=Rapid
sail artisan test --filter=SearchController
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
