@extends('layouts.app')

@section('title')
    - Edytuj samochód
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
                <form action="/cars/{{$car->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    <div class="form-group">
                        <label>Marka i model samochodu</label>
                        <input type="text" name="name"
                               class="w3-input @error('name') w3-border-bottom w3-border-red w3-pale-red @enderror "
                               value="{{ old('name', $car->name) }}" required>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
{{--
                    <div class="form-group">
                        <label>Aktualny przebieg</label>
                        <input type="text" name="przebieg"
                               class="w3-input @error('przebieg') w3-border-bottom w3-border-red w3-pale-red @enderror"
                               value="{{ old('przebieg', $car->mileage) }}">
                        @error('przebieg')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>--}}

                    <div class="form-group">
                        <label>Paliwo</label>
                        <select name="paliwo"
                                class="w3-select @error('paliwo') w3-border-bottom w3-border-red w3-pale-red @enderror"
                                id="">
                            <option value="{{NULL}}" disabled @if($car->fuel == null) selected @endif>Wybierz paliwo</option>
                            <option value="PB" @if($car->fuel == "PB") selected @endif >Benzyna</option>
                            <option value="ON" @if($car->fuel == "ON") selected @endif>Diesel</option>
                            <option value="LPG" @if($car->fuel == "LPG") selected @endif>Gaz</option>
                        </select>
                        @error('paliwo')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Paliwo alternatywne</label>
                        <select name="paliwo_alternatywne"
                                class="w3-select @error('paliwo_alternatywne') w3-border-bottom w3-border-red w3-pale-red @enderror"
                                id="">
                            <option value=""  @if($car->alternative_fuel == null) selected @endif>Wybierz paliwo alternatywne</option>
                            <option value="PB" @if($car->alternative_fuel == "PB") selected @endif >Benzyna</option>
                            <option value="ON" @if($car->alternative_fuel == "ON") selected @endif>Diesel</option>
                            <option value="LPG" @if($car->alternative_fuel == "LPG") selected @endif>Gaz</option>
                        </select>
                        @error('paliwo_alternatywne')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

           {{--         <div class="form-group">
                        <label>Dodaj zdjęcie samochodu</label><br/>
                        <input type="file" name="car_photo" accept="image/*"
                               @error('car_photo') class=" w3-border-bottom w3-border-red w3-pale-red"
                               @enderror value="{{ old('car_photo') }}">
                        <div class="text-black-50 h6">Maksymalny rozmiar zdjęcia to 7MB.</div>
                        @error('car_photo')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>--}}

                    <input type="submit" class="w3-button w3-black w3-hover-green" value="Zapisz">
                    <a href="{{url()->previous()}}" class="w3-button w3-border w3-white w3-hover-yellow text-decoration-none" >Anuluj</a>
                </form>
            </div>
        </div>

    </div>
@endsection