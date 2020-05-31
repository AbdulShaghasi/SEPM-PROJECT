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
	expiry_date datetime,
	last_login datetime
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

Create table tourTypes(
	type_id serial primary key,
	tour_type varchar(20)
);

Create table bookings(
	booking_id serial primary key,
	tour_id varchar(20),
	user_id varchar(40),
	booking_date datetime
);

INSERT INTO users (firstname, lastname, address, email, contact_num, username, password, account_type, reg_date, expiry_date)
VALUES ('admin','user','123 Hopkins','admin@gmail.com',12341,'admin-ad',SHA('password'),'admin','2020-05-03','2020-10-30');

INSERT INTO users (firstname, lastname, address, email, contact_num, username, password, account_type, reg_date, expiry_date)
VALUES ('assistant','user','123 Hopkins','assitant@gmail.com',12341,'assistant-as',SHA('password'),'assistant','2020-05-03','2020-10-30');

INSERT INTO users (firstname, lastname, address, email, contact_num, username, password, account_type, reg_date, expiry_date, last_login)
VALUES ('reg','user','123 Hopkins','reg@user.com',12341,'reg@user.com',SHA('password'),'customer','2020-05-03','2020-10-30', '2020-05-03');

INSERT INTO locations (location_name, XY_Coordinates, Description, Min_time_spent)
VALUES ('Melbourne','37.8136° S, 144.9631° E','A city in Australia','60');

INSERT INTO locations (location_name, XY_Coordinates, Description, Min_time_spent)
VALUES ('Sydney','33.8688° S, 151.2093° E','A city in Australia','30');

INSERT INTO tours (tour_name, tour_type, duration, location)
VALUES ('Australia','City Tour','90','1,2');

INSERT INTO tourTypes (tour_type)
VALUES ('City Tour');
