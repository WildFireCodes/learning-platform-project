<?php

use Codeception\Util\Locator;

$I = new AcceptanceTester($scenario ?? null);

$I->wantTo('login as teacher');
$I->amOnPage('/');
$I->seeCurrentUrlEquals('/');
$I->fillField('email', 'jan.kowalski@gmail.com');
$I->fillField('password', 'secret');
$I->click('Log in');
$I->seeCurrentUrlEquals('/');

$I->wantTo('open my exercises');
$user_id=$I->grabFromDatabase("users", "id", ["email" => "jan.kowalski@gmail.com"]);
$I->click('Moje zadania');
$I->seeCurrentUrlEquals('/user/' . $user_id . '/exercise');

$I->wantTo('add exercise 1');
$I->click('Utwórz zadanie');
$I->seeCheckboxIsChecked('Zamknięte');
$I->fillField('Tytuł zadania', '11*11=?');
$I->fillField('Treść zadania', 'Ile to jest 11 razy 11?');
$I->fillField('Poprawna odpowiedź', '121');
$I->fillField('Odpowiedź błędna 1', '111');
$I->fillField('Odpowiedź błędna 2', '101');
$I->fillField('Odpowiedź błędna 3', '1111');
$I->click('Utwórz zadanie');
$I->seeCurrentUrlEquals('/user/' . $user_id . '/exercise');
$I->see('11*11=?');

$I->wantTo('add exercise 2');
$I->click('Utwórz zadanie');
$I->seeCheckboxIsChecked('Otwarte');
$I->fillField('Tytuł zadania', 'Twierdzenie - trójkąt prostokątny');
$I->fillField('Treść zadania', 'Z jakiego twierdzenia skorzystasz mając dwa podane 2 boki by obliczyć trzeci w trójkącie prostokątnym?');
$I->fillField('Poprawna odpowiedź', 'Twierdzenia Pitagorasa');
$I->click('Utwórz zadanie');
$I->seeCurrentUrlEquals('/user/' . $user_id . '/exercise');
$I->see('Twierdzenie - trójkąt prostokątny');

$I->wantTo('add exercise 3');
$I->click('Utwórz zadanie');
$I->selectOption('input[id="prawda-falsz"]', 'Prawda-Fałsz');
$I->seeCheckboxIsChecked('Prawda-Fałsz');
$I->fillField('Tytuł zadania', 'Twierdzenie pitagorasa');
$I->fillField('Treść zadania', 'Twierdzenie pitagorasa służy do obliczenia boków w kwadracie?');
$I->fillField('Poprawna odpowiedź', 'fałsz');
$I->click('Utwórz zadanie');
$I->seeCurrentUrlEquals('/user/' . $user_id . '/exercise');
$I->see('Twierdzenie pitagorasa');

$I->wantTo('edit exercise');
$exercise_id=$I->grabFromDatabase("exercises", "id", ["exercise_name" => "Twierdzenie pitagorasa"]);
$I->seeCurrentUrlEquals('/user/' . $user_id . '/exercise');
$I->click("Twierdzenie pitagorasa");
$I->seeCurrentUrlEquals('/user/' . $user_id . '/exercise/' . $exercise_id);
$I->click('Edytuj');
$I->fillField('Tytuł zadania', 'Czy 13^2=169?');
$I->fillField('Treść zadania', '13 do potęgi 2 to 169?');
$I->seeCheckboxIsChecked('Fałsz');
$I->click('Prześlij');
$I->seeCurrentUrlEquals('/user/' . $user_id . '/exercise');
$I->see('Czy 13^2=169?');

$I->wantTo('delete exercise');
$I->click('11*11=?');
$I->click('Usuń');
$I->seeCurrentUrlEquals('/user/' . $user_id . '/exercise');
$I->dontSee('11*11=?');

