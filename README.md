# Website Tracker

## System requirements
1. Docker and Docker Compose

## Installation
1. Clone the repo: `git clone https://github.com/nahidacm/website-tracker.git`
2. `cd website-tracker`
3. `cp .env.example .env`
4. Install composer dependencies
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```
4. `./vendor/bin/sail up -d`
5. Install JS dependecy: `./vendor/bin/sail npm install`
6. Generate key: `./vendor/bin/sail artisan key:generate`
7. Database migrate: `./vendor/bin/sail artisan migrate:fresh`
8. Open `http://localhost:3099` this will send an conversion request to backend

## Test
Test case directory: `./tests`
* Run frontend test: `./vendor/bin/sail npm test`
* Run backend test: `./vendor/bin/sail test`

## Observation on the scope of work
- Though we should take the client IP from the backend request, instead sending this from frontend. I believe you are doing this the keep this assignment simple.
- I had to change the `date` column to `record_date`. Because using keywords as table column titles sometimes cause unexpected issues.
- Please ignore boilerplate codes like `User`
- For sake of simplicity, I have left the test db and dev db to same.
- IP Geo data fetching and Caching is done by the laravel package named `torann/geoip`
- Cache and Queue is using Reis
- Please note: mapped ports for docker services are frontend port: `3099`, Redis port: `6379`, MySql port: `3098`. these ports must be abailable on host machine. Incase if they are already availed, please update from `.env`