<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Check teacher's student list and add task to one person.");

$I->amOnPage('/');
$I->seeCurrentUrlEquals('/');

$I->wantTo('login as teacher');
$I->fillField('email', 'jan.kowalski@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');
$I->seeCurrentUrlEquals('/');

$I->wantTo("check teacher's student list");
$I->see('Lista uczniów');
$I->click('Lista uczniów');

$teacher_id = $I->grabFromDatabase("users", "id", ["email" => "jan.kowalski@gmail.com"]);
$I->seeCurrentUrlEquals('/user?' . $teacher_id);

$I->see('Milusiński');
$I->see('Cebula');
$I->see('Socjalny');

$I->see('PRZYPISZ ZADANIE');
$I->see('USUŃ');
$I->see('PODGLĄD POSTĘPÓW');

$I->wantTo("add task for Adam Milusiński");
$I->click("Przypisz zadanie");

$user_id = $I->grabFromDatabase("users", "id", ["email" => "adam@gmail.com"]);
$I->seeCurrentUrlEquals('/user/' . $user_id);

$I->see('ID Zadania');
$I->fillField('exercise_id', 7);
$I->click('Dodaj');

$I->wantTo("task id:7 added for Adam Milusiński");
$I->seeInDatabase("exercises_users", ["users_id" => $user_id, "exercises_id" => 7]);
