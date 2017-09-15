<?php

$routes->get('/', function() {
	HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
	HelloWorldController::sandbox();
});

$routes->get('/kurssi', function() {
	HelloWorldController::kurssi_list();
});
$routes->get('/kurssi/1', function() {
	HelloWorldController::kurssi_show();
});

$routes->get('/kurssi/1/edit', function() {
	HelloWorldController::kurssi_edit();
});

$routes->get('/aihe', function() {
	HelloWorldController::aihe_list();
});
$routes->get('/aihe/1', function() {
	HelloWorldController::aihe_show();
});

$routes->get('/aihe/1/edit', function() {
	HelloWorldController::aihe_edit();
});

$routes->get('/termi', function() {
	HelloWorldController::termi_list();
});
$routes->get('/termi/1', function() {
	HelloWorldController::termi_show();
});

$routes->get('/termi/1/edit', function() {
	HelloWorldController::termi_edit();
});

$routes->get('/login', function() {
	HelloWorldController::login();
});
