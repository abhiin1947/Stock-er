<?php
function dayadd()
{
$hand=mysql_connect("localhost","root","ronaldo");
mysql_select_db("project",$hand);
$dam="select * from data";
$res=mysql_query($dam,$hand);
while($ral=mysql_fetch_array($res))
{
$r=(((int)$ral['day'])+1);
$dam="update data set day=".$r." where SYMBOL='".$ral['SYMBOL']."' and TIMESTAMP='".$ral['TIMESTAMP']."'";
mysql_query($dam,$hand);
//echo $dam."<br />";
}
mysql_close($hand);
}
function addtodb($filename)
{
$handle=fopen($filename,"r");
$arr=fgetcsv($handle);
//print_r($arr);
dayadd();
$conn=mysql_connect("localhost","root","ronaldo");
mysql_select_db("project",$conn);
while(!feof($handle))
{
$dat=fgetcsv($handle);
$Open=(float)$dat[2];
$High=(float)$dat[3];
$Low=(float)$dat[4];
$Close=(float)$dat[5];
$Tottrdqty=(float)$dat[8];
$Tottrdval=(float)$dat[9];
$pivot=(float)($High + $Low + $Close) / 3;
$r3=$pivot + (1 * ($High - $Low));
$r2=$pivot + (0.618 * ($High - $Low));
$r1=$pivot + (0.382 * ($High - $Low));
$s1=$pivot - (0.382 * ($High - $Low));
$s2=$pivot - (0.618 * ($High - $Low));
$s3=$pivot - (1 * ($High - $Low));
//echo $r3."  ".$r2."  ".$r1."  ".$pivot."  ".$s1."  ".$s2."  ".$s3."<br />";

$sql="insert into data(".$arr[0].",".$arr[1].",".$arr[2].",".$arr[3].",".$arr[4].",".$arr[5].",".$arr[6].",".$arr[7].",".$arr[8].",".$arr[9].",".$arr[10].",".$arr[11].",".$arr[12].",day".",r3".",r2".",r1".",pivot".",s1".",s2".",s3".") values("."'".$dat[0]."',"."'".$dat[1]."',".$dat[2].",".$dat[3].",".$dat[4].",".$dat[5].",".$dat[6].",".$dat[7].",".$dat[8].",".$dat[9].","."'".$dat[10]."',".$dat[11].","."'".$dat[12]."',01,$r3,$r2,$r1,$pivot,$s1,$s2,$s3)";
//echo $sql;
mysql_query($sql,$conn);

}
exec("rm ".$filename,$abc);
mysql_close($conn);
}
$dt=file("lastdate.txt");
$day =(int)$dt[0];
$month =(int)$dt[1];
$year =(int)$dt[2];
//$tday =(int)mstrftime("%d",time());
//$tmonth =(int)mstrftime("%b",time());;
//$tyear =(int)mstrftime("%y",time());;
//$exp_date = $year."-".$month."-".$day; 
$todays_date = date("y-m-d");
//echo $todays_date;
$date = new DateTime($year."-".$month."-".$day);
//echo $date->format('Y-m-d') . "\n";
$today= new DateTime($todays_date);
//$date = date_create();
while($date<$today)
{
//echo $date;
$file= $day.$month.$year.".zip";
$filename="cm".strftime("%d", mktime(0,0,0,$month,$day,$year)).strtoupper(strftime("%b", mktime(0,0,0,$month,$day,$year))).strftime("%Y", mktime(0,0,0,$month,$day,$year))."bhav.csv";
$format = "http://www.nseindia.com/content/historical/EQUITIES/".strftime("%Y", mktime(0,0,0,$month,$day,$year))."/".strtoupper(strftime("%b", mktime(0,0,0,$month,$day,$year)))."/cm".strftime("%d", mktime(0,0,0,$month,$day,$year)).strtoupper(strftime("%b", mktime(0,0,0,$month,$day,$year))).strftime("%Y", mktime(0,0,0,$month,$day,$year))."bhav.csv.zip";
//echo strftime("%d%b%Y", mktime(0,0,0,11,03,11));
//echo $format."<br />";
//echo $year."-".$month."-".$day."<br />";
$exe ="java download ".$format." ".$file;
//echo $exe;
exec($exe,$output);
$exe2 ="unzip ".$file;
exec($exe2,$output);
$exe2 ="rm ".$file;
exec($exe2,$output);
//print_r($output);
$len=(((int)count($output))-1);
$date->add(new DateInterval('P1D'));
$day=(int)$date->format('d');
$month=(int)$date->format('m');
$year=(int)$date->format('y');
if($output[$len]!="wtf")
{
//echo $filename;
$file=fopen("lastdate.txt","w");
//echo $day."<br />";
fputs($file,$day."\n");
fputs($file,$month."\n");
fputs($file,$year."\n");
$date= new DateTime($year."-".$month."-".$day);
addtodb($filename);
}
}
?>
<html>
<head>
<title>
Please Wait while loading data
</title>
<script type="text/javascript">
function go()
{
document.forms['ya'].submit();
}
</script>
</head>
<body onload="go()">
<h1><center><b>Loading 7 day data</b></center></h1>
<form id='ya' method='post' action='load.php'>
</form>
</body>
</html>
