<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Product;

class PageController
{
    /**
     * Show homepage
     */
    public function home()
    {
        $products = ( new Product )->selectAll();
        $comments = ( new Comment )->selectByApprovalStatus(true);

        return view('front/home', compact('products', 'comments'));
    }
}