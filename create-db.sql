create database Proekt;
use Proekt;

create table User(
  ID int NOT NULL AUTO_INCREMENT,
  Username varchar(255) NOT NULL,
  Email varchar(255) NOT NULL,
  Password varchar(255) NOT NULL,
  PRIMARY KEY(ID)
);

create table Audio(
   ID int NOT NULL AUTO_INCREMENT,
   Username varchar(255) NOT NULL,
   Audioname varchar(255) NOT NULL,
   ReadableAudioname varchar(255) NOT NULL,
   Description varchar(1023),
   PRIMARY KEY(ID)
);

create table Comment(
     ID int NOT NULL AUTO_INCREMENT,
     CreatedAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
     Username varchar(255) NOT NULL,
     Audioname varchar(255) NOT NULL,
     Comment varchar(1023) NOT NULL,
     AtMoment FLOAT NOT NULL,
     PRIMARY KEY(ID)
    );
