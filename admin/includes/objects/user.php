<?php

    class user {

        private $name;
        private $password;
        private $email;
        private $avater;

        protected $db;

        public  function __construct($con){

            $this -> db = $con;
        }



        public function create($username,$email,$password){

            $this -> name       = filter_var($username,FILTER_SANITIZE_STRING);
            $this -> password   = password_hash($password,PASSWORD_DEFAULT);
            $this -> email      = filter_var($email,FILTER_SANITIZE_EMAIL);

            $stmt = $this -> db -> prepare("INSERT INTO user(name, password, email, Date) VALUES(?,?,?,now())");
            $stmt -> bindParam(1,$this -> name);
            $stmt -> bindParam(2,$this -> password);
            $stmt -> bindParam(3,$this -> email  );
            $stmt -> execute();

            if ($stmt -> rowCount() > 0){
                echo '<p class="container alert bg-transparent" style="border-color:#34F458;color:#34F458;">Added Successfully</p>';
            } else {
                echo '<p class="container alert bg-transparent" style="border-color:#F90A0A;color:#F90A0A;">Failed To Add</p>';
            }

        }

        public function edit($id,$username,$email,$password,$avaterName,$avaterSize,$avaterTmp){

            $imgAllowedExtension = array('jpg','jpeg','gif','png');

            $avater = explode('.',$avaterName);

            $imgExtension = strtolower(end($avater));

            $formErrors = array();

            if (!empty($avaterName)){
                if (!in_array($imgExtension,$imgAllowedExtension)){
                    $formErrors[] = '<p class="alert bg-transparent" style="border-color:#F90A0A">This Extension Is Not Allowed</p>';
                }
                if ($avaterSize > 4194304){
                    $formErrors[] ='<p class="alert bg-transparent" style="border-color:#F90A0A">Image Can`t Larger Than 4MB</p>';
                }
                if (empty($formErrors)){

                    $this -> avater = rand(0,100000) . '_' . $avaterName;

                    $avaterPath = '../data/uploads/avaters/';

                    move_uploaded_file($avaterTmp , $avaterPath . $this->avater);

                    $stmt = $this -> db -> prepare("UPDATE user SET name = ? , password = ?, email = ?, avater = ?  WHERE ID = ?");
                    $stmt -> execute(array($this -> name, $this -> password,$this -> email,$this -> avater,$id));



                } else {

                    foreach ($formErrors as $error){
                        echo $error;
                    }

                }

            } else {

                $this -> name       = filter_var($username,FILTER_SANITIZE_STRING);
                $this -> password   = password_hash($password,PASSWORD_DEFAULT);
                $this -> email      = filter_var($email,FILTER_SANITIZE_EMAIL);

                if (empty($this -> password)){
                    $stmt = $this -> db -> prepare("UPDATE user SET name = ? , email = ?  WHERE ID = ?");
                    $stmt -> execute(array($this -> name,$this -> email,$id));
                } else {
                    $stmt = $this -> db -> prepare("UPDATE user SET name = ? , password = ?, email = ?  WHERE ID = ?");
                    $stmt -> execute(array($this -> name, $this -> password,$this -> email,$id));
                }

            }

        }

        public function delete($id){

            $stmt = $this -> db -> prepare("DELETE FROM user WHERE ID = ?");
            $stmt -> execute(array($id));

        }

        public function view($id){

            $stmt = $this -> db -> prepare("SELECT * FROM user WHERE ID = ?");
            $stmt -> execute(array($id));
            $row = $stmt -> fetch();

            return $row;
        }

        public function viewAll(){

            $stmt = $this -> db -> prepare("SELECT * FROM user");
            $stmt -> execute();
            $row = $stmt -> fetchAll();

            return $row;
        }

        public function countUser(){
            $stmt = $this -> db -> prepare("SELECT COUNT('name') FROM user WHERE GroupID = 0");
            $stmt -> execute();
            return $stmt ->fetchColumn();
        }

        public function countAdmin(){
            $stmt = $this -> db -> prepare("SELECT COUNT('name') FROM user WHERE GroupID = 1");
            $stmt -> execute();
            return $stmt ->fetchColumn();
        }

        public function countActive(){
            $stmt = $this -> db -> prepare("SELECT COUNT('name') FROM user WHERE status = 1 AND GroupID = 0");
            $stmt -> execute();
            return $stmt ->fetchColumn();
        }

        public function activate($id){
            $stmt = $this -> db -> prepare("UPDATE user SET status = 1 WHERE  ID = ?");
            $stmt -> execute(array($id));
            return $stmt -> rowCount();
        }

        public function countPending(){
            $stmt = $this -> db -> prepare("SELECT COUNT('name') FROM user WHERE status = 0 AND GroupID = 0");
            $stmt -> execute();
            return $stmt ->fetchColumn();
        }

        public function viewActive(){
            $stmt = $this -> db -> prepare("SELECT * FROM user WHERE status = 1 AND GroupID = 0");
            $stmt -> execute();
            return $stmt ->fetchAll();
        }

        public function viewPending(){
            $stmt = $this -> db -> prepare("SELECT * FROM user WHERE status = 0 AND GroupID = 0");
            $stmt -> execute();
            return $stmt ->fetchAll();
        }

        public  function check($id){
            $stmt = $this -> db -> prepare("SELECT * FROM user WHERE ID = ?");
            $stmt -> execute(array($id));
            $check = $stmt -> rowCount();
            return $check;
        }

        public function addAdmin($id){
            $stmt = $this -> db -> prepare("UPDATE user SET GroupID = 1 WHERE ID = ?");
            $stmt -> execute(array($id));
            return $stmt -> rowCount();
        }

        public function removeAdmin($id){
            $stmt = $this -> db -> prepare("UPDATE user SET GroupID = 0 WHERE ID = ?");
            $stmt -> execute(array($id));
            return $stmt -> rowCount();
        }

        public function viewAdmins(){
            $stmt = $this -> db -> prepare("SELECT * FROM user WHERE GroupID = 1 AND status = 1");
            $stmt -> execute();
            return $stmt -> fetchAll();
        }

        public function admin(){
            $stmt = $this -> db -> prepare("SELECT * FROM user WHERE GroupID = 1 AND status = 0");
            $stmt -> execute();
            return $stmt -> fetch();
        }
    }

