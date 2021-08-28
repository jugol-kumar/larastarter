<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::UpdateOrCreate([
            'name'        => 'First Menu',
            'description' => 'this is first menu description',
            'deletable'   => false,
        ]);
    }
}
