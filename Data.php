<?php
session_start();

    require_once(__DIR__ . "/app/models/Email.php");
    require_once(__DIR__ . "/app/config/Database.php");

    if (!isset($_SESSION['access_token'])) {
        header('Location: index.php');
        exit();
    }

    //  init DB & Connect 
    $database = new Database();
    $db = $database->connect();

    // init email 

    $email = new Email($db);

    // Email query
    $result = $email->read();
    // get row count 
    $num = $result->rowCount();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email | Rest Api Email Code Challenge</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="app/style/signin.css">
</head>

<body class="text-center">
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Recipient</th>
                    <th>Body</th>
                    <th>Subject</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                echo "<tr>";
                echo "<td>".$row["sender"]."</td>";
                echo "<td>".$row["recipient"]."</td>";
                echo "<td>".$row["body"]."</td>";
                echo "<td>".$row["subject"]."</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
                <th>Nama</th>
                <th>Email</th>
                <th>picture</th>
            </thead>
            <tbody>
                <td><?php echo $_SESSION['givenName'] ?></td>
                <td><?php echo $_SESSION['email'] ?></td>
                <td><img src="<?php echo $_SESSION['picture'] ?>" alt="Foto Profil"></td>
            </tbody>
        </table>
        <input type="button" onclick="window.location= 'Logout.php'" class="btn btn-danger" value="Logout">
    </div>
</body>

</html>