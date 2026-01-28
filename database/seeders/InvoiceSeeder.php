<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Support\Str;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
{
  
  for ($i = 1; $i <= 20; $i++) {

            $sum = rand(10000, 80000);
            $vat = $sum * 0.075;
            $total = $sum + $vat;

            Invoice::create([
                'summary' => 'Invoice for services rendered #' . $i,
                'business_name' => 'Samatech Solutions',
                'business_address' => 'Abuja, Nigeria',

                'invoice_number' => rand(100000, 999999),
                'invoice_date' => now()->subDays(rand(1, 30)),
                'invoice_duedate' => now()->addDays(rand(5, 15)),

                'amount_due' => $total,

                'client_name' => 'Client ' . $i,
                'client_business' => 'Client Business ' . $i,
                'client_business_address' => 'Client Address ' . $i,
                'client_email' => 'client' . $i . '@mail.com',
                'client_phone' => '080' . rand(10000000, 99999999),

                'reminders' => null,

                'sum' => $sum,
                'vat' => $vat,
                'other_vat' => 0,
                'transaction_fee' => 0,
                'total' => $total,

                'vat_percent' => '7.5%',
                'other_vat_percent' => '0%',
                'tax_name' => 'VAT',

                'note' => 'Auto-generated invoice',
                'haspaid' => rand(0, 1),

                'ref' => strtoupper(Str::random(10)),
                'user_id' => 1,
                'status' => 1
            ]);
        }   

}

}
