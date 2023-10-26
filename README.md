# Stella Blogging App Project Using Laravel

## Installation

First clone or download this repository, install the dependencies, and setup your .env file.

```
git clone https://github.com/LinPaing21/Appointment-Portal.git
cd Appointment-Portal
composer install
cp .env.example .env
php artisan key:generate
```


Create the necessary database and connect in .env file.

Example:
 ``` DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={YourDatabaseName}
DB_USERNAME=root
DB_PASSWORD={If you have password, enter your password}  
```

And run the initial migrations and seeders.

```
php artisan migrate --seed
```

Password of all accounts "*password*".

```
php artisan serve
```

Open new terminal and run schedule for dynamically change database like history, schedule. 

```
php artisan schedule:work
```

Thanks for your time. 

