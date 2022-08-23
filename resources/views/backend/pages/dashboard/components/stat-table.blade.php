@php
$headers = ['id', 'name', 'status', 'today', 'yesterday', 'this-week', 'last-week', 'this-month', 'last-month'];
$table_data = [];
foreach ($tables as $name => $value) {
    $data_array = [];
    foreach ($value as $key => $user) {
        $data_array[$key]['id'] = $key + 1;
        $data_array[$key]['name'] = $user->name;
        foreach (config('constants.task_status') as $value) {
            $today = $user->getTodayStat($value);
            $yesterday = $user->getYesterdayStat($value);
            $this_week = $user->getThisWeekStat($value);
            $last_week = $user->getLastWeekStat($value);
            $this_month = $user->getThisMonthStat($value);
            $last_month = $user->getLastMonthStat($value);
            if ($today == 0 && $yesterday == 0 && $this_week == 0 && $last_week == 0 && $this_month == 0 && $last_month == 0) {
                // $data_array[$key]['status'][$value] = [];
            } else {
                $data_array[$key]['status'][$value] = [
                    'today' => $today,
                    'yesterday' => $yesterday,
                    'this-week' => $this_week,
                    'last-week' => $last_week,
                    'this-month' => $this_month,
                    'last-month' => $last_month,
                ];
            }
        }
    }
    $table_data[$name] = $data_array;
}

@endphp


<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-primary" role="tablist">
            @php
                $count = 0;
            @endphp
            @foreach ($table_data as $key => $data)
                @if ($data)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $count == 0 ? 'active' : '' }}" data-bs-toggle="tab"
                            href="#{{ $key }}" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-title">{{ ucwords($key) }}</div>
                            </div>
                        </a>
                    </li>
                    @php
                        $count++;
                    @endphp
                @endif
            @endforeach

        </ul>
        <div class="tab-content py-3">
            @php
                $count = 0;
            @endphp
            @foreach ($table_data as $key => $data)
                @if ($data)
                    <div class="tab-pane fade {{ $count == 0 ? 'show active' : '' }}" id="{{ $key }}"
                        role="tabpanel">
                        <div class="card radius-10 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0">{{ ucwords($key) }} Stats</h6>
                                </div>
                                <div class="table-responsive mt-2">
                                    <table class="table align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                @foreach ($headers as $header)
                                                    <th class="text-center">
                                                        {{ unSlug($header) }}
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $arr)
                                                <tr>
                                                    <td> {{ $arr['id'] }}</td>
                                                    <td> {{ $arr['name'] }}</td>
                                                    <td>
                                                        <table class="table align-middle mb-0">
                                                            <thead class="table-light">
                                                                @foreach ($arr['status'] ?? [] as $status => $value)
                                                                    <tr>
                                                                        <th class="text-center">
                                                                            {{ unSlug($status) }}
                                                                        </th>
                                                                    </tr>
                                                                @endforeach
                                                            </thead>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="table align-middle mb-0">
                                                            <thead class="table-light">
                                                                @foreach ($arr['status'] ?? [] as $status => $value)
                                                                    <tr>
                                                                        <th class="text-center">
                                                                            {{ $value['today'] ? $value['today'] : '-' }}
                                                                        </th>
                                                                    </tr>
                                                                @endforeach
                                                            </thead>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="table align-middle mb-0">
                                                            <thead class="table-light">
                                                                @foreach ($arr['status'] ?? [] as $status => $value)
                                                                    <tr>
                                                                        <th class="text-center">
                                                                            {{ $value['yesterday'] ? $value['yesterday'] : '-' }}
                                                                        </th>
                                                                    </tr>
                                                                @endforeach
                                                            </thead>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="table align-middle mb-0">
                                                            <thead class="table-light">
                                                                @foreach ($arr['status'] ?? [] as $status => $value)
                                                                    <tr>
                                                                        <th class="text-center">
                                                                            {{ $value['this-week'] ? $value['this-week'] : '-' }}
                                                                        </th>
                                                                    </tr>
                                                                @endforeach
                                                            </thead>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="table align-middle mb-0">
                                                            <thead class="table-light">
                                                                @foreach ($arr['status'] ?? [] as $status => $value)
                                                                    <tr>
                                                                        <th class="text-center">
                                                                            {{ $value['last-week'] ? $value['last-week'] : '-' }}
                                                                        </th>
                                                                    </tr>
                                                                @endforeach
                                                            </thead>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="table align-middle mb-0">
                                                            <thead class="table-light">
                                                                @foreach ($arr['status'] ?? [] as $status => $value)
                                                                    <tr>
                                                                        <th class="text-center">
                                                                            {{ $value['this-month'] ? $value['this-month'] : '-' }}
                                                                        </th>
                                                                    </tr>
                                                                @endforeach
                                                            </thead>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="table align-middle mb-0">
                                                            <thead class="table-light">
                                                                @foreach ($arr['status'] ?? [] as $status => $value)
                                                                    <tr>
                                                                        <th class="text-center">
                                                                            {{ $value['last-month'] ? $value['last-month'] : '-' }}
                                                                        </th>
                                                                    </tr>
                                                                @endforeach
                                                            </thead>
                                                        </table>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $count++;
                    @endphp
                @endif
            @endforeach
        </div>
    </div>
</div>
