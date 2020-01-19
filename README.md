# Price Monitor

## Getting Started

### Requirements

* Latest Git
* Latest NPM
* Latest Composer
* Latest Docker

### Installation

#### Using Docker

1. Clone this repository

```
git clone https://github.com/endrureza/price-monitor.git
```
2. Go to folder price-monitor
3. On your terminal, type 
```
cp .env.example .env
```
4. On your terminal, type 
```
docker-compose build && docker-compose up -d
```
5. Add `price-monitor.test` to your `hosts` file

6. Run this command to migrate database 
```
docker-compose exec php-fpm php artisan migrate
```
7. Run this command to install system dependencies
```
composer install
```
8. Run this command to install node modules and compile them
```
npm install (or using: yarn install)
npm run dev
```
9. Go to your browser and type `http://price-monitor.test`

#### Not Using Docker

1. Clone this repository

```
git clone https://github.com/endrureza/price-monitor.git
```
2. Go to folder price-monitor
3. On your terminal, type 
```
cp .env.example .env
```
4. Open file `.env` and edit these variables to meet your local system 
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=priceweb
DB_USERNAME=priceweb
DB_PASSWORD=secret
```
5. Add `price-monitor.test` to your `hosts` file
6. Run this command to install system dependencies
```
composer install
```
7. Run this command to install node modules and compile them
```
npm install (or using: yarn install)
npm run dev
```
8. Go to your browser and type `http://price-monitor.test`
