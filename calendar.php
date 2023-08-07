<style type="text/css">
	.cal{
		border: 1px solid #ccc;
		color: #333;
		background: #F6F6F6;
		font-family: Roboto Italic;
		font-size: 14px;
		text-align: center;
	}
	.caltoday{
		font-family: Roboto Italic;
		font-size: 14px;
		background: #F6F6F6;
		text-align: center;
		font-weight: bold;
		border: 5px solid rgb(102, 45, 145);
	}
	.calday{
		border: 1px solid #ccc;
		font-family: Roboto Italic;
		font-size: 14px;
		text-align: center;
		font-weight: bold;
		background-color: rgb(102, 45, 145, .65);
	}
	.calday1{
		border: 5px solid rgb(102, 45, 145, .9);
		font-family: Roboto Italic;
		font-size: 14px;
		text-align: center;
		font-weight: bold;
		background-color: rgb(102, 45, 145, .65);
	}
	.navi{
		font-family: Roboto Italic;
		font-size: 18px;
		font-weight: bold;
	}
	.datehead{
		font-family: Roboto Italic;
		font-size: 16px;
		font-weight: bold;
	}
</style>
<?php
	$self = $_SERVER['PHP_SELF'];
	if(isset($_GET['month'])){
		$month = $_GET['month'];
	} elseif(isset($_GET['viewmonth'])){
		$month = $_GET['viewmonth'];
	} else{
		$month = date('m');
	}
	if(isset($_GET['year'])) {
		$year = $_GET['year'];
	} elseif(isset($_GET['viewyear'])) {
		$year = $_GET['viewyear'];
	} else {
		$year = date('Y');
	}
	if($month == '12') {
		$next_year = $year + 1;
	} else {
		$next_year = $year;
	}
	$Month_r = array("1" => "Січень","2" => "Лютий","3" => "Березень","4" => "Квітень","5" => "Травень","6" => "Червень","7" => "Липень","8" => "Серпень","9" => "Вересень","10" => "Жовтень","11" => "Листопад","12" => "Грудень"); 
	$first_of_month = mktime(0, 0, 0, $month, 1, $year);
	$day_headings = array('Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Нд');
	$maxdays = date('t', $first_of_month);
	$date_info = getdate($first_of_month);
	$month = $date_info['mon'];
	$year = $date_info['year'];
	if($month == '1') {
		$last_year = $year-1;
	} else {
		$last_year = $year;
	}
	$timestamp_last_month = $first_of_month - (24*60*60);
	$last_month = date("m", $timestamp_last_month);
	if($month == '12') {
		$next_month = '1';
	} else { 
		$next_month = $month+1;
	}
	$calendar = "<div class=\"block-on-center col-sm-12\" style='display: inline-block;'><table width='500px' height='390px' style='border: 1px solid #cccccc;'><tr style='background: #5C8EB3;'><td colspan='7' class='navi text-light bg-dark' style='text-align: center; vertical-align: middle;'><a style=' color: #ffffff; text-decoration: none;' href='$self?month=".$last_month."&year=".$last_year."'><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" fill=\"currentColor\" class=\"bi bi-arrow-left-circle-fill\" viewBox=\"0 0 16 16\"><path d=\"M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z\"/></svg></a>".$Month_r[$month]." ".$year."<a style=' color: #ffffff; text-decoration: none;' href='$self?month=".$next_month."&year=".$next_year."'><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" fill=\"currentColor\" class=\"bi bi-arrow-left-circle-fill\" viewBox=\"0 0 16 16\"><path d=\"M6 12.796V3.204L11.481 8 6 12.796zm.659.753 5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z\"/></svg></a></td></tr><tr><td class='datehead' style='text-align: center; vertical-align: middle; '>Пн</td><td class='datehead' style='text-align: center; vertical-align: middle; '>Вт</td><td class='datehead' style='text-align: center; vertical-align: middle; '>Ср</td><td class='datehead' style='text-align: center; vertical-align: middle; '>Чт</td><td class='datehead' style='text-align: center; vertical-align: middle; '>Пт</td><td class='datehead' style='text-align: center; vertical-align: middle; '>Сб</td><td class='datehead' style='text-align: center; vertical-align: middle; '>Вс</td></tr><tr>"; 
	$class = "";
	$weekday = $date_info['wday'];
	$weekday = $weekday-1; 
	if($weekday == -1) {
		$weekday=6;
	}
	$day = 1;
	if($weekday > 0){
		$calendar .= "<td colspan='$weekday'> </td>";
	}
	$i=0;
	while($day <= $maxdays) {
	    if($weekday == 7) {
			$calendar .= "</tr><tr>";
			$weekday = 0;
		}
		$linkDate = mktime(0, 0, 0, $month, $day, $year);
		if(strlen($month)==1){
			$month="0".$month;
		}
		if(strlen($day)==1){
			$day="0".$day;
		}
		$c="";
		$sql="SELECT orders.id, rooms.name AS namer, clients.name AS namec, orders.date_start, orders.date_end FROM orders, rooms, clients WHERE orders.id_client=clients.id AND orders.id_room=rooms.id AND '".$year."-".$month."-".$day."' BETWEEN orders.date_start AND orders.date_end;";
        $res=mysqli_query($connect,$sql);
		$result=mysqli_fetch_array($res);
	    if((($day < 10 and "0$day" == date('d')) or ($day >= 10 and "$day" == date('d'))) and (($month < 10 and "0$month" == date('m')) or ($month >= 10 and "$month" == date('m'))) and $year == date('Y')){
		    $class = "caltoday";
			if($result){
				$class = "calday1";
				$c='<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions'.$i.'" aria-labelledby="offcanvasWithBothOptionsLabel'.$i.'"><div class="offcanvas-header" style="background-color: rgb(102, 45, 145, .16);"><h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel'.$i.'" style="font-family: Roboto Italic;">'.$year.'-'.$month.'-'.$day.'</h5><button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрити"></button></div><div class="offcanvas-body" style="background-color: rgb(102, 45, 145, .16);"><div class="list-group"><a href="new.php?id_order='.$result['id'].'" class="list-group-item list-group-item-action" aria-current="true" style="background-color: rgb(102, 45, 145, .16); font-family: Roboto Italic; border: 1px solid purple; border-radius: 5px;"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1">'.$result['namer'].'</h5><small>Редагувати</small></div><p class="mb-1">'.$result['namec'].'</p><small>'.$result['date_start'].' - '.$result['date_end'].'</small></a>';
				while($result=mysqli_fetch_array($res)){
					$c=$c.'	<a href="new.php?id_order='.$result['id'].'" class="list-group-item list-group-item-action" aria-current="true" style="background-color: rgb(102, 45, 145, .16); font-family: Roboto Italic; border: 1px solid purple; border-radius: 5px;"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1">'.$result['namer'].'</h5><small>Редагувати</small></div><p class="mb-1">'.$result['namec'].'</p><small>'.$result['date_start'].' - '.$result['date_end'].'</small></a>';
				}
				$c=$c.'</div></div></div>';
			} else {
				$c='<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions'.$i.'" aria-labelledby="offcanvasWithBothOptionsLabel'.$i.'" ><div class="offcanvas-header" style="background-color: rgb(102, 45, 145, .16);"><h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel'.$i.'" style="font-family: Roboto Italic;">'.$year.'-'.$month.'-'.$day.'</h5><button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрити"></button></div><div class="offcanvas-body" style="background-color: rgb(102, 45, 145, .16);"><h5></h5></div></div>';
			}
		} else if($result){ 
			$class = "calday";
			$c='<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions'.$i.'" aria-labelledby="offcanvasWithBothOptionsLabel'.$i.'"><div class="offcanvas-header" style="background-color: rgb(102, 45, 145, .16);"><h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel'.$i.'" style="font-family: Roboto Italic;">'.$year.'-'.$month.'-'.$day.'</h5><button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрити"></button></div><div class="offcanvas-body" style="background-color: rgb(102, 45, 145, .16);"><div class="list-group"><a href="new.php?id_order='.$result['id'].'" class="list-group-item list-group-item-action" aria-current="true" style="background-color: rgb(102, 45, 145, .16); font-family: Roboto Italic; border: 1px solid purple; border-radius: 5px;"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1">'.$result['namer'].'</h5><small>Редагувати</small></div><p class="mb-1">'.$result['namec'].'</p><small>'.$result['date_start'].' - '.$result['date_end'].'</small></a>';
			while($result=mysqli_fetch_array($res)){
				$c=$c.'	<a href="new.php?id_order='.$result['id'].'" class="list-group-item list-group-item-action" aria-current="true" style="background-color: rgb(102, 45, 145, .16); font-family: Roboto Italic; border: 1px solid purple; border-radius: 5px;"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1">'.$result['namer'].'</h5><small>Редагувати</small></div><p class="mb-1">'.$result['namec'].'</p><small>'.$result['date_start'].' - '.$result['date_end'].'</small></a>';
			}
			$c=$c.'</div></div></div>';
	   	} else {
			$d = date('m/d/Y', $linkDate);
		    $class = "cal";
			$c='<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions'.$i.'" aria-labelledby="offcanvasWithBothOptionsLabel'.$i.'" ><div class="offcanvas-header" style="background-color: rgb(102, 45, 145, .16);"><h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel'.$i.'" style="font-family: Roboto Italic;">'.$year.'-'.$month.'-'.$day.'</h5><button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Закрити"></button></div><div class="offcanvas-body" style="background-color: rgb(102, 45, 145, .16);"><h5></h5></div></div>';
		}
		if($weekday == 5 || $weekday == 6) {
			$red='style="color: red" ';
		} else {
			$red=''; 	 
		}
	    $calendar .= "<td class='{$class}'><button class='btn' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasWithBothOptions".$i."' aria-controls='offcanvasWithBothOptions".$i."' style=' text-decoration: none; color: black;'><span ".$red.">{$day}</span></button></td>";		
		$calendar=$calendar.$c;
	    $day++;
	    $weekday++;
		$i++;	
	}
	if($weekday != 7) {
		$calendar .= "<td colspan='" . (7 - $weekday) . "'> </td>";
	}
	echo $calendar . "</tr></table>"; 
	$months = array('Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень');
	echo "<br><form style='float: right; action='$self' method='get'><div class=\"row\"><div class=\"col-sm-4\"><select name='month'  class=\"col-sm-4 form-select\" style='font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;'>";
	for($i=0; $i<=11; $i++) {
		echo "<option style='color: white;' value='".($i+1)."'";
		if($month == $i+1) {
			echo "selected = 'selected'";
		}
		echo ">".$months[$i]."</option>";
	}
	echo "</select></div>";
	echo "<div class=\"col-sm-4\"><select name='year' class=\"col-sm-4 form-select\" style='font-family: Roboto Italic; background-color: rgb(102, 45, 145, .16); border: 1px solid purple; border-radius: 5px;'>";
	for($i=date('Y'); $i<=(date('Y')+20); $i++)	{
		$selected = ($year == $i ? "selected = 'selected'" : '');
		echo "<option style='color: white;' value=\"".($i)."\"$selected>".$i."</option>";
	}
	echo "</select></div><div class=\"col-sm-4\"><input type='submit' class=\"btn btn-dark\" value='Переглянути' style='font-family: Roboto Italic;' /></div></div></form>";
	if($month != date('m') || $year != date('Y')){
		echo "<a style='float: left; font-size: 14px; padding-top: 3px; text-decoration: none; color:black; font-family: Roboto Italic;' href='".$self."?month=".date('m')."&year=".date('Y')."'><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"18\" height=\"18\" fill=\"currentColor\" class=\"bi bi-box-arrow-in-left\" viewBox=\"0 0 16 16\">
		<path fill-rule=\"evenodd\" d=\"M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z\"/>
		<path fill-rule=\"evenodd\" d=\"M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z\"/></svg> Повернутись до сьогоднішньої дати</a>";
	}
	echo "</div>"; 
?>
