<?php


class department{

    private $name;
    private $description;
    private $img;

    protected $db;

    public function __construct($con){

        $this -> db = $con;

    }

    public function create($name,$desc,$imgName,$imgSize,$imgTmp){

        $this -> name = filter_var($name,FILTER_SANITIZE_STRING);
        $this -> description = filter_var($desc,FILTER_SANITIZE_STRING);

        $imgAllowedExtension = array('jpg','jpeg','gif','png');

        $img = explode('.',$imgName);

        $imgExtension = strtolower(end($img));

        $formErrors = array();

        if (!empty($imgName)){
            if (!in_array($imgExtension,$imgAllowedExtension)){
                $formErrors[] = '<p class="alert bg-transparent" style="border-color:#F90A0A">This Extension Is Not Allowed</p>';
            }
            if ($imgSize > 4194304){
                $formErrors[] ='<p class="alert bg-transparent" style="border-color:#F90A0A">Image Can`t Larger Than 4MB</p>';
            }
        }

        if (empty($formErrors)){

            $this -> img = rand(0,100000) . '_' . $imgName;

            $path = '../data/uploads/departments/';

            move_uploaded_file($imgTmp , $path . $this->img);

            $stmt = $this -> db  -> prepare("INSERT INTO department(name , description , img) VALUES(? , ? , ?)");
            $stmt -> bindParam(1,$this -> name );
            $stmt -> bindParam(2,$this -> description);
            $stmt -> bindParam(3,$this -> img);
            $stmt -> execute();

            if ($stmt -> rowCount() > 0){
                echo '<p class="container alert bg-transparent" style="border-color:#34F458;color:#34F458;">Added Successfully</p>';
            } else {
                echo '<p class="container alert bg-transparent" style="border-color:#F90A0A;color:#F90A0A;">Failed To Add</p>';
            }
        } else {

            foreach ($formErrors as $error){
                echo $error;
            }

        }

    }

    public function edit($id,$name,$desc,$imgName,$imgSize,$imgTmp){

        $this -> name = filter_var($name,FILTER_SANITIZE_STRING);
        $this -> description = filter_var($desc,FILTER_SANITIZE_STRING);

        $imgAllowedExtension = array('jpg','jpeg','gif','png');

        $img = explode('.',$imgName);

        $imgExtension = strtolower(end($img));

        $formErrors = array();

        if (!empty($imgName)){
            if (!in_array($imgExtension,$imgAllowedExtension)){
                $formErrors[] = '<p class="container alert bg-transparent" style="border-color:#F90A0A">This Extension Is Not Allowed</p>';
            }
            if ($imgSize > 4194304){
                $formErrors[] ='<p class="container alert bg-transparent" style="border-color:#F90A0A">Image Can`t Larger Than 4MB</p>';
            }
            if (empty($formErrors)){

                $this -> img = rand(0,100000) . '_' . $imgName;

                $path = '../data/uploads/departments/';

                move_uploaded_file($imgTmp , $path . $this->img);

                $stmt = $this -> db  -> prepare("UPDATE department SET name = ? , description =?  , img = ? WHERE ID = ?");
                $stmt -> execute(array($this -> name,$this -> description,$this->img,$id));

                if ($stmt -> rowCount() > 0){
                    echo '<p class="container alert bg-transparent" style="border-color:#34F458;color:#34F458;">Updated Successfully</p>';
                } else {
                    echo '<p class="container alert bg-transparent" style="border-color:#F90A0A;color:#F90A0A;">Failed</p>';
                }
            } else {

                foreach ($formErrors as $error){
                    echo $error;
                }

            }
        } else {
            $stmt = $this -> db  -> prepare("UPDATE department SET name = ? , description =?  WHERE ID = ?");
            $stmt -> execute(array($this -> name,$this -> description,$id));

            if ($stmt -> rowCount() > 0){
                echo '<p class="container alert bg-transparent" style="border-color:#34F458;color:#34F458;">Updated Successfully</p>';
            } else {
                echo '<p class="container alert bg-transparent" style="border-color:#F90A0A;color:#F90A0A;">Failed</p>';
            }
        }

    }

    public function delete($id){

        $stmt = $this -> db -> prepare("DELETE FROM department WHERE ID = ?");
        $stmt -> execute(array($id));

    }

    public function view($id){

        $stmt = $this -> db -> prepare("SELECT * FROM department WHERE ID = ?");
        $stmt -> execute(array($id));
        $row = $stmt -> fetch();

        return $row;
    }

    public function viewAll(){

        $stmt = $this -> db -> prepare("SELECT * FROM department");
        $stmt -> execute();
        $row = $stmt -> fetchAll();

        return $row;
    }



    public function count(){
        $stmt = $this -> db -> prepare("SELECT COUNT('name') FROM department");
        $stmt -> execute();
        return $stmt ->fetchColumn();
    }

    public function check($id){
        $stmt = $this -> db -> prepare("SELECT * FROM department WHERE ID = ?");
        $stmt -> execute(array($id));
        return $stmt -> rowCount();
    }
}