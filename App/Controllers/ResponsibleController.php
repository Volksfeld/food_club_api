<?php

namespace App\Controllers;

use App\Models\Responsible;

class ResponsibleController
{
    public function get($cpf = null)
    {
        if ($cpf) {
            return Responsible::select($cpf);
        }

        return Responsible::selectAll();
    }

    public function post($cpf = null)
    {
        $data = $_POST;

        if ($cpf) {
            return Responsible::update($cpf, $data);
        }

        return Responsible::insert($data);
    }

    public function delete($cpf)
    {

        return Responsible::delete($cpf);
    }
    public function deposit($studentEnrollment, $value)
    {

        return Responsible::deposit($studentEnrollment, $value);
    }
}
