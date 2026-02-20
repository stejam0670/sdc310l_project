# sdc310l_project

Barebones school project for a simple product catalog and cart.

## Stack / Runtime

- PHP with MySQL
- XAMPP used for local development and testing

## Database Setup

These SQL scripts assume a database named `lab_project` already exists.

### Configure credentials

1. Copy `config.example.php` to `config.local.php`.
2. Update the values in `config.local.php` to match your local MySQL setup.

### Create tables and seed products

Run `db/scripts/setup.sql` in MySQL.

### Tear down

Run `db/scripts/teardown.sql` to drop the tables.

## Week 4 MVC Status

Architecture refactor is complete and implemented in-place.

| Task Name | Task Description | Status |
|---|---|---|
| Set up models | Migrated DB and data-access logic into `models/` (`Database.php`, `ProductModel.php`, `CartModel.php`). | Completed |
| Set up views | Moved rendering/display markup into `views/` templates (`home`, `catalog`, `cart`). | Completed |
| Set up controllers | Moved page request/business flow into `controllers/` and converted entry files to simple controller-function dispatch. | Completed |
