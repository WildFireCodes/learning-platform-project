<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatisticRequest;
use App\Http\Requests\UpdateStatisticRequest;
use App\Models\Exercise;
use App\Models\Statistic;
use App\Models\User;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(User $user)
    {
        $points_1=0;
        $points_0=0;


        $exercises = $user->exercise; //wszystkie zadanie danego ucznia

        $exercise_count=$exercises->count();

        foreach ($exercises as $exercise) {
            if($exercise->pivot->is_correct =='1'){
                $points_1++;
            }
            elseif($exercise->pivot->is_correct =='0'){
                $points_0++;
            }

        }

        if($exercise_count == 0)
        {
            $is_solved = 0;
        }else {
            $is_solved = (($points_0 + $points_1) * 100 / $exercise_count);
        }

        if($points_0 +$points_1 == 0)
        {
            $is_correct = 0;
        }else{
             $is_correct = ($points_1 )*100/($points_0 +$points_1);
        }


        return view("exercise.statistics")
            ->withUser( $user)
            ->withExercises( $exercises)
            ->with('points',[$is_correct,$is_solved,$exercise_count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStatisticRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatisticRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Statistic  $statistic
     * @return \Illuminate\Http\Response
     */
    public function show(Statistic $statistic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Statistic  $statistic
     * @return \Illuminate\Http\Response
     */
    public function edit(Statistic $statistic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStatisticRequest  $request
     * @param  \App\Models\Statistic  $statistic
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStatisticRequest $request, Statistic $statistic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Statistic  $statistic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statistic $statistic)
    {
        //
    }


}
