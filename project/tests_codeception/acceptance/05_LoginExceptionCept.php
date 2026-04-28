<?php

$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('login if user not in db');
$I->amOnPage('/');
$I->seeCurrentUrlEquals('/');
$I->fillField('email', 'b@b.com');
$I->fillField('password', '123');
$I->click('Log in');
$I->seeCurrentUrlEquals('/');
$I->see("Whoops! Something went wrong. These credentials do not match our records.");


$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('login if user not in db');
$I->amOnPage('/');
$I->seeCurrentUrlEquals('/');
$I->fillField('email', 'jan.kowalski@gmail.com');
$I->fillField('password', '123');
$I->click('Log in');
$I->seeCurrentUrlEquals('/');
$I->see("Whoops! Something went wrong. These credentials do not match our records.");

