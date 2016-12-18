drop database lipa_db;

create database lipa_db;

use lipa_db;

create table regist(
	id varchar(12) not null,
	password varchar(20) not null,
	nick varchar(10) not null,
	tel char(11) not null,
	category char(50) not null,
	date char(20) not null,
	primary key(id)
);

create table list(
	no int not null auto_increment,
	id varchar(12) not null,
	nick varchar(10) not null,
	subject varchar(50) not null,
	content varchar(500) not null,
	category varchar(15) not null,
	image BLOB,
	width smallint(6) default '0', 
	height smallint(6) default '0',
	date char(20) not null,
	primary key(no)
);

create table ripple(
	no int not null,
	id varchar(12) not null,
	nick varchar(10) not null,
	content varchar(200) not null,
	date char(20) not null
);

create table message(
	no int not null auto_increment,
	s varchar(10) not null,
	r varchar(10) not null,
	subject varchar(50) not null,
	content varchar(200) not null,
	date char(20) not null,
	confirm enum('y','n') not null,
	primary key(no)
);

insert into regist values
('root','1234','���','01012345678','�丮/���','2016-11-01 12:59:35');

insert into regist values
('user1','1234','�����1','01012345678','�/�м�/����','2016-11-01 12:59:35');

insert into regist values
('user2','1234','�����2','01078901234','�/�丮','2016-11-01 12:59:35');

insert into regist values
('user3','1234','�����3','01056789012','��ȭ/����/���','2016-11-01 12:59:35');

insert into message values
('','���','�����1','�ݰ����ϴ�, �����1��','���� SNS�� �̿��� �ּż� ����帳�ϴ�^^','2016-11-01 12:59:35','n');

insert into message values
('','���','�����2','�ݰ����ϴ�, �����2��','���� SNS�� �̿��� �ּż� ����帳�ϴ�^^','2016-11-01 12:59:35','n');

insert into message values
('','���','�����3','�ݰ����ϴ�, �����3��','���� SNS�� �̿��� �ּż� ����帳�ϴ�^^','2016-11-01 12:59:35','n');