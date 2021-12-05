<?php

namespace App\Models;

class Student
{
    private static $table = 'student';


    public static function select(int $name)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE name = :name';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':name', $name);
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

        $sql = 'INSERT INTO ' . self::$table . ' (
                enrollment,
                student_class,
                shift,
                name,
                phone_number,
                email,
                login,
                password,
                responsible_cpf,
                balance,
                access_level
              ) VALUES (
                :enrollment,
                :student_class,
                :shift,
                :name,
                :phone_number,
                :email,
                :login,
                :password,
                :responsible_cpf,
                :balance,
                :access_level
              )';

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

        if ($stmt->rowCount() > 0) {
            return 'estudante inserido com sucesso!';
        } else {
            throw new \Exception("Falha ao inserir estudante");
        }
    }
}
