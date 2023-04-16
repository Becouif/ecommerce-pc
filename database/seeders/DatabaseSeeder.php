<?php

namespace Database\Seeders;
use App\Models\Category;
use App\Models\User;
use App\Models\Subcategory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // TO CREATE SEEDER FOR CATEGORY 

        // Category::create([
        //     'name'=>'laptop',
        //     'slug' => 'laptop'
        // ]);


        User::create([
            'name'=>'laravel-admin',
            'email'=>'admin@admin.com',
            'email_verified_at'=>NOW(),
            'password'=>bcrypt(12345),
            'phone_number'=>'0731185943',
            'address'=>'Babyaka 26',
            'is_admin'=>1,
        ]);
















        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
