<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electronicinvoice extends Model
{
    use HasFactory;
    protected $table = 'electronicinvoices';

    protected $fillable = [
        'Invoice_type',
        'Invoice_Number',
        'Customer',
        'customer_address',
        'customer_vat',
        'customer_phone',
        'customer_number',
        'Job_card',
        'quotation_number',
        'customer_po_number',
        'branch_name',
        'meters_reading',
        'fleet_number',
        'registeration',
        'manufacturer',
        'chassis_no',
        'model_name',
        'vehicle',
        'Date',
        'Discount',
        'job_open_date',
        'delivery_date',
        'Details',
        'vat_number',
        'Status',
        'Payment_type',
        'services_sum',

        'total_amount',
        'grand_total',
        'tax',
        'paid_amount',
        'branch_id',

        'final',
        'reg_chars',
        'final',
        'customer_id'
    ];



    public function services()
    {
        return $this->hasMany(Invoiceservice::class, 'invoice_id', 'id');
    }

     public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

}
