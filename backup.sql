-------------------------------------------------------------------------------- --
-- DROP DATABASE dbauthentication;
-- CREATE DATABASE dbauthentication;
-- CREATE TABLE dbauthentication.account (id BINARY(16) NOT NULL , accountname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL , password VARCHAR(255) NOT NULL , verified BOOLEAN NOT NULL , verified_code VARCHAR(255) NOT NULL , created DATE NOT NULL ) ENGINE = InnoDB; 

-- CREATE TABLE dbauthentication.user_information (id BINARY(16) NOT NULL ,account_id BINARY(16) NOT NULL ,name VARCHAR(255) NOT NULL , address VARCHAR(255) NOT NULL , phone_number VARCHAR(255) NOT NULL ) ENGINE = InnoDB;

-- ALTER TABLE dbauthentication.account ADD PRIMARY KEY(id);
-- ALTER TABLE dbauthentication.user_information ADD PRIMARY KEY(id);
-- ALTER TABLE dbauthentication.user_information ADD FOREIGN KEY(account_id) REFERENCES dbauthentication.account(id);

-- INSERT INTO dbauthentication.account (id, accountname, email, password, verified, verified_code, created)
-- VALUES 	
-- 	(UUID_TO_BIN(UUID()), 'admin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', true, "Abc123", "2023-01-10"),
-- 	(UUID_TO_BIN(UUID()), 'admin1','staff1@gmail.com', '202cb962ac59075b964b07152d234b70', true, "Abc123", "2023-01-10"),
-- 	(UUID_TO_BIN(UUID()), 'admin2','staff2@gmail.com', '202cb962ac59075b964b07152d234b70', true, "Abc123", "2023-01-10");
--     
-- INSERT INTO dbauthentication.user_information (id, account_id, name, address, phone_number)
-- VALUES 	
-- 	(UUID_TO_BIN(UUID()), UUID_TO_BIN((SELECT  BIN_TO_UUID(id) id FROM  dbauthentication.account WHERE accountname = "admin")), 'Bui Dinh Xuan', "Ho Chi Minh", "0335558814"),
-- 	(UUID_TO_BIN(UUID()), UUID_TO_BIN((SELECT  BIN_TO_UUID(id) id FROM  dbauthentication.account WHERE accountname = "admin1")), 'Bui Dinh Xuan 1 ', "Ho Chi Minh", "0335558814"),
-- 	(UUID_TO_BIN(UUID()), UUID_TO_BIN((SELECT  BIN_TO_UUID(id) id FROM  dbauthentication.account WHERE accountname = "admin2")), 'Bui Dinh Xuan 2', "Ho Chi Minh", "0335558814");

-- SELECT 
-- 	BIN_TO_UUID(id) id, 
-- 	BIN_TO_UUID(account_id) account_id, 
-- 	name,
-- 	address,
-- 	phone_number
-- FROM
-- 	dbauthentication.user_information;
-------------------------------------------------------------------------------- 
CREATE TABLE dbauthentication.article(id int NOT NULL AUTO_INCREMENT,title varchar(255), intro varchar(255), content text, slug varchar(255), avatar_url varchar(255)) ENGINE = InnoDB;
