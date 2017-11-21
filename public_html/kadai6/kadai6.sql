# create EI students table
create table ei_students (
	id			varchar(8)	not null,
	ename		varchar(30)	not null,
	jname		varchar(30),
	age			integer,
	gender	boolean,
	primary key(id),
	check(age between 0 and 100)
);

create table ei_students (id varchar(8) not null, ename varchar(30) not null, jname varchar(30), age integer, gender boolean, primary key(id),check(age between 0 and 100));


#レポート課題1(1)
insert into ei_students values ( 'a1fm1001', 'Masayuki Torai', '虎井 正之', 34, true);
insert into ei_students values ( 'a1fm1002', 'Naname Hajishima', '端島 斜', 33, true);
insert into ei_students values ( 'a1fm1003', 'Yuzo Tamoyama', '多茂山 雄三', 33, true);
insert into ei_students values ( 'a1fm1004', 'Takato Izumikawa', '泉川 高人', 33, True);
insert into ei_students values ( 'a1fm1005', 'Yuichi Ogawa', '小河 優一	', 29, True);
insert into ei_students values ( 'a1fm1006', 'Takashi Yotsuishi', '四足 蛸士	', 33, True);

select * from ei_students;

#レポート課題1(2)
create table ei_progress (
	id				varchar(8)	not null,
	course		varchar(20)	not null,
	progress	integer not null,
	result		varchar,
	check(progress between 0 and 100)
);


create table ei_progress (id varchar(8) not null, course varchar(20) not null, progress integer not null, result varchar, check(progress between 0 and 100));

insert into ei_progress values ( 'a1fm1001', '英語', 60, null);
insert into ei_progress values ( 'a1fm1001', '生物', 100, 'B');
insert into ei_progress values ( 'a1fm1001', '歴史', 80, null);

insert into ei_progress values ( 'a1fm1002', '英語', 100, 'A');
insert into ei_progress values ( 'a1fm1002', '数学', 100, 'B');
insert into ei_progress values ( 'a1fm1002', '物理', 70, null);
insert into ei_progress values ( 'a1fm1002', '化学', 40, null);

insert into ei_progress values ( 'a1fm1003', '英語', 90, null);
insert into ei_progress values ( 'a1fm1003', '数学', 30, null);
insert into ei_progress values ( 'a1fm1003', '生物', 80, null);
insert into ei_progress values ( 'a1fm1003', '政治', 70, null);

insert into ei_progress values ( 'a1fm1004', '英語', 40, null);
insert into ei_progress values ( 'a1fm1004', '生物', 90, null);
insert into ei_progress values ( 'a1fm1004', '歴史', 100, 'B');

insert into ei_progress values ( 'a1fm1005', '英語', 80, null);
insert into ei_progress values ( 'a1fm1005', '数学', 100, 'B');
insert into ei_progress values ( 'a1fm1005', '物理', 100, 'A');
insert into ei_progress values ( 'a1fm1005', '経済', 40, null);

insert into ei_progress values ( 'a1fm1006', '英語', 60, null);
insert into ei_progress values ( 'a1fm1006', '数学', 50, null);
insert into ei_progress values ( 'a1fm1006', '物理', 100, 'D');
insert into ei_progress values ( 'a1fm1006', '化学', 80, null);

#kadai2(1)
select id from ei_progress where course='英語' and progress < 80;


#kadai2(2)
select ei_students.jname, ei_progress.progress, ei_progress.result
from ei_students, ei_progress
where ei_students.id = ei_progress.id
and ei_progress.course = '物理'
and (ei_progress.result != 'A' and ei_progress.result !='B');

select ei_students.jname, ei_progress.progress, ei_progress.result
from ei_students, ei_progress
where ei_students.id = ei_progress.id
and ei_progress.course = '物理'
and ( (ei_progress.result != 'A' and ei_progress.result !='B') or ei_progress.result IS NULL );






