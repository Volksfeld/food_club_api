<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController
{

    public function get($code = null)
    {
        if ($code) {
            return Product::select($code);
        }

        return Product::selectAll();
    }

  
    public function post($code = null)
    {
        $data = $_POST;
        
        if (!$_POST) {
            $data = file_get_contents('php://input');
        }

        if ($code) {
            return Product::update($code, $data);
        }

        return Product::insert($data);
    }

    public function delete($code)
    {

        return Product::delete($code);
    }
}
