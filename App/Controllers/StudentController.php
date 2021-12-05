<?php

    namespace App\Controllers;

    use App\Models\Student;

    class StudentController {
        public function get($id = null) {
            if ($id) {
             return Student::select($id);
            }

            return Student::selectAll();
        }

        public function post() {
          $data = $_POST;

          return Student::insert($data);
        }

        public function update() {

        }

        public function delete() {

        }
    }
