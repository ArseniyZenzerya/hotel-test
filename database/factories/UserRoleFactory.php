<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Role;

class UserRoleFactory extends Factory
{

    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'role_id' => Role::factory()->create()->id,
        ];
    }
}
