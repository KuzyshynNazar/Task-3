<?php
include 'database.php';

if(count($_POST)>0){
    if($_POST['type']==1){
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $status=$_POST['status'];
        $role_id=$_POST['role_id'];
   
        $sql = ("INSERT INTO `users` (`first_name`, `last_name`,`status`,`role_id`) VALUES(?,?,?,?)");
	    $query = $pdo->prepare($sql);
        $query->execute([$first_name, $last_name, $status, $role_id]);
        
          if ($query) {
            echo json_encode(array("statusCode"=>200));
        }

    }
};




if(count($_POST)>0){
    if($_POST['type']==2){
        $id=$_POST['id'];
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $status=$_POST['status'];
        $role_id=$_POST['role_id'];

        $sql_1 = "UPDATE `users` SET `first_name`=?, `last_name`=?,`status`=?,`role_id`=? WHERE id=?";
        $query_1 = $pdo->prepare($sql_1);
	    $query_1->execute([$first_name, $last_name, $status, $role_id, $id]);
	   
        if ($query_1) {
            echo json_encode(array("statusCode"=>200));
        }
        
    }
};



if(count($_POST)>0){
    if($_POST['type']==3){
        $id=$_POST['id'];
       
        $sql_2 = "DELETE FROM users WHERE id=?";
	    $query_2 = $pdo->prepare($sql_2);
        $query_2->execute([$id]);
    
        if ( $query_2) {
            echo $id;
        }
    }
};

if(count($_POST)>0){
    if($_POST['type']==4){
        $id=$_POST['id'];
        $sql_3 = "DELETE FROM users WHERE id in ($id)";
        $query_3 = $pdo->prepare($sql_3);
        $query_3->execute([$id]);
        if ($query_3) {
            echo $id;
        }
        
    }
}

?>
