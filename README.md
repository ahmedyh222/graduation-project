<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Finished untill now
```
### * There is three APIs checkuser , Adduser, Login
### * Database needed untill this step
### * Needed Packages installed
```
<hr>
to run this project

### 1- php artisan serve
### 2- http://127.0.0.1:8000/api/adduser       which needs this data
    {
        "email": "ahm",
        "name": "a",
        "password": "1111",
        "username": "ahmed2626",
        "usertype": "doctor",
        "moreInf": true,
        "staff_type": "nsidlxk",
        "specialty" : "Engineer"
    }
### 3-http://127.0.0.1:8000/api/login
        {
             "password": "111",
              "username": "ahmed2626"
        }
### 4-http://127.0.0.1:8000/api/chkuname/ahm26 
where(ahm26) is the username


### 5-http://127.0.0.1:8000/api//feedback/ahm26
where(ahm26) is the username
