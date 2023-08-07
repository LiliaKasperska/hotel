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
    <body style="background-image: url(Фон.png); background-repeat: no-repeat; background-size: 70.3%; background-position-x: right;">
        <?php include_once("header.php") ?>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="row">
                    <?php 
                        if(!empty($_GET['id_order']) and $_GET['id_order']!="0"){
                            $_POST['id_o']=$_GET['id_order'];
                            $sql="SELECT orders.*, clients.name AS client_name, clients.passport, clients.phone FROM orders JOIN clients ON clients.id=orders.id_client WHERE orders.id='".$_POST['id_o']."'";
                            $res=mysqli_query($connect,$sql);
                            $result=mysqli_fetch_array($res);
                        } else {
                            $_POST['id_o']='0';
                        }
                    ?>
                    <form class="row g-3" method="POST" action="new.php?id_order=<?php echo $_POST['id_o']; ?>">
                        <input type="hidden" name="id_o" value="<?php echo $_POST['id_o']; ?>">
                        <div class="col-md-4">
                            <label class="form-label" style="font-family: Roboto Italic; ">В'їзд</label>
                            <input type="date" name="enter" class="form-control" <?php if($_POST['id_o']!="0") {echo "value='".$result['date_start']."'";} if(!empty($_POST['enter'])) {echo "value='".$_POST['enter']."'";} ?> style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="font-family: Roboto Italic;">Виїзд</label>
                            <input type="date" name="finish" class="form-control" <?php if($_POST['id_o']!="0") {echo "value='".$result['date_end']."'";} if(!empty($_POST['finish'])) {echo "value='".$_POST['finish']."'";} ?> style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                        </div>
                        <div class="col-md-4">
                        <br>
                            <button type="submit" class="btn btn-dark" name="check" style="font-family: Roboto Italic;">Вільні номери</button>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Номер</label>
                            <select class="form-select" aria-label="Default select example" name="room" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                                <option <?php if($_POST['id_o']=="0") {echo "selected";} ?> style="color: white;">Виберіть номер</option>
                                <?php
                                    if(isset($_POST['check'])){
                                        $period = new DatePeriod(
                                            new DateTime($_POST['enter']),
                                            new DateInterval('P1D'),
                                            new DateTime($_POST['finish'])
                                       );
                                       $dates = array();
                                       foreach ($period as $key => $value) {
                                           $dates[] = $value->format('Y-m-d');     
                                       }
                                       $sql_r="SELECT `rooms`.`id`, `rooms`.`name`, `type_room`.`name` AS `t_name` FROM `rooms`, `type_room` WHERE `type_room`.`id`=`rooms`.`id_type` AND `rooms`.`name` IN(
                                        SELECT `rooms`.`name` FROM `rooms` WHERE `rooms`.`name` NOT IN (
                                            SELECT `rooms`.`name` FROM `rooms` WHERE `rooms`.`id` IN (
                                                SELECT `orders`.`id_room` FROM `orders` WHERE '".$dates[0]."' BETWEEN `orders`.`date_start` AND `orders`.`date_end`
                                            )";
                                        if(count($dates)>1){
                                            for($i=1;$i<count($dates);$i++){
                                                $sql_r=$sql_r."UNION SELECT `rooms`.`name` FROM `rooms` WHERE `rooms`.`id` IN (
                                                    SELECT `orders`.`id_room` FROM `orders` WHERE '".$dates[$i]."' BETWEEN `orders`.`date_start` AND `orders`.`date_end`
                                                )";
                                                if($i==count($dates)-1){
                                                    $sql_r=$sql_r."UNION SELECT `rooms`.`name` FROM `rooms` WHERE `rooms`.`id` IN (
                                                        SELECT `orders`.`id_room` FROM `orders` WHERE DATE_ADD('".$dates[$i]."', INTERVAL 1 DAY) BETWEEN `orders`.`date_start` AND `orders`.`date_end`
                                                    )";
                                                }
                                            }
                                        }
                                        $sql_r=$sql_r."))";                                
                                    } else {
                                        $sql_r="SELECT rooms.*, type_room.name AS t_name  FROM rooms, type_room WHERE type_room.id=rooms.id_type";  
                                    }
                                    
                                    $res_r=mysqli_query($connect,$sql_r);
                                    while($result_r=mysqli_fetch_array($res_r)){
                                        echo "<option value='".$result_r['id']."' style='color: white;' ";
                                        if($_POST['id_o']!="0" and $result_r['id']==$result['id_room']) {
                                          echo "selected";
                                        }
                                        echo ">".$result_r['t_name']."(".$result_r['name'].")</option>";
                                    }
                                  ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Статус</label>
                            <select class="form-select" aria-label="Default select example" name="status" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                                <option <?php if($_POST['id_o']=="0") {echo "selected";} ?> style="color: white;">Виберіть статус</option>
                                <?php
                                    $sql_s="SELECT * FROM status";  
                                    $res_s=mysqli_query($connect,$sql_s);
                                    while($result_s=mysqli_fetch_array($res_s)){
                                        echo "<option value='".$result_s['id']."' style='color: white;' ";
                                        if($_POST['id_o']!="0" and $result_s['id']==$result['id_status']) {
                                          echo "selected";
                                        }
                                        echo ">".$result_s['name']."</option>";
                                    }
                                  ?>
                            </select>
                        </div>
                        <br><br>
                        <b style="font-family: Roboto Italic; font-size: 18px; ">Дані клієнта</b>
                        <hr style="margin: 1% 30% 2% 0%;  height: 1px; color: rgb(102, 45, 145); opacity: 100%;">
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Прізвище, ім'я</label>
                            <input class="form-control" type="text" name="client_name" <?php if($_POST['id_o']!="0") {echo "value='".$result['client_name']."'";} ?> style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Паспорт</label>
                            <input type="text" name="passport" class="form-control" <?php if($_POST['id_o']!="0") {echo "value='".$result['passport']."'";} ?> style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Телефон</label>
                            <input type="text" name="phone" class="form-control" <?php if($_POST['id_o']!="0") {echo "value='".$result['phone']."'";} ?> style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" style="font-family: Roboto Italic;">Кількість людей</label>
                            <input type="number" name="count_p" class="form-control" <?php if($_POST['id_o']!="0") {echo "value='".$result['number_people']."'";} ?> style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                        </div>
                        <div class="col-md-3"><br><br></div>
                        <div class="col-md-4">
                            <br>
                            <button type="submit" class="btn btn-dark" name="save_info" style="font-family: Roboto Italic;">Зберегти зміни</button>
                        </div>
                        <div class="col-md-4">
                            <br>
                            <button type="submit" class="btn btn-dark" name="delete_o" style="font-family: Roboto Italic;">Видалити</button>
                        </div>
                        <br><br>
                        <b style="font-family: Roboto Italic; font-size: 18px;">Інше</b>
                        <hr  style="margin: 1% 30% 2% 0%;  height: 1px; color: rgb(102, 45, 145); opacity: 100%;">
                        <div class="col-md-4">
                            <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions" style="font-family: Roboto Italic;">Їжа / Продукти</button>
                            <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                                <div class="offcanvas-header" style="background-color: rgb(102, 45, 145, .16);">
                                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel" style="font-family: Roboto Italic;">Їжа / Продукти</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
                                </div>
                                <div class="offcanvas-body" style="background-color: rgb(102, 45, 145, .16);">
                                    <?php if($_POST['id_o']!="0") {
                                        $sql_s1="SELECT all_add_service.*, add_sevrvice.name, add_sevrvice.id_type, add_sevrvice.price FROM all_add_service JOIN add_sevrvice ON all_add_service.id_service=add_sevrvice.id WHERE add_sevrvice.id_type='1' AND all_add_service.id_order='".$_POST['id_o']."'";  
                                        $res_s1=mysqli_query($connect,$sql_s1);
                                        while($result_s1=mysqli_fetch_array($res_s1)){?> 
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
				                                <div class="d-flex w-100 justify-content-between">
				                      	            <h5 class="mb-1"><?php echo $result_s1['name']; ?></h5>
				                      	            <button class="btn " type="submit" value="<?php echo $result_s1['id']; ?>" name="delete_food">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                        </svg>                          
                                                    </button>
				                                </div>
                                                <small>Кількість - <?php echo $result_s1['count']; ?></small>
				                                <p class="mb-1">Сума - <?php echo $result_s1['sum']; ?> грн </p>
				                                <small>Ціна за 1 - <?php echo $result_s1['price']; ?> грн</small>
				                            </a>
                                        <?php }
                                    } ?>
                                    <br>
                                    <div class="col-md-10" >
                                        <label class="form-label" style="font-family: Roboto Italic;">Назва</label>
                                        <select class="form-select" aria-label="Default select example" name="add_s_1" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                                            <option value="0" selected style="color: white;">Виберіть послугу</option>
                                            <?php
                                                $sql_s11="SELECT * FROM add_sevrvice WHERE id_type='1'";  
                                                $res_s11=mysqli_query($connect,$sql_s11);
                                                while($result_s11=mysqli_fetch_array($res_s11)){
                                                    echo "<option value='".$result_s11['id']."' style='color: white;'>".$result_s11['name']."</option>";
                                                } 
                                            ?> 
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" style="font-family: Roboto Italic;">Кількість</label>
                                        <input type="number" name="count_s1" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                                    </div>
                                    <div class="col-md-6">
                                        <br>
                                        <button type="submit" class="btn btn-dark" name="save_s1" style="font-family: Roboto Italic;">Зберегти</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions1" aria-controls="offcanvasWithBothOptions1" style="font-family: Roboto Italic;">Інші додаткові послуги</button>
                            <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions1" aria-labelledby="offcanvasWithBothOptionsLabel1">
                                <div class="offcanvas-header" style="background-color: rgb(102, 45, 145, .16);">
                                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel1" style="font-family: Roboto Italic;">Інші додаткові послуги</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
                                </div>
                                <div class="offcanvas-body" style="background-color: rgb(102, 45, 145, .16);">
                                    <?php if($_POST['id_o']!="0") {
                                        $sql_s2="SELECT all_add_service.*, add_sevrvice.name, add_sevrvice.id_type, add_sevrvice.price FROM all_add_service JOIN add_sevrvice ON all_add_service.id_service=add_sevrvice.id WHERE add_sevrvice.id_type='2' AND all_add_service.id_order='".$_POST['id_o']."'";  
                                        $res_s2=mysqli_query($connect,$sql_s2);
                                        while($result_s2=mysqli_fetch_array($res_s2)){?> 
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
				                                <div class="d-flex w-100 justify-content-between">
				                      	            <h5 class="mb-1"><?php echo $result_s2['name']; ?></h5>
				                      	            <button class="btn " type="submit" value="<?php echo $result_s2['id']; ?>" name="delete_other">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                                        </svg>                          
                                                    </button>
				                                </div>
                                                <small>Кількість - <?php echo $result_s2['count']; ?></small>
				                                <p class="mb-1">Сума - <?php echo $result_s2['sum']; ?> грн </p>
				                                <small>Ціна за 1 - <?php echo $result_s2['price']; ?> грн</small>
				                            </a>
                                        <?php }
                                    } ?>
                                    <br>
                                    <div class="col-md-10">
                                        <label class="form-label" style="font-family: Roboto Italic;">Назва</label>
                                        <select class="form-select" aria-label="Default select example" name="add_s_2" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                                            <option value="0" selected style="color: white;">Виберіть послугу</option>
                                            <?php
                                                $sql_s22="SELECT * FROM add_sevrvice WHERE id_type='2'";  
                                                $res_s22=mysqli_query($connect,$sql_s22);
                                                while($result_s22=mysqli_fetch_array($res_s22)){
                                                    echo "<option value='".$result_s22['id']."' style='color: white;'>".$result_s22['name']."</option>";
                                                } 
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label" style="font-family: Roboto Italic;">Кількість</label>
                                        <input type="number" name="count_s2" class="form-control" style="font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;">
                                    </div>
                                    <div class="col-md-6">
                                        <br>
                                        <button type="submit" class="btn btn-dark" name="save_s2" style="font-family: Roboto Italic;">Зберегти</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions2" aria-controls="offcanvasWithBothOptions2" style="font-family: Roboto Italic;">Чек</button>
                            <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions2" aria-labelledby="offcanvasWithBothOptionsLabel2">
                                <div class="offcanvas-header"  style="background-color: rgb(102, 45, 145, .16);">
                                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel2" style="font-family: Roboto Italic;">Чек</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрыть"></button>
                                </div>
                                <div class="offcanvas-body" style="background-color: rgb(102, 45, 145, .16);">
                                    <?php
                                      if($_POST['id_o']!="0") {
                                        $sql_ch1="SELECT rooms.price, orders.date_start, orders.date_end FROM  orders  JOIN rooms ON orders.id_room=rooms.id WHERE orders.id='".$_POST['id_o']."'";  
                                        $res_ch1=mysqli_query($connect,$sql_ch1);
                                        $result_ch1=mysqli_fetch_array($res_ch1);
                                        $sql_ch2="SELECT SUM(all_add_service.sum) AS sum_add_s FROM all_add_service JOIN orders  ON all_add_service.id_order=orders.id WHERE all_add_service.id_order='".$_POST['id_o']."'";  
                                        $res_ch2=mysqli_query($connect,$sql_ch2);
                                        $result_ch2=mysqli_fetch_array($res_ch2);
                                        $days=(strtotime($result_ch1['date_end'])-strtotime($result_ch1['date_start']))/ (60 * 60 * 24);
                                        $sum_d=(int)$result_ch1['price']*$days;
                                        $all_sum=$sum_d+(int)$result_ch2['sum_add_s'];
                                    ?>
                                        <p style="font-family: Roboto Italic;">Додаткові послуги - <?php if(!empty($result_ch2['sum_add_s'])){echo $result_ch2['sum_add_s'];} else { echo "0";} ?> грн</p>
                                        <p style="font-family: Roboto Italic;">Номер - <?php echo $sum_d; ?> грн</p>
                                        <hr style="color: rgb(102, 45, 145); opacity: 100%;">
                                        <p style="font-family: Roboto Italic;">Вартість - <?php echo $all_sum; ?> грн</p>
                                        <?php
                                            $sqll="SELECT date FROM payment WHERE id_order='".$_POST['id_o']."'";
                                            $ress=mysqli_query($connect,$sqll);
                                            if($resultt=mysqli_fetch_array($ress)){
                                                echo "<h5  style='font-family: Roboto Italic;'>Сплачено ".$resultt['date']."</h5>";
                                            } else {
                                                echo "<div class='col-md-6'>
                                                <br>
                                                <button type='submit' class='btn btn-dark' name='save_ch'  style='font-family: Roboto Italic;'>Сплатити</button>
                                            </div>";
                                            }
                                        ?>
                                        
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <br>
                    </form>
                    <?php
                        if(isset($_POST['delete_o'])){
                            $sql="SELECT id_client FROM orders WHERE id='".$_POST['id_o']."'";
                            $res=mysqli_query($connect,$sql);
                            $result=mysqli_fetch_array($res);
                            $sql="DELETE FROM clients WHERE id='".$result['id_client']."'";  
                            $res=mysqli_query($connect,$sql);
                            $sql="DELETE FROM all_add_service WHERE id_order='".$_POST['id_o']."'";
                            $res=mysqli_query($connect,$sql);
                            $sql="DELETE FROM payment WHERE id_order='".$_POST['id_o']."'";
                            $res=mysqli_query($connect,$sql);
                            $sql="DELETE FROM orders WHERE id='".$_POST['id_o']."'";
                            $res=mysqli_query($connect,$sql);
                            ?>
                            <script>document.location.href="rooms.php"</script>
                            <?php
                        }
                        if(isset($_POST['delete_food'])){
                            $sql="DELETE FROM all_add_service WHERE id='".$_POST['delete_food']."'";  
                            $res=mysqli_query($connect,$sql);
                            ?>
                            <script>document.location.href="new.php?id_order=<?php echo $_POST['id_o']; ?>"</script>
                            <?php
                        }
                        if(isset($_POST['delete_other'])){
                            $sql="DELETE FROM all_add_service WHERE id='".$_POST['delete_other']."'";  
                            $res=mysqli_query($connect,$sql);
                            ?>
                            <script>document.location.href="new.php?id_order=<?php echo $_POST['id_o']; ?>"</script>
                            <?php
                        }
                        if(isset($_POST['save_info'])){
                            if($_POST['id_o']=="0"){
                                if(!empty($_POST['enter']) and !empty($_POST['finish']) and !empty($_POST['client_name']) and !empty($_POST['passport']) and !empty($_POST['phone']) and !empty($_POST['count_p']) and $_POST['room']!='0' and $_POST['status']!='0'){
                                    $sql="INSERT INTO clients(name, passport, phone) VALUES ('".$_POST['client_name']."','".$_POST['passport']."','".$_POST['phone']."')";  
                                    $res=mysqli_query($connect,$sql);
                                    $sql="SELECT * FROM clients ORDER BY id DESC LIMIT 1;";
                                    $res=mysqli_query($connect,$sql);
                                    $result=mysqli_fetch_array($res);
                                    $sql="INSERT INTO orders (id_client, number_people, id_room, date_start, date_end, id_status) VALUES ('".$result['id']."','".$_POST['count_p']."','".$_POST['room']."','".$_POST['enter']."','".$_POST['finish']."','".$_POST['status']."')";  
                                    $res=mysqli_query($connect,$sql);
                                    $sql="SELECT * FROM orders ORDER BY id DESC LIMIT 1;";
                                    $res=mysqli_query($connect,$sql);
                                    $result=mysqli_fetch_array($res);
                                    ?>
                                    <script>document.location.href="rooms.php"</script>
                                    <?php
                                }
                            } else {
                                if(!empty($_POST['enter']) and !empty($_POST['finish']) and !empty($_POST['client_name']) and !empty($_POST['passport']) and !empty($_POST['phone']) and !empty($_POST['count_p']) and $_POST['room']!='0' and $_POST['status']!='0'){
                                    $sql="SELECT id_client FROM orders WHERE id='".$_POST['id_o']."'";
                                    $res=mysqli_query($connect,$sql);
                                    $result_id=mysqli_fetch_array($res);
                                    $sql="UPDATE clients SET name='".$_POST['client_name']."', passport='".$_POST['passport']."', phone='".$_POST['phone']."' WHERE id='".$result_id."'";  
                                    $res=mysqli_query($connect,$sql);
                                    
                                    $sql="UPDATE orders SET number_people='".$_POST['count_p']."', id_room='".$_POST['room']."', date_start='".$_POST['enter']."', date_end='".$_POST['finish']."', id_status='".$_POST['status']."' WHERE id='".$_POST['id_o']."'";  
                                    $res=mysqli_query($connect,$sql);
                                    ?>
                                    <script>document.location.href="rooms.php"</script>
                                    <?php
                                }
                            }
                        }
                        if(isset($_POST['save_s1'])){
                            if($_POST['id_o']!="0"){
                                if(!empty($_POST['add_s_1']) and !empty($_POST['count_s1'])){
                                    $sql="SELECT price FROM add_sevrvice WHERE id='".$_POST['add_s_1']."'";
                                    $res=mysqli_query($connect,$sql);
                                    $result=mysqli_fetch_array($res);
                                    $sum_s1=(int)$result['price']*(int)$_POST['count_s1'];
                                    $sql="INSERT INTO all_add_service(id_order, id_service, count, sum) VALUES ('".$_POST['id_o']."','".$_POST['add_s_1']."','".$_POST['count_s1']."','".$sum_s1."')";  
                                    $res=mysqli_query($connect,$sql);
                                    ?>
                                    <script>document.location.href="new.php?id_order=<?php echo $_POST['id_o']; ?>"</script>
                                    <?php
                                }
                            }
                        }
                        if(isset($_POST['save_s2'])){
                            if($_POST['id_o']!="0"){
                                if(!empty($_POST['add_s_2']) and !empty($_POST['count_s2'])){
                                    $sql="SELECT price FROM add_sevrvice WHERE id='".$_POST['add_s_2']."'";
                                    $res=mysqli_query($connect,$sql);
                                    $result=mysqli_fetch_array($res);
                                    $sum_s2=(int)$result['price']*(int)$_POST['count_s2'];
                                    $sql="INSERT INTO all_add_service(id_order, id_service, count, sum) VALUES ('".$_POST['id_o']."','".$_POST['add_s_2']."','".$_POST['count_s2']."','".$sum_s2."')";  
                                    $res=mysqli_query($connect,$sql);
                                    ?>
                                    <script>document.location.href="new.php?id_order=<?php echo $_POST['id_o']; ?>"</script>
                                    <?php
                                }
                            }
                        }
                        if(isset($_POST['save_ch'])){
                            if($_POST['id_o']!="0"){
                                $sql="INSERT INTO payment (sum, date, id_order) VALUES ('".$all_sum."', CURRENT_DATE(),'".$_POST['id_o']."')";
                                $res=mysqli_query($connect,$sql);
                                ?>
                                <script>document.location.href="rooms.php"</script>
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