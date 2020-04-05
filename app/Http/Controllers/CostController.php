<?php

namespace App\Http\Controllers;

use App\Car;
use App\Charts\TestChart;
use Illuminate\Http\Request;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $car = Car::find($id);

        $costs = new TestChart();
        $costs->minimalist(1)->displayLegend(1);
        $costs->dataset('koszty','pie',  [rand(10,100),rand(10,100),rand(10,100),rand(10,100)])
            ->color([/*'#ff0000','#00ff00','#0000ff','#ff7700'*/'rgba(0,0,0,0.0)'])
            ->backgroundColor(['rgba(255,0,0,0.4)','rgba(0,255,0,0.4)','rgba(0,0,255,0.4)','rgba(255, 119, 0,0.4)']);
        $costs->labels(['awarie','paliwo','opłaty','naprawy eksploatacyjne']);

        $mileage = new TestChart();
        $mileage->dataset('przebieg','line',[204890,249876,255765,256234,287890])->color(['rgba(0, 179, 255, 0.8)'])->backgroundColor(['rgba(0, 179, 255, 0.1)']);
        $mileage->labels(['23-01-2019','01-02-2019','30-04-2019','15-05-2019','22-07-2019']);



        if ($car == null)
            return redirect('/cars')->withErrors(['Wystąpił błąd spróbuj ponownie lub skontaktuj się z administratorem.']);

        //  dd($car);
        return view('costs.index',compact('car'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 /*   public function store(Request $request)
    {
        //
    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function stats($id)
    {
        $car = Car::find($id);

        $costs = new TestChart();
        $costs->minimalist(1)->displayLegend(1);
        $costs->dataset('koszty','pie',  [rand(10,100),rand(10,100),rand(10,100),rand(10,100)])
            ->color([/*'#ff0000','#00ff00','#0000ff','#ff7700'*/'rgba(0,0,0,0.0)'])
            ->backgroundColor(['rgba(255,0,0,0.4)','rgba(0,255,0,0.4)','rgba(0,0,255,0.4)','rgba(255, 119, 0,0.4)']);
        $costs->labels(['awarie','paliwo','opłaty','naprawy eksploatacyjne']);

        $mileage = new TestChart();
        $mileage->dataset('przebieg','line',[204890,249876,255765,256234,287890])->color(['rgba(0, 179, 255, 0.8)'])->backgroundColor(['rgba(0, 179, 255, 0.1)']);
        $mileage->labels(['23-01-2019','01-02-2019','30-04-2019','15-05-2019','22-07-2019']);



        if ($car == null)
            return redirect('/cars')->withErrors(['Wystąpił błąd spróbuj ponownie lub skontaktuj się z administratorem.']);

          //dd($car);
        return view('costs.stats',compact('car','costs','mileage'));
    }
}
