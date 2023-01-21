>TODO Move to `make init`

sail up
composer install
???


```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'


http://localhost


Setting up your development environment on your local machine :
```bash
$ git clone https://github.com/guillaumebriday/laravel-blog.git
$ cd laravel-blog
$ cp .env.example .env
$ composer install
$ vagrant up
$ vagrant ssh
```

All following commands must be run inside the VM:
```bash
$ cd code
$ yarn install
./artisan key:generate
./artisan migrate:fresh --seed
./artisan horizon:install
./artisan telescope:install
./artisan storage:link
```

Now you can access the application via [http://localhost:8000](http://localhost:8000).

**There is no need to run `php artisan serve`. PHP is already running in the dedicated virtual machine.**

## Before starting
You need to run the migrations with the seeds :
```bash
$ artisan migrate --seed
```

This will create a new user that you can use to sign in :
```yml
email: darthvader@deathstar.ds
password: 4nak1n
```

And then, compile the assets :
```bash
$ yarn dev # or yarn watch
```

Starting job for newsletter :
```bash
$ artisan tinker
> PrepareNewsletterSubscriptionEmail::dispatch();
```

## Useful commands
Seeding the database :
```bash
$ artisan db:seed
```

Running tests :
```bash
$ artisan test
```

Running Laravel Pint :
```bash
$ ./vendor/bin/pint --verbose --test
```

Generating backup :
```bash
$ artisan vendor:publish --provider="Spatie\Backup\BackupServiceProvider"
$ artisan backup:run
```

Generating fake data :
```bash
$ artisan db:seed --class=DevDatabaseSeeder
```

Discover package
```bash
$ artisan package:discover
```

In development environnement, rebuild the database :
```bash
$ artisan migrate:fresh --seed
```

## Accessing the API

Clients can access to the REST API. API requests require authentication via token. You can create a new token in your user profile.

Then, you can use this token either as url parameter or in Authorization header :

```bash
# Url parameter
GET http://laravel-blog.app/api/v1/posts?api_token=your_private_token_here

# Authorization Header
curl --header "Authorization: Bearer your_private_token_here" http://laravel-blog.app/api/v1/posts
```

API are prefixed by `api` and the API version number like so `v1`.

Do not forget to set the `X-Requested-With` header to `XMLHttpRequest`. Otherwise, Laravel won't recognize the call as an AJAX request.

To list all the available routes for API :

```bash
$ artisan route:list --path=api
```
