<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\TasksTable;
use App\Models\Backend\Article;
use App\Models\Backend\User;
use BaconQrCode\Writer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $writers = User::writer()->get();
        // return ($writers);
        return view('backend.pages.dashboard.index', [
            'tables' => [
                'writers' => $writers,
                'editors' => User::editor()->get(),
            ],
            'todays_posts' => Article::where('created_at', '=', Carbon::today())->count(),
            'yesterday_posts' => Article::where('created_at', '=', Carbon::yesterday())->count(),
            'total_posts' => Article::count(),
            'total_writers' => User::writer()->count(),
            'total_editors' => User::editor()->count(),
        ]);
    }

    public function table(){
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
                 $today = (int) $user->getTodayStat($value);
                 $yesterday = (int) $user->getYesterdayStat($value);
                 $this_week = (int) $user->getThisWeekStat($value);
                 $last_week = (int) $user->getLastWeekStat($value);
                 $this_month = (int) $user->getThisMonthStat($value);
                 $last_month = (int) $user->getLastMonthStat($value);
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

     $html = '
     <div class="card">
         <div class="card-body">
             <ul class="nav nav-tabs nav-primary" role="tablist">';
             $count = 0;
             foreach ($table_data as $key => $data) {
                if($data){
                $html .='<li class="nav-item "  role="presentation">
                 <a class="nav-link '. ($count == 0 ? 'active' : '').'" data-bs-toggle="tab"
                     href="#'.$key.'" role="tab" aria-selected="true">
                     <div class="d-flex align-items-center">
                         <div class="tab-title">'. ucwords($key) .'</div>
                     </div>
                 </a>
             </li>';

             $count ++;
                }
             }

             $html .='

             </ul>
             <div class="tab-content py-3">';
             $count= 0;
             foreach ($table_data as $key => $data) {
                 if($data){

                 $html .='
                         <div class="tab-pane fade '. ($count == 0 ? 'show active' : '').'" id="'.$key.'"
                             role="tabpanel">
                             <div class="card radius-10 w-100">
                                 <div class="card-body">
                                     <div class="d-flex align-items-center">
                                         <h6 class="mb-0">'.ucwords($key) .'Stats</h6>
                                     </div>
                                     <div class="table-responsive mt-2">
                                         <table class="table align-middle mb-0">
                                             <thead class="table-light">
                                                 <tr>';
                                                     foreach ($headers as $header){
                                                         $html .= '<th class="text-center">
                                                             '. unSlug($header) .'
                                                         </th>';
                                                     }
                                                $html .= '</tr>
                                             </thead>
                                             <tbody>';
                                                 foreach ($data as $key => $arr){
                                                   $html .='<tr>
                                                                <td>'.  $arr["id"] . '</td>
                                                                <td> '. $arr['name'] .'</td>
                                                                <td>
                                                                    <table class="table align-middle mb-0">
                                                                        <thead class="table-light">';
                                                                            foreach ($arr['status'] ?? [] as $status => $value){
                                                                                $html .= '<tr>
                                                                                    <th class="text-center">'.
                                                                                        unSlug($status)
                                                                                    .' </th>
                                                                                </tr> ';
                                                                            }
                                                                        $html .= ' </thead>
                                                                    </table>
                                                                </td>
                                                                <td>
                                                                    <table class="table align-middle mb-0">
                                                                        <thead class="table-light">';
                                                                        foreach ($arr['status'] ?? [] as $status => $value){
                                                                            $html .='<tr>
                                                                                <th class="text-center">
                                                                                '.
                                                                           ( $value['today'] > 0 ? $value["today"] : "-")
                                                                        .'
                                                                                </th>
                                                                                </tr> ';
                                                                        }
                                                                        $html .= ' </thead>
                                                                    </table>
                                                                </td>

                                                                <td>
                                                                    <table class="table align-middle mb-0">
                                                                        <thead class="table-light">';
                                                                        foreach ($arr['status'] ?? [] as $status => $value){
                                                                            $html .='<tr>
                                                                                <th class="text-center">
                                                                                '.
                                                                          (  $value['yesterday'] ?  $value["yesterday"] : "-")
                                                                        .'
                                                                                </th>
                                                                                </tr> ';
                                                                        }
                                                                        $html .= ' </thead>
                                                                    </table>
                                                                </td>

                                                                <td>
                                                                    <table class="table align-middle mb-0">
                                                                        <thead class="table-light">';
                                                                        foreach ($arr['status'] ?? [] as $status => $value){
                                                                            $html .='<tr>
                                                                                <th class="text-center">
                                                                                '.
                                                                            ($value['this-week'] ? $value['this-week']: '-')
                                                                        .'
                                                                                </th>
                                                                                </tr> ';
                                                                        }
                                                                        $html .= ' </thead>
                                                                    </table>
                                                                </td>

                                                                <td>
                                                                    <table class="table align-middle mb-0">
                                                                        <thead class="table-light">';
                                                                        foreach ($arr['status'] ?? [] as $status => $value){
                                                                            $html .='<tr>
                                                                                <th class="text-center">
                                                                                '.
                                                                            ($value['last-week'] ? $value['last-week'] : "-")
                                                                        .'
                                                                                </th>
                                                                                </tr> ';
                                                                        }
                                                                        $html .= ' </thead>
                                                                    </table>
                                                                </td>

                                                                <td>
                                                                    <table class="table align-middle mb-0">
                                                                        <thead class="table-light">';
                                                                        foreach ($arr['status'] ?? [] as $status => $value){
                                                                            $html .='<tr>
                                                                                <th class="text-center">
                                                                                '.
                                                                            ($value['this-month'] ? $value['this-month']:"-")
                                                                        .'
                                                                                </th>
                                                                                </tr> ';
                                                                        }
                                                                        $html .= ' </thead>
                                                                    </table>
                                                                </td>

                                                                <td>
                                                                    <table class="table align-middle mb-0">
                                                                        <thead class="table-light">';
                                                                        foreach ($arr['status'] ?? [] as $status => $value){
                                                                            $html .='<tr>
                                                                                <th class="text-center">
                                                                                '.
                                                                            ($value['last-month'] ? $value['last-month'] : '-')
                                                                        .'
                                                                                </th>
                                                                                </tr> ';
                                                                        }
                                                                        $html .= ' </thead>
                                                                    </table>
                                                                </td>




                                                            </tr>';
                                                }


                                             $html .= '</tbody>
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>';

                             $count++;

                                                         } }

           $html .='  </div>
         </div>
     </div>';

     return response()->json(["body" => $html]);
         }
        }
}
