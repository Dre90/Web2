PROGRAMMING FOR WEB II
LAB 5 / TASK 4 ANSWER

SELECT * FROM books;

SELECT * FROM books WHERE MATCH(abstract) AGAINST ('+book -first' IN BOOLEAN MODE);

ALTER TABLE books DROP INDEX category;

ALTER TABLE books DROP COLUMN pages;

DROP TABLE books;

DROP DATABASE imt3851_db;

[You need to logout and login as root user or as any other power user]

DROP USER â€˜imt3851'@'localhost';
