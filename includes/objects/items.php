<?php


class items{

    private $name;
    private $desc;
    private $price;
    private $img;
    private $dept_ID;
    private $user_ID;

    protected $db;

    public function __construct($con){
        $this -> db = $con;
    }

    public function create($name,$desc,$price,$imgName,$imgSize,$imgTmp,$dept_ID,$use_ID){

        $this -> name    = filter_var($name,FILTER_SANITIZE_STRING);
        $this -> desc    = filter_var($desc,FILTER_SANITIZE_STRING);
        $this -> price   = filter_var($price,FILTER_SANITIZE_NUMBER_INT);
        $this -> dept_ID = $dept_ID;
        $this -> user_ID = $use_ID;

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
        }

        if (empty($formErrors)){

            $this -> img = rand(0,100000) . '_' . $imgName;

            $path = 'data/uploads/items/';

            move_uploaded_file($imgTmp , $path . $this->img);

            $stmt = $this -> db  -> prepare("INSERT INTO items(name, description, price, img, dept_ID, user_ID, date) VALUES(?, ?, ?, ?, ?, ?, now())");
            $stmt -> bindParam(1,$this -> name );
            $stmt -> bindParam(2,$this -> desc);
            $stmt -> bindParam(3,$this -> price);
            $stmt -> bindParam(4,$this -> img);
            $stmt -> bindParam(5,$this -> dept_ID);
            $stmt -> bindParam(6,$this -> user_ID);
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


    public function edit($id,$name,$desc,$price,$imgName,$imgSize,$imgTmp,$dept_ID,$use_ID){

        $this -> name    = filter_var($name,FILTER_SANITIZE_STRING);
        $this -> desc    = filter_var($desc,FILTER_SANITIZE_STRING);
        $this -> price   = filter_var($price,FILTER_SANITIZE_NUMBER_INT);
        $this -> dept_ID = $dept_ID;
        $this -> user_ID = $use_ID;

        $imgAllowedExtension = array('jpg','jpeg','gif','png');

        $img = explode('.',$imgName);

        $imgExtension = strtolower(end($img));

        $formErrors = array();

        if (empty($imgName)){

            $stmt = $this -> db  -> prepare("UPDATE  items SET name = ?, description = ?, price = ?, dept_ID = ?, user_ID = ? WHERE ID = ?");
            $stmt -> execute(array($this->name,$this->desc,$this->price,$this->dept_ID,$this->user_ID,$id));

            if ($stmt -> rowCount() > 0){
                echo '<p class="container alert bg-transparent" style="border-color:#34F458;color:#34F458;">Updated Successfully</p>';
            } else {
                echo '<p class="container alert bg-transparent" style="border-color:#F90A0A;color:#F90A0A;">Failed To Update</p>';
            }


        } else {
            if (!empty($imgName)){
                if (!in_array($imgExtension,$imgAllowedExtension)){
                    $formErrors[] = '<p class="container alert bg-transparent" style="border-color:#F90A0A">This Extension Is Not Allowed</p>';
                }
                if ($imgSize > 4194304){
                    $formErrors[] ='<p class="container alert bg-transparent" style="border-color:#F90A0A">Image Can`t Larger Than 4MB</p>';
                }
            }

            if (empty($formErrors)){

                $this -> img = rand(0,100000) . '_' . $imgName;

                $path = 'data/uploads/items/';

                move_uploaded_file($imgTmp , $path . $this->img);

                $stmt = $this -> db  -> prepare("UPDATE  items SET name = ?, description = ?, price = ?, img = ?, dept_ID = ?, user_ID = ? WHERE ID = ?");
                $stmt -> execute(array($this->name,$this->desc,$this->price,$this->img,$this->dept_ID,$this->user_ID,$id));

                if ($stmt -> rowCount() > 0){
                    echo '<p class="container alert bg-transparent" style="border-color:#34F458;color:#34F458;">Updated Successfully</p>';
                } else {
                    echo '<p class="container alert bg-transparent" style="border-color:#F90A0A;color:#F90A0A;">Failed To Update</p>';
                }
            } else {

                foreach ($formErrors as $error){
                    echo $error;
                }

            }
        }

    }

    public function delete($id){
        $stmt = $this -> db -> prepare('DELETE FROM items WHERE ID = ?');
        $stmt -> execute(array($id));
    }

    public function view($id){
        $stmt = $this -> db -> prepare("SELECT * FROM  items WHERE ID = ?");
        $stmt -> execute(array($id));
        return $stmt -> fetch();
    }

    public function viewAll(){
        $stmt = $this -> db -> prepare("SELECT * FROM items ");
        $stmt -> execute();
        return $stmt -> fetchAll();
    }

    public function userItems($id){
        $stmt = $this -> db -> prepare("SELECT * FROM items WHERE user_ID = ?");
        $stmt -> execute(array($id));
        return $stmt -> fetchAll();
    }

    public function count(){
        $stmt = $this -> db -> prepare("SELECT COUNT('name') FROM items");
        $stmt -> execute();
        return $stmt ->fetchColumn();
    }

    public function check($id){
        $stmt = $this -> db -> prepare("SELECT * FROM items WHERE ID = ?");
        $stmt -> execute(array($id));
        return $stmt -> rowCount();
    }

    public function itemDept($id){
        $stmt = $this -> db -> prepare("SELECT * FROM items WHERE dept_ID = ?");
        $stmt -> execute(array($id));
        return $stmt -> fetchAll();
    }

    public function itemInfo($id){
        $stmt = $this -> db -> prepare("SELECT user.name AS user, department.name AS dept, items.* FROM items INNER JOIN department ON department.ID = items.dept_ID INNER JOIN user ON user.ID = items.user_ID WHERE items.ID = ? ORDER BY ID DESC");
        $stmt -> execute(array($id));
        return $stmt -> fetch();
    }

    public function viewHome(){
        $stmt = $this -> db -> prepare("SELECT * FROM items ORDER BY ID DESC LIMIT 8 ");
        $stmt -> execute();
        return $stmt -> fetchAll();
    }

    public function search($name){
        $stmt = $this -> db -> prepare("SELECT * FROM items WHERE name LIKE '%$name%' ORDER BY ID DESC");
        $stmt -> execute();
        return $stmt -> fetchAll();
    }

    public function related($id){
        $stmt = $this -> db -> prepare("SELECT * FROM items WHERE dept_ID = ? ORDER BY ID DESC LIMIT 3 ");
        $stmt -> execute(array($id));
        return $stmt -> fetchAll();
    }
}