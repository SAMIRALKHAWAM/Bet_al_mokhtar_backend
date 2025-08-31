<?php

namespace App\Observers\Material;

use App\Models\Material;
use App\Models\Warehouse;
use App\Models\WarehouseMaterial;

class MaterialObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(Material $material): void
    {
      $warehouses = Warehouse::get();
      foreach ($warehouses as $warehouse){
          WarehouseMaterial::create([
              'warehouse_id' => $warehouse->id,
              'material_id' => $material->id,
          ]);
      }
    }


    /**
     * Handle the User "updated" event.
     */
    public function updated(Material $material): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(Material $material): void
    {
        WarehouseMaterial::where('material_id',$material->id)->delete();
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(Material $material): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(Material $material): void
    {
        //
    }

}
