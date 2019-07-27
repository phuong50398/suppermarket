<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BillExportDetail extends Model
{
    public function billExport()
    {
        return $this->belongsTo(BillExport::class);
    }
}
