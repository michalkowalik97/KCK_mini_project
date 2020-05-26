<?php

namespace App\Http\Controllers;

use App\Car;
use App\Fuel;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $fuel = Fuel::where('car_id', $id)->orderBy('created_at', 'DESC')->get();
        $car = Car::findOrFail($id);

        return view('fuel.index', compact('fuel', 'car'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $car = Car::findOrFail($id);

        return view('fuel.create', compact('car'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $car_id)
    {
        $validatedData = $request->validate([
            'kwota' => 'required',
            'ilosc' => 'required',
            'paliwo' => 'required'
        ]);

       // dd($request->all());

        $fuel = new Fuel();
        $fuel->car_id = $car_id;
        $fuel->value = floatval(str_ireplace(',', '.', $request->kwota));
        $fuel->quantity = floatval(str_ireplace(',', '.', $request->ilosc));//$request->ilosc ;

        if ($request->cena)
            $fuel->price = floatval(str_ireplace(',', '.', $request->cena)); //$request->cena ;
        else
            $fuel->price = round(($fuel->value / $fuel->quantity),2) ;

        $fuel->type = $request->paliwo;
        $fuel->save();

        return redirect('/cars/' . $car_id)->with('message', "Zapisano pomyślnie.");

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
