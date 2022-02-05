<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
          UserSeeders::class,
        ]);
        $this->command->info('---- Medicine table seeding process, takes a few minutes -----!');
        DB::unprepared(file_get_contents('database/seeders_sql/obatalkes_m.sql'));
        $this->command->info('Medicine table seeded!');
        $this->command->info('--------------------------------------------------------------');
        $this->command->info('---- Signa table seeding process, takes a few minutes -----!');
        DB::unprepared(file_get_contents('database/seeders_sql/signa_m.sql'));
        $this->command->info('Signa table seeded!');
        $this->command->info('--------------------------------------------------------------');

    }
}
