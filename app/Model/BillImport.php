<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BillImport extends Model
{
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function billDetail()
    {
        return $this->hasMany(BillImportDetail::class);
    }
}
