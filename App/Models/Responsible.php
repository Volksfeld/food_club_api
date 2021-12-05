<?php

namespace App\Models;

class Responsible
{
    private static $table = 'responsible';


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
            throw new \Exception("Nenhum responsável encontrado");
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
            throw new \Exception("Nenhum responsável encontrado");
        }
    }



    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'INSERT INTO ' . self::$table . ' (
                cpf,
                name,
                phone_number,
                email,
                login,
                password,
                access_level
              ) VALUES (
                :cpf,
                :name,
                :phone_number,
                :email,
                :login,
                :password,
                :access_level
              )';

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':cpf', $data['cpf']);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':phone_number', $data['phone_number']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':login', $data['login']);
        $stmt->bindValue(':password', $data['password']);
        $stmt->bindValue(':access_level', $data['access_level']);

        if ($stmt->rowCount() > 0) {
            return 'responsável inserido com sucesso!';
        } else {
            throw new \Exception("Falha ao inserir responsável");
        }
    }
}
