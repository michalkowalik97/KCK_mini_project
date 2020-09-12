@extends('layouts.app')

@section('title')
    - Lista samochodów
@endsection

@section('links')
    @component('components.links',['car'=>$car,'active'=>"statystyki"] )
    @endcomponent


@endsection

@section('content')
    <div id="app">

        <div class="row ml-5">
            <div class="col-12 ml-5">

                Wybierz zakres dat <br>
            </div>
            <form action="" class="p-3 ml-5 form-inline w3-right">


                <div class="form-group pull-right">
                    <label for="">Od</label>
                    <input type="date" class="form-control" name="from" value="{{Request::get('from')}}">
                    <label for="">do</label>
                    <input type="date" class="form-control" name="to" value="{{Request::get('to')}}">
                    <button type="submit" class="form-control" ><i class="fa fa-search"></i></button>
                </div>

            </form>
        </div>
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

