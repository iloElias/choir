# PHP HTTP Request Handler Template with Nginx

[![Maintainer](http://img.shields.io/badge/maintainer-@iloElias-blue.svg)](https://github.com/iloElias)
[![Package](https://img.shields.io/badge/package-iloelias/choir-orange.svg)](https://packagist.org/packages/ilias/choir)
[![Source Code](https://img.shields.io/badge/source-iloelias/choir-blue.svg)](https://github.com/iloElias/choir)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)

This GitHub repository provides a comprehensive Nginx server setup optimized for PHP applications, specifically tailored for deploying web APIs. It includes a ready-to-use template designed to streamline the development and deployment process on Railway platforms. This setup is ideal for developers looking to quickly and efficiently launch PHP-based APIs with Nginx, ensuring compatibility and performance on Railway deployments.

*Informações traduzidas para português do Brasil em `./docs/README_ptBR.md`*

## Dependencies

This template has some dependencies that need to be installed on your current workspace:

- **Docker**: Mainly used for local testing
- **PHP 8.0**: The current used programming language and it's minimum version
- **Composer**: PHP package manager

## 1st Step: Domain name

In your local host machine add the following lines to your `/etc/hosts` file in order to find the application.

```hosts
127.0.0.1   choir.api.com
```

## 2nd Step: Preparing the environment

Build your custom Docker Image running `./docker/build.sh`

Exceptions:

- In case you are having some permission troubles, use `sudo` to execute the fallowing files

## 3rd Step: Running Docker

`docker-compose up`: Standalone version

`docker-compose up -d`: Daemon version

Exceptions:

- If the daemon is not allawing you to use the `0.0.0.0:80` port, change the `docker-compose.yml` file to expose the port 81:

```yml
    expose:
      - 3000
      - 81
    ports:
      - 3000:3000
      - 81:81
```

## 4th Step: Check your browser

Open <http://choir.api.com/> and check the headers on your devtools, and you should see this entry `ping: "pong"`.
