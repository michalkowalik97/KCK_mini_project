@extends('layouts.app')

@section('title')
    - Dodaj wpis
@endsection

@section('content')

    <div class="w3-card container p-4">
        {{--@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif--}}
        <div class="row">
            <div class="col-9">
                <form action="/car/{{$car->id}}/fuel/add" method="POST" enctype="multipart/form-data">
                    {{--   name	photo	mileage	user_id	reminder_id	created_at	updated_at	 --}}
                    @csrf
                    <div class="form-group">
                        <label>Kwota za jaką zatankowano [zł]</label>
                        <input type="text" name="kwota"
                               class="w3-input @error('kwota') w3-border-bottom w3-border-red w3-pale-red @enderror "
                               value="{{ old('kwota') }}" required>
                        @error('kwota')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Ilość paliwa [l]</label>
                        <input type="text" name="ilosc"
                               class="w3-input @error('ilosc') w3-border-bottom w3-border-red w3-pale-red @enderror"
                               value="{{ old('ilosc') }}">
                        @error('ilosc')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Cena za litr [zł]</label>
                        <input type="text" name="cena"
                               class="w3-input @error('cena') w3-border-bottom w3-border-red w3-pale-red @enderror"
                               value="{{ old('cena') }}">
                        @error('cena')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($car->alternative_fuel != null && $car->alternative_fuel != '')
                        <div class="form-group">
                            <label>Paliwo</label>
                            <select name="paliwo"
                                    class="w3-select @error('paliwo') w3-border-bottom w3-border-red w3-pale-red @enderror"
                                    id="">

                                    <option value="{{$car->fuel}}" >{{$car->fuelName($car->fuel)}}</option>
                                    <option value="{{$car->alternative_fuel}}" >{{$car->fuelName($car->alternative_fuel)}}</option>

                            </select>
                            @error('paliwo')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <input type="hidden" name="paliwo" value="{{$car->fuel}}">
                    @endif
                    <input type="submit" class="w3-button w3-black w3-hover-green" value="Dodaj">
                    <a href="{{url()->previous()}}"
                       class="w3-button w3-border w3-white w3-hover-yellow text-decoration-none">Anuluj</a>

                </form>
            </div>
        </div>

    </div>
@endsection