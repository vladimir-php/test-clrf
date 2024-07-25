# Test Task

## Run the following commands in the same order in the project directory:

* `docker-compose up --build`
* `docker exec testclrf_php php bin/console doctrine:migrations:migrate --no-interaction`
* `docker exec testclrf_php php bin/console doctrine:fixtures:load --no-interaction`

## Launch

* Point a browser at: http://localhost:8876/

## Description:
There is a certain company “ZOO”, which is currently working with two carriers:
* TransCompany
* PackGroup
Each carrier always has its own formula for calculating the cost of parcel delivery (for simplicity, all prices will always be in EUR):

TransCompany charges 20 EUR for up to 10 kg, 100 EUR for anything over 10 kg PackGroup charges 1 EUR for every 1 kg
in the future, other new carriers will be added with their own calculation formula (this must be taken into account).
