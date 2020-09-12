<?php

namespace App\Http\Controllers;

use App\Car;
use App\Category;
use App\Charts\TestChart;
use App\Cost;
use App\Fuel;
use App\Repair;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $car = Car::find($id);

        $costs = Cost::where('car_id', $id)
            ->with('repair.category')
            ->sort($request->sort)
            ->get();

        //          $costs = $costs->where('repair.category_id',1);

        $categories = Category::all();
        if (in_array($request->category, $categories->pluck('id')->toArray())) {
            $costs = $costs->where('repair.category_id', $request->category);
        }
        return view('costs.index', compact('costs', 'car', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $categories = Category::all();

        return view('costs.create', compact('id', 'categories'));
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
            'opis' => 'required|max:255',
            'przebieg' => 'numeric|nullable',
            'kategoria' => 'required',
            'koszt' => 'required'
        ]);


        $car = Car::findOrFail($car_id);
        $repair = new Repair();
        $repair->name = $request->opis;
        $repair->category_id = $request->kategoria;
        $repair->save();

        $cost = new Cost();
        $cost->value = floatval(str_ireplace(',', '.', $request->koszt));
        $cost->mileage = $request->przebieg;
        $cost->repair_id = $repair->id;
        $cost->car_id = $car_id;
        $cost->save();

        if ((int)$request->przebieg > 0) {
            $car->mileage = (int)$request->przebieg;
            $car->save();
        }

        return redirect('/cars/' . $car_id)->with('message', "Dodano pomyślnie.");

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

    public function stats(Request $request, $id)
    {
        //dd($request->all());
        $car = Car::find($id);
        $categories = Category::all();
        $costsObj = Cost::where('car_id', $id)
            ->dates($request)
            ->with('repair')
            ->get();
        $fuel = Fuel::where('car_id', $id)->get();

        $categoriesSum = [];
        foreach ($categories as $category) {
            $categoriesSum[] = ["name" => $category->name, "color" => $category->color, "sum" => $costsObj->where('repair.category_id', $category->id)->sum('value')];
        }
        $categoriesSum[] = ["name" => "paliwo", "color" => "#26fc26", "sum" => $fuel->sum('value')];

        $categoriesSum = collect($categoriesSum);
        //  dd($categoriesSum);

        $costs = new TestChart();
        $costs->minimalist(1)->displayLegend(1);
        $costs->dataset('koszty', 'pie', $categoriesSum->pluck('sum'))
            ->color([ 'rgba(0,0,0,0.0)'])
            ->backgroundColor($categoriesSum->pluck('color'));
        $costs->labels($categoriesSum->pluck('name'));

        $mileage = new TestChart();
        $mileage->dataset('przebieg', 'line', $costsObj->where('mileage', '>', 0)->pluck('mileage') )->color(['rgba(0, 179, 255, 0.8)'])->backgroundColor(['rgba(0, 179, 255, 0.1)']);
        $dates = $costsObj->where('mileage', '>', 0)->pluck('created_at');
        foreach ($dates as $key => $date) {
            $carbon = new Carbon($date);
            $dates[$key] = $carbon->toDateString();
        }
        $mileage->labels($dates);


        if ($car == null)
            return redirect('/cars')->withErrors(['Wystąpił błąd spróbuj ponownie lub skontaktuj się z administratorem.']);

        //dd($car);
        return view('costs.stats', compact('car', 'costs', 'mileage'));
    }
}
