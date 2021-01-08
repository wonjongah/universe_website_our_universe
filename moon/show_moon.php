<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="euc-kr">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/greet.css" rel="stylesheet" type="text/css" media="all">
<style>
body div
{cursor: url('../img/enterprise.ani'), url('../img/cursor.png'), auto;}
</style>
</head>
<?

	include "../lib/dbconn.php";
function sunlunar_data() { 
return 
"1212122322121-1212121221220-1121121222120-2112132122122-2112112121220-2121211212120-2212321121212-2122121121210-2122121212120-1232122121212-1212121221220-1121123221222-1121121212220-1212112121220-2121231212121-2221211212120-1221212121210-2123221212121-2121212212120-1211212232212-1211212122210-2121121212220-1212132112212-2212112112210-2212211212120-1221412121212-1212122121210-2112212122120-1231212122212-1211212122210-2121123122122-2121121122120-2212112112120-2212231212112-2122121212120-1212122121210-2132122122121-2112121222120-1211212322122-1211211221220-2121121121220-2122132112122-1221212121120-2121221212110-2122321221212-1121212212210-2112121221220-1231211221222-1211211212220-1221123121221-2221121121210-2221212112120-1221241212112-1212212212120-1121212212210-2114121212221-2112112122210-2211211412212-2211211212120-2212121121210-2212214112121-2122122121120-1212122122120-1121412122122-1121121222120-2112112122120-2231211212122-2121211212120-2212121321212-2122121121210-2122121212120-1212142121212-1211221221220-1121121221220-2114112121222-1212112121220-2121211232122-1221211212120-1221212121210-2121223212121-2121212212120-1211212212210-2121321212221-2121121212220-1212112112210-2223211211221-2212211212120-1221212321212-1212122121210-2112212122120-1211232122212-1211212122210-2121121122210-2212312112212-2212112112120-2212121232112-2122121212110-2212122121210-2112124122121-2112121221220-1211211221220-2121321122122-2121121121220-2122112112322-1221212112120-1221221212110-2122123221212-1121212212210-2112121221220-1211231212222-1211211212220-1221121121220-1223212112121-2221212112120-1221221232112-1212212122120-1121212212210-2112132212221-2112112122210-2211211212210-2221321121212-2212121121210-2212212112120-1232212122112-1212122122120-1121212322122-1121121222120-2112112122120-2211231212122-2121211212120-2122121121210-2124212112121-2122121212120-1212121223212-1211212221220-1121121221220-2112132121222-1212112121220-2121211212120-2122321121212-1221212121210-2121221212120-1232121221212-1211212212210-2121123212221-2121121212220-1212112112220-1221231211221-2212211211220-1212212121210-2123212212121-2112122122120-1211212322212-1211212122210-2121121122120-2212114112122-2212112112120-2212121211210-2212232121211-2122122121210-2112122122120-1231212122212-1211211221220-2121121321222-2121121121220-2122112112120-2122141211212-1221221212110-2121221221210-2114121221221"; 
} 



