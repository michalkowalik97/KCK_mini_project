<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::user()->get();
        //dd($cars);

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
            'car_photo' => 'mimetypes:image/*|file|nullable',
        ]);
//name	photo	mileage	user_id	reminder_id	created_at	updated_at
        $car = new Car();
        $car->name = $request->name;
        $car->mileage = $request->przebieg;
        $car->user_id = Auth::id();
        if ($request->hasFile('car_photo')){
            $path = $request->file('car_photo')->store('photos');
            $car->photo = $path;
        }
        $car->save();

        return redirect('/cars');
            /*dump($request->file('car_photo')->extension());
        $path = $request->file('car_photo')->store('photos');
        /*echo "test";
        dump($request->car_photo);
        echo "------------------------- <br/>";
        dump($request->hasFile('car_photo'));
        echo "------------------------- <br/>";
        $path = Storage::putFile('photos', $request->file('car_photo'));*/
        //dd($path);

        /*dd($request->file('photo'));
        $path = $request->photo->store();
        echo $path;
        dd($request->file('photo'));*/

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('cars.show');
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
}
