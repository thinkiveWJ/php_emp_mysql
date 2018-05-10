<?php
header("charset=UTF-8");
//接收前端传过来的参数
$emp_name = @$_POST['user_name_search'];
//当前页
$page_current = @$_POST['page_current'];
// 每页多少条数据
$page_size = @$_POST['page_size'];

$page_current = $page_current > 0 ? $page_current : 1;
$page_size = $page_size > 0 ? $page_size : 20;

//连接数据库
$mysqli = @new mysqli("localhost", "root", "root", "php_emp_an3");
if($mysqli->connect_errno){
    $result = [
        "error_code" => 1001,
        "error_msg" => $mysqli->connect_error
    ];
    //对数组数据进行json格式转换
    echo json_encode($result, JSON_UNESCAPED_UNICODE); 
    exit;
}



$sql = "";

//查询总共多少条数据
$sql2 = "";

if($emp_name){
    $sql .= "select emp_id, emp_name, emp_dept, emp_birthday, emp_entry ";
    $sql .= "from yh_emp_info where emp_name like '%{$emp_name}%' ";

    $sql2 .= "select count(*) ";
    $sql2 .= "from yh_emp_info where emp_name like '%{$emp_name}%' ";
}else{
    $sql .= "select emp_id, emp_name, emp_dept, emp_birthday, emp_entry ";
    $sql .= "from yh_emp_info";

    $sql2 .= "select count(*) from yh_emp_info";
}
$start = ($page_current-1)*$page_size;
$sql .= " limit {$start}, {$page_size}";

//执行sql2
$res2 = $mysqli->query($sql2);
if(!$res2){
    $result = [
        "error_code" => 1001,
        "error_msg" => $mysqli->error
    ];
    //对数组数据进行json格式转换
    echo json_encode($result, JSON_UNESCAPED_UNICODE); 
    exit;
}
//总共多少条数据
$total = $res2->fetch_array()[0];
//向上取整
$total_page = ceil($total/$page_size);


//执行sql
$res = $mysqli->query($sql);
if(!$res){
    $result = [
        "error_code" => 1001,
        "error_msg" => $mysqli->error
    ];
    //对数组数据进行json格式转换
    echo json_encode($result, JSON_UNESCAPED_UNICODE); 
    exit;
}
// 保存返回数据结果
$return_res = [
    'list' => [],
    'data' => [
        'total' => $total,
        'total_page' => $total_page
    ],
    'error_code' => 0,
    'error_msg' => '请求成功'
];

while($row = $res->fetch_assoc()){
    array_push($return_res['list'], $row);
}
//释放资源
$res->free();
//关闭数据连接
$mysqli->close();

echo json_encode($return_res, JSON_UNESCAPED_UNICODE);
exit;









