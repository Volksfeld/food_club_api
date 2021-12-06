<?php

    namespace App\Controllers;

    use App\Models\Responsible;

    class ResponsibleController {
        public function get($cpf = null) {
            if ($cpf) {
             return Responsible::select($cpf);
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
