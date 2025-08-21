# simple-crud

#### Requirements
- PHP >= 7.4
- Composer
- `php-curl` extension

#### Check if `php-curl` is installed
Run the command:
```bash
php -m | grep curl
````

* If `"curl"` is listed, cURL is enabled.
* If not, install it with:

```bash
sudo apt-get update && sudo apt-get install php-curl
```

#### Install Dependencies

Navigate to the project directory and install dependencies with Composer:

```bash
cd app

composer --version
composer install
```

#### Environment File

Copy the environment configuration file:

```bash
cp .env.example .env
```

Update `.env` with your project’s credentials and configurations.

### Database
```
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```