@php
    $factsOrder = ['full-name', 'popular-name', 'birth-place', 'birth-month', 'birth-year', 'death-month', 'death-year', 'death-cause', 'age', 'nationality', 'ethnicity', 'father', 'mother', 'siblings', 'profession', 'net-worth', 'height', 'weight', 'body-measurement', 'gender-identity', 'marital-status', 'spouse', 'children'];


    $tables = $article->category->tables;
    $ids = $tables->pluck('id')->toArray();
    $allFields = \App\Models\Backend\TableField::whereIn('table_set_id', $ids)->get();


    $articleTable = $article->tables['quick-facts'];

    $birthFound = 0;
    $deathFound = 0;


    // Age Calculation

    function age($birthYear, $birthMonth=null, $birthDay=null, $deathYear=null, $deathMonth=null, $deathDay=null){
        $months = ['January'=>1, 'February'=>2,'March'=>3,'April'=>4,'May'=>5,'June'=>6,'July'=>7,'August'=>'8','September'=>9,'October'=>10,'November'=>11,'December'=>12 ];

        if (!$deathYear) {
            $day = carbon()->format('d');
            $month = carbon()->format('F');
            $year = carbon()->format('Y');


            if(!$birthMonth){
                return $year - $birthYear;
            }

            else if($birthMonth && $months[$month] - $months[$birthMonth] > 0){
                return $year - $birthYear;
            }
            else if($birthMonth && $months[$month] - $months[$birthMonth] == 0){
                if($birthDay){
                    if((int)$day - (int)$birthDay >= 0){
                        return $year - $birthYear;
                    }
                    else{
                        return $year - ($birthYear+1);
                    }
                }
                else{
                    return $year - $birthYear;
                }
            }
            else{
                return $year - ($birthYear +1);
            }
        }else{

            if(!$deathMonth && !$birthMonth){
                return $deathYear - $birthYear;
            }

            if($deathMonth && $months[$deathMonth] - $months[$birthMonth] > 0){
                return $deathYear - $birthYear;
            }
            else if($deathMonth && $months[$deathMonth] - $months[$birthMonth] == 0){
                if($deathDay){
                    if((int)$deathDay - (int)$birthDay >= 0){
                        return $deathYear - $birthYear;
                    }
                    else{
                        return $deathYear - ($birthYear+1);
                    }
                }
                else{
                    return $deathYear - $birthYear;
                }
            }
            else if($deathMonth && $months[$deathMonth] - $months[$birthMonth] < 0){
                return $deathYear - ($birthYear +1);
            }


        }


    }

@endphp

