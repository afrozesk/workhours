# Workhours

This api helps organize workhours of employees

## Framework
Build using [Lumen](https://github.com/laravel/lumen) on top of PHP 7.4

## Requirements
- Bash
- Docker
- Docker compose

_Linux systems are prefered_

## Architecture 
- Docker containers
  - PHP 7.4
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

