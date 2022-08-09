<?php

// permission check

use Illuminate\Support\Facades\Cache;


if (!function_exists("hasPermission")) {
    function hasPermission($permission)
    {

        $permissions_map = [
            "manage" => [
                "edit",
                "update",
                "create",
                "store",
            ],


        ];


        $permissions = Cache::rememberForever("permissions_" . auth()->id(), function () {
            return auth()->user()->permissions;
        });

        // dd($permission, $permissions);

        //
        if (str_contains($permission, 'delete') || str_contains($permission, 'update_status')) {
            if (auth()->user()->role->slug == "super-admin") {
                return true;
            }
            return false;
        }

        if (in_array(str_replace("backend.", "", $permission), $permissions)) {
            return true;
        } else {
            $new_permission = (explode("-", explode(".", $permission)[1] ?? '')[0] ?? '') . "-manage";
            if (in_array($new_permission, $permissions)) {
                $action = explode("-", $permission)[1] ?? null;

                if (in_array($action, $permissions_map["manage"])) {
                    return true;
                }
            }
        }
        return false;
    }
}
