# Plentific - API Service Test
This is a PHP library for interacting with the [Reqres API](https://reqres.in/), providing user management features such as fetching, listing, and creating users. This package uses **GuzzleHttp** for HTTP requests and includes a lightweight DTO for user data transfer.

## Requirements
Ensure you have installed in your local machine, the software required:

### PHP >= 8.4
Execute the following command in your terminal to install PHP 8.4:
* `/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.4)"`

### Composer
Follow these instructions to install `composer`:
* `https://getcomposer.org/download/`

### Git
Execute the following commands in your terminal to install Git:
* `/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"`
* `brew install git`

## Install the library in `Local`
Requirements and steps to set up and install the library locally.

### 1. Download from GitHub
Download the library by cloning from a GitHub repository (preferably using `SSH` mode), ie:
* `git clone git@github.com:chemafernandez/plentific.git`

### 2. Download PHP dependencies
Execute the following command in your terminal from the `api-service` directory;
* `composer update`

## Classes

* `UserService` is the main class which provides methods to interact with the API:
  - `getUserById`: Fetch a user by ID
  - `getUsersListByPage`: Get a list of users by page
  - `createUser`: Create a new user

* `UserDTO` class is a Data Transfer Object representing a user.

* All API errors are wrapped in the `ApiException` class.

## Unit Tests
This library is tested by PHPUnit class `UserServiceTest`, allocated in `tests` folder. To run the tests, execute the following command in your terminal from the `api-service` directory:
* `vendor/bin/phpunit tests`

## Examples of use
There is a folder `api-service-consumer` with 3 scripts as examples of use of the library. Before running the examples, execute the following command in your terminal from the `api-service-consumer` directory to download the PHP dependencies:
* `composer update`

### Examples

#### getUserById.php
This script shows how to call function `getUserById` from the library. To run the example, execute the following command in your terminal from the `api-service-consumer` directory:
* `php getUserById.php`

#### getUsersListByPage.php
This script shows how to call function `getUsersListByPage` from the library. To run the example, execute the following command in your terminal from the `api-service-consumer` directory:
* `php getUsersListByPage.php`

#### createUser.php
This script shows how to call function `createUser` from the library. To run the example, execute the following command in your terminal from the `api-service-consumer` directory:
* `php createUser.php`

## PSR-12
To ensure the library complies with PSR-12 standards, the `psr` library is installed. To run the PSR-12 validation, execute the following command in your terminal from the `api-service` directory:
* `vendor/bin/phpcs`

## PHPStan
PHPStan analys library is installed. To run the PHPStan analys, execute the following command in your terminal from the `api-service` directory:
* `vendor/bin/phpstan`
