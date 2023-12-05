<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('products')->insert([
            [
                
                'name' => 'LG mobile',
                'price' => '200',
                'description' => 'A smartphone',
                'category' => 'mobile',
                'gallery' => 'https://www.lg.com/levant_en/images/plp-b2c/levanten-mobilephones-categoryselector-1.jpg',
            ],
            [
                'name' => 'LG Fridge',
                'price' => '1000',
                'description' => 'A Fridge',
                'category' => 'Fridge',
                'gallery' => 'https://m.media-amazon.com/images/I/51dTuOXIoPL.jpg',
            ],
            [
                'name' => 'LG Television',
                'price' => '7000',
                'description' => 'A Television',
                'category' => 'Television',
                'gallery' => 'https://techgadgetscanada.com/wp-content/uploads/2021/08/IMG_0534-2.jpg',
            ],
            [
                'name' => 'Laptop',
                'price' => '37000',
                'description' => 'A Laptop',
                'category' => 'Laptop',
                'gallery' => 'https://cdn.thewirecutter.com/wp-content/media/2023/06/laptopsunder500-2048px-aceraspire3spin14.jpg',
            ],
            [
                'name' => 'Computer',
                'price' => '17000',
                'description' => 'A Desktop',
                'category' => 'Computer',
                'gallery' => 'https://media.istockphoto.com/id/174645080/photo/modern-desktop-computer.jpg?s=612x612&w=0&k=20&c=3pQlWyourf8xZWcWGWsmp-jSWFZydkdCW9H9ESnIOSY=',
            ],
        ]);
        
    }
}
