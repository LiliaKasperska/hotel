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
                    <form class="row g-3" method="POST" action="clients.php">
                        <div class="col-md-6">
                            <input type="text" name="s" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                        </div>
						<div class="col-md-6">
                            <button type="submit" class="btn btn-dark" name="ss" style="font-family: Roboto Italic;">Пошук</button>   
                        </div>
                    </form>
					<hr style="margin: 1% 30% 2% 0%;  height: 1px; color: rgb(102, 45, 145); opacity: 100%;">
					<?php
                        if(isset($_POST['ss'])){
                            if(!empty($_POST['s'])){
                                $sql="SELECT * FROM clients WHERE name LIKE '%".$_POST['s']."%'";  
                                $res=mysqli_query($connect,$sql);
                                while($result=mysqli_fetch_array($res)){
								    if($result){
								    ?>
								    <div class="col-md-6">
								    	<label class="form-label" style="font-family: Roboto Italic; font-size: 18px;"><?php echo $result['name']; ?></label>
								    </div>
								    <div class="col-md-6">
								    	<label class="form-label" style="font-family: Roboto Italic;">Паспорт: <?php echo $result['passport']; ?></label>
								    </div>
								    <div class="col-md-6">
								    	<label class="form-label" style="font-family: Roboto Italic;">Телефон: <?php echo $result['phone']; ?></label>
								    </div>
                                    <div class="col-md-6">
								    </div>
                                    <hr style="margin: 1% 30% 2% 0%;  height: 1px; color: rgb(102, 45, 145); opacity: 100%;">
								    <?php
								    }
                                }
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