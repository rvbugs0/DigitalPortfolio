Create table Admin (
	code Int NOT NULL AUTO_INCREMENT,
	email Varchar(60) NOT NULL,
	password Varchar(100) NOT NULL,
	name Varchar(100),
	UNIQUE (code),
	UNIQUE (email),
 Primary Key (code)) ENGINE = InnoDB;