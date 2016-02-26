PROGRAMMING FOR WEB II
LAB 5 / TASK 2 ANSWER

Use imt3851_db;

CREATE TABLE books (
  isbn SMALLINT PRIMARY KEY,
  title VARCHAR(100),
  publisher VARCHAR(50),
  pages TINYINT(4),
  abstract TEXT(1000)
);

DESCRIBE books.

ALTER TABLE books ADD index(isbn);
ALTER TABLE books ADD index(title(20));
ALTER TABLE books ADD index(publisher(10));
ALTER TABLE books ADD index(abstract(100));
ALTER TABLE books ADD FULLTEXT(abstract);

INSERT INTO books(isbn, title, publisher, pages, abstract) VALUES('1234', 'This is the first book', 'Publisher A', '340', 'This is the abstract of the first book!');

INSERT INTO books(isbn, title, publisher, pages, abstract) VALUES('1235', 'This is the second book', 'Publisher B', '500', 'This is the abstract of the second book!');

DESCRIBE books;
