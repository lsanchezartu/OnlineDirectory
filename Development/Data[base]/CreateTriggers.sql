delimiter //
CREATE TRIGGER beforeInsert_UserProfile
BEFORE INSERT ON UserProfile
     FOR EACH ROW
     BEGIN

		--Set Last Name to Pledge's if no Last Name provided--
         IF NEW.LastName IS NULL THEN
            SET NEW.LastName = NEW.LastNamePledge;
         END IF;

	 	--Create MemberId--
         SET @Line = (SELECT ul.name FROM UserLine ul WHERE ul.id = NEW.UserLine_Id LIMIT 1);
         SET @Semester = (SELECT ul.semester FROM UserLine ul WHERE ul.id = NEW.UserLine_Id LIMIT 1);
         SET @InitiationYear = (SELECT ul.InitiationYear FROM UserLine ul WHERE ul.id = NEW.UserLine_Id LIMIT 1);
		 
         SET NEW.MemberId = concat(@InitiationYear, left(@Semester,1), left(@Line,1), NEW.LinePosition, left(NEW.FirstName,1), left(NEW.LastNamePledge,1));         

    END;//
 delimiter ;


 delimiter //
CREATE TRIGGER beforeUpdate_UserProfile
BEFORE UPDATE ON UserProfile
     FOR EACH ROW
     BEGIN
	 	--Set LastName to updated Pledge's if LastName originally Pledge's--
         IF NEW.LastNamePledge != OLD.LastNamePledge  && NEW.LastName = OLD.LastNamePledge THEN
            SET NEW.LastName = NEW.LastNamePledge;
         END IF;
    END;//
 delimiter ;

 delimiter //
CREATE TRIGGER beforeInsert_UserAccount
BEFORE INSERT ON UserAccount
     FOR EACH ROW
     BEGIN
        --Auto Salt & Algorithm--
            SET NEW.Salt =  cast((FLOOR(RAND()*((9*50)-1)+1)) as char);
            SET NEW.HashLength = DEFAULT;

	 	--Hash Password--
        SET NEW.Password = SHA2(concat(NEW.Password,NEW.Salt),NEW.HashLength);
    END;//
 delimiter ;