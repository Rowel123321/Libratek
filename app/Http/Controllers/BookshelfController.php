<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookshelf;

class BookshelfController extends Controller
{
    public function index()
    {
        $bookshelves = Bookshelf::all()->groupBy('year');
        return response()->json($bookshelves);
    }
}
