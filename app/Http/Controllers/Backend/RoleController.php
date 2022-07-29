<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\RoleRequest;
use App\Models\Backend\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RoleController extends Controller
{

    private $path = "backend.pages.role.";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return response()->json(Role::find(request()->role_id)?->permissions);
        }
        return view($this->path . "index", [
            "roles" => Role::orderBy("id", "desc")->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = (self::getRouteArray());
        // dd($permissions);
        return view($this->path . "crud", compact("permissions"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        // dd($request->validated());
        Role::create($request->validated());
        return redirect()->route("backend.role-list")->with("success", "Role created successfully.");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view($this->path . "crud", [
            "role" => $role,
            "permissions" => (self::getRouteArray())
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        // dd($request->validated());
        $role->update($request->validated());
        return redirect()->route("backend.role-list")->with("success", "Role updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role?->delete();
        return redirect()->route("backend.role-list")->with("success", "Role deleted successfully.");
    }


    public static function getRouteArray()
    {
        $routeCollection = Route::getRoutes();
        $routes = [];
        foreach ($routeCollection as $route) {
            if (str_contains($route->getName(), "backend.") && in_array("GET", $route->methods)) {
                $arr = explode(".", $route->getName());
                if (count($arr) > 1 && $arr[1] != "dashboard") {
                    $names = explode("-", $arr[1]);
                    $routes[$names[0]][] =  [
                        "name" => $route->getName(),
                        "title" =>  $names[1]
                    ];
                }
            }
        }
        return $routes;
    }


    public static function getSuperAdminPermission()
    {
        return (call_user_func_array('array_merge', collect(self::getRouteArray())->pluck("*.name")->toArray()));
    }
}
