DROP TABLE IF EXISTS `Grades` ;
DROP TABLE IF EXISTS `Notification` ;
DROP TABLE IF EXISTS `Roster` ;
DROP TABLE IF EXISTS `UnitTest` ;
DROP TABLE IF EXISTS `Submission` ;
DROP TABLE IF EXISTS `Assignment` ;
DROP TABLE IF EXISTS `Practice` ;
DROP TABLE IF EXISTS `Classes` ;
DROP TABLE IF EXISTS `Member` ;
DROP TABLE IF EXISTS `Administrator` ;
DROP TABLE IF EXISTS `Template` ;
DROP TABLE IF EXISTS `Student` ;
DROP TABLE IF EXISTS `Instructor` ;
-- -----------------------------------------------------
-- Table `Member`
-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS `Member` (
  `idMember` INT NOT NULL AUTO_INCREMENT ,
  `FirstName` VARCHAR(15) NOT NULL ,
  `LastName` VARCHAR(25) NOT NULL ,
  `MemberEmail` VARCHAR(45) NOT NULL ,
  `MemberBanner` VARCHAR(45) NOT NULL ,
  `MemberPassword` VARCHAR(50) NOT NULL ,
  `IsInstructor` BINARY NOT NULL ,
  PRIMARY KEY (`idMember`) ,
  UNIQUE INDEX `idMember_UNIQUE` (`idMember` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Classes`
-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS `Classes` (
  `idClass` INT NOT NULL AUTO_INCREMENT ,
  `ClassCRN` INT NOT NULL ,
  `ClassName` VARCHAR(45) NOT NULL ,
  `ClassInstructorId` INT NOT NULL ,
  `ClassStartDate` DATE NULL ,
  `ClassEndDate` DATE NULL ,
  `isFinished` BINARY NOT NULL ,
  PRIMARY KEY (`idClass`) ,
  UNIQUE INDEX `idClass_UNIQUE` (`idClass` ASC) ,
  INDEX `ClassMemberId_idx` (`ClassInstructorId` ASC) ,
  CONSTRAINT `ClassInstructorId`
    FOREIGN KEY (`ClassInstructorId` )
    REFERENCES `Member` (`idMember` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Practice`
-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS `Practice` (
  `idPractice` INT NOT NULL AUTO_INCREMENT ,
  `PracticeName` TEXT NOT NULL ,
  `PracticeMemberId` INT NOT NULL ,
  `PracticeAnswer` TEXT NOT NULL ,
  PRIMARY KEY (`idPractice`) ,
  UNIQUE INDEX `idPractice_UNIQUE` (`idPractice` ASC) ,
  INDEX `PracticeMemberId_idx` (`PracticeMemberId` ASC) ,
  CONSTRAINT `PracticeMemberId`
    FOREIGN KEY (`PracticeMemberId` )
    REFERENCES `Member` (`idMember` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Assignment` 
-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS `Assignment` (
  `idAssignment` INT NOT NULL AUTO_INCREMENT ,
  `AssignmentName` VARCHAR(45) NOT NULL ,
  `AssignmentDueDate` DATETIME NULL ,
  `AssignmentInstructions` TEXT NULL ,
  `AssignmentCode` TEXT NULL ,
  `AssignmentClass` INT NOT NULL ,
  `AssignmentType` BINARY NOT NULL COMMENT 'AssignmentType is 0 for C++ and 1 for Python' ,
  `AssignmentMaxAttempts` INT NULL ,
  `SuccessesToPass` INT NOT NULL DEFAULT '0', 
  PRIMARY KEY (`idAssignment`) ,
  INDEX `ForClass_idx` (`AssignmentClass` ASC) ,
  UNIQUE INDEX `idAssignment_UNIQUE` (`idAssignment` ASC) ,
  CONSTRAINT `AssignmentClassId`
    FOREIGN KEY (`AssignmentClass` )
    REFERENCES `Classes` (`idClass` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Submission` 
-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS `Submission` (
  `idSubmission` INT NOT NULL AUTO_INCREMENT ,
  `SubmissionMemberId` INT NOT NULL ,
  `SubmissionAssignmentId` INT NOT NULL ,
  `Attempts` INT,
  `DateSubmit` DATETIME,
  `Performance` varchar(10),
  `Grade` char,
  PRIMARY KEY (`idSubmission`) ,
  INDEX `AssignmentId_idx` (`SubmissionAssignmentId` ASC) ,
  UNIQUE INDEX `idSubmission_UNIQUE` (`idSubmission` ASC) ,
  INDEX `SubmissionMemberId_idx` (`SubmissionMemberId` ASC) ,
  CONSTRAINT `SubmissionMemberId`
    FOREIGN KEY (`SubmissionMemberId` )
    REFERENCES `Member` (`idMember` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `SubmissionAssignmentId`
    FOREIGN KEY (`SubmissionAssignmentId` )
    REFERENCES `Assignment` (`idAssignment` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `UnitTest`
-- -----------------------------------------------------


CREATE  TABLE IF NOT EXISTS `UnitTest` (
  `idUnitTest` INT NOT NULL AUTO_INCREMENT ,
  `UnitTestName` VARCHAR(45) NOT NULL ,
  `UnitTestAssignmentId` INT NOT NULL ,
  `UnitTestProgram` TEXT NOT NULL ,
  PRIMARY KEY (`idUnitTest`) ,
  INDEX `AssociatedAssignment_idx` (`UnitTestAssignmentId` ASC) ,
  UNIQUE INDEX `idUnitTest_UNIQUE` (`idUnitTest` ASC) ,
  CONSTRAINT `AssociatedAssignment`
    FOREIGN KEY (`UnitTestAssignmentId` )
    REFERENCES `Assignment` (`idAssignment` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Roster`
-- -----------------------------------------------------


CREATE  TABLE IF NOT EXISTS `Roster` (
  `idRoster` INT NOT NULL AUTO_INCREMENT ,
  `ClassId` INT NOT NULL ,
  `StudentId` INT NOT NULL ,
  PRIMARY KEY (`idRoster`) ,
  INDEX `ClassId_idx` (`ClassId` ASC) ,
  UNIQUE INDEX `idRoster_UNIQUE` (`idRoster` ASC) ,
  INDEX `RosterStudentId_idx` (`StudentId` ASC) ,
  CONSTRAINT `RosterStudentId`
    FOREIGN KEY (`StudentId` )
    REFERENCES `Member` (`idMember` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `RosterClassId`
    FOREIGN KEY (`ClassId` )
    REFERENCES `Classes` (`idClass` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Notification`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Notification` (
  `idNotification` INT NOT NULL AUTO_INCREMENT ,
  `NotificationName` VARCHAR(45) NOT NULL ,
  `NotificationClassId` INT NOT NULL ,
  `NotificationText` TEXT NOT NULL ,
  PRIMARY KEY (`idNotification`) ,
  INDEX `AssociatedNotificationClass_idx` (`NotificationClassId` ASC) ,
  UNIQUE INDEX `idNotification_UNIQUE` (`idNotification` ASC) ,
  CONSTRAINT `AssociatedClasses`
    FOREIGN KEY (`NotificationClassId` )
    REFERENCES `Classes` (`idClass` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Template`
-- -----------------------------------------------------


CREATE  TABLE IF NOT EXISTS `Template` (
  `idTemplate` INT NOT NULL ,
  `TemplateName` VARCHAR(45) NOT NULL ,
  `TemplateCode` TEXT NULL ,
  PRIMARY KEY (`idTemplate`) ,
  UNIQUE INDEX `idTemplate_UNIQUE` (`idTemplate` ASC) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Grades`
-- -----------------------------------------------------

CREATE  TABLE IF NOT EXISTS `Grades` (
  `GradeID` INT NOT NULL AUTO_INCREMENT ,
  `StudentID` INT NOT NULL ,
  `AssignmentID` INT NOT NULL,
  `Grade` CHAR NULL,
  PRIMARY KEY (`GradeID`) ,
  UNIQUE INDEX `GradeID_UNIQUE` (`GradeID` ASC) ,
  CONSTRAINT `StudentID` 
	FOREIGN KEY (`StudentID`) 
	REFERENCES `Member` (`idMember`) 
	ON DELETE NO ACTION 
	ON UPDATE NO ACTION ,
  CONSTRAINT `AssignmentID` 
	FOREIGN KEY (`AssignmentID`) 
	REFERENCES `Assignment` (`idAssignment`) 
	ON DELETE NO ACTION 
	ON UPDATE NO ACTION )
ENGINE = InnoDB;



INSERT INTO Member VALUES (1, 'Instruct', 'Lastname', 'instructor@email.gov', 812345678, md5('password'), 1);
INSERT INTO Member VALUES (2, 'Student', 'Last2', 'student@email.gov', 810000001, md5('password'), 0);
INSERT INTO Member VALUES (3, 'Instructor2', 'Last3', 'instructor2@email.gov', 812345679, md5('instructorpass'), 1);
INSERT INTO Member VALUES (4, 'Student2', 'Last4', 'student2@email.gov', 810000002, md5('studentpass'), 0);
INSERT INTO Classes VALUES (1, 1234567, 'Computer Science 1', 0001, '2013-10-10', '2014-07-10', 0);
INSERT INTO Classes VALUES (2, 1234568, 'Computer Science 2', 0002, '2013-10-10', '2014-07-10', 0);
INSERT INTO Roster VALUES (1, 0001, 0002);
INSERT INTO Roster VALUES (2, 0002, 0002);
INSERT INTO Roster VALUES (3, 0001, 0004);
INSERT INTO Roster VALUES (4, 0002, 0004);
INSERT INTO Assignment VALUES (1, 'Practice Test', NULL, 'Print Out Hello World', '//This Is Code', 1, 0, NULL,3);
INSERT INTO Assignment VALUES (2, 'Sample Test', NULL, 'Print Out Goodbye World', '//This Is Code', 1, 0, 5,3);
INSERT INTO Template VALUES (0001, 'Hello World', '#include <iostream>using namespace std;int main (){cout << "Hello World!";return 0;}');
INSERT INTO UnitTest VALUES (0001, 'Hello Test', 0001, 'TRUE');
INSERT INTO Practice VALUES (0001, 'Hello World', 0002, '#include <iostream>using namespace std;int main (){cout << "Hello World!";return 0;}');
INSERT INTO Notification VALUES (1, 'Testing Notifications', 1, "Hi Class, this is the notes system!");

-- -------------------------------------
-- Member Population
-- -------------------------------------
INSERT INTO Member VALUES (5, 'Thamer', 'Instructor', 'italrefai@kent.edu', 81000009, md5('studentpass'), 1);
INSERT INTO Member VALUES (6, 'Thamer', 'Student', 'stalrefai@kent.edu', 810000003, md5('studentpass'), 0);
INSERT INTO Member VALUES (7, 'Ovunc', 'Instructor', 'ioasikogl@kent.edu', 8100000010, md5('12345'), 1);
INSERT INTO Member VALUES (8, 'Ovunc', 'Student', 'soasikogl@kent.edu', 810000004, md5('12345'), 0);
INSERT INTO Member VALUES (9, 'Abdul', 'Instructor', 'iaalahai@kent.edu', 810000013, md5('studentpass'), 1);
INSERT INTO Member VALUES (10, 'Abdul', 'Student', 'saalmahai@kent.edu', 810000005, md5('studentpass'), 0);
INSERT INTO Member VALUES (11, 'Rafia', 'Instructor', 'irqureshi@kent.edu', 810000023, md5('rafiaq88'), 1);
INSERT INTO Member VALUES (12, 'Rafia', 'Student', 'srqureshi@kent.edu', 810000006, md5('rafiaq88'), 0);
INSERT INTO Member VALUES (13, 'Cody', 'Instructor', 'ickerstin@kent.edu', 810000033, md5('12345'), 1);
INSERT INTO Member VALUES (14, 'Cody', 'Student', 'sckerstin@kent.edu', 810000007, md5('12345'), 0);
INSERT INTO Member VALUES (15, 'Mich', 'Instructor', 'ipedwards@kent.edu', 810000043, md5('12345'), 1);
INSERT INTO Member VALUES (16, 'Mich', 'Student', 'spedwards@kent.edu', 810000008, md5('12345'), 0);

-- -------------------------------------
-- Classes Population (idClass, ClassCRN, ClassName, ClassInstructorId,ClassStartDate,ClassEndDate)
-- -------------------------------------
INSERT INTO Classes VALUES (3, 1334567, 'Computer Science 11', 0005, '2013-10-10', '2014-07-10', 0);
INSERT INTO Classes VALUES (4, 1534568, 'Computer Science 12', 0005, '2013-10-10', '2014-07-10', 0);
INSERT INTO Classes VALUES (5, 1234567, 'Computer Science 3', 0009, '2013-10-10', '2014-07-10', 0);
INSERT INTO Classes VALUES (6, 1544568, 'Computer Science 4', 0009, '2013-10-10', '2014-07-10', 1);
INSERT INTO Classes VALUES (7, 1224567, 'Computer Science 5', 0007, '2013-10-10', '2014-07-10', 0);
INSERT INTO Classes VALUES (8, 1214568, 'Computer Science 6', 0007, '2013-10-10', '2014-07-10', 1);
INSERT INTO Classes VALUES (9, 1233567, 'Computer Science 7', 0011, '2013-10-10', '2014-07-10', 0);
INSERT INTO Classes VALUES (10, 1277568, 'Computer Science 8', 0011, '2013-10-10', '2014-07-10', 0);
INSERT INTO Classes VALUES (11, 1233537, 'Computer Science 9', 0013, '2013-10-10', '2014-07-10', 1);
INSERT INTO Classes VALUES (12, 1277548, 'Computer Science 10', 0013, '2013-10-10', '2014-07-10', 0);
INSERT INTO Classes VALUES (13, 1377568, 'Intro to Databases', 0005, '2013-10-10', '2014-07-10', 0);
INSERT INTO Classes VALUES (14, 1433537, 'Information Visualization', 0007, '2013-10-10', '2014-07-10', 0);
INSERT INTO Classes VALUES (15, 1477548, 'Capstone Project', 0009, '2013-10-10', '2014-07-10', 0);
INSERT INTO Classes VALUES (16, 1477568, 'Computer Graphics', 0011, '2013-10-10', '2014-07-10', 1);
INSERT INTO Classes VALUES (17, 1333537, 'Algorithms', 0015, '2013-10-10', '2014-07-10', 0);
INSERT INTO Classes VALUES (18, 1377548, 'Networks', 0015, '2013-10-10', '2014-07-10', 0);

-- -------------------------------------
-- Roster Population (id,classid,studentid)
-- -------------------------------------
INSERT INTO Roster VALUES (NULL, 0003, 0006);
INSERT INTO Roster VALUES (NULL, 0003, 0010);
INSERT INTO Roster VALUES (NULL, 0003, 0012);
INSERT INTO Roster VALUES (NULL, 0003, 0014);
INSERT INTO Roster VALUES (NULL, 0003, 0016);

INSERT INTO Roster VALUES (NULL, 0004, 0008);
INSERT INTO Roster VALUES (NULL, 0004, 0010);
INSERT INTO Roster VALUES (NULL, 0004, 0012);
INSERT INTO Roster VALUES (NULL, 0004, 0014);

INSERT INTO Roster VALUES (NULL, 0005, 0006);
INSERT INTO Roster VALUES (NULL, 0005, 0008);
INSERT INTO Roster VALUES (NULL, 0005, 0014);

INSERT INTO Roster VALUES (NULL, 0006, 0006);
INSERT INTO Roster VALUES (NULL, 0006, 0008);
INSERT INTO Roster VALUES (NULL, 0006, 0010);
INSERT INTO Roster VALUES (NULL, 0006, 0014);

INSERT INTO Roster VALUES (NULL, 0007, 0006);
INSERT INTO Roster VALUES (NULL, 0007, 0008);
INSERT INTO Roster VALUES (NULL, 0007, 0010);
INSERT INTO Roster VALUES (NULL, 0007, 0014);

INSERT INTO Roster VALUES (NULL, 0008, 0006);
INSERT INTO Roster VALUES (NULL, 0008, 0008);
INSERT INTO Roster VALUES (NULL, 0008, 0012);
INSERT INTO Roster VALUES (NULL, 0008, 0014);

INSERT INTO Roster VALUES (NULL, 0009, 0008);
INSERT INTO Roster VALUES (NULL, 0009, 0010);
INSERT INTO Roster VALUES (NULL, 0009, 0012);
INSERT INTO Roster VALUES (NULL, 0009, 0014);

INSERT INTO Roster VALUES (NULL, 0010, 0006);
INSERT INTO Roster VALUES (NULL, 0010, 0010);
INSERT INTO Roster VALUES (NULL, 0010, 0012);
INSERT INTO Roster VALUES (NULL, 0010, 0014);
INSERT INTO Roster VALUES (NULL, 0010, 0016);

INSERT INTO Roster VALUES (NULL, 0011, 0006);
INSERT INTO Roster VALUES (NULL, 0011, 0008);
INSERT INTO Roster VALUES (NULL, 0011, 0012);
INSERT INTO Roster VALUES (NULL, 0011, 0014);

INSERT INTO Roster VALUES (NULL, 0012, 0006);
INSERT INTO Roster VALUES (NULL, 0012, 0008);
INSERT INTO Roster VALUES (NULL, 0012, 0010);
INSERT INTO Roster VALUES (NULL, 0012, 0012);

INSERT INTO Roster VALUES (NULL, 0013, 0006);
INSERT INTO Roster VALUES (NULL, 0013, 0008);
INSERT INTO Roster VALUES (NULL, 0013, 0010);
INSERT INTO Roster VALUES (NULL, 0013, 0012);
INSERT INTO Roster VALUES (NULL, 0010, 0016);

INSERT INTO Roster VALUES (NULL, 0014, 0006);
INSERT INTO Roster VALUES (NULL, 0014, 0010);
INSERT INTO Roster VALUES (NULL, 0014, 0012);
INSERT INTO Roster VALUES (NULL, 0014, 0014);

INSERT INTO Roster VALUES (NULL, 0015, 0006);
INSERT INTO Roster VALUES (NULL, 0015, 0008);
INSERT INTO Roster VALUES (NULL, 0015, 0010);
INSERT INTO Roster VALUES (NULL, 0015, 0012);
INSERT INTO Roster VALUES (NULL, 0010, 0016);

INSERT INTO Roster VALUES (NULL, 0016, 0008);
INSERT INTO Roster VALUES (NULL, 0016, 0010);
INSERT INTO Roster VALUES (NULL, 0016, 0012);
INSERT INTO Roster VALUES (NULL, 0016, 0014);

INSERT INTO Roster VALUES (NULL, 0017, 0006);
INSERT INTO Roster VALUES (NULL, 0017, 0008);
INSERT INTO Roster VALUES (NULL, 0017, 0012);
INSERT INTO Roster VALUES (NULL, 0017, 0014);

INSERT INTO Roster VALUES (NULL, 0018, 0006);
INSERT INTO Roster VALUES (NULL, 0018, 0008);
INSERT INTO Roster VALUES (NULL, 0018, 0010);
INSERT INTO Roster VALUES (NULL, 0010, 0016);


-- -------------------------------------
-- Assignment Population(idAssignment,AssignmentName,AssignmentDueDate,AssignmentInstructions,AssignmentCode,AssignmentClass,AssignmentType,AssignmentMaxAttempts, SuccessestoPass)
-- -------------------------------------
INSERT INTO Assignment VALUES (19, 'Practice Test 1', NULL, 'Print Out Hello World', '//This Is Code', 10, 0, NULL,3);
INSERT INTO Assignment VALUES (4, 'Sample Test 1', NULL, 'Print Out Goodbye World', '//This Is Code', 3, 0, 5,3);
INSERT INTO Assignment VALUES (5, 'Practice Test 2', NULL, 'Print Out Hello World', '//This Is Code', 4, 1, NULL,3);
INSERT INTO Assignment VALUES (6, 'Sample Test 2', NULL, 'Print Out Goodbye World', '//This Is Code', 5, 0, 5,3);
INSERT INTO Assignment VALUES (7, 'Practice Test 3', NULL, 'Print Out Hello World', '//This Is Code', 6, 1, NULL,3);
INSERT INTO Assignment VALUES (8, 'Sample Test 3', NULL, 'Print Out Goodbye World', '//This Is Code', 7, 0, 5,3);
INSERT INTO Assignment VALUES (9, 'Practice Test 4', NULL, 'Print Out Hello World', '//This Is Code', 8, 1, NULL,3);
INSERT INTO Assignment VALUES (10, 'Sample Test 4', NULL, 'Print Out Goodbye World', '//This Is Code', 9, 0, 5,3);
INSERT INTO Assignment VALUES (13, 'Practice Test 5', NULL, 'Print Out Hello World', '//This Is Code', 11, 0, NULL,3);
INSERT INTO Assignment VALUES (14, 'Sample Test 5', NULL, 'Print Out Goodbye World', '//This Is Code', 13, 0, 5,3);
INSERT INTO Assignment VALUES (15, 'Practice Test 6', NULL, 'Print Out Hello World', '//This Is Code', 14, 1, NULL,3);
INSERT INTO Assignment VALUES (16, 'Sample Test 6', NULL, 'Print Out Goodbye World', '//This Is Code', 15, 0, 5,3);
INSERT INTO Assignment VALUES (17, 'Practice Test 7', NULL, 'Print Out Hello World', '//This Is Code', 16, 0, NULL,3);
INSERT INTO Assignment VALUES (18, 'Sample Test 7', NULL, 'Print Out Goodbye World', '//This Is Code', 17, 1, 5,3);
INSERT INTO Assignment VALUES (11, 'Practice Test 8', NULL, 'Print Out Hello World', '//This Is Code', 18, 1, NULL,3);
INSERT INTO Assignment VALUES (12, 'Sample Test 8', NULL, 'Print Out Goodbye World', '//This Is Code', 12, 0, 5,3);
INSERT INTO Assignment VALUES (20, 'Sample Test 9', NULL, 'Print Out Goodbye World', '//This Is Code', 17, 1, 5,3);
INSERT INTO Assignment VALUES (21, 'Practice Test 9', NULL, 'Print Out Hello World', '//This Is Code', 18, 1, NULL,3);
