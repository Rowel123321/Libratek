<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookshelfSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['year' => 2022, 'book_title' => "Smart Parking System"],
            ['year' => 2022, 'book_title' => "AI-Based Resume Screener"],
            ['year' => 2023, 'book_title' => "AI-Powered Tutor"],
            ['year' => 2023, 'book_title' => "E-Waste Management System"],
            ['year' => 2024, 'book_title' => "E-Health Monitoring"],
            ['year' => 2025, 'book_title' => "AI-Powered Library System"],
        ];

        DB::table('bookshelves')->insert($books);
    }
}
