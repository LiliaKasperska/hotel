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
    <body style="background-image: url(Фон.png); background-repeat: no-repeat; background-size: 85%; background-position-x: right;">
        <?php include_once("header.php") ?>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-4">                     
               <?php include_once("calendar.php"); ?>
            </div>
            <div class="col-sm-2">
                <a href="new.php?id_order=0"><button type="button" class="btn btn-dark" style="font-family: Roboto Italic;">Додати нове</button></a>
                <br><br>
                <table class="table table-striped">
                    <?php
                        $sql="SELECT type_room.name AS type, rooms.* FROM type_room, rooms WHERE type_room.id=rooms.id_type";  
                        $res=mysqli_query($connect,$sql);
                        while($result=mysqli_fetch_array($res)){
                    ?>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-sm-9">
                                    <a href="#" style="text-decoration: none; color: black; font-family: Roboto Italic;"><?php echo $result['name'] ?></a>
                                </div>
                                <div class="col-sm-1">
                                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions0<?php echo $result['id'] ?>" aria-controls="offcanvasWithBothOptions0<?php echo $result['id'] ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                        </svg>
                                    </button>
                                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions0<?php echo $result['id'] ?>" aria-labelledby="offcanvasWithBothOptionsLabel0<?php echo $result['id'] ?>" >
                                        <div class="offcanvas-header" style="background-color: rgb(102, 45, 145, .16);">
                                            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel0<?php echo $result['id'] ?>" style="font-family: Roboto Italic;"><?php echo $result['name'] ?></h5>
                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрыть" style="font-family: Roboto Italic;"></button>
                                        </div>
                                        <div class="offcanvas-body" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16);">
                                            <p>Тип - <?php echo $result['type'] ?></p>
                                            <p>Ціна - <?php echo $result['price'] ?></p>
                                            <p>Опис<br><?php echo $result['description'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-sm-3"></div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>