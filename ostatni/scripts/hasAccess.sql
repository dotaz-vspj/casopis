-- Active: 1729363936287@@127.0.0.1@3306@rsp
DELIMITER $$
CREATE DEFINER=`tis`@`%` FUNCTION `hasAccess`(`userNO` INT, `articleNO` INT) RETURNS tinyint(1)
    READS SQL DATA
BEGIN
  IF userNO<>0 THEN
    SET userNO = (SELECT MAX(ID) FROM (SELECT 0 as ID UNION SELECT ID FROM RSP_USER WHERE ID=userNO) as X);
  END IF;
  SET @userFce = 0;
  IF userNO<>0 THEN
    SET @userFce = (SELECT Func FROM RSP_USER WHERE ID=userNO);
  END IF;
  SET articleNO=(SELECT ID from RSP_ARTICLE where ID=articleNO);
  IF articleNO is null THEN
  	RETURN 0;
  END IF;
  IF (SELECT Status from RSP_ARTICLE where ID=articleNO)=5 THEN
  	RETURN 1;
  END IF;
  IF @userFce=0 THEN
     RETURN 0;
  ELSEIF @userFce<20 THEN
     RETURN 1;
  ELSE
  	 RETURN (SELECT Article from RSP_ARTICLE_ROLE where article=articleNO and person=userNO and Active_from<=NOW() and (Active_to is null or Active_to>now())) is not null;
  END IF;
END$$
DELIMITER ;

