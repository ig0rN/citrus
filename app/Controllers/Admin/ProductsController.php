<?php

namespace App\Controllers\Admin;

use App\Models\Product;
use App\RequestValidation\ProductRequest;
use App\Services\UploadImageService;
use Core\App;

class ProductsController extends BaseController
{
    public function __construct()
    {
        $this->handleUnauthorizedUser();
    }

    public function index()
    {
        $products = ( new Product() )->selectAll();

        return view('admin/product/index', compact('products'));
    }

    public function create()
    {
        return view('admin/product/create');
    }

    public function store()
    {
        $validation = ( new ProductRequest() )->validate($_POST);

        if (! $validation->passed()) {
            App::get('session')->set('errors', $validation->errors());

            return redirect('/admin/product/create');
        }

        $image_path = ( new UploadImageService() )->upload($_FILES['image'], $_POST['name']);
        $_POST['image_path'] = $image_path;

        ( new Product() )->save($_POST);

        App::get('session')->set('success', 'You successfully created new product');

        return redirect('/admin/products');
    }

    public function edit()
    {
        $product = ( new Product() )->find($_GET);

        return view('admin/product/edit', compact('product'));
    }

    public function update()
    {
        $validation = ( new ProductRequest() )->validate($_POST);

        if (! $validation->passed()) {
            App::get('session')->set('errors', $validation->errors());

            return redirect('/admin/product/edit?id=' . $_POST['id']);
        }

        ( new Product() )->update($_POST);

        App::get('session')->set('success', 'You successfully updated product');

        return redirect('/admin/products');
    }

    public function destroy()
    {
        ( new Product() )->delete($_POST);

        App::get('session')->set('success', 'You successfully deleted product');

        return redirect('/admin/products');
    }
}