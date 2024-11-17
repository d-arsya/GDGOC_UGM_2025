<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            "title" => "5 Minute to Learn Go",
            "author" => "Sundar Pichai",
            "published_at" => "2023-10-25",
        ]);
        Book::create([
            "title" => "5 Minute to Learn Go",
            "author" => "Sundar Pichai",
            "published_at" => "2023-10-25",
        ]);
        Book::first()->delete();
        Book::factory(30)->create();
    }
}
