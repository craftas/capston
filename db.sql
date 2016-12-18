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
('root','1234','운영자','01012345678','요리/기계','2016-11-01 12:59:35');

insert into regist values
('user1','1234','사용자1','01012345678','운동/패션/음악','2016-11-01 12:59:35');

insert into regist values
('user2','1234','사용자2','01078901234','운동/요리','2016-11-01 12:59:35');

insert into regist values
('user3','1234','사용자3','01056789012','영화/음악/기계','2016-11-01 12:59:35');

insert into message values
('','운영자','사용자1','반갑습니다, 사용자1님','저희 SNS를 이용해 주셔서 감사드립니다^^','2016-11-01 12:59:35','n');

insert into message values
('','운영자','사용자2','반갑습니다, 사용자2님','저희 SNS를 이용해 주셔서 감사드립니다^^','2016-11-01 12:59:35','n');

insert into message values
('','운영자','사용자3','반갑습니다, 사용자3님','저희 SNS를 이용해 주셔서 감사드립니다^^','2016-11-01 12:59:35','n');