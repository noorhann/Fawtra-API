<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Electronicinvoice;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_name', 'contact_number', 'branch_email', 'branch_address', 'branch_status', 'vat_number', 'division', 'division_en', 'name_en '
    ];

    public function invoices()
    {
        return $this->hasMany(Electronicinvoice::class, 'branch_id', 'id');
    }

}
