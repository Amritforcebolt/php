<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>

    <?php

    include '_dbconnect.php';

    //creating database
    //    $sql = "CREATE DATABASE amrit4";
    //    $result = mysqli_query($conn,$sql);

    //creating table

    // $sql = "CREATE TABLE `students` ( `name` VARCHAR(15) NOT NULL AUTO_INCREMENT, `roll_no` INT(3))";

    // $sql = "CREATE TABLE Persons (
    //     PersonID int,
    //     LastName varchar(255),
    //     FirstName varchar(255),
    //     Address varchar(255),
    //     City varchar(255)
    // )";

    // $result = mysqli_query($conn, $sql);
    // echo 'connected ' . var_dump($result) . ' <br>';
    // echo $result;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        echo "$name $email $password";

        $sql = "INSERT INTO users (name,email,password)
        VALUES ('$name','$email','$password')";
        
        $result = mysqli_query($conn,$sql);
        echo 'connected' .var_dump($result). '<br>';
        
    }
    ?>

    <div class="container">
        <h3>Signup</h3>
        <form action="/php_tut/signup.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input name='email' type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>