<?php
require_once __DIR__ . '/controllers/CatalogController.php';

handle_catalog_request();
$products = get_catalog_products();
require __DIR__ . '/views/catalog.php';
