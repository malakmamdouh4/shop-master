<?php


class slider{

    private $head;
    private $caption;
    private $img;

    protected $db;

    public function __construct($con){

        $this -> db = $con;

    }

    public function add($head,$caption,$imgName,$imgSize,$imgTmp){

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

            $path = '../data/uploads/slider/';

            move_uploaded_file($imgTmp , $path . $this->img);

            $this -> head       = filter_var($head,FILTER_SANITIZE_STRING);
            $this -> caption    = filter_var($caption,FILTER_SANITIZE_STRING);

            $stmt = $this -> db -> prepare("INSERT INTO slider(head, caption, img) VALUES(?,?,?)");
            $stmt -> bindParam(1,$this -> head);
            $stmt -> bindParam(2,$this -> caption);
            $stmt -> bindParam(3,$this -> img);
            $stmt -> execute();

        } else {

            foreach ($formErrors as $error){
                echo $error;
            }

        }

    }

    public function edit($id,$head,$caption,$imgName,$imgSize,$imgTmp){

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
            if (empty($formErrors)){

                $this -> img = rand(0,100000) . '_' . $imgName;

                $path = '../data/uploads/slider/';

                move_uploaded_file($imgTmp , $path . $this->img);

                $this -> head       = filter_var($head,FILTER_SANITIZE_STRING);
                $this -> caption    = filter_var($caption,FILTER_SANITIZE_STRING);

                $stmt = $this -> db -> prepare("UPDATE slider SET head = ?, caption = ?, img = ? WHERE ID = ?");
                $stmt -> execute(array($this -> head,$this -> caption,$this->img,$id));

            } else {

                foreach ($formErrors as $error){
                    echo $error;
                }

            }
        } else {

            $this -> head       = filter_var($head,FILTER_SANITIZE_STRING);
            $this -> caption    = filter_var($caption,FILTER_SANITIZE_STRING);

            $stmt = $this -> db -> prepare("UPDATE slider SET head = ?, caption = ? WHERE ID = ?");
            $stmt -> execute(array($this -> head,$this -> caption,$id));

        }

    }

    public function delete($id){

       $stmt = $this -> db -> prepare("DELETE FROM slider WHERE ID = ?");
       $stmt -> execute(array($id));

    }

    public function viewAll(){
        $stmt = $this -> db -> prepare("SELECT * FROM slider ");
        $stmt -> execute();
        return $stmt -> fetchAll();
    }

}