<?php

namespace Database\Factories;

use App\Models\CustomerBillingInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CustomerBillingInfo>
 */
class CustomerBillingInfoFactory extends Factory
{
    protected $model = CustomerBillingInfo::class;

    public function definition(): array
    {
        $company = fake()->boolean(30);

        return [
            'name' => fake()->name(),
            'country' => 'HU',
            'postcode' => fake()->postcode(),
            'city' => fake()->city(),
            'address' => fake()->streetAddress(),

            'company_name' => $company ? fake()->company() : null,
            'tax_number' => $company ? fake()->numerify('########-#-##') : null,
            'eu_vat_number' => $company ? 'HU' . fake()->numerify('########') : null,
        ];
    }
}
