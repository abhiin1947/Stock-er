<html>
<head>
<title>
Please Wait while the information is loading...
</title>
<?php
$conn=mysql_connect("localhost","root","ronaldo");
mysql_select_db("project");
function correl($X,$Y,$nod,$sym,$day,$att)
{
//print_r($X);
//echo "<br />";
//print_r($Y);
//echo "<br />";
$sumX=0;
for($j=1;$j<=$nod;$j++)
$sumX+=$X[$j];
$sumY=0;
for($j=1;$j<=$nod;$j++)
$sumY+=$Y[$j];
$sumXsq=0;
for($j=1;$j<=$nod;$j++)
$sumXsq+=$X[$j]*$X[$j];
$sumYsq=0;
for($j=1;$j<=$nod;$j++)
$sumYsq+=$Y[$j]*$Y[$j];
$sumXY=0;
for($j=1;$j<=$nod;$j++)
$sumXY+=$X[$j]*$Y[$j];
$cor2=(($nod*$sumXY)-($sumX*$sumY)) / sqrt((($nod*$sumXsq)-($sumX*$sumX))*(($nod*$sumYsq)-($sumY*$sumY)));
//echo $cor2."<br />";
$cor=round($cor2,6);
//echo "$sym $att $cor <br/>";
$sq="update data set $att=$cor where SYMBOL='$sym' and day=$day";
//echo "$sq <br />"; 
//$h=mysql_connect("localhost","root","ronaldo");
//mysql_select_db("project",$h);
//mysql_query($sq,$conn);
//mysql_close($h);
return $sq;
}
//

$sql="delete from data where SERIES!='EQ'";
$res=mysql_query($sql,$conn);
$sql="delete from data where day>15";
$res=mysql_query($sql,$conn);
$sql="select distinct SYMBOL from data";
$res=mysql_query($sql,$conn);
$v1=array();
$v2=array();

while($val=mysql_fetch_array($res))
{
//$val=mysql_fetch_array($res);
//for($day=1;$day<14;$day++)
//{
$day=1;
$eday=$day+14;
$sql1="select TOTTRDQTY from data where day>=".$day." and day<".$eday." and SYMBOL='".$val[0]."' order by day asc";
//echo $sql1;
$c3=mysql_query($sql1,$conn);
$i=1;
while($c14_r3=mysql_fetch_array($c3))
{
//echo $c14_r3[0]." ".$c14_r3[1];
//print_r($c14_r3);
//echo "<br />";
$v2[$i]=(float)$c14_r3['TOTTRDQTY'];
$i++;
}
$sql1="select r3 from data where day>=".$day." and day<".$eday." and SYMBOL='".$val[0]."' order by day asc";
//echo $sql1;
$c3=mysql_query($sql1,$conn);
$i=1;
while($c14_r3=mysql_fetch_array($c3))
{
//echo $c14_r3[0]." ".$c14_r3[1];
//print_r($c14_r3);
//echo "<br />";
$v1[$i]=(float)$c14_r3['r3'];
$i++;
}
mysql_query(correl($v1,$v2,14,$val[0],$day,"c14_r3"),$conn);
//echo correl($v1,$v2,14,$val[0],$day,"c14_r3");
$sql1="select r2 from data where day>=".$day." and day<".$eday." and SYMBOL='".$val[0]."' order by day asc";
//echo $sql1;
$c3=mysql_query($sql1,$conn);
$i=1;
while($c14_r2=mysql_fetch_array($c3))
{
//echo $c14_r2[0]." ".$c14_r2[1];
//print_r($c14_r2);
//echo "<br />";
$v1[$i]=(float)$c14_r2['r2'];
$i++;
}
mysql_query(correl($v1,$v2,14,$val[0],$day,"c14_r2"),$conn);
$sql1="select r1 from data where day>=".$day." and day<".$eday." and SYMBOL='".$val[0]."' order by day asc";
//echo $sql1;
$c3=mysql_query($sql1,$conn);
$i=1;
while($c14_r1=mysql_fetch_array($c3))
{
//echo $c14_r1[0]." ".$c14_r1[1];
//print_r($c14_r1);
//echo "<br />";
$v1[$i]=(float)$c14_r1['r1'];
$i++;
}

mysql_query(correl($v1,$v2,14,$val[0],$day,"c14_r1"),$conn);
$sql1="select pivot from data where day>=".$day." and day<".$eday." and SYMBOL='".$val[0]."' order by day asc";
//echo $sql1;
$c3=mysql_query($sql1,$conn);
$i=1;
while($c14_pivot=mysql_fetch_array($c3))
{
//echo $c14_pivot[0]." ".$c14_pivot[1];
//print_r($c14_pivot);
//echo "<br />";
$v1[$i]=(float)$c14_pivot['pivot'];
$i++;
}
mysql_query(correl($v1,$v2,14,$val[0],$day,"c14_pivot"),$conn);
$sql1="select s1 from data where day>=".$day." and day<".$eday." and SYMBOL='".$val[0]."' order by day asc";
//echo $sql1;
$c3=mysql_query($sql1,$conn);
$i=1;
while($c14_s1=mysql_fetch_array($c3))
{
//echo $c14_s1[0]." ".$c14_s1[1];
//print_r($c14_s1);
//echo "<br />";
$v1[$i]=(float)$c14_s1['s1'];
$i++;
}
mysql_query(correl($v1,$v2,14,$val[0],$day,"c14_s1"),$conn);
$sql1="select s2 from data where day>=".$day." and day<".$eday." and SYMBOL='".$val[0]."' order by day asc";
//echo $sql1;
$c3=mysql_query($sql1,$conn);
$i=1;
while($c14_s2=mysql_fetch_array($c3))
{
//echo $c14_s2[0]." ".$c14_s2[1];
//print_r($c14_s2);
//echo "<br />";
$v1[$i]=(float)$c14_s2['s2'];
$i++;
}
mysql_query(correl($v1,$v2,14,$val[0],$day,"c14_s2"),$conn);
$sql1="select s3 from data where day>=".$day." and day<".$eday." and SYMBOL='".$val[0]."' order by day asc";
//echo $sql1;
$c3=mysql_query($sql1,$conn);
$i=1;
while($c14_s3=mysql_fetch_array($c3))
{
//echo $c14_s3[0]." ".$c14_s3[1];
//print_r($c14_s3);
//echo "<br />";
$v1[$i]=(float)$c14_s3['s3'];
$i++;
}
mysql_query(correl($v1,$v2,14,$val[0],$day,"c14_s3"),$conn);
}
//}
?>
<script type="text/javascript">
function go()
{
document.forms['go'].submit();
}
</script>

</head>
<body onload="javascript:go()">
<h1><center><b>Done.</b></center></h1>
<form id ="go" action="project.html" method="post">
</form>
</body>
</html>
