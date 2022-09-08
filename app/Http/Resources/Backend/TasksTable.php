<?php

namespace App\Http\Resources\Backend;

use App\Models\Backend\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksTable extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {


       $tables = [
            'writers' => User::writer()->get(),
            'editors' => User::editor()->get(),
       ];

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

$html = `
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs nav-primary" role="tablist">`;
        $count = 0;
        foreach ($table_data as $key => $data) {
           if($data){
           $html .=`<li class="nav-item" role="presentation">
            <a class="nav-link" data-bs-toggle="tab"
                href="#$key" role="tab" aria-selected="true">
                <div class="d-flex align-items-center">
                    <div class="tab-title">`. ucwords($key) .`</div>
                </div>
            </a>
        </li>`;

        $count ++;
           }
        }

        $html .=`

        </ul>
        <div class="tab-content py-3">`;

        foreach ($table_data as $key => $data) {
            if($data){
            $html =`
                    <div class="tab-pane fade" id="$key"
                        role="tabpanel">
                        <div class="card radius-10 w-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0">`.ucwords($key) .`Stats</h6>
                                </div>
                                <div class="table-striped mt-2">
                                    <table class="table table-striped table-bordered align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>`;
                                                foreach ($headers as $header){
                                                    $html .= `<th class="text-center">
                                                        `. unSlug($header) .`
                                                    </th>`;
                                                }
                                           $html .= `</tr>
                                        </thead>
                                        <tbody>`;
                                            foreach ($data as $key => $arr){
                                              $html .=`  <tr>
                                                    <td>`.  $arr["id"] . `</td>
                                                    <td> `. $arr['name'] .`</td>
                                                    <td>
                                                        <table class="table-striped table-bordered align-middle mb-0">
                                                            <thead class="table-light">`;
                                                                foreach ($arr['status'] ?? [] as $status => $value){
                                                                   $html .= `<tr>
                                                                        <th class="text-center">`.
                                                                            unSlug($status)
                                                                       .` </th>
                                                                    </tr> `;
                                                                }
                                                           $html .= ` </thead>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="table table-striped table-bordered align-middle mb-0">
                                                            <thead class="table-light"> `;
                                                                foreach ($arr['status'] ?? [] as $status => $value)
                                                                   $html .=` <tr>
                                                                        <th class="text-center"> `.
                                                                            $value['today'] ? $value['today'] : '-'
                                                                       .` </th>
                                                                    </tr> `;
                                                            }
                                                           $html .= ` </thead>
                                                        </table>
                                                    </td>
                                                    <td>

                                                        <table class="table table-striped table-bordered align-middle mb-0">
                                                            <thead class="table-light"> `;
                                                                foreach ($arr['status'] ?? [] as $status => $value)
                                                                   $html .=` <tr>
                                                                        <th class="text-center"> `.
                                                                            $value['yesterday'] ? $value['yesterday'] : '-'
                                                                       .` </th>
                                                                    </tr> `;
                                                            }
                                                           $html .= ` </thead>
                                                        </table>
                                                    </td>
                                                    <td>

                                                        <table class="table table-striped table-bordered align-middle mb-0">
                                                            <thead class="table-light"> `;
                                                                foreach ($arr['status'] ?? [] as $status => $value){
                                                                   $html .=` <tr>
                                                                        <th class="text-center"> `.
                                                                            $value['this-week'] ? $value['this-week'] : '-'
                                                                       .` </th>
                                                                    </tr> `;
                                                            }
                                                           $html .= ` </thead>
                                                        </table>
                                                    </td>
                                                    <td>


                                                        <table class="table table-striped table-bordered align-middle mb-0">
                                                            <thead class="table-light"> `;
                                                                foreach ($arr['status'] ?? [] as $status => $value){
                                                                   $html .=` <tr>
                                                                        <th class="text-center"> `.
                                                                            $value['last-week'] ? $value['last-week'] : '-'
                                                                       .` </th>
                                                                    </tr> `;
                                                            }
                                                           $html .= ` </thead>
                                                        </table>
                                                    </td>
                                                    <td>


                                                        <table class="table table-striped table-bordered align-middle mb-0">
                                                            <thead class="table-light"> `;
                                                                foreach ($arr['status'] ?? [] as $status => $value){
                                                                   $html .=` <tr>
                                                                        <th class="text-center"> `.
                                                                            $value['this-month'] ? $value['this-month'] : '-'
                                                                       .` </th>
                                                                    </tr> `;
                                                            }
                                                           $html .= ` </thead>
                                                        </table>
                                                    </td>
                                                    <td>

                                                        <table class="table table-striped table-bordered align-middle mb-0">
                                                            <thead class="table-light"> `;
                                                                foreach ($arr['status'] ?? [] as $status => $value){
                                                                   $html .=` <tr>
                                                                        <th class="text-center"> `.
                                                                            $value['last-month'] ? $value['last-month'] : '-'
                                                                       .` </th>
                                                                    </tr> `;
                                                            }
                                                           $html .= ` </thead>
                                                        </table>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>`;

                        $count++;

                                                    }

      $html .=`  </div>
    </div>
</div>`;

return $html;
    }
}
