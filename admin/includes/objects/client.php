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

    public function create($name,$address,$phone,$email,$item_ID){

        $this -> name = filter_var($name,FILTER_SANITIZE_STRING);
        $this -> address = $address;
        $this -> phone = filter_var($phone,FILTER_SANITIZE_NUMBER_INT);
        $this -> email = filter_var($email,FILTER_SANITIZE_EMAIL);

        $stmt = $this -> db -> prepare("INSERT INTO clients(name, address, phone, email, item_ID, date) VALUES(?, ?, ?, ?, ?, now())");
        $stmt -> bindParam(1,$this -> name);
        $stmt -> bindParam(2,$this -> address);
        $stmt -> bindParam(3,$this -> phone);
        $stmt -> bindParam(4,$this -> email);
        $stmt -> bindParam(5,$item_ID);
        $stmt -> execute();

        if ($stmt -> rowcount() > 0){
            echo '<p class="container alert bg-transparent" style="border-color:#34F458;color:#34F458;">Added Successfully</p>';
        } else {
            echo '<p class="container alert bg-transparent" style="border-color:#F90A0A;color:#F90A0A;">Failed To Add</p>';
        }

    }

    public function viewAll(){
        $stmt = $this -> db -> prepare("SELECT * FROM clients");
        $stmt -> execute();
        return $stmt -> fetchAll();
    }

//    public function viewAll(){
//
//        $stmt = $this -> db -> prepare("SELECT items.name AS item, department.name AS dept, clients.* FROM clients INNER JOIN department ON department.ID = clients.dept_ID  INNER JOIN items ON items.ID = clients.item_ID  ORDER BY ID DESC ");
//        $stmt -> execute();
//        return $stmt -> fetchAll();
//
//    }

    public function done($id){

        $stmt = $this -> db -> prepare("UPDATE clients SET sold = 1 WHERE ID = ?");
        $stmt -> execute(array($id));

    }

    public function sold($id){
        $stmt = $this -> db -> prepare("SELECT * FROM clients WHERE sold = 1 AND user_ID = ?");
        $stmt -> execute(array($id));
        return $stmt -> fetchAll();
    }

    public function cancel($id){

        $stmt = $this -> db -> prepare("DELETE FROM clients WHERE ID = ?");
        $stmt -> execute(array($id));

    }

}