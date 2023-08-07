<?php 
    require_once("connect_db.php");
    session_start();
    if (empty($_SESSION['id'])) {
        header('Location: index.php');
    }
?>
<html style="overflow-x: hidden;">
    <head>
        <title>Імобільяре</title>
        <link href="style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">     
    </head>
    <body style="background-image: url(Фон.png); background-repeat: no-repeat; background-size: 58%; background-position-x: right;">
        <?php include_once("header.php") ?>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-5">
                <div class="row">
                    <?php 
                        $sql="SELECT * FROM admin WHERE id='".$_SESSION['id']."'";
                        $res=mysqli_query($connect,$sql);
                        $result=mysqli_fetch_array($res);
                    ?>
                    <form class="row g-3" method="POST" action="main.php">
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Ім'я</label>
                            <input type="text" name="name" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;" value="<?php echo $result['name'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Логін</label>
                            <input type="text" name="login" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;" value="<?php echo $result['login'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Телефон</label>
                            <input type="text" name="phone" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;" value="<?php echo $result['phone'] ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Пароль</label>
                            <input type="password" name="pass1" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                        </div>
                        <div class="col-md-6">
                            <br>
                            <button type="submit" class="btn btn-dark" name="save" style="font-family: Roboto Italic;">Зберегти зміни</button>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Повторіть пароль</label>
                            <input type="password" name="pass2" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                        </div>
                    </form>
                    <?php 
                        if(isset($_POST['save'])){
                            if(empty($_POST['pass1']) and empty($_POST['pass2']) and !empty($_POST['name']) and !empty($_POST['login']) and !empty($_POST['phone'])) {
                                $sql="UPDATE admin SET login='".$_POST['login']."', name='".$_POST['name']."', phone='".$_POST['phone']."' WHERE id='".$_SESSION['id']."'";
                                $res=mysqli_query($connect,$sql);
                                ?>
                                <script>document.location.href="main.php"</script>
                                <?php
                            }
                            if(!empty($_POST['pass1']) and !empty($_POST['pass2']) and $_POST['pass1']==$_POST['pass2'] and !empty($_POST['name']) and !empty($_POST['login']) and !empty($_POST['phone'])) {
                                $sql="UPDATE admin SET login='".$_POST['login']."', name='".$_POST['name']."', password='".$_POST['pass1']."', phone='".$_POST['phone']."' WHERE id='".$_SESSION['id']."'";
                                $res=mysqli_query($connect,$sql);
                                ?>
                                <script>document.location.href="main.php"</script>
                                <?php
                            }
                        }                      
                    ?>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>