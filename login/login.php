<?php 
header("charset=UTF-8");
// 接收从前端传过来的参数
$user_name = @$_POST['user_name'];
$user_pwd = @$_POST['user_pwd'];

if(!isset($user_name)){
    $result = [
        "error_code" => 1,
        "error_msg" => "用户名不能为空"
    ];
    //转换为json字符串
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
if(!isset($user_pwd)){
    $result = [
        "error_code" => 1,
        "error_msg" => "密码不能为空"
    ];
    //转换为json字符串
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
// 实例化一个$mysqli对象 连接数据库
$mysqli = @new mysqli("localhost", "root", 'root', 'php_emp_an3');

if($mysqli->connect_errno){
    $result = [
        "error_code" => 1001,
        "error_msg" => $mysqli->connect_error
    ];
    //转换为json字符串
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
// 写一个sql语句
$sql = "select user_name, user_pwd, user_id from yh_user where user_name='{$user_name}'";
// 执行sql
$res = @$mysqli->query($sql);
if(!$res){
    $result = [
        "error_code" => 1001,
        "error_msg" => $mysqli->error
    ];
    //转换为json字符串
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
//保存从数据库根据用户名查询出来的密码
$user_pwd_res = "";
$result = [];
while($row = $res->fetch_assoc()){
    $user_pwd_res  = $row['user_pwd'];
    $result = $row;
}
// 释放资源
$res->free();
// 关闭mysqli数据库连接
$mysqli->close();
if($user_pwd == $user_pwd_res){
    //把user_id保存到session中，用作保持保持状态
    session_start();
    $_SESSION['user_id'] = $result['user_id'];
    $result['error_code'] = 0;
    $result['error_msg'] = "请求成功";
    unset($result['user_pwd']);
     //转换为json字符串
     echo json_encode($result, JSON_UNESCAPED_UNICODE);
     exit;
}
$result = [
    "error_code" => 1,
    "error_msg" => "用户名或密码不正确"
];
//转换为json字符串
echo json_encode($result, JSON_UNESCAPED_UNICODE);
exit;
?>