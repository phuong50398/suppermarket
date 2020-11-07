<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BillExportDetail extends Model
{
    public function billExport()
    {
        return $this->belongsTo(BillExport::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
