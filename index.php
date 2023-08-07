<?php 
    require_once("connect_db.php");
?>
<html>
    <head>
        <title>Імобільяре</title>
        <link href="style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body style="background-image: url(Фон.png); background-repeat: no-repeat; background-size: 58%; background-position-x: right;">
        <div>
            <ul class="nav justify-content-left">
                <li class="nav-item">
                    <h1><a class="nav-link disabled" href="main.php" tabindex="-1" aria-disabled="true" style="font-family: Roboto Italic; color: black;"><i><b>ІМОБІЛЬЯРЕ</b></i></a></h1>
                </li>
            </ul>    
        </div>
        <hr style="margin: 1% 30% 2% 0%; width: 40%; height: 1px; color: rgb(102, 45, 145); opacity: 100%;">
        <div style=" margin: auto; width: 25%; ">
            <h1 class="h" style="font-family: Roboto Italic;"><i>Вхід</i></h1>
            <form method="POST" action="index.php" >
                <div class="form-floating" style=" margin: auto; width: 90%; border: 1px solid purple; border-radius: 5px; color: black;">
                    <input type="text" class="form-control" id="floatingPassword" placeholder="Логін" name="login" style="background-color: rgb(102, 45, 145, .16); font-family: Roboto Italic;">
                    <label for="floatingPassword" style="font-family: Roboto Italic;">Логін</label>
                </div>
                <br>
                <div class="form-floating" style=" margin: auto; width: 90%;  border: 1px solid purple; border-radius: 5px;">
                    <input type="password" class="form-control" id="floatingPassword1" placeholder="Пароль" name="pass" style="background-color: rgb(102, 45, 145, .16); font-family: Roboto Italic;">
                    <label for="floatingPassword1" style="font-family: Roboto Italic;">Пароль</label>
                </div>
                <br>
                <div style="text-align:center;"><input type="submit" class="btn btn-dark" value="Увійти" name="admin" style="font-family: Roboto Italic;"></div>
            </form>
            <?php
                session_start();
                if(!empty($_SESSION['id'])){
                    header('Location: main.php');
                } else {
                    if(isset($_POST['admin'])){
                        $sql="SELECT * FROM admin WHERE login='".$_POST['login']."' AND password='".$_POST['pass']."'";
                        $res=mysqli_query($connect,$sql);
                        $result=mysqli_fetch_array($res);
                        if(empty($result)){
                            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>Помилка!<br></strong> Невірний логін або пароль<button type='button' class='close' data-dismiss='alert' aria-label='Закрити'><span aria-hidden='true'>&times;</span></button></div>";
                        } else {
                            $_SESSION['id']=$result['id'];
                            header('Location: main.php');
                        }
                    }
                }
            ?>           
        </div>        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>