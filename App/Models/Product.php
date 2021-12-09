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
            var_dump($stmt->errorInfo());
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
            var_dump($stmt->errorInfo());
            throw new \Exception("Nenhum produto encontrado");
        }
    }

    public static function insert($data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        if (!empty($data['ingredients'])) {
            $sql = 'INSERT INTO product (type, code, name, price, ingredients) VALUES (:type, :code, :name, :price, :ingredients)';

            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':type', $data['type']);
            $stmt->bindValue(':code', $data['code']);
            $stmt->bindValue(':name', $data['name']);
            $stmt->bindValue(':price', $data['price']);
            $stmt->bindValue(':ingredients', $data['ingredients']);
        } else {
            $sql = 'INSERT INTO product (type, code, name, price, provider) VALUES (:type, :code, :name, :price, :provider)';

            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(':type', $data['type']);
            $stmt->bindValue(':code', $data['code']);
            $stmt->bindValue(':name', $data['name']);
            $stmt->bindValue(':price', $data['price']);
            $stmt->bindValue(':provider', $data['provider']);
        }
    
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Produto inserido com sucesso!';
        } else {
            var_dump($stmt->errorInfo());
            throw new \Exception("Falha ao inserir produto");
        }
    }

    public static function update($code, $data)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $type = $data["type"];
        $name = $data["name"];
        $price = $data["price"];

        if (!empty($data['ingredients'])) {
            $sql = "UPDATE product SET type = ?, name = ?, price = ?, ingredients = ? WHERE code = ?";

            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(1, $type);
            $stmt->bindValue(2, $name);
            $stmt->bindValue(3, $price);
            $stmt->bindValue(4, $data['ingredients']);
            $stmt->bindValue(5, $code);

            $stmt->execute();
        } else {
            $provider = $data['provider'];

            $sql = "UPDATE product SET type = ?, name = ?, price = ?, provider = ? WHERE code = ?";

            $stmt = $connPdo->prepare($sql);
            $stmt->bindValue(1, $type);
            $stmt->bindValue(2, $name);
            $stmt->bindValue(3, $price);
            $stmt->bindValue(4, $provider);
            $stmt->bindValue(5, $code);

            $stmt->execute();
        }


        if ($stmt->rowCount() > 0) {
            return 'Produto atualizado com sucesso!';
        } else {
            var_dump($stmt->errorInfo());
            throw new \Exception("Falha ao atualizar produto");
        }
    }

    public static function delete($code)
    {
        $connPdo = new \PDO(DBDRIVE . ': host=' . DBHOST . '; dbname=' . DBNAME, DBUSER, DBPASS);

        $sql = 'DELETE FROM product WHERE code = :code';

        $stmt = $connPdo->prepare($sql);
        $stmt->bindValue(':code', $code);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return 'Produto deletado com sucesso!';
        } else {
            var_dump($stmt->errorInfo());
            throw new \Exception("Falha ao deletar produto");
        }
    }
}
