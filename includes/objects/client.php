<?php


class client{

    private $name;
    private $address;
    private $phone;
    private $email;


    protected $db;

    public function __construct($con){
        $this -> db = $con;
    }

    public function create($name,$address,$phone,$email,$item_ID,$user_ID,$dept_ID){

        $this -> name = filter_var($name,FILTER_SANITIZE_STRING);
        $this -> address = filter_var($address,FILTER_SANITIZE_STRING);
        $this -> phone = filter_var($phone,FILTER_SANITIZE_NUMBER_INT);
        $this -> email = filter_var($email,FILTER_SANITIZE_EMAIL);

        $stmt = $this -> db -> prepare("INSERT INTO clients(name, address, phone, email, user_ID, item_ID, dept_ID, date) VALUES(?, ?, ?, ?, ?, ?, ?, now())");
        $stmt -> bindParam(1,$this -> name);
        $stmt -> bindParam(2,$this -> address);
        $stmt -> bindParam(3,$this -> phone);
        $stmt -> bindParam(4,$this -> email);
        $stmt -> bindParam(5,$user_ID);
        $stmt -> bindParam(6,$item_ID);
        $stmt -> bindParam(7,$dept_ID);
        $stmt -> execute();

        if ($stmt -> rowCount() > 0){
            echo '<p class="container alert bg-transparent" style="border-color:#34F458;color:#34F458;">Added SuccessFully </p>';
        } else {
            echo '<p class="container alert bg-transparent" style="border-color:#F90A0A;color:#F90A0A;">Failed</p>';
        }

    }

    public function viewAll($id){

        $stmt = $this -> db -> prepare("SELECT items.name AS item, department.name AS dept, clients.* FROM clients INNER JOIN department ON department.ID = clients.dept_ID  INNER JOIN items ON items.ID = clients.item_ID WHERE clients.sold = 0 AND clients.user_ID = ?  ORDER BY ID DESC ");
        $stmt -> execute(array($id));
        return $stmt -> fetchAll();
    }

    public function view($id){

        $stmt = $this -> db -> prepare("SELECT * FROM clients WHERE user_ID = ?");
        $stmt -> execute(array($id));
        return $stmt -> fetch();

    }

    public function done($id){

        $stmt = $this -> db -> prepare("UPDATE clients SET sold = 1 WHERE ID = ?");
        $stmt -> execute(array($id));

        if ($stmt -> rowCount() > 0){
            echo '<p class="container alert bg-transparent" style="border-color:#34F458;color:#34F458;">Updated SuccessFully </p>';
        } else {
            echo '<p class="container alert bg-transparent" style="border-color:#F90A0A;color:#F90A0A;">Failed</p>';
        }
    }

    public function sold($id){
        $stmt = $this -> db -> prepare("SELECT items.name AS item ,items.price AS price, department.name AS dept, clients.* FROM clients INNER JOIN department ON department.ID = clients.dept_ID  INNER JOIN items ON items.ID = clients.item_ID WHERE clients.sold = 1 AND clients.user_ID = ?");
        $stmt -> execute(array($id));
        return $stmt -> fetchAll();
    }

    public function cancel($id){

        $stmt = $this -> db -> prepare("DELETE FROM clients WHERE ID = ?");
        $stmt -> execute(array($id));

    }

}