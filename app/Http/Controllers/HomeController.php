<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chart = Charts::create('line', 'highcharts')

            ->title('my chart')

            ->elementLabel('Hola Lable')

            ->labels(['First', 'Second', 'Third'])

            ->values([5, 10, 20])

            ->dimensions(1000, 500)

            ->responsive(true);
        return view('welcome', compact('chart'));
    }
}
