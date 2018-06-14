USE akaiotagamma_org;

CREATE TABLE UserLine(
    Id  smallint AUTO_INCREMENT,
    Name    varchar(25) NOT NULL UNIQUE,
    Semester varchar(10) NOT NULL,
    InitiationYear year NOT NULL,

    PRIMARY KEY(Id),
    CONSTRAINT pk_UserLine  UNIQUE (Id),
    CONSTRAINT unique_YearSemester UNIQUE (Semester, InitiationYear)
);

CREATE TABLE UserProfile (
    MemberId char(10) DEFAULT '0000000000',
    UserLine_Id smallint NOT NULL,
    LinePosition char(2) NOT NULL,
    FirstName varchar(25) NOT NULL,
    MiddleName varchar(25),
    LastName varchar(25),
    LastNamePledge varchar(25) NOT NULL,
    Street varchar(50),
    City varchar(50),
    State char(2),
    Zipcode char(10),
    PhonePrimary char(15),
    PhoneSecondary char(15),
    Birthday date DEFAULT '1900-01-01',
    DateofDeath date,
    DateofDeathNot date,
    Email varchar(50),
    WorkName varchar(50),
    WorkPosition varchar(50),
    WorkStreet varchar(50),
    WorkCity varchar(50),
    WorkState char(2),
    WorkZipcode char(10),
    WorkPhone char(15),
    MailingStreet varchar(50),
    MailingState varchar(50),
    MailingCity varchar(50),
    MailingZipcode char(10),
    CurrentChapter varchar(50),
    EmergencyName varchar(50),
    EmergencyPhone char(15),
    EmergencyEmail varchar(50),
    Facebook text,
    Twitter text,
    Instagram text,
    Website text,

    PRIMARY KEY (MemberId),
    CONSTRAINT pk_UserProfile UNIQUE (MemberId),
    CONSTRAINT Userline_fk_UserProfile FOREIGN KEY (UserLine_Id) REFERENCES UserLine(Id),
    CONSTRAINT unique_LinePosition UNIQUE (LinePosition, UserLine_Id)
);

CREATE TABLE AccountPermission (
    Id tinyint AUTO_INCREMENT,
    Name varchar(25) NOT NULL,
    Description varchar(255),

    PRIMARY KEY (Id),
    CONSTRAINT pk_AccountPermission UNIQUE (Id)
);

CREATE TABLE UserAccount(
    Id mediumint AUTO_INCREMENT,
    MemberId char(10),
    AccountPermission_Id tinyint,
    Password varchar(200) NOT NULL,
    Salt varchar(50),
    HashLength smallint DEFAULT 0,

    PRIMARY KEY (Id),
    CONSTRAINT pk_UserAccount UNIQUE (Id),
    CONSTRAINT UserProfile_fk_UserAccount FOREIGN KEY (MemberId) REFERENCES UserProfile(MemberId),
    CONSTRAINT AccountPermission_fk_UserAccount FOREIGN KEY (AccountPermission_Id) REFERENCES AccountPermission(Id),
    CONSTRAINT unique_Hash UNIQUE (Salt, HashLength)
);

CREATE TABLE FamilyType(
    Id smallint AUTO_INCREMENT,
    Name varchar(25) NOT NULL,
    Description varchar(255),

    PRIMARY KEY (Id),
    CONSTRAINT pk_FamilyType UNIQUE (Id)
);

CREATE TABLE UserFamily(
    Id int AUTO_INCREMENT,
    MemberId char(10),
    FamilyType_Id smallint,
    FirstName varchar(25),
    MiddleName varchar(25),
    LastName varchar(25),
    Gender varchar(10),

    PRIMARY KEY (Id),
    CONSTRAINT pk_UserFamily UNIQUE (Id),
    CONSTRAINT UserProfile_fk_UserFamily FOREIGN KEY (MemberId) REFERENCES UserProfile(MemberId),
    CONSTRAINT FamilyType_fk_UserFamily FOREIGN KEY (FamilyType_Id) REFERENCES FamilyType(Id)
);