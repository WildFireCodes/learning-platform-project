<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Validation\Rules\RequiredIf;

class UserExerciseController extends Controller
{
    public function index(User $user)
    {

        $user = User::find($user->id);
        $exercise = $user->exercise;

        return view('exercise.index')->withExercise($exercise)->withUser($user);
    }

    public function store(User $user, StoreExerciseRequest $request)
    {
        $rules = ['exercise_name' => 'required',
            'exercise_content' => 'required',
            'type'=> 'required',
            'answers_a' => [new requiredif($request->type == "Zamknięte")],
            'answers_b' => [new requiredif($request->type == "Zamknięte")],
            'answers_c' => [new requiredif($request->type == "Zamknięte")]];

        if($request->type != "Prawda-Fałsz"){
            $rules['correct_answer'] = 'required';
        }

        $request->validate($rules);

        $exercise = new Exercise();
        $exercise->exercise_content = $request->exercise_content;
        $exercise->exercise_name = $request->exercise_name;

        $exercise->type = $request->type;
        if ($exercise->type == "Prawda-Fałsz") {
            $exercise->correct_answer = $request->correct_answer_pf;
        }
        if ($exercise->type == "Otwarte") {
            $exercise->correct_answer = $request->correct_answer;
        }
        if ($exercise->type == "Zamknięte") {
            $exercise->correct_answer = $request->correct_answer;
            $answers = [$request->answers_a, $request->answers_b, $request->answers_c];
        }
        else
            $answers = null;

        $exercise->answers = json_encode($answers);
        $exercise->save();

        $id_user = $user->id;
        $exercise->user()->attach($id_user);


        return redirect()->route('user.exercise.index',[$user]);
    }

    public function create(User $user)
    {
        return view('exercise.create')->with(['user', $user]);
    }

    public function show(User $user, Exercise $exercise)
    {
        $ue = 0;
        $temp = $user->exercise->where('id', '==', $exercise->getKey());
        foreach ($temp as $key => $value) {
            $ue = $value;
        }

        $answers = json_decode($exercise->answers, true);
        $answers[3] = $exercise->correct_answer;
        shuffle($answers);

        return view('exercise.show')
            ->withExercise($exercise)
            ->withUser($user)
            ->with('ue', $ue)
            ->with('answers', $answers);
    }

    public function update(User $user, Exercise $exercise, UpdateExerciseRequest $request)
    {
        //ODPOWIEDŹ UCZNIA I POPRAWNA ODPOWIEDŹ DO MAŁYCH LITER I BEZ BIAŁYCH ZNAKÓW
        $user_answer_edited=trim(strtolower($request->answer)," \n\r\t\v\x00");
        $correct_answer_edited=trim(strtolower($exercise->correct_answer)," \n\r\t\v\x00");

        //SPRAWDZAM ROLĘ
        if($user->role == "user") {
            $this->validate($request, [
                'answer' => 'required',
            ]);
            $user_answer=['user_answer' => $request->answer];

            if ($user_answer_edited == $correct_answer_edited) {
                $is_correct = ['is_correct' => 1];
            } else {
                $is_correct = ['is_correct' => 0];
            }

            $user->exercise()->updateExistingPivot($exercise->id, $is_correct);
            $user->exercise()->updateExistingPivot($exercise->id, $user_answer);
        }
        else{
            $old_exercise=Exercise::find($exercise->id);
            $old_exercise->exercise_name = $request->exercise_name;
            $old_exercise->exercise_content = $request->exercise_content;
            $old_exercise->correct_answer = $request->correct_answer;

            if ($exercise->type == "Zamknięte")
                $answers = [$request->answers_a, $request->answers_b, $request->answers_c];
            else
                $answers = null;
            $old_exercise->answers = json_encode($answers);
            $old_exercise->save();
        }


        return redirect()->route('user.exercise.index',[$user]);

    }

    public function destroy(User $user,Exercise $exercise)
    {
        $exercise->delete();

        return redirect()->route('user.exercise.index',[$user]);
    }

    public function edit(User $user,Exercise $exercise)
    {
        $answers = json_decode($exercise->answers, true);
        return view('exercise.edit')
            ->withExercise($exercise)
            ->withUser($user)
            ->with('answers', $answers);
    }


}
