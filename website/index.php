<?php

    require 'database.php';

    session_start();


    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $mess = '';

        if ($results !== false && password_verify($_POST['password'], $results['password'])) {
            $_SESSION['user_id'] = $results['id'];
            header('Location: inicio.php');
            exit;
        }else{
            $mess = "Lo siento esas credenciales no coiciden";
        }

       
    }        
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>

    
    <div class="wrapper">
        <form action="index.php" method="post">
            <h1>Login</h1>

            <?php if(!empty($mess)) { ?>
        <p> <?= $mess ?> </p>
        <?php } ?>
            <div class="input-box">
                <input type="text" placeholder="usuario"required name="email">
                <i class='bx bxs-user' ></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="contraseña"required name="password">
                <i class='bx bxs-lock-alt' ></i>
            </div>
            <div class="remember-forgot">
                <label> <input type="checkbox">recuerdame</label>
                <a href="#">olvidaste tu contraseña?</a>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>no tienes una cuenta? <a href="signup.php"> Registrate</a></p>

            </div>
        </form>
    </div>
</body>
</html>