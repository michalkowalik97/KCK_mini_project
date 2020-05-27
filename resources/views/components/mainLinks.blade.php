@php
    $links=
    [

    /*"Koszty"=>"/user/costs",
    "Paliwo"=>"/user/fuel",
     "Statystyki"=>"/user/stats"*/

    "Koszty"=>'#',
    "Paliwo"=>'#',
    "Statystyki"=>'#',
     ];
@endphp

@isset($links)
    @foreach($links as $key => $link)

        <li class="nav-item @if(strtolower($key) == strtolower($active)) active @endif "><a class="nav-link"
                                                                                            href="{{$link}}">{{$key}}</a>
        </li>
    @endforeach
@endisset