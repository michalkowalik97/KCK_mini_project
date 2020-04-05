@extends('layouts.app')

@section('title')
    - Lista samochodów
@endsection

@section('links')
    @component('components.links',
    ['links'=>["Koszty"=>"/car/".$car->id."/costs", "Statystyki"=>"/car/".$car->id."/stats"],
    'active'=>"koszty"]
    )
    @endcomponent

@endsection

@section('content')
    <div id="app">
        <div class="row ml-4">
            <div class="col-11">
                <h3>Podsumowanie</h3>
            </div>
        </div>

        <div class="row ml-4">
            <div class="col-1">
                <h3></h3>
            </div>
        </div>
        <div class="row justify-content-center">


            <div class="col-11">
                <h3>Koszty w bieżącym miesiącu</h3>
                <table class="table table-hover table-bordered ">
                    <tr>
                        <th>Lp.</th>
                        <th>Opis</th>
                        <th>Data</th>
                        <th>Kategoria</th>
                    </tr>
                    @for($i = 1; $i <50; $i++)
                        <tr style="background-color: rgba({{rand(0,100)}},{{rand(0,255)}},{{rand(0,255)}},0.4)">
                            <td>{{$i}}</td>
                            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam pharetra venenatis ex vel congue. In cursus id sapien eu viverra. In bibendum, tellus non imperdiet aliquam, sem sapien ornare lectus, </td>
                            <td>{{now()}}</td>
                            <td>Lorem ipsum</td>
                        </tr>
                    @endfor
                </table>
            </div>
        </div>
        <br><br>

    </div>


@endsection

