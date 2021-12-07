<?php

namespace App\Models;

class Responsible
{
    private static $table = 'responsible';


    public static function select(int $cpf)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE cpf = :cpf';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':cpf', $cpf);
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

        $sql = 'INSERT INTO ' . self::$table . '(cpf, name, phone_number, email, login, password, access_level) VALUES (:cpf, :name, :phone_number, :email, :login, :password, :access_level)';

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':cpf', $data['cpf']);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':phone_number', $data['phone_number']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':login', $data['login']);
        $stmt->bindValue(':password', $data['password']);
        $stmt->bindValue(':access_level', $data['access_level']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Responsável inserido com sucesso!';
        } else {
          
            throw new \Exception("Falha ao inserir responsável");
        }
    }

    public static function delete($cpf)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'DELETE FROM responsible WHERE cpf = :cpf';

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->execute();

        var_dump($stmt->errorInfo());
        if ($stmt->rowCount() > 0) {
            return 'Responsável deletado com sucesso!';
        } else {
            throw new \Exception("Falha ao deletar responsável");
        }
    }
}
