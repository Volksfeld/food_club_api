<?php

namespace App\Controllers;

use App\Models\Staff;

class StaffController
{
    public function get($id = null)
    {
        if ($id) {
            return Staff::select($id);
        }

        return Staff::selectAll();
    }

    public function post()
    {
        $data = $_POST;

        return Staff::insert($data);
    }

    public function update()
    {
    }

    public function delete($id)
    {

        return Staff::delete($id);
    }
}
