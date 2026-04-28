<?php

use Codeception\Util\Locator;

$I = new AcceptanceTester($scenario ?? null);


$I->wantTo('login as student');
$I->amOnPage('/');
$I->seeCurrentUrlEquals('/');
$I->fillField('email', 'adam@gmail.com');
$I->fillField('password', 'secret');
$I->click('Log in');
$I->seeCurrentUrlEquals('/');



$I->wantTo('open my exercises');
$user_id=$I->grabFromDatabase("users", "id", ["email" => "adam@gmail.com"]);
$I->click('Moje zadania');
$I->seeCurrentUrlEquals('/user/' . $user_id . '/exercise');


$I->wantTo('solve exercise');
$user_id=$I->grabFromDatabase("users", "id", ["email" => "adam@gmail.com"]);
$exercise_id=$I->grabColumnFromDatabase("exercises_users", "exercises_id", ["users_id" => $user_id])[0];
$exercise_name=$I->grabFromDatabase("exercises", "exercise_name", ["id" => $exercise_id]);
$exercise_type=$I->grabFromDatabase("exercises", "type", ["id" => $exercise_id]);
$I->click($exercise_name);

if ($exercise_type == "Otwarte") {
    $I->see($exercise_name);
    $I->fillField("Udziel odpowiedzi.", "4");
    $I->click("Prześlij");
}
else if ($exercise_type == "Zamknięte") {
    $I->see($exercise_name);
    $answer=$I->grabFromDatabase("exercises", "correct_answer", ["id" => $exercise_id]);
    $I->seeCheckboxIsChecked($answer);
    $I->click("Prześlij");
}
else {
    $I->see($exercise_name);
    $I->seeCheckboxIsChecked('prawda');
    $I->click("Prześlij");
}

$I->wantTo("check if I'm unable to solve this exercise again");
$I->seeCurrentUrlEquals('/user/' . $user_id . '/exercise');
$I->click($exercise_name);
$I->dontSee('Prześlij');
