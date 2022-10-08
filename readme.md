In the dir when project is unpacked in order to make it work run following commads : 

To build dependencies:
````
docker-compose run --rm composer install
````
To create env file:

````
touch .env
````
!S3 requires envs specified in `.env.sample` file!

To run command:
````
docker-compose run --rm php bin/console app:upload-images
````
To run unit tests:
````
docker-compose run --rm php bin/phpunit tests
````

Images are stored in `file` dir. `file2` contains resized images stored on drive. 
