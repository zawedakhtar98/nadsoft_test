# Nadsoft Test for Business Rating System

A simple PHP MySQL CRUD application for managing business listings and submitting business ratings via AJAX.

## Features

- Add, edit, and delete business listings
- View businesses in a DataTable with search and pagination
- Submit and update ratings for each business
- Ratings are displayed using star icons
- Uses Bootstrap, jQuery, DataTables, and raty.js

## Requirements

- PHP 7.4+ or compatible
- MySQL / MariaDB
- XAMPP, WAMP, or similar local PHP development environment
- Browser with JavaScript enabled

## Installation

1. Copy the project folder into your web server root, e.g. `C:\xampp\htdocs\nadsoft`
2. Start Apache and MySQL
3. Create a database named `business_rating_sys` or you can direct export from the dbfolder
4. Create the tables below in the database

### Database schema

```sql
CREATE TABLE `businesses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `ratings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `business_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `rating` decimal(3,1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `business_id` (`business_id`),
  CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `businesses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

5. Open `config/config.php` if you need to adjust the `BASE_URL`
6. Open `config/connection.php` to update the database host, username, password, and database name if needed

## Usage

- Navigate to `http://localhost/nadsoft/`
- Click `Add Business` to create a new listing
- Click `Edit` to update an existing business
- Click `Delete` to remove a business
- Click a business rating star area to submit or update a rating

## AJAX Endpoints

The application uses the following AJAX scripts in the `ajax/` folder:

- `AddBusinessListing.php` — save a new business
- `UpdateBusinessListing.php` — update an existing business
- `DeleteBusinessListing.php` — delete a business
- `FetchBusinessListing.php` — load businesses into DataTables
- `getSingleBusiListing.php` — retrieve a single business for editing
- `AddBusinessRating.php` — submit or update a rating

## Project Structure

- `index.php` — main front-end page
- `layout/header.php` and `layout/footer.php` — shared page layout
- `assets/css/` — stylesheets
- `assets/js/` — JavaScript and custom logic
- `config/` — application configuration
- `ajax/` — server-side AJAX handlers

## Notes

- The app expects MySQL credentials to match `config/connection.php`
- The DataTable is loaded server-side from `ajax/FetchBusinessListing.php`
- Ratings are stored in the `ratings` table and averaged per business
