<?php

header("charset=UTF-8");

$emp_name = @$_POST['emp_name_add'];
$emp_dept = @$_POST['emp_dept_add'];
$emp_birthday = @$_POST['emp_birthday_add'] - 0;
$emp_entry = @$_POST['emp_entry_add'] - 0;
if(!$emp_name){
    $result = [
        'error_code' => 1,
        'error_msg' => "员工姓名不能为空"
    ];
    //json编码
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
if(!$emp_dept){
    $result = [
        'error_code' => 1,
        'error_msg' => "员工部门不能为空"
    ];
    //json编码
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
if(!$emp_birthday){
    $result = [
        'error_code' => 1,
        'error_msg' => "员工生日不能为空"
    ];
    //json编码
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
if(!$emp_entry){
    $result = [
        'error_code' => 1,
        'error_msg' => "员工入职日期不能为空"
    ];
    //json编码
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
$mysqli = new mysqli("localhost", 'root', 'root', 'php_emp_an3');
if($mysqli->connect_errno){
    $result = [
        'error_code' => 1001,
        'error_msg' => $mysqli->connect_error
    ];
    //json编码
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
// $sql = "insert into yh_emp_info values(null, '{emp_name}', '{emp_dept}',";
// $sql .= "'{emp_birthday}', '{emp_entry}')";

$sql = "insert into yh_emp_info(emp_name, emp_dept, emp_birthday, emp_entry)";
$sql .= "values('{$emp_name}', '{$emp_dept}', '{$emp_birthday}', '{$emp_entry}')";


$res = $mysqli->query($sql);
if(!$res){
    $result = [
        'error_code' => 1001,
        'error_msg' => $mysqli->error
    ];
    //json编码
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$mysqli->close();
$result = [
    'error_code' => 0,
    'error_msg' => '请求成功'
];
//json编码
echo json_encode($result, JSON_UNESCAPED_UNICODE);
exit;








