<?php

use App\Models\Feature;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

    /**
     * @param featureName,PermissionName
     * @return permissionId
     */
    function getPermissionId($featureName,$permissionName){
        $feature = Feature::where('name',$featureName)->first();
        if($feature){
            $permission = $feature->permissions->where('name',$permissionName)->first();
            if($permission){
                return $permission->id;
            }
        }
        return null;
    }

    /**
     * @param permission_id
     * @return bool
     */
    function checkPermission($permissionId)
    {
        $user = Auth::user();
        if ($user && $user->role) {
            //role_id 1 is admin
            if($user->role->id ==1 ){
                return true;
            }
            return $user->role->permissions->contains('id', $permissionId);
        }
        return false;
    }

    /**
     * @param featureName,PermissionName
     * @return true_Or_403
     */
    function authorizeUser($featureName,$permissionName){
        $permissionId = getPermissionId($featureName,$permissionName);
        if ($permissionId === null) {
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized Access.');
        }
        $isAuthorized = checkPermission($permissionId);
        if (!$isAuthorized) {
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized Access.');
        }
        return true;
    }

    /**
     * @param feaureName,permissionName
     * @return bool
     */
    function viewContent($featureName, $permissionName){
        $permissionId = getPermissionId($featureName,$permissionName);
        if ($permissionId === null) {
            return false;
        }
        $isAuthorized = checkPermission($permissionId);
        if (!$isAuthorized) {
            return false;
        }
        return true;
    }