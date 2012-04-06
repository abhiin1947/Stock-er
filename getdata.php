<?php
$query=$_REQUEST['query'];
$conn=mysql_connect('localhost','root','ronaldo');
mysql_select_db("project",$conn);
$res=mysql_query($query,$conn);
$i;
while($ans=mysql_fetch_array($res))
{
$i=1;
echo "<tr>";
foreach ( $ans as $v )
{
if($i%2==0)
echo "<td>$v</td>";
$i++;
}

echo "</tr>";
}
?>
