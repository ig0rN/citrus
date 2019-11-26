<?php

namespace App\Controllers\Admin;

use App\Models\Product;
use App\RequestValidation\ProductRequest;
use App\Services\UploadImageService;

class ProductsController extends BaseController
{
    /**
     * ProductsController constructor.
     */
    public function __construct()
    {
        $this->handleUnauthorizedUser();
    }

    /**
     * Show products pages
     *
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        $products = Product::selectAll();

        return view('admin/product/index', compact('products'));
    }

    /**
     * Show form for creating new product
     *
     * @return mixed
     */
    public function create()
    {
        return view('admin/product/create');
    }

    /**
     * Store product in database
     *
     * @throws \Exception
     */
    public function store()
    {
        $validation = ( new ProductRequest() )->validate($_POST);

        if (! $validation->passed()) {
            return redirect('/admin/product/create', ['errors' => $validation->errors()]);
        }

        $image_path = ( new UploadImageService() )->upload($_FILES['image'], $_POST['name']);
        $_POST['image_path'] = $image_path;

        Product::create($_POST);

        return redirect('/admin/products', ['success' => 'You successfully created new product']);
    }

    /**
     * Show form for editing product
     *
     * @return mixed
     * @throws \Exception
     */
    public function edit()
    {
        $product = Product::findBy('id', $_GET['id']);

        return view('admin/product/edit', compact('product'));
    }

    /**
     * Update product in database
     *
     * @throws \Exception
     */
    public function update()
    {
        $validation = ( new ProductRequest() )->validate($_POST);

        if (! $validation->passed()) {
            return redirect('/admin/product/edit?id=' . $_POST['id'], ['errors' => $validation->errors()]);
        }

        Product::findBy('id', $_POST['id'])->update($_POST);

        return redirect('/admin/products', ['success' => 'You successfully updated product']);
    }

    /**
     * Delete product from databse
     *
     * @throws \Exception
     */
    public function destroy()
    {
        Product::findBy('id', $_POST['id'])->delete();

        return redirect('/admin/products', ['success' => 'You successfully deleted product']);
    }
}