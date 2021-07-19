<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(config('admin.admin_name')) {
            User::firstOrCreate(
                ['email' => config('admin.admin_email')],
                [
                    'name' => config('admin.admin_name'), 
                    'password' => Hash::make(config('admin.admin_password')), 
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
