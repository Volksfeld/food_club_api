<?php

    namespace App\Controllers;

    use App\Models\Responsible;

    class ResponsibleController {
        public function get($id = null) {
            if ($id) {
             return Responsible::select($id);
            }

            return Responsible::selectAll();
        }

        public function post() {
          $data = $_POST;

          return Responsible::insert($data);
        }

        public function update() {

        }

        public function delete() {

        }
    }
