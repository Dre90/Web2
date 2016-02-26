PROGRAMMING FOR WEB II
LAB 5 / TASK 1 ANSWER

[Login is specific to your system â€” consult with your lab assistant]

SHOW DATABASES;

CREATE USER 'imt3851'@'localhost' IDENTIFIED BY 'imt3851';

CREATE DATABASE imt3851_db;

GRANT ALL ON imt3851_db.* TO 'imt3851'@'localhost';
