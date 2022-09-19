<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Electronicinvoice;

class Invoiceservice extends Model
{
    use HasFactory;

    protected $table = 'invoiceservices';

     protected $fillable = [
     	    'invoice_id',
            'service_name',
            'service_value', 
            'qty',
            'sub_total',
    ];

    public function invoice()
    {
        return $this->belongsTo(Electronicinvoice::class, 'invoice_id');
    }

}
