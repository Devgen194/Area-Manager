Description

The Area Management App is a Laravel application that allows users to create, view, and manage areas with specific categories. Users can draw areas on a map, save them with relevant details, and perform live searches. The app also allows uploading GeoJSON files for areas and provides a good UI using Tailwind CSS and Alpine.js.

Features

Create and save new areas with categories, start, and end dates.
Draw areas on an interactive Leaflet map and capture coordinates.
Upload GeoJSON files for areas.
Live search functionality using Livewire.
User-friendly UI with Tailwind CSS and Alpine.js.
Display areas in a table with associated details.
Requirements

PHP 7.4 or higher
Composer
Node.js and npm
SQLite (for the database)
Laravel 8.x or higher

Installation

 Clone the Repository
bash
git clone the repo 
cd area-management-app

Install Dependencies
bash
composer install
npm install
npm run dev


Run Migrations and Seeders

Run the database migrations and seed the database with sample data:
php artisan migrate
php artisan db:seed

 Serve the Application
 
Serve the application using the Laravel development server:
php artisan serve
