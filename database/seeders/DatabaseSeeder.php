<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(!User::whereEmail('admin@admin.com')->exists()){
            User::factory(1)->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
            ]);
        }
        News::factory(10)->create();
    }
}
