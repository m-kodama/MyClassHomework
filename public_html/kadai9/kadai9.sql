create table ei_questions (
number	  integer	not null,
	course		varchar(20)	not null,
	question	varchar(1000) not null,
	answer	  varchar(50) not null,
	unit	    varchar(30),
	comment   varchar(1000),
	primary key(number),
);
