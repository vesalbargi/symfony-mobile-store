# Symfony Mobile Store Project

This Symfony-based mobile store project is a comprehensive web application for mobile device sales and management. It includes Docker support for consistent deployment and Xdebug integration for enhanced debugging capabilities, streamlining development while ensuring productivity and maintainability.

## Spec

- Symfony 6.0.7
- PHP 8.1
- Apache
- Mariadb latest
- Xdebug 3.14
- Composer latest
- symfony/apache-pack 1.0.1
- Git

The application/Symfony code in under the `/src` folder.  
The `src` folder is mounted into `/var/www/html` inside the `app` container. 

## Set up the project

1. Clone the project.
2. Copy `.env.sample` file to `.env` file in the main directory.
3. Inside the main folder, start the docker-compose: `docker-compose up -d`
4. Connect to the `app` container: `docker-compose exec app bash`
5. Install composer inside the container `composer install`
6. Check [http://localhost](http://localhost/index.php/), you should see the Symfony welcome page. 

## Commands cheat sheet

Start the docker-compose

```bash
docker-compose up -d
```

To rebuild the container

```bash
docker-compose up -d --build
```

Start the docker-compose

```bash
docker-compose down
```

To remove the dependent orphaned containers

```bash
docker-compose down --remove-orphans
```

Connect to container

```bash
docker-compose exec app bash
```

Disable the xdebug

```bash
bin/xdebug disable
```

Enable the xdebug

```bash
bin/xdebug enable
```

## License

This project is licensed under the MIT License.

[![MIT License](https://img.shields.io/badge/License-MIT-green.svg)](https://choosealicense.com/licenses/mit/)