//양->음 변환
function SolaToLunar($yyyymmdd) {
	$getYEAR = substr($yyyymmdd,0,4); 
	$getMONTH = substr($yyyymmdd,4,2); 
	$getDAY = substr($yyyymmdd,6,2); 

	$arrayDATASTR = sunlunar_data(); 
	$arrayDATA = explode("-",$arrayDATASTR); 

	$arrayLDAYSTR="31-0-31-30-31-30-31-31-30-31-30-31"; 
	$arrayLDAY = explode("-",$arrayLDAYSTR); 

	$dt = $arrayDATA; 

	for ($i=0;$i<=168;$i++) { 
		$dt[$i] = 0; 
		for ($j=0;$j<12;$j++) { 
			switch (substr($arrayDATA[$i],$j,1)) { 
				case 1: 
				$dt[$i] += 29; 
				break; 
				case 3: 
				$dt[$i] += 29; 
				break; 
				case 2: 
				$dt[$i] += 30; 
				break; 
				case 4: 
				$dt[$i] += 30; 
				break; 
			} 
		} 

		switch (substr($arrayDATA[$i],12,1)) { 
			case 0: 
			break; 
			case 1: 
			$dt[$i] += 29; 
			break; 
			case 3: 
			$dt[$i] += 29; 
			break; 
			case 2: 
			$dt[$i] += 30; 
			break; 
			case 4: 
			$dt[$i] += 30; 
			break; 
		} 
	} 


	$td1 = 1880 * 365 + (int)(1880/4) - (int)(1880/100) + (int)(1880/400) + 30; 
	$k11 = $getYEAR - 1; 

	$td2 = $k11 * 365 + (int)($k11/4) - (int)($k11/100) + (int)($k11/400); 

	if ($getYEAR % 400 == 0 || $getYEAR % 100 != 0 && $getYEAR % 4 == 0) { 
		$arrayLDAY[1] = 29; 
	} else { 
		$arrayLDAY[1] = 28; 
	} 

	if ($getMONTH > 13) { 
		$gf_sol2lun = 0; 
	} 

	if ($getDAY > $arrayLDAY[$getMONTH-1]) { 
		$gf_sol2lun = 0; 
	} 

	for ($i=0;$i<=$getMONTH-2;$i++) { 
		$td2 += $arrayLDAY[$i]; 
	} 

	$td2 += $getDAY; 
	$td = $td2 - $td1 + 1; 
	$td0 = $dt[0]; 

	for ($i=0;$i<=168;$i++) { 
		if ($td <= $td0) { 
			break; 
		} 
		$td0 += $dt[$i+1]; 
	} 

	$ryear = $i + 1881; 
	$td0 -= $dt[$i]; 
	$td -= $td0; 

	if (substr($arrayDATA[$i], 12, 1) == 0) { 
		$jcount = 11; 
	} else { 
		$jcount = 12; 
	} 
	$m2 = 0; 

	for ($j=0;$j<=$jcount;$j++) { // 달수 check, 윤달 > 2 (by harcoon) 
		if (substr($arrayDATA[$i],$j,1) <= 2) { 
			$m2++; 
			$m1 = substr($arrayDATA[$i],$j,1) + 28; 
			$gf_yun = 0; 
		} else { 
			$m1 = substr($arrayDATA[$i],$j,1) + 26; 
			$gf_yun = 1; 
		} 
		if ($td <= $m1) { 
			break; 
		} 
		$td = $td - $m1; 
	} 

	$k1=($ryear+6) % 10; 
	$syuk = $arrayYUK[$k1]; 
	$k2=($ryear+8) % 12; 
	$sgap = $arrayGAP[$k2]; 
	$sddi = $arrayDDI[$k2]; 

	$gf_sol2lun = 1; 

	if($m2<10) $m2="0".$m2; 
	if($sday<10) $td="0".$td; 

	$Ary[year]=$ryear;
	$Ary[month]=$m2;
	$Ary[day]=$td;
	$Ary[time]=mktime(0,0,0,$Ary[month],$Ary[day],$Ary[year]);

	return $Ary;
}
?>
<body>
<div id="wrap">
  <div id="header">
    <? include "../lib/top_login2.php"; ?>
  </div>  <!-- end of header -->

  <div id="menu">
	<? include "../lib/top_menu2.php"; ?>
  </div>  <!-- end of menu --> 

  <div id="content">
	
	<div id="col2">
        
		<div id="title">
			<img src="../img/title_moon.png">
		</div>

<?    

   include "../lib/dbconn.php";       
$total=$_POST['total'];

$result= SolaToLunar($total);

$year = $result[year];
$month = $result[month];
$day1 = $result[day];
$day = substr($day1,1,2);
$getYEAR = substr($total,0,4); 
	$getMONTH = substr($total,4,2); 
	$getDAY = substr($total,6,2); 
echo "<br><br><font size = 4><center>입력한 날짜 {$getYEAR}년 {$getMONTH}월 {$getDAY}일을 음력 날짜로 {$year}년 {$month}월 {$day}일입니다.<br>";

if($result[day] == 1)
{
echo "입력한 날짜의 달의 위상은 <b><font color = #e8cb48>삭</b></font>입니다.<br>태양과 지구 사이에 달이 있어 달을 관측할 수 없습니다.</font></center>";
}

if($result[day] == 2 || $result[day] == 3)
{
echo "입력한 날짜의 달의 위상은 <b><font color = #e8cb48>초승달</b></font>입니다.<br>저녁 때 태양이 서쪽 하늘로 지고 난 후 서쪽 하늘에서 잠시 관측할 수 있습니다.</font></center>";

$row = mysql_fetch_array(mysql_query("SELECT moon_image FROM moon WHERE num = 1"));


?>
<div id = moon><img src = "../img/<?=$row[moon_image]?>.png"></div>
<?
}

