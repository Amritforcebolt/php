<?php
// sleep(5);

include './_dbconnect.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $userid = $_POST['userid'];

    if ($_POST['id']) {
        $id = $_POST['id'];
        $sql = "UPDATE todos SET name = '$name', email= '$email' WHERE userid = $id ";

        $result = mysqli_query($conn, $sql);

        echo 'update';
        print $result;
        print $name;
        print $email;
    }elseif($_POST['delid']){
        $delid = $_POST['delid'];
        $sql = "DELETE FROM todos WHERE userid = $delid";
        $result = mysqli_query($conn, $sql);
        echo 'del'; 
        print $result;


    } else {
        $sql = "INSERT INTO todos (name,email,userid) VALUES ('$name','$email','$userid')";

        $result = mysqli_query($conn, $sql);

        echo var_dump($result);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM todos";

    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    $data = [];
    while ($rows = mysqli_fetch_assoc($result)) {
        $data[] = array(
            'id' => $rows['id'],
            'name' => $rows['name'],
            'email' => $rows['email'],
            'userid' => $rows['userid']
        );
    }

    echo json_encode($data);
}
