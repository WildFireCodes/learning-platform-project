<?php

$I = new AcceptanceTester($scenario ?? null);
//$I->recreateObjectTable();

$I->wantTo('register new user');

$I->amOnPage("/");

$I->click("Nie masz konta? Zarejestruj się tutaj!");

$I->seeInCurrentUrl("/register");
//$I->seeInTitle("Register");

//$I->see("Register");

$name = "a";
$surname = "a";
$email = "a@a.com";
$password = "12345678";

$I->fillField("name", $name);
$I->fillField("surname", $surname);
$I->fillField("email", $email);
$I->fillField("password", $password);
$I->fillField("password_confirmation", $password);

$I->dontSeeInDatabase("users", ["email" => "a@a.com"]);

$I->click("Zarejestruj się");

$I->seeInDatabase("users", ["email" => "a@a.com"]);

$r_email = $I->grabColumnFromDatabase("users", "email", ["email" => "a@a.com"]);
$r_name = $I->grabColumnFromDatabase("users", "name", ["name" => "a"]);
$r_surname = $I->grabColumnFromDatabase("users", "surname", ["surname" => "a"]);

$I->assertEquals($name, $r_name);
$I->assertEquals($surname, $r_surname);
$I->assertEquals($email, $r_email);

$I->amGoingTo("check redirection to dashboard page");

$I->seeCurrentUrlEquals("/");
$I->see("Witaj " . $name . "!");
