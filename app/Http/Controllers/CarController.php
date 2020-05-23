<?php

namespace App\Http\Controllers;

use App\Car;
use App\Charts\TestChart;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::user()->orderBy("name")->get();

        return view('cars.list',compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'przebieg' => 'numeric|nullable',
            'paliwo' => 'required',
            'paliwo_alternatywne' => 'different:paliwo|nullable',
            'car_photo' => 'mimetypes:image/*|file|nullable|max:7000',
        ]);

        $car = new Car();
        $car->name = $request->name;
        $car->mileage = $request->przebieg;
        $car->user_id = Auth::id();
        $car->fuel = $request->paliwo;
        $car->alternative_fuel = $request->paliwo_alternatywne;

        if ($request->hasFile('car_photo')){
            $path = $request->file('car_photo')->store('photos');
            $car->photo = $path;
        }

        $car->save();

        return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);

     /*   $costs = new TestChart();
        $costs->minimalist(1)->displayLegend(1);
        $costs->dataset('koszty','pie',  [rand(10,100),rand(10,100),rand(10,100),rand(10,100)])
            ->color([/*'#ff0000','#00ff00','#0000ff','#ff7700'*//*'rgba(0,0,0,0.0)'])
            ->backgroundColor(['rgba(255,0,0,0.4)','rgba(0,255,0,0.4)','rgba(0,0,255,0.4)','rgba(255, 119, 0,0.4)']);
        $costs->labels(['awarie','paliwo','opłaty','naprawy eksploatacyjne']);

        $mileage = new TestChart();
        $mileage->dataset('przebieg','line',[204890,249876,255765,256234,287890])->color(['rgba(0, 179, 255, 0.8)'])->backgroundColor(['rgba(0, 179, 255, 0.1)']);
        $mileage->labels(['23-01-2019','01-02-2019','30-04-2019','15-05-2019','22-07-2019']);*/



        if ($car == null)
            return redirect('/cars')->withErrors(['Wystąpił błąd spróbuj ponownie lub skontaktuj się z administratorem.']);

      //  dd($car);
        return view('cars.show',compact('car'/*,'costs','mileage'*/));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::find($id);
        if ($car)
            return view('cars.edit', compact('car'));

       return redirect("/cars")->withErrors(['Coś poszło nie tak, spróbuj jeszcze raz']);
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
          //  'przebieg' => 'numeric|nullable',
            'paliwo' => 'required',
            'paliwo_alternatywne' => 'different:paliwo|nullable',
           // 'car_photo' => 'mimetypes:image/*|file|nullable|max:7000',
        ]);

        $car = Car::find($id);
        if (!$car)
            return redirect()->back()->withErrors(['Coś poszło nie tak, spróbuj jeszcze raz']);

        $car->name = $request->name;
        $car->fuel = $request->paliwo;
        $car->alternative_fuel = $request->paliwo_alternatywne;
        $car->save();


     return redirect('/cars/'.$id)->with('message', "Zamiany zostały zapisane.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::find($id);
        if (!$car)
            return redirect()->back()->withErrors(['Coś poszło nie tak, spróbuj jeszcze raz']);
        Storage::delete($car->photo);
        $car->photo = null;
        $car->save();

        $car->delete();

        return redirect('/cars/')->with('message', "Samochód został usunięty.");
    }

    public function editPhoto($id)
    {
        $car = Car::find($id);
        if (!$car)
            return redirect()->back()->withErrors(['Coś poszło nie tak, spróbuj jeszcze raz']);

        return view('cars.editPhoto', compact('car'));

    }

    public function updatePhoto(Request $request, $id)
    {
        $validatedData = $request->validate([
            'car_photo' => 'mimetypes:image/*|file|nullable|max:7000',
        ]);

        $car = Car::find($id);
        if (!$car)
            return redirect()->back()->withErrors(['Coś poszło nie tak, spróbuj jeszcze raz']);

        $oldPhoto = $car->photo;

        if ($request->hasFile('car_photo')){
            $path = $request->file('car_photo')->store('photos');
            $car->photo = $path;
        }

        $car->save();

        Storage::delete($oldPhoto);

        return redirect('/cars/'.$id)->with('message', "Zamiany zostały zapisane.");

    }

    public function deletePhoto(Request $request, $id)
    {
        $car = Car::find($id);
        if (!$car)
            return redirect()->back()->withErrors(['Coś poszło nie tak, spróbuj jeszcze raz']);

        Storage::delete($car->photo);
        $car->photo = null;
        $car->save();

        return redirect('/cars/'.$id)->with('message', "Zamiany zostały zapisane.");

    }
}
