## Laravel Web Scraper

Built to scrap a [webpage][https://www.spiegel.de/politik/deutschland/] and save all articles from that page to the database and display in a vue page.

## Requirements

[Laravel](https://laravel.com/docs/9.x/installation#laravel-and-docker) <br/>
Docker(Only if you want to use sail) <br/>

Install dependencies <br/>
Migrate database and run seeders(optional) <br/>

## Run scraper

With sail : sail php artisan articles:scrape <br/>
Without sail: php artisan articles:scrape <br/>

## Article views

The vue article view can be found on the home page route "/" <br/>
