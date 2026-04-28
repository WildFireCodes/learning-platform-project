<?php
#tutaj bedzie test testujacy strone glowna
$I = new AcceptanceTester($scenario ?? null);
$I->wantTo('check details of the page');

$I->amOnPage('/');

$I->seeCurrentUrlEquals('/');

$I->see("Witaj w Twoim programie do nauki matematyki!");
$I->see("Log in");
$I->see("Nie masz konta? Zarejestruj się tutaj!");


