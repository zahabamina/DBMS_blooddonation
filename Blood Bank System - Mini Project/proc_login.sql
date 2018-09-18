USE `bloodbank_management_system`;
DROP procedure IF EXISTS `proc_login`;

DELIMITER $$
USE `bloodbank_management_system`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_login`(IN user_name VARCHAR(50), IN pwd VARCHAR(50))
BEGIN
	DECLARE var_user_id INT;
    DECLARE var_user_level VARCHAR(50);
    
    SELECT user_id, user_level_id INTO var_user_id, var_user_level FROM user WHERE user_username = user_name AND user_password = pwd;
    IF var_user_id IS NOT NULL THEN
		INSERT INTO login VALUES (var_user_id,user_name,pwd,var_user_level,now()) ON DUPLICATE KEY UPDATE login_date=now();
    END IF;
    
	SELECT * FROM user WHERE user_username = user_name AND user_password = pwd;
	
END$$

DELIMITER ;

