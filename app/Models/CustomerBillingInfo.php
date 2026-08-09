<?php

namespace App\Models;

use Database\Factories\CustomerBillingInfoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerBillingInfo extends Model
{
    //
    /** @use HasFactory<CustomerBillingInfoFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'customer_id',
        'name',
        'country',
        'postcode',
        'city',
        'address',
        'company_name',
        'tax_number',
        'eu_vat_number',
    ];

    protected function casts(): array
    {
        return [
            'customer_id' => 'integer',
        ];
    }

    /**
     * @return BelongsTo<Customer, $this>
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
