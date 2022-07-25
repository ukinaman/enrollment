<?php

use App\Models\Fee;
use App\Models\User;
use App\Models\Course;
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

// Registrar
// Course
Breadcrumbs::for('courses.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Courses', route('courses.index'));
});
Breadcrumbs::for('course.show', function (BreadcrumbTrail $trail, $id): void {
    $course = Course::where('id','=',$id)->first();
    $trail->parent('courses.index')
    ->push($course->accronym, route('course.show', $id));
});
Breadcrumbs::for('courses.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('courses.index')
    ->push('Create course', route('courses.create'));
});
Breadcrumbs::for('registrar.assessment.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Assessment', route('registrar.assessment.index'));
});
Breadcrumbs::for('registrar.assessment.show', function (BreadcrumbTrail $trail, $id): void {
    $trail->parent('registrar.assessment.index')
        ->push('Student', route('registrar.assessment.show', $id));
});


// Subject
Breadcrumbs::for('subject.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Subjects', route('subject.index'));
});
Breadcrumbs::for('subject.uploadBlade', function (BreadcrumbTrail $trail): void {
    $trail->parent('subject.index')
        ->push('Upload Subjects', route('subject.uploadBlade'));
});
Breadcrumbs::for('students.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Students', route('students.index'));
});
Breadcrumbs::for('accounting.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Accounting', route('accounting.index'));
});
Breadcrumbs::for('subject.show', function (BreadcrumbTrail $trail): void {
    $trail->parent('subject.index')
        ->push('Show', route('subject.show'));
});

// Accounting
//Semestral Fee
Breadcrumbs::for('semfee.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Semestral Fees', route('semfee.index'));
});
Breadcrumbs::for('semfee.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('semfee.index')
        ->push('Create', route('semfee.create'));
});
Breadcrumbs::for('semfee.edit', function (BreadcrumbTrail $trail, $id): void {
    $fee = Fee::find($id);
    $trail->parent('semfee.index')
        ->push('Edit', route('semfee.edit', $id));
});
// Assessment
Breadcrumbs::for('assessment.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Assessment', route('assessment.index'));
});
Breadcrumbs::for('assessment.show', function (BreadcrumbTrail $trail): void {
    $trail->parent('assessment.index')
        ->push('Show', route('assessment.show'));
});
// Enrollee Assessment
Breadcrumbs::for('enrollee.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Enrollee Assessment', route('enrollee.index'));
});
Breadcrumbs::for('enrollee.show', function (BreadcrumbTrail $trail, $id): void {
    $trail->parent('enrollee.index')
        ->push('Enrollee', route('enrollee.show', $id));
});
// Discount
Breadcrumbs::for('discount.index', function (BreadcrumbTrail $trail): void {
    $trail->push('Discounts', route('discount.index'));
});
Breadcrumbs::for('discount.create', function (BreadcrumbTrail $trail): void {
    $trail->parent('discount.index')
        ->push('Create', route('discount.create'));
});
Breadcrumbs::for('discount.edit', function (BreadcrumbTrail $trail, $id): void {
    $trail->parent('discount.index')
        ->push('Edit', route('discount.edit', $id));
});