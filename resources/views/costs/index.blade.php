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

                    <div class="row">
                        <div class="col-12">

                            Filtruj <br>
                        </div>
                        <form action="" class="form-inline py-3" id="form">

                            <div class="form-group">
                                <select name="category" class="form-control" onchange="document.getElementById('form').submit()">
                                    <option value="null" selected>Wszystkie kategorie</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if(Request::get('category') == $category->id)selected @endif>
                                            {{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <select name="sort" class="form-control" onchange="document.getElementById('form').submit()">
                                    <option value="null" disabled selected> Sortuj</option>
                                    <option value="mileage-asc" @if(Request::get('sort') =='mileage-asc') selected @endif > Przebieg rosnąco</option>
                                    <option value="mileage-desc" @if(Request::get('sort') =='mileage-desc') selected @endif > Przebieg malejąco</option>
                                    <option value="value-asc" @if(Request::get('sort') =='value-asc') selected @endif > Kwota rosnąco</option>
                                    <option value="value-desc" @if(Request::get('sort') =='value-desc') selected @endif > Kwota malejąco</option>
                                    <option value="created_at-asc" @if(Request::get('sort') =='created_at-asc') selected @endif > Data rosnąco</option>
                                    <option value="created_at-desc" @if(Request::get('sort') =='created_at-desc') selected @endif > Data malejąco</option>
                                </select>
                            </div>
                        </form>
                    </div>

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

                        <tr>
                            <td colspan="2">Suma</td>

                            <td>{{ number_format($costs->sum('value'),2,".",' ')  }} zł</td>
                        </tr>
                    </table>
                @endif
    {{--            {{$costs->links()}}--}}
            </div>
        </div>
        <br><br>

    </div>


@endsection

