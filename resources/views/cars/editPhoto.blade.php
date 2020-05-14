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
                @if($car->photo == '' || !$car->photo)
                    <h3>Wybrany samochód nie posiada zdjęcia</h3>
                @else
                    Obecne zdjęcie:
                    <img @if($car->photo == '' || !$car->photo)
                         src="{{asset('photos/default.png')}}"
                         @else
                         src="{{asset($car->photo)}}"
                         @endif
                         alt="Car photo" style="width:100%">
                    <form action="/cars/{{$car->id}}/delete/photo" method="POST" enctype="multipart/form-data">
                        {{--   <input type="hidden" name="_method" value="PUT">--}}
                        @csrf
                        <div class="form-group">
                            <input type="submit" class="w3-button w3-black w3-hover-red confirm" data-txt="Czy na pewno chcesz uusnąć zdjęcie?" value="Usuń zdjęcie">
                        </div>
                    </form>
                @endif




                <form action="/cars/{{$car->id}}/edit/photo" method="POST" enctype="multipart/form-data">
                    {{--   <input type="hidden" name="_method" value="PUT">--}}
                    @csrf

                    <div class="form-group mt-5">
                        <label>Wgraj nowe zdjęcie samochodu</label><br/>
                        <span class="text-black-50">Obecne zdjęcie zostanie zastąpione przesłanym zdjęciem</span>
                        <input type="file" name="car_photo" accept="image/*"
                               @error('car_photo') class=" w3-border-bottom w3-border-red w3-pale-red"
                               @enderror value="{{ old('car_photo') }}">
                        <div class="text-black-50 h6">Maksymalny rozmiar zdjęcia to 7MB.</div>
                        @error('car_photo')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <input type="submit" class="w3-button w3-black w3-hover-green" value="Zapisz">
                    <a href="{{url()->previous()}}"
                       class="w3-button w3-border w3-white w3-hover-yellow text-decoration-none">Anuluj</a>
                </form>
            </div>
        </div>

    </div>
@endsection