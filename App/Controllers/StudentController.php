<?php

namespace App\Controllers;

use App\Models\Student;

class StudentController
{
    public function get($enrollment = null)
    {
        if ($enrollment) {
            return Student::select($enrollment);
        }

        return Student::selectAll();
    }

    public function post($enrollment = null)
    {
        $data = $_POST;
        
        if (!$_POST) {
            $data = file_get_contents('php://input');
        }

        if ($enrollment) {
            return Student::update($enrollment, $data);
        }

        return Student::insert($data);
    }

    public function delete($enrollment)
    {

        return Student::delete($enrollment);
    }

    public function buyProduct($productCode, $studentEnrollment)
    {
        return Student::buyProduct($productCode, $studentEnrollment);
    }
}
