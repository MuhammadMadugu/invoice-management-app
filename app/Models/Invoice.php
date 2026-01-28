<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

   protected $fillable = [
        'summary',
        'business_name',
        'business_address',
        'invoice_number',
        'invoice_date',
        'invoice_duedate',
        'amount_due',
        'client_name',
        'client_business',
        'client_business_address',
        'client_email',
        'client_phone',
        'reminders',
        'sum',
        'vat',
        'other_vat',
        'transaction_fee',
        'total',
        'vat_percent',
        'other_vat_percent',
        'tax_name',
        'note',
        'haspaid',
        'ref',
        'user_id',
        'status'
    ];

    public function files()
{
    return $this->hasMany(InvoiceFile::class);
}


    use HasFactory;
}
