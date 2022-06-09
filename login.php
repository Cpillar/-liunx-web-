
<?php
header('cotent-type:text/html;charset=utf-8');
//receive the data from client
$name=$_POST["username"];
$pwd=$_POST["password"];
//telnet mysql
$db=mysqli_connect("localhost","root","","web");
if(!$db)
{
    die('数据库连接失败'.$mysql_error());
}
//select the databases
if($name==null or $pwd==null)
{
	echo"账号或密码错误不能为空";
	header("Location:index.html");
}
else if(strlen($name)>15||strlen($pwd)>18)
{
    echo"用户名或密码非法";
}
else 
{
$res = mysqli_query($db,"select * from text where username =  '$name' ");
$row = mysqli_fetch_assoc($res);
if ($row['password'] == $pwd) 
{
	header("Location:start.php");
    exit();
}
else
{
	
	echo "账号或密码错误";
	
}
include "index.html";
}
?>