if($result[day] > 3 && $result[day] < 7)
{
echo "입력한 날짜의 달의 위상은 <b><font color = #e8cb48>부푼 초승달 모양</b></font>입니다.<br></font></center>";
$row = mysql_fetch_array(mysql_query("SELECT moon_image FROM moon WHERE num = 2"));
?>
<div id = moon><img src = "../img/<?=$row[moon_image]?>.png"></div>
<?
}


if($result[day] == 7 || $result[day] == 8)
{
echo "입력한 날짜의 달의 위상은 <b><font color = #e8cb48>상현달</b></font>입니다.<br>이 무렵 달은 정오에 떠서 자정에 집니다.</font></center>";
$row = mysql_fetch_array(mysql_query("SELECT moon_image FROM moon WHERE num = 3"));
?>
<div id = moon><img src = "../img/<?=$row[moon_image]?>.png"></div>
<?
}
if($result[day] > 8 && $result[day] < 15)
{
echo "입력한 날짜의 달의 위상은 <b><font color = #e8cb48>부푼 상현달</b></font>입니다.<br></font></center>";
$row = mysql_fetch_array(mysql_query("SELECT moon_image FROM moon WHERE num = 4"));
?>
<div id = moon><img src = "../img/<?=$row[moon_image]?>.png"></div>
<?
}
if($result[day] == 15)
{
echo "입력한 날짜의 달의 위상은 <b><font color = #e8cb48>보름달</b></font>입니다.<br>일몰할 때 달이 떠서 일출할 때 달이 지기 때문에 밤 내내 볼 수 있습니다.<br>가장 크고 밝은 달의 위상입니다.</font></center>";
$row = mysql_fetch_array(mysql_query("SELECT moon_image FROM moon WHERE num = 5"));
?>
<div id = moon2><img src = "../img/<?=$row[moon_image]?>.png"></div>
<?
}
if($result[day] >15 && $result[day] <22)
{
echo "입력한 날짜의 달의 위상은 <b><font color = #e8cb48>부푼 하현달</b></font>입니다.<br></font></center>";
$row = mysql_fetch_array(mysql_query("SELECT moon_image FROM moon WHERE num = 6"));
?>
<div id = moon2><img src = "../img/<?=$row[moon_image]?>.png"></div>
<?}
if($result[day] == 22 || $result[day] ==23)
{
echo "입력한 날짜의 달의 위상은 <b><font color = #e8cb48>하현달</b></font>입니다.<br>이 무렵 달은 자정에 떠서 정오에 집니다.</font></center>";
$row = mysql_fetch_array(mysql_query("SELECT moon_image FROM moon WHERE num = 7"));
?>
<div id = moon2><img src = "../img/<?=$row[moon_image]?>.png"></div>
<?
}
if($result[day] >23 && $result[day] <26)
{
echo "입력한 날짜의 달의 위상은 <b><font color = #e8cb48>부푼 그믐달</b></font>입니다.<br>해 뜨기 전 동쪽 하늘에서 잠시 볼 수 있습니다</font></center>";
$row = mysql_fetch_array(mysql_query("SELECT moon_image FROM moon WHERE num = 8"));
?>
<div id = moon2><img src = "../img/<?=$row[moon_image]?>.png"></div>
<?
}
if($result[day] == 26 || $result[day] ==27)
{
echo "입력한 날짜의 달의 위상은 <b><font color = #e8cb48>그믐달</b></font>입니다.<br>해가 뜨기 전, 새벽녘 동쪽하늘에서 잠시 볼 수 있습니다.</font></center>";
$row = mysql_fetch_array(mysql_query("SELECT moon_image FROM moon WHERE num = 9"));
?>
<div id = moon2><img src = "../img/<?=$row[moon_image]?>.png"></div>
<?
}
if($result[day] > 27)
{
echo "입력한 날짜의 달의 위상은 <b><font color = #e8cb48>삭에서 그믐달 모양</b></font>입니다.<br>엷게 왼쪽이 빛나는 달의 모습을 관측할 수 있습니다.</font></center>";
$row = mysql_fetch_array(mysql_query("SELECT moon_image FROM moon WHERE num = 10"));
?>
<div id = moon2><img src = "../img/<?=$row[moon_image]?>.png"></div>
<?
}
mysql_close();
	?>				
		
<div id ="back"> <a href="moon.php"><img src="../img/moon_back.png"></a>