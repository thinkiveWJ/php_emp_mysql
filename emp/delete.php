<?php
header("charset=UTF-8");

$emp_id = @$_POST['emp_id'];
//判断前端穿过来的员工id是否为空
if(!$emp_id){
    $result = [
        'error_code' => 1,
        'error_msg' => '员工id不能为空'
    ];
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
// 连接mysql数据库并实例化一个mysqli对象
$mysqli = new mysqli("localhost", 'root', 'root', 'php_emp_an3');

// 判断是否连接成功
if($mysqli->connect_errno){
    $result = [
        'error_code' => 1001,
        'error_msg' => $mysqli->connect_error
    ];
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
// 写个删除的sql语句
$sql = "delete from yh_emp_info where emp_id='{$emp_id}'";

// 执行sql
$res = $mysqli->query($sql);
// 判断sql是否执行成功
if(!$res){
    $result = [
        'error_code' => 1001,
        'error_msg' => $mysqli->error
    ];
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
// 关闭数据库连接
$mysqli->close();
// sql执行成功并返回
$result = [
    'error_code' => 0,
    'error_msg' => '请求成功'
];
echo json_encode($result, JSON_UNESCAPED_UNICODE);
exit;







