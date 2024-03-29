<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::updateOrCreate([
            'role_id'  => Role::where('slug', 'admin')->first()->id,
            'name'     => 'Admin',
            'email'    => 'admin@mail.com',
            'number'   => '01723717933',
            'code'     => '123456',
            'active'   => 1,
            'password' => Hash::make('admin12345'),
            'status'   => true,
        ]);

        User::updateOrCreate([
            'role_id'  => Role::where('slug', 'user')->first()->id,
            'name'     => 'User',
            'email'    => 'user@mail.com',
            'number'   => '01723717932',
            'code'     => '123456',
            'active'   => 1,
            'password' => Hash::make('user12345'),
            'status'   => true,
        ]);
    }
}
