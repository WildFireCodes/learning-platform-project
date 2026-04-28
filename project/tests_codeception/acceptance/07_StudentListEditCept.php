<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo("Check teacher's student list and delete one person.");

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

//$user_id = $I->grabFromDatabase("users", "id", ["email" => "adam@gmail.com"]);

$I->wantTo("delete student Adam Milusiński");
$I->click('Usuń');

$I->seeCurrentUrlEquals('/user');

$I->dontSee('Milusiński');
$I->see('Cebula');
$I->see('Socjalny');
