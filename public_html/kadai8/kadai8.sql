create table ei_users (
	id			varchar(16)	not null,
	ename		varchar(30)	not null,
	jname		varchar(30),
	age			integer,
	gender	boolean,
	password varchar(34) not null,
	primary key(id),
	check(age between 0 and 100)
);