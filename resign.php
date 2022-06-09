<?php
header('cotent-type:text/html;charset=utf-8');
//receive the data from client
$name=$_POST["username"];
$pwd=$_POST["password"];
$pwda=$_POST["password_again"];
//telnet mysql
$db=mysqli_connect("localhost","root","","web");
//select the databases
$checkid=preg_match("/^\w{1,15}$/",$name);
$checkwd=preg_match("/^\w{4,18}$/",$pwd);
if(!$db)
{
    die('数据库连接失败'.$mysql_error());
    echo"die";
}
if($name==null or $pwd==null)
{
	echo"账号或密码不能为空";
    include "resign.html";
}
else if($pwd!=$pwda)
{
    echo"两次密码不一致";
    include "resign.html";
}
else if(strlen($name)>15||strlen($pwd)>18)
{
    echo"用户名或密码过长，请重新输入（用户名不长于15个字符，密码不长于18个字符）";
}
else if($checkid && $checkwd )
    {

        $res = mysqli_query($db,"select * from text where username =  '$name' ");
        $row = mysqli_fetch_assoc($res);
        if ($row != NULL ) 
            {
                echo"该用户名已经被注册";
                include "resign.html";
            }
        else
            {
            $sql="INSERT INTO `text` (`username`, `password`) VALUES ('$name', '$pwd')";
            $res1=mysqli_query($db,$sql);
            if ($res1) 
            {
                echo"注册成功";
                include "resign.html";
            }
            else
            {
                echo"注册失败";
                include "resign.html";
            }
            }
    }
else
{
    echo "error";
    include "resign.html";
}
?>