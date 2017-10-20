<?php

function check_logged_in() {
	BaseController::check_logged_in();
}

$routes->get('/hiekkalaatikko', function() {
	HelloWorldController::sandbox();
});

//Etusivu
$routes->get('/', function(){
	KurssiController::index();
});

//Kurssisivut

$routes->get('/kurssi', function(){
	KurssiController::index();
});

$routes ->get('/kurssi/new', function() {
	KurssiController::create();
});

$routes->get('/kurssi/:id', function($id){
	KurssiController::show($id);
});

$routes->get('/kurssi/:id/edit', 'check_logged_in', function($id) {
	KurssiController::edit($id);
});

$routes->post('/kurssi/:id/edit', 'check_logged_in', function($id) {
	KurssiController::update($id);
});

$routes->post('/kurssi/:id/destroy', 'check_logged_in', function($id) {
	KurssiController::destroy($id);
});

$routes ->post('/kurssi', function() {
	KurssiController::store();
});

//Aihesivut

$routes->get('/aihe', function() {
	AiheController::index();
});

$routes ->get('/aihe/new', function() {
	AiheController::create();
});

$routes->get('/aihe/:id', function($id) {
	AiheController::show($id);
});

$routes->get('/aihe/:id/edit', 'check_logged_in', function($id) {
	AiheController::edit($id);
});

$routes->post('/aihe/:id/edit', 'check_logged_in', function($id) {
	AiheController::update($id);
});

$routes->post('/aihe/:id/destroy', 'check_logged_in', function($id) {
	AiheController::destroy($id);
});

$routes ->post('/aihe', function() {
	AiheController::store();
});

//Termisivut

$routes->get('/termi', function(){
	TermiController::index();
});

$routes ->get('/termi/new', function() {
	TermiController::create();
});

$routes->get('/termi/:id', function($id){
	TermiController::show($id);
});

$routes->get('/termi/:id/edit', 'check_logged_in', function($id) {
	TermiController::edit($id);
});

$routes->post('/termi/:id/edit', 'check_logged_in', function($id) {
	TermiController::update($id);
});

$routes->post('/termi/:id/destroy', 'check_logged_in', function($id) {
	TermiController::destroy($id);
});

$routes ->post('/termi', function() {
	TermiController::store();
});

//Kayttajasivut

$routes->get('/login', function(){
	OpiskelijaController::login();
});

$routes->get('/signup', function(){
	OpiskelijaController::create();
});

$routes ->post('/signup', function() {
	OpiskelijaController::store();
});

$routes->get('/opiskelija/:id', function() {
	OpiskelijaController::show();
});

$routes->post('/login', function(){
	OpiskelijaController::handle_login();
});

$routes->post('/logout', function(){
	OpiskelijaController::logout();
});
