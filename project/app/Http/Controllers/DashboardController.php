<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDashboardRequest;
use App\Http\Requests\UpdateDashboardRequest;
use App\Models\Dashboard;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::check()) return view("user.mainpage");

        $users = User::where('id', '!=', Auth::id())->get();
        $users_count = 3;
        if ($users->count() < 3) {
            $users_count = $users->count();
        }

        $exercises = Exercise::all();
        $exercises_count = 3;
        if ($exercises->count() < 3) {
            $exercises_count = $exercises->count();
        }


        $user = User::find(Auth::id());

        $exercises_done = $user->exercise()->wherePivot('is_correct', '!=', null)->get();
        $exercises_done_count = 3;
        if ($exercises_done->count() < 3) {
            $exercises_done_count = $exercises_done->count();
        }

        $exercises_todo = $user->exercise()->wherePivot('is_correct', null)->get();
        $exercises_todo_count = 3;
        if ($exercises_todo->count() < 3) {
            $exercises_todo_count = $exercises_todo->count();
        }

        $randoms = Exercise::inRandomOrder()->limit(1)->get();
        $random = null;
        $answers = [];
        foreach ($randoms as $key => $value)
            $random = $value;

        if ($random != null) {
            $answers = json_decode($random->answers, true);
            $answers[3] = $random->correct_answer;
            shuffle($answers);
        }

        return view("user.mainpage")
            ->with(['users' => $users])
            ->with(['users_count' => $users_count])
            ->with(['user' => $user])
            ->with(['exercises' => $exercises])
            ->with(['exercises_count' => $exercises_count])
            ->with(['exercises_todo' => $exercises_todo])
            ->with(['exercises_todo_count' => $exercises_todo_count])
            ->with(['exercises_done' => $exercises_done])
            ->with(['exercises_done_count' => $exercises_done_count])
            ->with(['random' => $random])
            ->with(['answers' => $answers]);

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
     * @param \App\Http\Requests\StoreDashboardRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDashboardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Dashboard $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Dashboard $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateDashboardRequest $request
     * @param \App\Models\Dashboard $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDashboardRequest $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Dashboard $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
