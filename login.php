<?php
// create database project;
// create table users(uname varchar(20),pass varchar(20));
// insert into users values('admin','smallfox');
$uname = $_REQUEST['uname'];
$pass = $_REQUEST['pass'];
//echo $uname."<br />".$pass;
$conn = mysql_connect("localhost","root","ronaldo");
if(!$conn)
echo "Database ERROR";
else
{

//if(mysql_query("create database project_users",$conn))
//{
//mysql_select_db("project_users",$conn);
//mysql_query("create table users(uname varchar(20) , pass varchar(20))",$conn);
//mysql_query("insert into users values('admin','smallfox')",$conn);
//}
//else
//{

mysql_select_db("project",$conn);
//}
$que = "select * from users where uname='".$uname."'";
$res = mysql_query($que,$conn);
$row = mysql_fetch_array($res);
if($row['pass'] == $pass)
header('Location: http://localhost/project/option.html');
//echo $row['uname']."<br />".$row['pass'];
}
?>
