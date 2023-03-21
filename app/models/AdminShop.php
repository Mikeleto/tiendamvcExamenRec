<?php

class AdminShop
{
    private $db;

    public function __construct()
    {
        $this->db = Mysqldb::getInstance()->getDatabase();

    }

    public function createPay($data)
    {
        $response = false;

        $sql = 'INSERT INTO payments(name,deleted,deleted_at) 
                VALUES (:name,:deleted,:deleted_at)';
        $params = [
            ':name' => $data['name'],
            ':deleted' => 0,
            ':deleted_at' => null,
        ];
        $query = $this->db->prepare($sql);
        $response = $query->execute($params);



        return $response;
    }
    public function getSales()
    {
        $sql = 'SELECT * FROM carts WHERE state = 1 ';
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getSalesById($id)
    {
        $sql = 'SELECT * FROM carts WHERE payment_id=:payment_id';
        $query = $this->db->prepare($sql);
        $query->execute([':id' => $id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getPayment()
    {
        $sql = 'SELECT * FROM payments WHERE deleted = 0 ';
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPaymentById($id)
    {
        $sql = 'SELECT * FROM payments WHERE payment_id=:payment_id';
        $query = $this->db->prepare($sql);
        $query->execute([':payment_id' => $id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function payments($id)
    {
        $sql = 'SELECT * FROM payments';
        $query = $this->db->prepare($sql);
        $query->execute([':id' => $id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getConfigs($type)
    {
        $sql = 'SELECT * FROM config WHERE type=:type ORDER BY value DESC';
        $query = $this->db->prepare($sql);
        $query->execute([':type' => $type]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function setPay($user)
    {
        $errors = [];



            $sql = 'UPDATE payments SET name=:name
                    WHERE payment_id=:payment_id';

            $params = [
                ':payment_id' => $user['payment_id'],
                ':name' => $user['name'],

            ];


        $query = $this->db->prepare($sql);

        if ( ! $query->execute($params) ) {
            array_push($errors, 'Error al modificar el usuario administrador');
        }

        return $errors;

    }

    public function deletePay($id)
    {
        $errors = [];

        $sql = 'UPDATE payments SET deleted=:deleted, deleted_at=:deleted_at WHERE payment_id=:payment_id';
        $params = [
            'payment_id' => $id,
            'deleted' => 1,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];

        $query = $this->db->prepare($sql);

        if ( ! $query->execute($params) ) {
            array_push($errors, 'Error al eliminar el metodo');
        }

        return $errors;
    }
}