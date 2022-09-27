@php
$tables = $article->category->tables;
$ids = $tables->pluck('id')->toArray();
$allFields = \App\Models\Backend\TableField::whereIn('table_set_id', $ids)->get();
$articleTable = $article->tables;
$isBirthdayDisplay = 0;

// dd($articleTable);
@endphp

@foreach ($tables as $table)
    @php
        $tableKey = str_slug($table->title);
    @endphp
    @if (array_key_exists($tableKey, $articleTable ?? []))
        <div class="facts">
            <div class="heading">
                <div class="category-segment">
                    <span>{{ $table->title }}</span>
                </div>
            </div>
            <table class="table facts-table">
                <tbody>
                    @foreach ($allFields->where('table_set_id', $table->id) ?? [] as $field)
                        @php
                            $fieldKey = str_slug($field->title);
                        @endphp
                        @if (array_key_exists($fieldKey, $articleTable[$tableKey] ?? []))
                            @if (str_contains($field->title, 'Birth'))
                                @if (!$isBirthdayDisplay++)
                                    <tr>
                                        <td class="title">Birth Day</td>

                                        <td class="value">
                                            @foreach (['birth-day', 'birth-month', 'birth-year'] as $item)
                                                @if (array_key_exists($item, $articleTable[$tableKey] ?? []))
                                                    <a
                                                        href="{{ route('news.search', ['field' => $item, 'value' => $articleTable[$tableKey][$item]['value']]) }}">
                                                        {{ $articleTable[$tableKey][$item]['value'] }}
                                                        {{-- second last loop --}}
                                                        {{ $loop->remaining == 1 ? ',' : '' }}
                                                    </a>
                                                @endif
                                            @endforeach

                                        </td>
                                    </tr>
                                @endif
                            @else
                                <tr>
                                    <td class="title">{{ $field->title }}</td>
                                    @if ($field->searchable)
                                        <td class="value">
                                            <a
                                                href="{{ route('news.search', ['field' => $fieldKey, 'value' => $articleTable[$tableKey][$fieldKey]['value']]) }}">
                                                {{ $articleTable[$tableKey][$fieldKey]['value'] }}
                                            </a>
                                        </td>
                                    @else
                                        <td class="value">{{ $articleTable[$tableKey][$fieldKey]['value'] }}</td>
                                    @endif

                                </tr>
                            @endif
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endforeach
