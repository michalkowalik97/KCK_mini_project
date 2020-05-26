@extends('layouts.app')

@section('title')
    - Lista samochodów
@endsection

@section('links')
    @component('components.links',['car'=>$car,'active'=>"koszty"] )
    @endcomponent


@endsection

@section('content')
    <div id="app">


        <div class="row ml-4">
            <div class="col-1">
                <h3></h3>
            </div>
        </div>
        <div class="row justify-content-center">


            <div class="col-11">
                <h3><a href="/cars/{{$car->id}}" class="text-decoration-none">{{$car->renderName()}}</a> <br/><br/>
                    Podsumowanie kosztów</h3>
                <span class="float-right mb-2"> <a
                            href="/car/{{$car->id}}/cost/add" class="w3-button w3-hover-green w3-black w3-tiny">Dodaj <i
                                class="fas fa-plus"></i></a> </span>
                @if(count($costs) <= 0)
                    <div class="col-10 mr-5 {{--py-3--}} w3-panel w3-blue ">
                        Samochód nie posiada jeszcze żadnych wpisów.
                    </div>

                @else
                    <table class="table table-hover table-bordered ">
                        <tr>
                            <th>Lp.</th>
                            <th>Opis</th>
                            <th>Kwota</th>
                            <th>Przy przebiegu</th>
                            <th>Kategoria</th>
                            <th>Data</th>
                        </tr>
                        @foreach($costs as $key => $cost)
                            <tr style="background-color: {{$cost->repair->category->color}}">
                                <td> {{++$key}} </td>
                                <td> {{$cost->repair->name}} </td>
                                <td> {{number_format($cost->value,0,".",' ')  }} zł</td>
                                <td> @if($cost->mileage > 0) {{number_format($cost->mileage,0,".",' ')  }} km @else
                                        - @endif</td>
                                <td>{{$cost->repair->category->name}}</td>
                                <td>{{$cost->repair->created_at}}</td>
                            </tr>

                        @endforeach

                        {{--       @for($i = 1; $i <50; $i++)
                                   <tr style="background-color: rgba({{rand(0,100)}},{{rand(0,255)}},{{rand(0,255)}},0.4)">
                                       <td>{{$i}}</td>
                                       <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam pharetra venenatis
                                           ex vel congue. In cursus id sapien eu viverra. In bibendum, tellus non imperdiet
                                           aliquam, sem sapien ornare lectus,
                                       </td>
                                       <td>{{now()}}</td>
                                       <td>Lorem ipsum</td>
                                   </tr>
                               @endfor--}}
                        <tr>
                            <td colspan="2">Suma</td>

                            <td>{{ number_format($costs->sum('value'),2,".",' ')  }} zł</td>
                        </tr>
                    </table>
                @endif
                    {{$costs->links()}}
            </div>
        </div>
        <br><br>

    </div>


@endsection

