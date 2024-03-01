<?php

use App\Models\Feature;
use App\Models\Permission;

/**
 * @param features
 * Create features
 */
function createFeature(...$features){
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
function createPermission($featureName,...$permissions){
    $feature = Feature::where('name',$featureName)->firstOrFail();
    foreach ($permissions as $permission){
        $feature->permissions()->create([
            'name' => $permission,
        ]);
    }
}

