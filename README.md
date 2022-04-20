# Workhours

This api helps organize workhours of employees

## Framework
Build using [Lumen](https://github.com/laravel/lumen) on top of PHP 8.1

## Requirements
- Bash
- Docker
- Docker compose

_Linux systems are prefered_

## Architecture 
- Docker containers
  - PHP 8.1
  - nginx (server)
  - mysql 5.7

## How to run
- copy `.env.example` to `.env`
- copy `build/docker/.env.example` to `.build/docker/env`
- edit `.env` files as per your liking
- generate 32 char log application key (`APP_KEY`) for `Lumen` and add it to `.env`
- edit your `/etc/hosts` file and add following line `127.0.0.1 workhours.local`
- run `./build/start.sh` to start docker containers
- to stop docker containers use `./build/stop.sh`

## How to setup Lumen
 - goto php docker container `docker exec -it php8 bash`
 - run `composer update -v`
 - run `php artisan migrate`
 - run `php artisan db:seed`
 - run `php artisan base_user:api_token` cop the token printed on console and use this token as your bearer token for HTTP headers

## Routes
All the routes below require bearer token generated from above command.

GET `/`
This is route to check your setup is working

POST `/employee` Add employee
```
{    "name": "Afroze shaik",
    "email": "afroze.shaik.afroze@gmail.com"
}
```
If accepted it should return employee details including its `employee_id` (`id`)

POST `/employee/shifts/{employeeId}` Add employee shift
```
{
    "date": "2023-05-05",
    "start_hour": 0,
    "end_hour": 8
}
```
If accepted it should return shift details

GET `/employee/shifts/{employeeId}` List employee shifts
