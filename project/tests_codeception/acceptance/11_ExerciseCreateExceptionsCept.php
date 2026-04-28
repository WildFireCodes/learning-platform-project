<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Test");

$I->amOnPage('/');
$I->seeCurrentUrlEquals('/');

$I->wantTo('login as teacher and check create tasks exceptions');
$I->fillField('email', 'jan.kowalski@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');
$I->seeCurrentUrlEquals('/');

$I->wantTo('open my exercises');
$teacher_id = $I->grabFromDatabase("users", "id", ["email" => "jan.kowalski@gmail.com"]);

$I->click('Moje zadania');
$I->seeCurrentUrlEquals('/user/' . $teacher_id . '/exercise');

$I->wantTo('test exception 1');
$I->click('Utwórz zadanie');

$I->selectOption('input[id="zamkniete"]', 'Zamknięte');
$I->seeCheckboxIsChecked('Zamknięte');

$I->fillField('Tytuł zadania', '11*11=?');
$I->fillField('Odpowiedź błędna 2', '101');
$I->fillField('Odpowiedź błędna 3', '1111');

$I->click('Utwórz zadanie');
$I->see('Whoops! Something went wrong.
The exercise content field is required.
The answers a field is required.
The correct answer field is required.');

$I->selectOption('input[id="prawda-falsz"]', 'Prawda-Fałsz');
$I->seeCheckboxIsChecked('Prawda-Fałsz');

$I->wantTo('test exception 2');
$I->fillField('Tytuł zadania', '1 naturalne?');
$I->click('Utwórz zadanie');

$I->see('Whoops! Something went wrong.
The exercise content field is required.');

$I->wantTo('test exception 3');
$I->selectOption('input[id="otwarte"]', 'Otwarte');
$I->seeCheckboxIsChecked('Otwarte');

$I->fillField('Tytuł zadania', 'Ile wierzcholkow ma kwadrat?');
$I->fillField('Poprawna odpowiedź', '4');

$I->see('Whoops! Something went wrong.
The exercise content field is required.');
