<?php 
    require 'database.php';

    $mess = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);
    
        if($stmt->execute()){
            $mess = "Ha sido creado el usuario";
        }else{
            $mess = "ha ocurrido un error creando su contraseña " . $stmt->errorInfo()[2];;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">
        <form action="signup.php" method="post">
            <h1>Sign up</h1>
            <?php if(!empty($mess)) { ?>
                <p><?= $mess ?></p>
            <?php } ?>
            <div class="input-box">
                <label for="email"><i class='bx bxs-envelope'></i></label>
                <input type="text" id="email" name="email" placeholder="Add your Email" required>
            </div>
            <div class="input-box">
                <label for="password"><i class='bx bxs-lock-alt'></i></label>
                <input type="password" id="password" name="password" placeholder="Add your password" required>
            </div>
            <div class="input-box">
                <label for="password-confirm"><i class='bx bxs-lock-alt'></i></label>
                <input type="password" id="password-confirm" name="password-confirm" placeholder="Confirm your password" required> 
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>
        <div class="register-link">
            <p>or <a href="index.php">Login</a></p>
        </div>
    </div>
</body>
</html>
