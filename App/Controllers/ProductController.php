<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController
{

    public function get($id = null)
    {
        if ($id) {
            return Product::select($id);
        }

        return Product::selectAll();
    }

    public function post()
    {
        $data = $_POST;

        return Product::insert($data);
    }

    public function update()
    {
    }

    public function delete($code)
    {

        return Product::delete($code);
    }
}
