-- Drop database if exists
DROP DATABASE IF EXISTS rsp_dotaz;
CREATE DATABASE rsp_dotaz;
CREATE USER 'admin_dotaz'@'localhost' IDENTIFIED BY 'Letmein*7';
GRANT ALL PRIVILEGES ON rsp_dotaz.* TO 'admin_dotaz'@'localhost';
FLUSH PRIVILEGES;
GRANT SUPER ON *.* TO 'admin_dotaz'@'localhost';
FLUSH PRIVILEGES;
