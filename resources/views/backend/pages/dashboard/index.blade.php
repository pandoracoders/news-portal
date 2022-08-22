@extends('backend.layouts.index')

@push('styles')
    <!--plugins-->
    <link href="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <!--plugins-->
    <script src="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/chartjs/chart.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/index.js"></script>
@endpush


@section('content')
    @php
    $headers = ['id', 'name', 'status', 'today', 'yesterday', 'this-week', 'last-week', 'this-month', 'last-month'];
    $data_array = [];
    foreach ($writers as $key => $writer) {
        $data_array[$key]['id'] = $key + 1;
        $data_array[$key]['name'] = $writer->name;
        foreach (config('constants.task_status') as $value) {
            $today = $writer->getTodayStat($value);
            $yesterday = $writer->getYesterdayStat($value);
            $this_week = $writer->getThisWeekStat($value);
            $last_week = $writer->getLastWeekStat($value);
            $this_month = $writer->getThisMonthStat($value);
            $last_month = $writer->getLastMonthStat($value);
            if ($today == 0 && $yesterday == 0 && $this_week == 0 && $last_week == 0 && $this_month == 0 && $last_month == 0) {

            } else {
                $data_array[$key]['status'][$value] = [
                    'today' => $writer->getTodayStat($value),
                    'yesterday' => $writer->getYesterdayStat($value),
                    'this-week' => $writer->getThisWeekStat($value),
                    'last-week' => $writer->getLastWeekStat($value),
                    'this-month' => $writer->getThisMonthStat($value),
                    'last-month' => $writer->getLastMonthStat($value),
                ];
            }
        }
    }

    @endphp
    <div class="card radius-10 w-100">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h6 class="mb-0">Writer Stats</h6>
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
                        @foreach ($data_array as $key => $arr)
                            <tr>
                                <td> {{ $arr['id'] }}</td>
                                <td> {{ $arr['name'] }}</td>
                                <td>
                                    <table class="table align-middle mb-0">
                                        <thead class="table-light">
                                            @foreach ($arr['status'] as $status => $value)
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
                                            @foreach ($arr['status'] as $status => $value)
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
                                            @foreach ($arr['status'] as $status => $value)
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
                                            @foreach ($arr['status'] as $status => $value)
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
                                            @foreach ($arr['status'] as $status => $value)
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
                                            @foreach ($arr['status'] as $status => $value)
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
                                            @foreach ($arr['status'] as $status => $value)
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

    <div class="card radius-10 w-100">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h6 class="mb-0">Recent Orders</h6>
                <div class="fs-5 ms-auto dropdown">
                    <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i
                            class="bi bi-three-dots"></i></div>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
            <div class="table-responsive mt-2">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#ID</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#89742</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img src="https://via.placeholder.com/110X110/212529/fff" alt="">
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">Smart Mobile Phone</h6>
                                    </div>
                                </div>
                            </td>
                            <td>2</td>
                            <td>$214</td>
                            <td><span class="badge alert-dark">Completed</span></td>
                            <td>Apr 8, 2021</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                        aria-label="Views">
                                        <ion-icon name="eye-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                        aria-label="Edit">
                                        <ion-icon name="pencil-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                        aria-label="Delete">
                                        <ion-icon name="trash-sharp"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#68570</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img src="https://via.placeholder.com/110X110/212529/fff" alt="">
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">Sports Time Watch</h6>
                                    </div>
                                </div>
                            </td>
                            <td>1</td>
                            <td>$185</td>
                            <td><span class="badge alert-dark">Completed</span></td>
                            <td>Apr 9, 2021</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                        aria-label="Views">
                                        <ion-icon name="eye-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                        aria-label="Edit">
                                        <ion-icon name="pencil-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                        aria-label="Delete">
                                        <ion-icon name="trash-sharp"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#38567</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img src="https://via.placeholder.com/110X110/212529/fff" alt="">
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">Women Red Heals</h6>
                                    </div>
                                </div>
                            </td>
                            <td>3</td>
                            <td>$356</td>
                            <td><span class="badge alert-dark">Cancelled</span></td>
                            <td>Apr 10, 2021</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                        aria-label="Views">
                                        <ion-icon name="eye-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                        aria-label="Edit">
                                        <ion-icon name="pencil-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                        aria-label="Delete">
                                        <ion-icon name="trash-sharp"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#48572</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img src="https://via.placeholder.com/110X110/212529/fff" alt="">
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">Yellow Winter Jacket</h6>
                                    </div>
                                </div>
                            </td>
                            <td>1</td>
                            <td>$149</td>
                            <td><span class="badge alert-dark">Completed</span></td>
                            <td>Apr 11, 2021</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                        aria-label="Views">
                                        <ion-icon name="eye-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                        aria-label="Edit">
                                        <ion-icon name="pencil-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                        aria-label="Delete">
                                        <ion-icon name="trash-sharp"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#96857</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img src="https://via.placeholder.com/110X110/212529/fff" alt="">
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">Orange Micro Headphone</h6>
                                    </div>
                                </div>
                            </td>
                            <td>2</td>
                            <td>$199</td>
                            <td><span class="badge alert-dark">Cancelled</span></td>
                            <td>Apr 15, 2021</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                        aria-label="Views">
                                        <ion-icon name="eye-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                        aria-label="Edit">
                                        <ion-icon name="pencil-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                        aria-label="Delete">
                                        <ion-icon name="trash-sharp"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>#96857</td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="product-box border">
                                        <img src="https://via.placeholder.com/110X110/212529/fff" alt="">
                                    </div>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">Pro Samsung Laptop</h6>
                                    </div>
                                </div>
                            </td>
                            <td>1</td>
                            <td>$699</td>
                            <td><span class="badge alert-dark">Pending</span></td>
                            <td>Apr 18, 2021</td>
                            <td>
                                <div class="d-flex align-items-center gap-3 fs-6">
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                        aria-label="Views">
                                        <ion-icon name="eye-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                        aria-label="Edit">
                                        <ion-icon name="pencil-sharp"></ion-icon>
                                    </a>
                                    <a href="javascript:;" class="text-dark" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                        aria-label="Delete">
                                        <ion-icon name="trash-sharp"></ion-icon>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
