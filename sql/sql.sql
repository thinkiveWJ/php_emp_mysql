--项目库
create database php_emp_an3;
--选择库
use php_emp_an3;
--用户表
create table yh_user(
	user_id int not null auto_increment,
	user_name varchar(32) not null,
	user_pwd char(32) not null,
	primary key(user_id)
)ENGINE=InnoDB default charset=utf8 auto_increment=1; 
--模拟一条用户数据
insert into yh_user values(1, 'admin', md5('admin'));


--创建员工信息表
create table yh_emp_info(
	emp_id int unsigned not null auto_increment primary key,
	emp_name varchar(32) not null,
	emp_dept varchar(32) not null,
	emp_birthday bigint not null,
	emp_entry bigint not null
)ENGINE=InnoDB default charset=utf8 auto_increment=1;

--模拟员工数据
insert into yh_emp_info 
values(1, "张三", '1', 1397870169584, 1524014148430);

insert into yh_emp_info 
values(null, "李四", '2', 1397870169584, 1524014148430);

insert into yh_emp_info(emp_name, emp_dept, emp_birthday, emp_entry)
select emp_name, emp_dept, emp_birthday, emp_entry from yh_emp_info;







