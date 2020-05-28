drop database if exists SEPM;
create database SEPM;
use SEPM;

create table users(
	unique_id serial primary key,
	firstname varchar(20),
	lastname varchar(20),
	address varchar(80),
	email varchar(40),
	contact_num INT(10),
	username varchar(40),
	password char(40),
	account_type varchar(20),
	reg_date datetime,
	expiry_date datetime
);

Create table locations(
	location_id serial primary key,
	location_name varchar(20),
	XY_Coordinates varchar(40),
	Description varchar(100),
	Min_time_spent INT(5)
);

Create table tours(
	tour_id serial primary key,
	tour_name varchar(20),
	tour_type varchar(30),
	duration INT(10),
	location varchar(20)
);

INSERT INTO users (firstname, lastname, address, email, contact_num, username, password, account_type, reg_date, expiry_date)
VALUES ('mahdi','atai','123 Hopkins','mahdi@gmail.com',12341,'mahdi.atai-ad',SHA('password'),'admin','2020-05-03','2020-10-30');

INSERT INTO users (firstname, lastname, address, email, contact_num, username, password, account_type, reg_date, expiry_date)
VALUES ('abdul','shaghasi','123 Hopkins','abdul@gmail.com',12341,'abdul.shaghasi-ad',SHA('password'),'admin','2020-05-03','2020-10-30');

INSERT INTO users (firstname, lastname, address, email, contact_num, username, password, account_type, reg_date, expiry_date)
VALUES ('liam','hector','123 Hopkins','liam@gmail.com',12341,'liam.hector-ad',SHA('password'),'admin','2020-05-03','2020-10-30');

INSERT INTO users (firstname, lastname, address, email, contact_num, username, password, account_type, reg_date, expiry_date)
VALUES ('Test','Admin','123 Test Address Melbourne','test-ad@gmail.com.com',12341,'test.admin-ad',SHA('password'),'admin','2020-05-03','2020-10-30');

INSERT INTO users (firstname, lastname, address, email, contact_num, username, password, account_type, reg_date, expiry_date)
VALUES ('Test','Assistant','123 Test Address Melbourne','test-as@gmail.com.com',12341,'test.assistant-as',SHA('password'),'assistant','2020-05-03','2020-10-30');

INSERT INTO users (firstname, lastname, address, email, contact_num, username, password, account_type, reg_date, expiry_date)
VALUES ('Test','User','123 Test Address Melbourne','test@gmail.com.com',12341,'test.user-ad',SHA('password'),'user','2020-05-03','2020-10-30');

INSERT INTO locations (location_name, XY_Coordinates, Description, Min_time_spent)
VALUES ('Melbourne','37.8136° S, 144.9631° E','A city in Australia','60');

INSERT INTO locations (location_name, XY_Coordinates, Description, Min_time_spent)
VALUES ('Sydney','33.8688° S, 151.2093° E','A city in Australia','30');

INSERT INTO tours (tour_name, tour_type, duration, location)
VALUES ('Australia','City Tour','90','1,2');
