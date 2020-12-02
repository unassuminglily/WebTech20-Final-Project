CREATE SCHEMA if not exists LOA06212022;

use LOA06212022;


CREATE table Student(
StudentID varchar(8), Fname varchar(20) not null, Onames varchar(30), Lname varchar(30) not null, DOB date, gender char(1), 
Major varchar(3), CGPA dec(4,2) not null, Tel varchar(15) unique, Email varchar(50),
primary key(StudentID) 
);


CREATE TABLE Staff (
StaffID int(10) NOT NULL AUTO_INCREMENT, email varchar(50), fname varchar(30), lname varchar(30), password varchar(20),
PRIMARY KEY (StaffID));


CREATE table Fraternity(
FraternityID int, Frat_name varchar(10), Frat_type char(1), No_rooms int check (No_rooms>20), No_members int, FRank tinyint,
primary key(FraternityID)
);

CREATE table Applications(
StudentID varchar(8), FraternityID int,Fname varchar(20), Lname varchar(30),DOB date, Gender char(1), 
Major varchar(3), CGPA dec(4,2) check(CGPA>2.9), App_pts tinyint, Pref_Frathouse varchar(10), Alt varchar(20),  Status varchar(10),
foreign key(StudentID) references Student(StudentID), foreign key(FraternityID) references Fraternity(FraternityID) on update cascade
);

CREATE TABLE Applications_Fraternity (
App_FID int, App_SID varchar(8), 
foreign key (App_FID) references Applications(FraternityID),
foreign key (App_SID) references Applications(StudentID)
 );

CREATE TABLE Applications_Staff (
App_StaID int(10), App_StuID varchar(8), 
foreign key (App_StaID) references Staff(StaffID),
foreign key (App_StuID) references Applications(StudentID)
);


CREATE table FRooms(
Roomnumber varchar(4), FraternityID int, Frat_name varchar(10), Capacity tinyint not null, Block char(1),
primary key(Roomnumber), foreign key(FraternityID) references Fraternity(FraternityID) on update cascade
);

CREATE table Members(
MemberID varchar(9), Roomnumber varchar(4), Fname varchar(20), Lname varchar(20), Gender char(1),
Frat_name varchar(10), CGPA dec(4,2), Tel varchar(15) unique, Email varchar(50),
primary key(MemberID), foreign key(Roomnumber) references FRooms(Roomnumber) on update cascade
);

CREATE table New_Member(
MemberID varchar(9), Gender char(1), Major varchar(3), CGPA dec(4,2),
foreign key(MemberID) references Members(MemberID) 
);

CREATE table Senior_Member(
MemberID varchar(9),Gender char(1), Major varchar(3), CGPA dec(4,2), no_yrs tinyint check (no_yrs>0),
foreign key(MemberID) references Members(MemberID) 
);

CREATE table Executive_Member(
MemberID varchar(9), Gender char(1), Major varchar(3), CGPA dec(4,2), Position varchar(30) not null,
foreign key(MemberID) references Members(MemberID) 
);

CREATE table Alumni(
MemberID varchar(9),Gender char(1), Major varchar(3), CGPA dec(4,2),A_class varchar(30) not null,
foreign key(MemberID) references Members(MemberID) 
);