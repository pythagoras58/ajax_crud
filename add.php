<?php 
    include('connection.php');

    if(isset($_POST['save_student'])){
        $name = htmlentities($_POST['name']);
        $email = htmlentities($_POST['email']);
        $phone = htmlentities($_POST['phone']);
        $course = htmlentities($_POST['course']);

        if(($name == NULL) || ($email == NULL) || ($phone==NULL) || ($course == NULL)){
            $res = [
                'status'=> 422,
                'message'=> 'ALL FIELDS ARE REQUIRED'
            ];

            echo json_encode($res);
            return;
        }

        $query = "INSERT INTO students(name, email, phone,course) VALUES(:name,:email,:phone,:course)";
        $stmt = $conn ->prepare($query);

        $stmt->bindParam('s', $name,PDO::PARAM_STR);
        $stmt->bindParam('s', $email,PDO::PARAM_STR);
        $stmt->bindParam('s', $phone,PDO::PARAM_STR);
        $stmt->bindParam('s', $course,PDO::PARAM_STR);

        $runner = $stmt->execute([
            'name'=>$name,
            'email'=>$email,
            'phone'=>$phone,
            'course'=>$course
        ]);

        if($runner){
            $res = [
                'status'=> 200,
                'message'=> 'STUDENT CREATED SUCCESSFULLY'
            ];
            echo json_encode($res);
            return;
        }else{
            $res = [
                'status'=> 500,
                'message'=> 'SORRY AN ERROR OCCURED'
            ];
            echo json_encode($res);
            return;
        }
    }
?>