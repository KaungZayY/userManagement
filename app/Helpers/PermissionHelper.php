<?php
namespace App\Helpers;

use App\Models\Feature;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PermissionHelper{
    /**
     * @param featureName,PermissionName
     * @return permissionId
     */
    public function getPermissionId($featureName,$permissionName){
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
    public function checkPermission($permissionId)
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
    public function authorizeUser($featureName,$permissionName){
        $permissionId = $this->getPermissionId($featureName,$permissionName);
        if ($permissionId === null) {
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized Access.');
        }
        $isAuthorized = $this->checkPermission($permissionId);
        if (!$isAuthorized) {
            abort(Response::HTTP_FORBIDDEN, 'Unauthorized Access.');
        }
        return true;
    }

}