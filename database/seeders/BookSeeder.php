<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $pemrograman = Category::where('name', 'Pemrograman')->first();
        $novel = Category::where('name', 'Novel')->first();
        $teknologi = Category::where('name', 'Teknologi')->first();

        Book::create([
            'category_id' => $pemrograman->id,
            'title' => 'Belajar PHP Dasar',
            'author_name' => 'Ayu Kartika',
            'price' => 85000,
        ]);

        Book::create([
            'category_id' => $pemrograman->id,
            'title' => 'Dasar Pemrograman Java',
            'author_name' => 'Wayan Sudiarta',
            'price' => 72000,
        ]);

        Book::create([
            'category_id' => $novel->id,
            'title' => 'The Long Walk',
            'author_name' => 'Stephen King',
            'price' => 72000,
        ]);

        Book::create([
            'category_id' => $novel->id,
            'title' => 'Holy Mother',
            'author_name' => 'Akiyoshi Rikako',
            'price' => 95000,
        ]);

        Book::create([
            'category_id' => $teknologi->id,
            'title' => 'Kecerdasan Buatan(AI)',
            'author_name' => 'Alexsandra Harahap',
            'price' => 85000,
        ]);

        Book::create([
            'category_id' => $teknologi->id,
            'title' => 'Teknologi Masa Depan',
            'author_name' => 'Komang Ayu',
            'price' => 95000,
        ]);
    }
}
