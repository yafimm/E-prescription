<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Models
use App\Models\User;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(['email' => 'admin@prescription.com',
                              'password' => bcrypt('admin'),
                              'name' => 'admin']);

        $user = User::create(['email' => 'admintest@prescription.com',
                              'password' => bcrypt('admin'),
                              'name' => 'admin tes']);

        $user = User::create(['email' => 'dadang@prescription.com',
                              'password' => bcrypt('admin'),
                              'name' => 'dadang']);
    }
}
