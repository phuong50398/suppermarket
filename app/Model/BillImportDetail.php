<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BillImportDetail extends Model
{
    public function billImport()
    {
        return $this->belongsTo(BillImport::class);
    }
}
