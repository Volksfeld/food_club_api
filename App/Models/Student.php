<?php

namespace App\Models;

class Student
{
    private static $table = 'student';


    public static function select(int $enrollment)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE enrollment = :enrollment';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':enrollment', $enrollment);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum estudante encontrado");
        }
    }

    public static function selectAll()
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table;
        $stmt = $connPdo->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum estudante encontrado");
        }
    }



    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'INSERT INTO ' . self::$table . ' (enrollment, student_class, shift, name,phone_number, email, login, password, responsible_cpf, balance, access_level) VALUES (:enrollment, :student_class, :shift, :name, :phone_number, :email, :login, :password, :responsible_cpf, :balance, :access_level)';

        $stmt = $connPdo->prepare($sql);

        $stmt->bindValue(':enrollment', $data['enrollment']);
        $stmt->bindValue(':student_class', $data['student_class']);
        $stmt->bindValue(':shift', $data['shift']);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':phone_number', $data['phone_number']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':login', $data['login']);
        $stmt->bindValue(':password', $data['password']);
        $stmt->bindValue(':responsible_cpf', $data['responsible_cpf']);
        $stmt->bindValue(':balance', $data['balance']);
        $stmt->bindValue(':access_level', $data['access_level']);
        $stmt->execute();
        var_dump($stmt->errorInfo());

        if ($stmt->rowCount() > 0) {
            return 'Estudante inserido com sucesso!';
        } else {
            throw new \Exception('falha');
        }
    }

    public static function update($enrollment, $data)
    {

        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        echo $data["phone_number"];
        $student_class = $data["student_class"];
        $shift = $data["shift"];
        $name = $data["name"];
        $phone_number = $data["phone_number"];
        $email = $data["email"];
        $login = $data["login"];
        $password = $data["password"];
        $responsible_cpf = $data["responsible_cpf"];
        $balance = $data["balance"];

        $sql = "UPDATE student SET
                 student_class = '" . $student_class . 
                 "', shift = '" . $shift . 
                 "', name = '" . $name . 
                 "', phone_number = '" . $phone_number . 
                 "',email = '" . $email .  
                 "', login = '" . $login .  
                 "', password = '" . $password .  
                 "', phone_number = '" . $login .  
                 "', responsible_cpf = '" . $responsible_cpf .  
                 "', balance = '" . $balance . "'
                WHERE enrollment = " . $enrollment;

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':enrollment', $enrollment);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Estudante atualizado com sucesso!';
        } else {
            var_dump($stmt->errorInfo());
            throw new \Exception("Falha ao atualizar estudante");
        }
    }

    public static function delete($enrollment)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'DELETE FROM student WHERE enrollment = :enrollment';

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':enrollment', $enrollment);
        $stmt->execute();

        var_dump($stmt->errorInfo());
        if ($stmt->rowCount() > 0) {
            return 'Estudante deletado com sucesso!';
        } else {
            throw new \Exception("Falha ao deletar estudante");
        }
    }
}
