# Test Task

## Run the following commands in the same order in the project directory:

* `docker-compose up --build`
* `docker exec testclrf_php php bin/console doctrine:migrations:migrate --no-interaction`
* `docker exec testclrf_php php bin/console doctrine:fixtures:load --no-interaction`

## Launch

* Point your browser to: http://localhost:8876/

## Description:
There is a certain company “ZOO”, which is currently working with two carriers:
* TransCompany
* PackGroup
Each carrier always has its own formula for calculating the cost of parcel delivery (for simplicity, all prices will always be in EUR):

### Task:
It is necessary to describe the OOP architecture in PHP from methods, classes, modules, API controllers, etc. for working with carriers to obtain the cost of delivery for each of the specified carriers, according to their formulas. When developing, it is necessary to take into account that the number of carriers may increase over time. And the formulas for calculating the cost for newly added carriers will be different. Hint for implementation: inheritance, abstract classes, a service class for calculating the cost, which will accept the class of the transport service and input data from the client (in this case, the weight of the parcel), etc.

### Expected result:

* On the front end, a web page with simple input fields: parcel weight, a select field with a choice of slug (or ID, it doesn’t matter) of the carrier and a “calculate price” button.
* On the back end, an API controller that will accept the parcel weight and slug (or ID, it doesn’t matter) of the carrier and in response give the calculated cost in EUR.

### Requirements:
The task must be done on the Symfony PHP framework, since in the future the employee will have to work with it on the backend and a little with the Vue.js frontend framework (the backend accompanies a simple admin panel on Vue.js. It is important for us to understand your knowledge or lack of knowledge of Vue.js), then it is advisable to use Vue.js for rendering input fields (without fanaticism, everything is simple), and Symfony for the backend part. You will also need to work with the Docker containerization system. Therefore, ideally, the entire implementation should be wrapped in Docker, that is, create an ngnix container, a php container, a ui container and orchestrate all this through docker-compose.yml. PHPunit tests are welcome, since in future work the employee will also have to write them.