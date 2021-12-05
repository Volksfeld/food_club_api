<?php

namespace App\Models;

class Staff
{
    private static $table = 'staff';


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
            throw new \Exception("Nenhum funcionário encontrado");
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
            throw new \Exception("Nenhum funcionário encontrado");
        }
    }



    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'INSERT INTO ' . self::$table . ' (name, adress, phone_number, email, access_level) VALUES (:name, :adress, :phone_number, :email, :access_level)';

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':adress', $data['adress']);
        $stmt->bindValue(':phone_number', $data['phone_number']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':access_level', $data['access_level']);

        if ($stmt->rowCount() > 0) {
            return 'funcionário inserido com sucesso!';
        } else {
            throw new \Exception("Falha ao inserir funcionário");
        }
    }
}
