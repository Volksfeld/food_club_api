<?php

namespace App\Models;

class Product
{
    private static $table = 'product';


    public static function select(int $code)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'SELECT * FROM ' . self::$table . ' WHERE code = :code';
        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            throw new \Exception("Nenhum produto encontrado");
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
            throw new \Exception("Nenhum produto encontrado");
        }
    }



    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'INSERT INTO ' . self::$table . ' (
                type,
                code,
                name,
                picture,
                price,
                blocked,
              ) VALUES (
                :type,
                :code,
                :name,
                :picture,
                :price,
                :blocked,
              )';

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':type', $data['type']);
        $stmt->bindValue(':code', $data['code']);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':picture', $data['picture']);
        $stmt->bindValue(':price', $data['price']);
        $stmt->bindValue(':blocked', $data['blocked']);

        if ($stmt->rowCount() > 0) {
            return 'Produto inserido com sucesso!';
        } else {
            throw new \Exception("Falha ao inserir produto");
        }
    }
}
