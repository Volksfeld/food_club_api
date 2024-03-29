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
            var_dump($stmt->errorInfo());
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
            var_dump($stmt->errorInfo());
            throw new \Exception("Nenhum funcionário encontrado");
        }
    }



    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'INSERT INTO ' . self::$table . ' (name, adress, phone_number, email, access_level, password) VALUES (:name, :adress, :phone_number, :email, :access_level, :password)';

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':adress', $data['adress']);
        $stmt->bindValue(':phone_number', $data['phone_number']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':access_level', $data['access_level']);
        $stmt->bindValue(':password', $data['password']);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Funcionário inserido com sucesso!';
        } else {
            var_dump($stmt->errorInfo());
            throw new \Exception("Falha ao inserir funcionário");
        }
    }

    public static function update($id, $data)
    {

        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $name = $data["name"];
        $adress = $data["adress"];
        $phone_number = $data["phone_number"];
        $email = $data["email"];
        $password = $data["password"];

        $sql = "UPDATE staff SET name = ?, adress = ?, phone_number = ?, email = ?, password = ? WHERE id = ?";
              
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $adress);
        $stmt->bindValue(3, $phone_number);
        $stmt->bindValue(4, $email);
        $stmt->bindValue(5, $password);
        $stmt->bindValue(6, $id);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Funcionário atualizado com sucesso!';
        } else {
            var_dump($stmt->errorInfo());
            throw new \Exception("Falha ao atualizar funcionário");
        }
    }

    public static function delete($id)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'DELETE FROM staff WHERE id = :id';

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Funcionário deletado com sucesso!';
        } else {
            var_dump($stmt->errorInfo());
            throw new \Exception("Falha ao deletar funcionário");
        }
    }
}
