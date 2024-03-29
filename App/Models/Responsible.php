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
            var_dump($stmt->errorInfo());
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
            var_dump($stmt->errorInfo());
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
            var_dump($stmt->errorInfo());
            throw new \Exception("Falha ao inserir responsável");
        }
    }

    public static function update($cpf, $data)
    {

        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $name = $data["name"];
        $phone_number = $data["phone_number"];
        $email = $data["email"];
        $login = $data["login"];
        $password = $data["password"];

        $sql = "UPDATE responsible SET name = ?, phone_number = ?, email = ?, login = ?, password = ? WHERE cpf = ?";

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $phone_number);
        $stmt->bindValue(3, $email);
        $stmt->bindValue(4, $login);
        $stmt->bindValue(5, $password);
        $stmt->bindValue(6, $cpf);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Responsável atualizado com sucesso!';
        } else {
            var_dump($stmt->errorInfo());
            throw new \Exception("Falha ao atualizar responsável");
        }
    }

    public static function delete($cpf)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'DELETE FROM responsible WHERE cpf = :cpf';

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Responsável deletado com sucesso!';
        } else {
            var_dump($stmt->errorInfo());
            throw new \Exception("Falha ao deletar responsável");
        }
    }

    public static function deposit($enrollment, $value)
    {
        if ($value <= 1) {
            throw new \Exception("O valor deve ser maior que R$ 1");
        }

        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $selectSql = 'SELECT * FROM student WHERE enrollment = :enrollment';

        $selectStmt = $connPdo->prepare($selectSql);

        $selectStmt->bindValue(':enrollment', $enrollment);
        $selectStmt->execute();

        $selectedStudent = $selectStmt->fetch(\PDO::FETCH_ASSOC);
        $currentBalance = $selectedStudent['balance'];

        $updatedBalance =  $currentBalance + $value;

        $sql = "UPDATE student SET balance = ? WHERE enrollment = ?";

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(1, $updatedBalance);
        $stmt->bindValue(2, $enrollment);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Deposito efetuado com sucesso!';
        } else {
            var_dump($stmt->errorInfo());
            throw new \Exception("Falha ao depositar");
        }
    }
}
