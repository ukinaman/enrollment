<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
 
Breadcrumbs::for('home', function (BreadcrumbTrail $trail): void {
    $trail->push('Home', route('home'));
});
Breadcrumbs::for('user.index', function (BreadcrumbTrail $trail): void {
    $trail->push('User Management', route('user.index'));
});
Breadcrumbs::for('user.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('user.index')
        ->push('Add User', route('user.create'));
});
Breadcrumbs::for('roles.index', function (BreadcrumbTrail $trail): void {
    $trail->parent('user.index')
        ->push('Roles and Permissions', route('roles.index'));
});
Breadcrumbs::for('roles.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('roles.index')
        ->push('Create Role', route('roles.create'));
});
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail): void {
    $trail->push('Dashboard', route('dashboard'));
});
Breadcrumbs::for('courses.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Courses', route('courses.index'));
});
Breadcrumbs::for('courses.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('courses.index')
        ->push('Create course', route('courses.create'));
});
Breadcrumbs::for('students.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Students', route('students.index'));
});
Breadcrumbs::for('accounting.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Accounting', route('accounting.index'));
});