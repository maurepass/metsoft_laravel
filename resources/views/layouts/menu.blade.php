@if(Request::is(['offers*', 'tech*', 'reports*', 'patterns', 'patterns/create', 'patterns/*/edit', 'patterns/patterns-report', '*patterns-status*']))
    <nav class="navbar navbar-custom" @if(Request::is('*8088')) style="background-color: #0f7c30" @endif>
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                @if(Request::is(['offers*', 'tech*']) || (Auth::check() && Auth::user()->name == 'marcin'))
                    <li><a href="{{ route('offers.index') }}">Oferty</a></li>
                @endif

                <li><a href="http://192.168.1.185/"  target="_blade">Kokila</a></li>

                @if(Request::is(['offers*', 'tech*']))
                    <li><a href="{{ route('orders.index') }}">Zlecenia</a></li>
                @endif

                @if(Request::is(['offers*', 'reports*', 'tech*']))
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Raporty (Kokila)<span class="caret"></span></a>
                        <ul class="dropdown-menu" style="font-size:large" >
                            <li><a href="{{ route('monitoring-in-work') }}" >Monitoring odlewów w produkcji</a></li>
                            <li><a href="{{ route('monitoring-all') }}" >Monitoring odlewów (wszystkie zlecenia)</a></li>
                            <li><a href="{{ route('odbiory') }}">Rejestr odbiorów</a></li>
                            <li><a href="{{ route('zalania') }}">Rejestr zalań</a></li>
                            <li><a href="{{ route('niezgodnosci') }}">Rejestr niezgodnych operacji</a></li>
                            <li><a href="{{ route('zaformowane') }}">Rejestr zaformowań</a></li>
                            <li><a href="{{ route('badania-ndt') }}">Rejestr badań</a></li>
                            <li><a href="{{ route('machining') }}">Rejestr wykonanych obróbek mechanicznych</a></li>
                            <li><a href="{{ route('uwagi') }}">Rejestr uwag do zatwierdzonych operacji</a></li>
                            <li><a href="{{ route('czas-wykonania') }}" >Międzyczasy wykonania odlewów</a></li>
                            <li><a href="{{ route('weight-per-client') }}">Tonaż odlewów do wykonania wg klientów</a></li>
                            <li><a href="{{ route('weight-per-group') }}" >Tonaż odlewów do wykonania wg grup kalkulacyjnych</a></li>
                            <li><a href="{{ route('wybraki') }}">Rejestr wybraków</a></li>
                            <li><a href="{{ route('wagi-odlewow') }}">Rejestr operacji ważenia</a></li>
                            <li><a href="{{ route('magazyn') }}"> Stan magazynowy</a></li>
                            <li><a href="{{ route('inserted-datas') }}">Rejest wpisanych danych</a></li>
                            <li><a href="{{ route('uzyski') }}"> Uzyski wg KO</a></li>
                        </ul>
                    </li>
                @endif

                @if(Request::is(['offers*', 'tech*']))
                    <li><a href="{{ route('offers.create') }}">Dodaj ofertę</a></li>
                    <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Detale<span class="caret"></span></a>
                            <ul class="dropdown-menu" style="font-size:large" >
                                <li><a href="{{ route('offers.details') }}" >Wszystkie</a></li>
                                <li><a href="{{ route('offers.details-searching') }}" >Wyszukiwanie</a></li>
                            </ul>
                        </li>
                    <li><a href="{{ route('offers.materials.index') }}">Materiały</a></li>
                    <li><a href="{{ route('offers.stats') }}">Statystyki</a></li>
                @endif

                <li><a href="{{ route('patterns.index') }}">Modele</a></li>

                @if(Request::is(['patterns', 'patterns/create', 'patterns/*/edit', 'patterns/patterns_raport', '*patterns-status*']))
                    @can('modelarnia')
                        <li><a href="{{ route('patterns.create') }}">Dodaj model</a></li>
                    @endcan
                {{-- <li><a href="/patterns_search">Wyszukiwanie</a></li> --}}
                    <li><a target="_blank" href="{{ route('patterns.report-form') }}">Raport (modele)</a></li>
                @endif
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li style="float: right"><a href="{{ route('logout') }}">Wyloguj</a></li>
                @else
                    <li style="float: right"><a href="{{ route('login') }}">Zaloguj</a></li>
                @endif
            </ul>
        </div>
    </nav>
@endif
