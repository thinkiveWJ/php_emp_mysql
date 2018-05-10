<?php
header("charset=UTF-8");
$emp_id = @$_POST['emp_id'];
if(!$emp_id){
    $result = [
        'error_code' => 1,
        'error_msg' => '员工id不能为空'
    ];
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$mysqli = new mysqli("localhost", 'root', 'root', 'php_emp_an3');
if($mysqli->connect_errno){
    $result = [
        'error_code' => 1001,
        'error_msg' => $mysqli->connect_error
    ];
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "select emp_id, emp_name, emp_birthday, emp_entry, emp_dept";
$sql .= " from yh_emp_info where emp_id='{$emp_id}'";


$res = $mysqli->query($sql);
if(!$res){
    $result = [
        'error_code' => 1001,
        'error_msg' => $mysqli->error
    ];
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$data = [];
while($row = $res->fetch_assoc()){
    $data = $row;
}
$result = [
    'data' => $data,
    'error_code' => 0,
    'error_msg' => '请求成功'
];
$res->free();
$mysqli->close();
echo json_encode($result, JSON_UNESCAPED_UNICODE);
exit;














