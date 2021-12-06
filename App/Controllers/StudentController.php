<?php

    namespace App\Controllers;

    use App\Models\Student;

    class StudentController {
        public function get($enrollment = null) {
            if ($enrollment) {
             return Student::select($enrollment);
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
