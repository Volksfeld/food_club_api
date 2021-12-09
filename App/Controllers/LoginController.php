<?php

namespace App\Controllers;

class LoginController
{
    private function handleLoginSuccess($selectedUser)
    {
        http_response_code(200);
        return json_encode(array('status' => 'success', 'data' => $selectedUser));
    }

    public function login($data)
    {

        $email = $data['email'];
        $password = $data['password'];

        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $responsibleSql = 'SELECT * FROM responsible WHERE email = ?';
        $selectResponsiblesStmt = $connPdo->prepare($responsibleSql);
        $selectResponsiblesStmt->bindValue(1, $email);

        $selectResponsiblesStmt->execute();

        $selectedResponsible = $selectResponsiblesStmt->fetch(\PDO::FETCH_ASSOC);

        if ($selectedResponsible && $password == $selectedResponsible['password']) {
            return $this->handleLoginSuccess($selectedResponsible);
        }

        $staffSql = 'SELECT * FROM staff WHERE email = ?';
        $selectStaffStmt = $connPdo->prepare($staffSql);
        $selectStaffStmt->bindValue(1, $email);

        $selectStaffStmt->execute();

        $selectedStaff = $selectStaffStmt->fetch(\PDO::FETCH_ASSOC);

        if ($selectedStaff && $password == $selectedStaff['password']) {
            return $this->handleLoginSuccess($selectedStaff);
        }


        $staffSql = 'SELECT * FROM staff WHERE email = ?';
        $selectStaffStmt = $connPdo->prepare($staffSql);
        $selectStaffStmt->bindValue(1, $email);

        $selectStaffStmt->execute();

        $selectedStaff = $selectStaffStmt->fetch(\PDO::FETCH_ASSOC);

        if ($selectedStaff && $password == $selectedStaff['password']) {
            return  $this->handleLoginSuccess($selectedStaff);
        }

        $studentSql = 'SELECT * FROM student WHERE email = ?';
        $selectStudentStmt = $connPdo->prepare($studentSql);
        $selectStudentStmt->bindValue(1, $email);

        $selectStudentStmt->execute();

        $selectedStudent = $selectStudentStmt->fetch(\PDO::FETCH_ASSOC);

        if ($selectedStudent && $password == $selectedStudent['password']) {
            return $this->handleLoginSuccess($selectedStudent);
        }

        http_response_code(401);
        echo json_encode(array('status' => 'error', 'data' => 'null', 'error' => 'Usuário e/ou senha incorreto.'), JSON_UNESCAPED_UNICODE);
    }
}
