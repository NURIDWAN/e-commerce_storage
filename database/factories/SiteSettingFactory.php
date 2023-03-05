<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SiteSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'logo' => 'upload/logo/130305.png',
            'icon' => 'upload/logo/130305.png',
            'description' => 'SALSAL adalah toko di bidang atk',
            'phone_one' => '+62081234567',
            'phone_two' => '+62089876521',
            'email' => 'nuridwn@gmail.com',
            'company_name' => 'NURIDWN',
            'company_address' => 'JL.Babakantiga No.82 Ciwidey',
        ];
    }
}
