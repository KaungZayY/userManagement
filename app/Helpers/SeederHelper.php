<?php
namespace App\Helpers;
use App\Models\Feature;
use App\Models\Permission;

class SeederHelper{
    /**
     * @param features
     * Create features
     */
    public function createFeature(...$features){
        foreach ($features as $feature){
            Feature::create([
                'name' => $feature,
            ]);
        }
    }

    /**
     * @param featureName,permissions
     * Create permissions for a feature
     */
    public function createPermission($featureName,...$permissions){
        $feature = Feature::where('name',$featureName)->firstOrFail();
        foreach ($permissions as $permission){
            $feature->permissions()->create([
                'name' => $permission,
            ]);
        }
    }
}