<div class="facts">
    <div class="heading">
        <div class="category-segment">
            <span>Quick Facts</span>
        </div>
    </div>
    <table class="table facts-table">
        <tbody>
            @foreach ($factsOrder as $factsFields)
                @if (isset($articleTable[$factsFields]))
                    @if($factsFields == 'birth-month' || $factsFields == 'birth-year')
                        @if ($birthFound == 0)
                            @php
                                $birthFound =1;
                            @endphp
                            <tr>
                                <td style="font-weight:bold;">
                                    Birthday
                                </td>
                                <td>
                                    @foreach ($allFields as $tbFields)

                                        @if ( $articleTable[$factsFields]['title'] == $tbFields['title'])

                                            @if($tbFields['searchable'] == 1)

                                                @if(isset($articleTable['birth-day']) && isset($articleTable['birth-month']))

                                                    <a style="color: #4da7df"
                                                        href="{{ route('facts.search', ['birth', str_slug($articleTable['birth-month']['value'].' '.$articleTable['birth-day']['value'])]) }}"
                                                    >

                                                        @if (isset($articleTable['birth-year']))
                                                            {{ $articleTable['birth-month']['value']}}&nbsp;{{ $articleTable['birth-day']['value']}},
                                                        @else
                                                            {{ $articleTable['birth-month']['value']}}&nbsp;{{ $articleTable['birth-day']['value']}}
                                                        @endif

                                                    </a>

                                                    @elseif (!isset($articleTable['birth-day']) && isset($articleTable['birth-month']))

                                                    <a style="color: #4da7df" href="{{ route('facts.search', [$factsFields, $articleTable[$factsFields]['value']]) }}">
                                                        {{ $articleTable['birth-month']['value']}}
                                                    </a>

                                                @endif

                                                @if (isset($articleTable['birth-year']))
                                                    <a style="color: #fa6237" href="{{ route('facts.search', ['birth-year', ($articleTable['birth-year']['value'])]) }}">
                                                       {{ $articleTable['birth-year']['value']}}
                                                    </a>
                                                @endif


                                            @else

                                                {{ $articleTable['birth-month']['value'] }}&nbsp;{{ $articleTable['birth-day']['value'] }},&nbsp;{{ $articleTable['birth-year']['value'] }}

                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    @elseif ($factsFields == 'death-month' || $factsFields == 'death-year')
                        @if ($deathFound == 0)
                            @php
                                $deathFound =1;
                            @endphp
                            <tr>
                                <td style="font-weight:bold;">
                                    Death
                                </td>
                                <td>
                                    @foreach ($allFields as $tbFields)

                                        @if ( $articleTable[$factsFields]['title'] == $tbFields['title'])

                                            @if($tbFields['searchable'] == 1)

                                                @if(isset($articleTable['death-day']) && isset($articleTable['death-month']))

                                                    <a style="color: #4da7df"
                                                        href="{{ route('facts.search', ['death', str_slug($articleTable['death-month']['value'].' '.$articleTable['death-day']['value'])]) }}"
                                                    >

                                                        @if (isset($articleTable['death-year']))
                                                            {{ $articleTable['death-month']['value']}}&nbsp;{{ $articleTable['death-day']['value']}},
                                                        @else
                                                            {{ $articleTable['death-month']['value']}}&nbsp;{{ $articleTable['death-day']['value']}}
                                                        @endif

                                                    </a>

                                                    @elseif (!isset($articleTable['death-day']) && isset($articleTable['death-month']))

                                                    <a style="color: #4da7df" href="{{ route('facts.search', [$factsFields, $articleTable[$factsFields]['value']]) }}">
                                                        {{ $articleTable['death-month']['value']}}
                                                    </a>

                                                @endif

                                                @if (isset($articleTable['death-year']))
                                                    <a style="color: #fa6237" href="{{ route('facts.search', ['death-year', ($articleTable['death-year']['value'])]) }}">
                                                    {{ $articleTable['death-year']['value']}}
                                                    </a>
                                                @endif
                                            @else
                                                {{-- From Here --}}
                                                @if(isset($articleTable['death-day']) && isset($articleTable['death-month']))

                                                    @if (isset($articleTable['death-year']))

                                                        {{ $articleTable['death-month']['value']}}&nbsp;{{ $articleTable['death-day']['value']}},

                                                    @else

                                                        {{ $articleTable['death-month']['value']}}&nbsp;{{ $articleTable['death-day']['value']}}

                                                    @endif
                                                @elseif (!isset($articleTable['death-day']) && isset($articleTable['death-month']))

                                                    {{ $articleTable['death-month']['value']}}

                                                @endif

                                                @if (isset($articleTable['death-year']))

                                                    {{ $articleTable['death-year']['value']}}

                                                @endif

                                                {{-- Till Here --}}
                                            @endif
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    @else
                        <tr>
                            <td style="font-weight:bold;">
                                {{ $articleTable[$factsFields]['title'] }}
                            </td>
                            <td>
                                @foreach ($allFields as $tbFields)
                                    @if ( $articleTable[$factsFields]['title'] == $tbFields['title'])
                                        @if($tbFields['searchable'] == 1)
                                            <a style="color: #4da7df" href="{{ route('facts.search', [$factsFields, ($articleTable[$factsFields]['value'])]) }}">{{ $articleTable[$factsFields]['value'] }}</a>
                                        @else
                                            {{ $articleTable[$factsFields]['value'] }}
                                        @endif
                                   @endif
                                @endforeach
                            </td>
                        </tr>
                    @endif
                @elseif($factsFields == 'age')
                    @if (isset($articleTable['birth-year']))
                        <tr>
                            <td style="font-weight:bold;">
                                Age
                            </td>

                            @if (!isset($articleTable['death-year']))

                                <td>

                                    @if(!isset($articleTable['birth-month']) && !isset($articleTable['birth-day']))

                                        {{ age($articleTable['birth-year']['value']) }}

                                    @elseif(isset($articleTable['birth-month']) && !isset($articleTable['birth-day']))

                                        {{ age($articleTable['birth-year']['value'], $articleTable['birth-month']['value']) }}

                                    @elseif (isset($articleTable['birth-month']) && isset($articleTable['birth-day']))

                                        {{ age($articleTable['birth-year']['value'], $articleTable['birth-month']['value'], $articleTable['birth-day']['value']) }}


                                    @endif

                                </td>

                            @elseif (isset($articleTable['death-year']))
                                <td>

                                    @if(isset($articleTable['birth-month']) && !isset($articleTable['birth-day']))
                                        @if (isset($articleTable['death-month']))

                                            {{ age($articleTable['birth-year']['value'], $articleTable['birth-month']['value'], null, $articleTable['death-year']['value'], $articleTable['death-month']['value']) }}

                                        @else

                                            {{ age($articleTable['birth-year']['value'], $articleTable['birth-month']['value'], null,  $articleTable['death-year']['value']) }}

                                        @endif


                                    @elseif (isset($articleTable['birth-month']) && isset($articleTable['birth-day']))

                                        @if (isset($articleTable['death-month']) && !isset($articleTable['death-day']))

                                            {{ age($articleTable['birth-year']['value'], $articleTable['birth-month']['value'], null, $articleTable['death-year']['value'], $articleTable['death-month']['value']) }}

                                        @elseif(isset($articleTable['death-month']) && isset($articleTable['death-day']))

                                            {{ age($articleTable['birth-year']['value'], $articleTable['birth-month']['value'], $articleTable['birth-day']['value'] , $articleTable['death-year']['value'], $articleTable['death-month']['value'], $articleTable['death-day']['value']) }}

                                        @else

                                            {{ age($articleTable['birth-year']['value'], null, null, $articleTable['death-year']['value'], null, null) }}

                                        @endif
                                    @else
                                        {{ age($articleTable['birth-year']['value'], null, null, $articleTable['death-year']['value'], null, null) }}

                                    @endif

                                </td>

                            @endif
                        </tr>
                    @endif
                @endif
            @endforeach
        </tbody>
    </table>
</div>
