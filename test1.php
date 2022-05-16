<?php
// sleep(5);

include './_dbconnect.php';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
$email = $_POST['email'];

$sql = "INSERT INTO todos (name,email) VALUES ('$name','$email')";

$result = mysqli_query($conn,$sql);

echo var_dump($result);
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $sql = "SELECT * FROM todos";

    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    $data = [];
    while($rows = mysqli_fetch_assoc($result)){
        $data[] = array(
            'id' => $rows['id'],
            'name' => $rows['name'],
            'email' => $rows['email']
        );
    }
      
    echo json_encode($data);
}

?>