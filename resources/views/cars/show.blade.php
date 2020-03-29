@extends('layouts.app')

@section('title')
    - Lista samochodów
@endsection

@section('links')
    @component('components.links',
    ['links'=>["Koszty"=>"/car/".$car->id."/costs", "Statystyki"=>"/car/".$car->id."/stats"],
    'active'=>"statystyki"]
    )
    @endcomponent

@endsection

@section('content')
    <div id="app">
        <div class="row justify-content-center">
            <div class="col-10">
                {!! $costs->container() !!}
            </div>
        </div>
        <br><br>
        <div class="row justify-content-center">
            <div class="col-10">
                {!! $mileage->container() !!}
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    {!! $costs->script() !!}
    {!! $mileage->script() !!}

@endsection

