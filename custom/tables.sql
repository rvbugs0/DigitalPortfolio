Create table Admin (
	code Int NOT NULL AUTO_INCREMENT,
	email Varchar(60) NOT NULL,
	password Varchar(100) NOT NULL,
	name Varchar(100),
	UNIQUE (code),
	UNIQUE (email),
 Primary Key (code)) ENGINE = InnoDB;

Create table Services (
	code Int NOT NULL AUTO_INCREMENT,
	title Varchar(60) NOT NULL,
	description text,
	admin Int NOT NULL,
	UNIQUE (code),
Primary Key (code)) ENGINE = InnoDB;

Alter table Services add Foreign Key (admin) references Admin (code) on delete  restrict on update  restrict; 