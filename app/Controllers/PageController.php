<?php

namespace App\Controllers;

use App\Models\{Product, Comment};

class PageController
{
    /**
     * Show homepage
     */
    public function home()
    {
        $products = Product::selectAll('ORDER BY name ASC');
        $comments = Comment::selectAll('WHERE approved = 1 ORDER BY id DESC');

        return view('front/home', compact('products', 'comments'));
    }
}