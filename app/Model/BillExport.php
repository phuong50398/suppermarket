<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BillExport extends Model
{
    public function employees()
    {
        return $this->belongsTo(User::class);
    }
    public function billDetail()
    {
        return $this->hasMany(BillExportDetail::class);
    }
}
