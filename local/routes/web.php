<?php

Route::get('/', 'LoginController@Login');
Route::get('/login', 'LoginController@Login')->name('login'); 

Route::post('/login/ValidarForm', 'LoginController@ValidarForm');
Route::get('/login/ValidarForm', 'LoginController@ValidarForm');

Route::any('logout', 'LoginController@logout');

Event::listen('404', function(){
	return Response::error('404');
});

Event::listen('500', function(){
	return Response::error('500');
});

Event::listen('403', function(){
	return Response::error('403');
});

//Route::any('/pdf1', 'TicketsController@pdf1')->name('pdf1'); 

Route::group(['middleware' => ['user']], function(){
	
	Route::get('/home', 'HomeController@index')->name('home'); 

	Route::get('/crear_tickets', 'TicketsController@crear')->name('crear_tickets');
	Route::post('/crear_tickets', 'TicketsController@crear');

	Route::get('/listar_tickets', 'TicketsController@listar')->name('listar_tickets');
	Route::post('/listar_tickets', 'TicketsController@listar');

	Route::get('/ticket_list', 'TicketsController@ticket_list');

	Route::get('/DelTicket', 'TicketsController@DelTicket')->name('DelTicket');
	Route::post('/DelTicket', 'TicketsController@DelTicket');

	Route::get('/historial_tickets', 'TicketsController@historial')->name('historial_tickets');
	Route::post('/historial_tickets', 'TicketsController@historial');

	Route::get('/ticket_historial', 'TicketsController@ticket_historial');

	Route::get('/crear_dependencia', 'DependenciaController@crear_dependencia')->name('crear_dependencia');
	Route::post('/crear_dependencia', 'DependenciaController@crear_dependencia');

	Route::get('/listar_dependencia', 'DependenciaController@listar_dependencia')->name('listar_dependencia');
	Route::post('/listar_dependencia', 'DependenciaController@listar_dependencia');

	Route::get('/dependencia_list', 'DependenciaController@dependencia_list');

	Route::get('/historial_dependencia', 'DependenciaController@historial')->name('historial_dependencia');
	Route::post('/historial_dependencia', 'DependenciaController@historial');

	Route::get('/dependencia_historial', 'DependenciaController@dependencia_historial');

	Route::get('/DelDependencia', 'DependenciaController@DelDependencia')->name('DelDependencia');
	Route::post('/DelDependencia', 'DependenciaController@DelDependencia');

	Route::get('/TicketGenerade', 'TicketsController@TicketGenerade')->name('historial_tickets');
	Route::post('/TicketGenerade', 'TicketsController@TicketGenerade');

	Route::get('/reporte', 'ExcelController@index')->name('reporte');
	Route::post('/reporte', 'ExcelController@index');

	Route::get('/reportexcel', 'ExcelController@ReportGenerade')->name('reportexcel');
	Route::post('/reportexcel', 'ExcelController@ReportGenerade');
});

