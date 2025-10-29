# Plentific - API Service Test

This is a PHP library for interacting with the [Reqres API](https://reqres.in/), providing user management features such as fetching, listing, and creating users. This package uses **GuzzleHttp** for HTTP requests and includes a lightweight DTO for user data transfer.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
  - [UserService](#userservice)
  - [UserDTO](#userdto)
  - [Handling Exceptions](#handling-exceptions)
- [License](#license)



## Requirements
Ensure you have installed in your local machine, the software required:

### PHP >= 8.4
Execute this command in your terminal to install PHP 8.4:
* `/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.4)"`

### Composer
Follow these instructions to install `composer`:
* `https://getcomposer.org/download/`

### Git
Execute these commands in your terminal to install Git:
* `/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"`
* `brew install git`

## Install the library in `Local`
Requirements and steps to set up and install the library locally.

### 1. Download from GitHub
Download the library by cloning from a GitHub repository (preferably using `SSH` mode), ie:
* `git clone git@github.com:chemafernandez/plentific.git`

### 2. Download PHP dependencies
Execute this command in your terminal inside the directory `api-service`;
* `composer update`

## Usage
