# LogParser
## Description
Test task for Smart Pension

# How to install
Requirements: PHP7.4

## Installation, running:
Clone this repo:
```
$ git clone https://github.com/Dmitry-Pryshchepa/smart-test.git
```

Go to smart-test directory and run:
```
$ php artisan logs:parse ../webserver.log 
```

To run unit tests:
```
$ ./vendor/bin/phpunit --coverage-html coverage-report
```

Output example:
```
$ php artisan logs:parse ../webserver.log
Webpages with most page views ordered from most pages views to less page views:
/about/2 90 visits
/contact 89 visits
/index 82 visits
/about 81 visits
/help_page/1 80 visits
/home 78 visits
List of webpages with most unique page views also ordered:
/help_page/1 23 unique views
/contact 23 unique views
/home 23 unique views
/index 23 unique views
/about/2 22 unique views
/about 21 unique views
```
