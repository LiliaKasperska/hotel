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
    <body style="background-image: url(Фон.png); background-repeat: no-repeat; background-size: 58.8%; background-position-x: right;">
        <?php include_once("header.php") ?>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-5">
                <div class="row">
                    <form class="row g-3" method="POST" action="settings_room.php">
                        <div>
                            <b style="font-family: Roboto Italic; font-size: 18px;">Види номерів</b>
                            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions1" aria-controls="offcanvasWithBothOptions1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                </svg>
                            </button>
                            <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions1" aria-labelledby="offcanvasWithBothOptionsLabel1">
                                <div class="offcanvas-header" style="background-color: rgb(102, 45, 145, .16);">
                                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel1" style="font-family: Roboto Italic; ">Види номерів</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
                                </div>
                                <div class="offcanvas-body" style="background-color: rgb(102, 45, 145, .16);">
                                    <?php
                                        $sql="SELECT * FROM type_room";  
                                        $res=mysqli_query($connect,$sql);
                                        while($result=mysqli_fetch_array($res)){
                                    ?>
                                    <a href="#" class="list-group-item list-group-item-action" aria-current="true" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                              			<div class="d-flex w-100 justify-content-between">
                              				<h5 class="mb-1"><?php echo $result['name']; ?></h5>
                                            <button class="btn " type="submit" value="<?php echo $result['id']; ?>" name="delete_type">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                </svg>                          
                                            </button>
                              			</div>
                              		</a><br>
                                    <?php } ?>
                                </div>
                            </div>
                          </div>
                          <hr style="margin: 1% 30% 2% 0%;  height: 1px; color: rgb(102, 45, 145); opacity: 100%;">
                          <div class="col-md-6">
                              <label class="form-label" style="font-family: Roboto Italic;">Назва</label>
                              <input type="text" name="name_type" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                          </div>
                          <div class="col-md-6">
                              <label class="form-label">&nbsp;</label><br>
                              <button type="submit" class="btn btn-dark" name="save_type" style="font-family: Roboto Italic;">Зберегти зміни</button>
                          </div>
                          <br><br>
                          <div>
                              <b style="font-family: Roboto Italic; font-size: 18px;">Номери</b>
                              <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                      <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                  </svg>
                              </button>
                              <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                                  <div class="offcanvas-header" style="background-color: rgb(102, 45, 145, .16);">
                                      <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel" style="font-family: Roboto Italic;">Номери</h5>
                                      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
                                  </div>
                                  <div class="offcanvas-body" style="background-color: rgb(102, 45, 145, .16);">
                                      <?php
                                          $sql="SELECT type_room.name AS type, rooms.* FROM type_room, rooms WHERE type_room.id=rooms.id_type";  
                                          $res=mysqli_query($connect,$sql);
                                          while($result=mysqli_fetch_array($res)){
                                      ?>
                                      <a href="#" class="list-group-item list-group-item-action" aria-current="true" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                              		        <div class="d-flex w-100 justify-content-between">
                              		            <h5 class="mb-1"><?php echo $result['name'] ?></h5>
                                              <button class="btn " type="submit" value="<?php echo $result['id']; ?>" name="delete_room">
                                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                      <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                  </svg>                          
                                              </button>
                              		        </div>
                              		        <p class="mb-1">Ціна - <?php echo $result['price'] ?> грн</p>
                                          <small><?php echo $result['type'] ?></small><br>
                              		        <small><?php echo $result['description'] ?></small>
                              				</a><br>
                                      <?php } ?>
                                  </div>
                              </div>
                          </div>
                          <hr style="margin: 1% 30% 2% 0%;  height: 1px; color: rgb(102, 45, 145); opacity: 100%;">
                          <div class="col-md-6">
                              <label class="form-label" style="font-family: Roboto Italic;">Тип</label>
                              <select class="form-select" aria-label="Default select example" name="type_select" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                                  <option value="0" selected style="color: white;">Виберіть тип</option>
                                  <?php
                                      $sql="SELECT * FROM type_room";  
                                      $res=mysqli_query($connect,$sql);
                                      while($result=mysqli_fetch_array($res)){
                                          echo "<option value='".$result['id']."' style='color: white;'>".$result['name']."</option>";
                                      }
                                  ?>
                              </select>
                          </div>
                          <div class="col-md-6">
                              <label class="form-label" style="font-family: Roboto Italic;">Назва</label>
                              <input type="text" name="name_room" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                          </div>
                          <div class="col-md-6">
                              <label class="form-label" style="font-family: Roboto Italic;">Ціна</label>
                              <input type="number" name="price" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                          </div>
                          <div class="col-md-6">
                              <label class="form-label" style="font-family: Roboto Italic;">Опис</label>
                              <textarea class="form-control" name="description" rows="1" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;"></textarea>
                          </div>
                          <div class="col-md-6">
                              <button type="submit" class="btn btn-dark" name="save_room" style="font-family: Roboto Italic;">Зберегти зміни</button>
                          </div>
                    </form>
                    <?php
                        if(isset($_POST['save_type'])){
                            if(!empty($_POST['name_type'])){
                                $sql="INSERT INTO type_room (name) VALUES ('".$_POST['name_type']."')";  
                                $res=mysqli_query($connect,$sql);
                                ?>
                                <script>document.location.href="settings_room.php"</script>
                                <?php
                            }
                        }
                        if(isset($_POST['delete_type'])){
                            $sql="DELETE FROM type_room WHERE id='".$_POST['delete_type']."'";  
                            $res=mysqli_query($connect,$sql);
                            ?>
                            <script>document.location.href="settings_room.php"</script>
                            <?php
                        }
                        if(isset($_POST['save_room'])){
                          if(!empty($_POST['name_room']) and !empty($_POST['price']) and $_POST['type_select']!='0'){
                              $sql="INSERT INTO rooms(id_type, name, price, description) VALUES ('".$_POST['type_select']."','".$_POST['name_room']."','".$_POST['price']."','".$_POST['description']."')";  
                              $res=mysqli_query($connect,$sql);
                              ?>
                              <script>document.location.href="settings_room.php"</script>
                              <?php
                          }
                        }
                        if(isset($_POST['delete_room'])){
                            $sql="DELETE FROM rooms WHERE id='".$_POST['delete_room']."'";  
                            $res=mysqli_query($connect,$sql);
                            ?>
                            <script>document.location.href="settings_room.php"</script>
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