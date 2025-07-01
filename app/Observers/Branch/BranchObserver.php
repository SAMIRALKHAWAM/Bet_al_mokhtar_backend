<?php

namespace App\Observers\Branch;

use App\Models\Branch;
use App\Models\Material;
use App\Models\Warehouse;
use App\Models\WarehouseMaterial;

class BranchObserver
{

    /**
     * Handle the User "created" event.
     */
    public function created(Branch $branch): void
    {
      $warehouse = Warehouse::create([
           'name' => $branch->name,
           'branch_id' => $branch->id,
       ]);
      $materials = Material::get();
      foreach ($materials as $material){
          WarehouseMaterial::create([
              'warehouse_id' => $warehouse->id,
              'material_id' => $material->id,
          ]);
      }
    }


    /**
     * Handle the User "updated" event.
     */
    public function updated(Branch $branch): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(Branch $branch): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(Branch $branch): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(Branch $branch): void
    {
        //
    }

}
