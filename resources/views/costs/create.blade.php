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
                <form action="/car/{{$id}}/cost/add" method="POST" enctype="multipart/form-data">
                    {{--   name	photo	mileage	user_id	reminder_id	created_at	updated_at	 --}}
                    @csrf
                    <div class="form-group">
                        <label>Opis</label>
                        <input type="text" name="opis"
                               class="w3-input @error('opis') w3-border-bottom w3-border-red w3-pale-red @enderror "
                               value="{{ old('opis') }}" required>
                        @error('opis')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Aktualny przebieg [km]</label>
                        <input type="text" name="przebieg"
                               class="w3-input @error('przebieg') w3-border-bottom w3-border-red w3-pale-red @enderror"
                               value="{{ old('przebieg') }}">
                        @error('przebieg')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Koszt [zł]</label>
                        <input type="text" name="koszt"
                               class="w3-input @error('koszt') w3-border-bottom w3-border-red w3-pale-red @enderror"
                               value="{{ old('koszt') }}">
                        @error('koszt')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Kategoria</label>
                        <select name="kategoria"
                                class="w3-select @error('kategoria') w3-border-bottom w3-border-red w3-pale-red @enderror"
                                id="">
                            <option value="{{NULL}}" disabled selected>Wybierz kategorię</option>
                            @foreach($categories as $cateogry)
                                <option value="{{$cateogry->id}}"
                                        style="background-color: {{$cateogry->color}}">{{$cateogry->name}}</option>
                            @endforeach

                        </select>
                        @error('kategoria')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="submit" class="w3-button w3-black w3-hover-green" value="Dodaj">
                    <a href="{{url()->previous()}}"
                       class="w3-button w3-border w3-white w3-hover-yellow text-decoration-none">Anuluj</a>

                </form>
            </div>
        </div>

    </div>
@endsection