<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoiceFile extends Model
{
     protected $fillable = ['invoice_id','filename','path'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    use HasFactory;
}
