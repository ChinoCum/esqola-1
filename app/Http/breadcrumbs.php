<?php


// ADMIN - USERS

Breadcrumbs::register('Administración', function($breadcrumbs) {
    $breadcrumbs->push('Administración', action('Admin\DashboardController@index'));
});

Breadcrumbs::register('Usuarios', function($breadcrumbs) {
    $breadcrumbs->parent('Administración');
    $breadcrumbs->push('Usuarios', action('Admin\UsersController@mainUsers'));
});

Breadcrumbs::register('Agregar', function($breadcrumbs) {
    $breadcrumbs->parent('Usuarios');
    $breadcrumbs->push('Agregar', action('Admin\UsersController@addUser'));
});

Breadcrumbs::register('createUser', function($breadcrumbs) {
    $breadcrumbs->parent('Agregar');
    $breadcrumbs->push('createUser', action('Admin\UsersController@addUser'));
});

Breadcrumbs::register('Editar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Usuarios');
    $breadcrumbs->push('Editar', action('Admin\UsersController@editUser',$uuid));
});

Breadcrumbs::register('Eliminar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Usuarios');
    $breadcrumbs->push('Eliminar', action('Admin\UsersController@removeUser',$uuid));
});

// ADMIN - GRADES

Breadcrumbs::register('Grados', function($breadcrumbs) {
    $breadcrumbs->parent('Administración');
    $breadcrumbs->push('Grados', action('Admin\GradesController@index'));
});

Breadcrumbs::register('Agregar', function($breadcrumbs) {
    $breadcrumbs->parent('Grados');
    $breadcrumbs->push('Agregar', action('Admin\GradesController@addGrade'));
});

Breadcrumbs::register('Eliminar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Grados');
    $breadcrumbs->push('Eliminar', action('Admin\GradesController@remove',$uuid));
});

Breadcrumbs::register('Editar', function($breadcrumbs, $uuid) {
    $breadcrumbs->parent('Grados');
    $breadcrumbs->push('Editar', action('Admin\GradesController@edit',$uuid));
});

Breadcrumbs::register('Editar', function($breadcrumbs) {
    $breadcrumbs->parent('Grados');
    $breadcrumbs->push('Editar', action('Admin\GradesController@update'));
});

//




















Breadcrumbs::register('Log', function($breadcrumbs) {
    $breadcrumbs->parent('Administración');
    $breadcrumbs->push('Log', action('Admin\SystemController@log'));
});

Breadcrumbs::register('Descripción', function($breadcrumbs,$id) {
    $breadcrumbs->parent('Log');
    $breadcrumbs->push('Descripción', action('Admin\SystemController@LogDescription',$id));
});