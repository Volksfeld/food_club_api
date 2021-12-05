<?php

    namespace App\Controllers;

    use App\Models\User;

    class UserController {
        public function get($id = null) {
            if ($id) {
             return User::select($id);
            }

            return User::selectAll();
        }

        public function post() {
          $data = $_POST;

          return User::insert($data);
        }

        public function update() {

        }

        public function delete() {

        }
    }
