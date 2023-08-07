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
    <body style="background-image: url(Фон.png); background-repeat: no-repeat; background-size: 64.5%; background-position-x: right;">
        <?php include_once("header.php") ?>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-5">
                <div class="row">
                    <form class="row g-3" method="POST" action="settings_add_service.php">
                        <div>
                            <b style="font-family: Roboto Italic; font-size: 18px;">Партнери</b>
                            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions1" aria-controls="offcanvasWithBothOptions1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                            </button>
                            <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions1" aria-labelledby="offcanvasWithBothOptionsLabel1">
                                <div class="offcanvas-header" style="background-color: rgb(102, 45, 145, .16);">
                                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel1" style="font-family: Roboto Italic;">Партнери</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
                                </div>
                                <div class="offcanvas-body" style="background-color: rgb(102, 45, 145, .16);">
                                    <?php
                                        $sql="SELECT * FROM partner";  
                                        $res=mysqli_query($connect,$sql);
                                        while($result=mysqli_fetch_array($res)){
                                    ?>
                                    <a href="#" class="list-group-item list-group-item-action" aria-current="true" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                              				  <div class="d-flex w-100 justify-content-between">
                              					    <h5 class="mb-1"><?php echo $result['name']; ?></h5>
                              					    <button class="btn " type="submit" value="<?php echo $result['id']; ?>" name="delete_p">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                </svg>                      
                                            </button>
                              				  </div>
                              				  <p class="mb-1"><?php echo $result['address']; ?></p>
                                        <small><?php echo $result['phone']; ?></small>
                              			</a><br>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <hr style="margin: 1% 30% 2% 0%;  height: 1px; color: rgb(102, 45, 145); opacity: 100%;">
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Назва</label>
                            <input type="text" name="name_p" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Адреса</label>
                            <input type="text" name="address_p" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Телефон</label>
                            <input type="text" name="phone_p" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">&nbsp;</label><br>
                            <button type="submit" class="btn btn-dark" name="save_p" style="font-family: Roboto Italic;">Зберегти зміни</button>
                        </div>
                        <br><br>
                        <div>
                            <b style="font-family: Roboto Italic; font-size: 18px;">Додаткові послуги</b>
                            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                            </button>
                            <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                                <div class="offcanvas-header" style="background-color: rgb(102, 45, 145, .16);">
                                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel" style="font-family: Roboto Italic;">Додаткові послуги</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
                                </div>
                                <div class="offcanvas-body" style="background-color: rgb(102, 45, 145, .16);">
                                    <?php
                                        $sql="SELECT partner.name AS name_p, add_sevrvice.*, type_add_service.type AS type FROM partner, add_sevrvice, type_add_service WHERE partner.id=add_sevrvice.id_partner AND type_add_service.id=add_sevrvice.id_type";  
                                        $res=mysqli_query($connect,$sql);
                                        while($result=mysqli_fetch_array($res)){
                                      ?>
                                    <a href="#" class="list-group-item list-group-item-action" aria-current="true" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                            		        <div class="d-flex w-100 justify-content-between">
                            			          <h5 class="mb-1"><?php echo $result['name']; ?></h5>
                            			          <button class="btn " type="submit" value="<?php echo $result['id']; ?>" name="delete_service">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                </svg>                          
                                            </button>
                            		        </div>
                            		        <p class="mb-1">Ціна - <?php echo $result['price']; ?> грн</p>
                            		        <small><?php echo $result['name_p']; ?></small><br>
                                        <small><?php echo $result['type']; ?></small>
                            		    </a><br>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <hr style="margin: 1% 30% 2% 0%;  height: 1px; color: rgb(102, 45, 145); opacity: 100%;">
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Тип</label>
                            <select class="form-select" aria-label="Default select example" name="type_service" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                                <option value="0" selected style='color: white;'>Виберіть тип</option>
                                <?php
                                    $sql="SELECT * FROM type_add_service";  
                                    $res=mysqli_query($connect,$sql);
                                    while($result=mysqli_fetch_array($res)){
                                        echo "<option value='".$result['id']."' style='color: white;'>".$result['type']."</option>";
                                    }
                                  ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Партнер</label>
                            <select class="form-select" aria-label="Default select example" name="partner" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                                <option value="0" selected style='color: white;'>Виберіть партнера</option>
                                <?php
                                    $sql="SELECT * FROM partner";  
                                    $res=mysqli_query($connect,$sql);
                                    while($result=mysqli_fetch_array($res)){
                                        echo "<option value='".$result['id']."' style='color: white;'>".$result['name']."</option>";
                                    }
                                  ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Назва</label>
                            <input type="text" name="name_service" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Ціна</label>
                            <input type="number" name="price" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-dark" name="save_service" style="font-family: Roboto Italic;">Зберегти зміни</button>
                        </div>
                    </form>
                    <?php
                        if(isset($_POST['save_p'])){
                            if(!empty($_POST['name_p']) and !empty($_POST['address_p']) and !empty($_POST['phone_p'])){
                                $sql="INSERT INTO partner(name, address, phone) VALUES ('".$_POST['name_p']."','".$_POST['address_p']."','".$_POST['phone_p']."')";  
                                $res=mysqli_query($connect,$sql);
                                ?>
                                <script>document.location.href="settings_add_service.php"</script>
                                <?php
                            }
                        }
                        if(isset($_POST['delete_p'])){
                            $sql="DELETE FROM partner WHERE id='".$_POST['delete_p']."'";  
                            $res=mysqli_query($connect,$sql);
                            ?>
                            <script>document.location.href="settings_add_service.php"</script>
                            <?php
                        }
                        if(isset($_POST['save_service'])){
                          if(!empty($_POST['name_service']) and !empty($_POST['price']) and $_POST['type_service']!='0' and $_POST['partner']!='0'){
                              $sql="INSERT INTO add_sevrvice(id_type, id_partner, name, price) VALUES ('".$_POST['type_service']."','".$_POST['partner']."','".$_POST['name_service']."','".$_POST['price']."')";  
                              $res=mysqli_query($connect,$sql);
                              ?>
                              <script>document.location.href="settings_add_service.php"</script>
                              <?php
                          }
                        }
                        if(isset($_POST['delete_service'])){
                            $sql="DELETE FROM add_sevrvice WHERE id='".$_POST['delete_service']."'";  
                            $res=mysqli_query($connect,$sql);
                            ?>
                            <script>document.location.href="settings_add_service.php"</script>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>