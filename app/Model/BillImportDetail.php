<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BillImportDetail extends Model
{
    public function billImport()
    {
        return $this->belongsTo(BillImport::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
