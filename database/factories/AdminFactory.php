<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'brand' => '1',
            'category' => '1',
            'product' => '1',
            'slider' => '1',
            'cupons' => '1',
            'banner' => '1',
             'shipping' => '1',
            'returnorder' => '1',
            'review' => '1',
            'agent_add' => '1',
            'pos' => '1',
            'orders' => '1',
              'stock' => '1',
            'list_info' => '1',
            'alluser' => '1',
            'reports' => '1',
            'setting' => '1',
            'adminuserrole' => '1',
             'employee' => '1',
            'supplier' => '1',
            'department' => '1',
            'employee_salary' => '1',
            'brand_caregory' => '1',
            'purchase' => '1',
             'admin_dashboard' => '1',
            'websetting' => '1',
            'expence' => '1',
            'email_verified_at' => now(),
            'password' => '$2a$12$FABIWEnTXaPLTBDhPj0kNOGFdA7htSNiuY4XGutmbyD36fm5pre2i', // password
            'remember_token' => Str::random(10),
        ];
    }
}
