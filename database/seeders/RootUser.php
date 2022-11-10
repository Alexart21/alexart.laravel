<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RootUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory is better
        $data = [
            'id' => User::ADMIN_ID,
            'name' => 'Admin',
            'email' => 'aa@aa.aa',
            'status' => User::STATUS_ADMIN,
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ];

        User::create($data);
    }
}
