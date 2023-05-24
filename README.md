# Website Tracker

## System requirements
1. Docker and Docker Compose

## Installation
1. Clone this repo.
2. `cd <path to repo>`
3. `cp .env.example .env`
4. `./vendor/bin/sail up -d`


## Observation on the scope of work
- Though we should take the client IP from the backend request, instead sending this from frontend. I believe you are doing this the keep this assignment simple.
- I had to change the `date` column to `record_date`. Because using keywords as table column titles sometimes cause unexpected issues.
- In `PK (date, country_code, campaign_id, creative_id, browser_id, device_id)` did you mean Primary Key? But, a table can't have multiple primary keys.
