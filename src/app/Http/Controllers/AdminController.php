<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\User;

class AdminController extends Controller
{

        public function board()
    {
        return view('admin.board');
    }

    public function create()
    {
        return view('admin.create');
    }
}