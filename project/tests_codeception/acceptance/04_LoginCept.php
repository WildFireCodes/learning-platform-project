<?php
$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('login with existing user');

$I->amOnPage('/');

$I->seeCurrentUrlEquals('/');

#$I->click('Zaloguj');

$I->fillField('email', 'jan.kowalski@gmail.com');
$I->fillField('password', 'secret');

$I->click('Log in');

$I->seeCurrentUrlEquals('/');

#$I->seeInSource('<div class="title">Twoje zadania</div>');\
$r_name = $I->grabFromDatabase("users", "name", ["email" => "jan.kowalski@gmail.com"]);
$I->see("Witaj " . $r_name . "!");

