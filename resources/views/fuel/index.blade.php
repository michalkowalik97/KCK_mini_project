@extends('layouts.app')

@section('title')
    - Lista samochodów
@endsection

@section('links')
    @component('components.links',['car'=>$car,'active'=>"paliwo"] )
    @endcomponent
 {{--   @component('components.links',
    ['links'=>["Podsumowanie"=>"/cars/".$car->id,"Koszty"=>"/car/".$car->id."/costs", "Statystyki"=>"/car/".$car->id."/stats"],
    'active'=>"koszty"]
    )
    @endcomponent--}}

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
                    Podsumowanie kosztów paliwa</h3>
                <span class="float-right mb-2"> <a
                            href="/car/{{$car->id}}/fuel/add" class="w3-button w3-hover-green w3-black w3-tiny">Dodaj <i
                                class="fas fa-plus"></i></a> </span>
                @if(count($fuel) <= 0)
                    <div class="col-10 mr-5 {{--py-3--}} w3-panel w3-blue ">
                        Samochód nie posiada jeszcze żadnych wpisów.
                    </div>

                @else
                    <div class="row">
                        <div class="col-12">

                            Filtruj <br>
                        </div>
                        <form action="#" class="form-inline py-3">

                            <div class="form-group">
                                <select name="" class="form-control" id="">
                                    <option value="">Wszystkie paliwa</option>
                                    <option value="">Benzyna</option>
                                    <option value="">Ropa</option>
                                    <option value="">Gaz</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <select name="sort" class="form-control">
                                    <option value="null" disabled selected> Sortuj</option>
                                    <option value=""> Kwota malejąco</option>
                                    <option value=""> Kwota rosnąco</option>
                                    <option value=""> Ilość rosnąco</option>
                                    <option value=""> Ilość malejąco</option>
                                    <option value=""> Cena za litr rosnąco</option>
                                    <option value=""> Cena za litr malejąco</option>
                                    <option value=""> Data malejąco</option>
                                    <option value=""> Data rosnąco</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <table class="table table-hover table-bordered ">
                        <tr>
                            <th>Lp.</th>
                            <th>Kwota</th>
                            <th>Ilość</th>
                            <th>Cena za litr</th>
                            <th>Paliwo</th>
                            <th>Data</th>
                        </tr>
                        @foreach($fuel as $key => $f)
                            <tr>
                                <td> {{++$key}} </td>
                                <td> {{number_format($f->value,2,".",' ')  }} zł</td>
                                <td> {{number_format($f->quantity,2,".",' ')  }}</td>
                                <td> {{number_format($f->price,2,".",' ')  }} zł</td>
                                <td> {{$car->fuelName($f->type)}} </td>
                                <td>{{$f->created_at}}</td>
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
                            <td  >Suma</td>

                            <td>{{ number_format($fuel->sum('value'),2,".",' ')  }} zł</td>
                            <td>{{ number_format($fuel->sum('quantity'),2,".",' ')  }}</td>
                        </tr>
                    </table>
                @endif
                   {{-- {{$fuel->links()}}--}}
            </div>
        </div>
        <br><br>

    </div>


@endsection

