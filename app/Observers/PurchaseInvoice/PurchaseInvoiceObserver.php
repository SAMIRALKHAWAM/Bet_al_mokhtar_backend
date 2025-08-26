<?php

namespace App\Observers\PurchaseInvoice;

use App\Models\PurchaseInvoice;
use App\Models\PurchaseInvoiceLine;

class PurchaseInvoiceObserver
{

    /**
     * Handle the User "created" event.
     */
    public function created(PurchaseInvoice $purchaseInvoice): void
    {
        $materials = \request()->materials;
        $full_price = 0;
        foreach ($materials as $material) {
            $material_full_price = $material['quantity'] * $material['price'];
            PurchaseInvoiceLine::create([
                'purchase_invoice_id' => $purchaseInvoice->id,
                'material_id' => $material['material_id'],
                'quantity' => $material['quantity'],
                'price' => $material['price'],
                'full_price' => $material_full_price,
            ]);
            $full_price += $material_full_price;
        }
        $purchaseInvoice->increment('full_price', $full_price);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(PurchaseInvoice $purchaseInvoice): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(PurchaseInvoice $purchaseInvoice): void
    {
        $purchaseInvoice->PurchaseInvoiceLines()->delete();
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(PurchaseInvoice $purchaseInvoice): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(PurchaseInvoice $purchaseInvoice): void
    {
        //
    }
}
