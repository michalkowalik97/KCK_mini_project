@extends('layouts.app')

@section('title')
    - Dodaj samochód
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
                <form action="/cars" method="POST" enctype="multipart/form-data">
                    {{--   name	photo	mileage	user_id	reminder_id	created_at	updated_at	 --}}
                    @csrf
                    <div class="form-group">
                        <label>Marka i model samochodu</label>
                        <input type="text" name="name"
                               class="w3-input @error('name') w3-border-bottom w3-border-red w3-pale-red @enderror "
                               value="{{ old('name') }}" required>
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Aktualny przebieg</label>
                        <input type="text" name="przebieg"
                               class="w3-input @error('przebieg') w3-border-bottom w3-border-red w3-pale-red @enderror"
                               value="{{ old('przebieg') }}">
                        @error('przebieg')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Paliwo</label>
                        <select name="paliwo"
                                class="w3-select @error('paliwo') w3-border-bottom w3-border-red w3-pale-red @enderror"
                                id="">
                            <option value="{{NULL}}" disabled selected>Wybierz paliwo</option>
                            <option value="PB">Benzyna</option>
                            <option value="ON">Diesel</option>
                            <option value="LPG">Gaz</option>
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
                            <option value=""  selected>Wybierz paliwo alternatywne</option>
                            <option value="PB">Benzyna</option>
                            <option value="ON">Diesel</option>
                            <option value="LPG">Gaz</option>
                        </select>
                        @error('paliwo_alternatywne')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Dodaj zdjęcie samochodu</label><br/>
                        <input type="file" name="car_photo" accept="image/*"
                               @error('car_photo') class=" w3-border-bottom w3-border-red w3-pale-red"
                               @enderror value="{{ old('car_photo') }}">
                        <div class="text-black-50 h6">Maksymalny rozmiar zdjęcia to 7MB.</div>
                        @error('car_photo')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="submit" class="w3-button w3-black w3-hover-green" value="Dodaj">
                    <a href="{{url()->previous()}}" class="w3-button w3-border w3-white w3-hover-yellow text-decoration-none" >Anuluj</a>

                </form>
            </div>
        </div>

    </div>
@endsection