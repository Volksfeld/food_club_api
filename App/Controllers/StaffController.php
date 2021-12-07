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

    public function post($id = null)
    {
        $data = $_POST;

        if ($id) {
            return Staff::update($id, $data);
        }

        return Staff::insert($data);
    }


    public function delete($id)
    {

        return Staff::delete($id);
    }
}
