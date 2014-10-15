Huge PHP coding challenge
==================

Installation:

** Clone the repo:
```
git clone https://github.com/yefb/huge-php-challenge
```

** Access to the folder:
```
cd huge-php-challenge
```

** Install composer (If you don't have it installed already):
```
curl -sS https://getcomposer.org/installer | php
```

** Install all dependencies:
```
php composer.phar update
```

** Give the storage forder some write permissions:
```
chmod -R 777 src/storage
```

** Give the canvas.php file execution permissions:
```
chmod +x canvas.php
```

** Start the application:
```
php canvas.php
```

** Or:
```
./canvas.php
```

Tests
==================
** This app includes unit tests for all the drawers
```
phpunit
```
