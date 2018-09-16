
DROP TABLE IF EXISTS users ;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS u_contact;
DROP TABLE IF EXISTS b_author;

CREATE TABLE users
  (
     userid    INT NOT NULL PRIMARY KEY,
     password  VARCHAR(30),
     email     VARCHAR(30),
     dob       DATE,
     firstname VARCHAR(30),
     lastname  VARCHAR(30)
  );

CREATE TABLE employees
  (
     employeeid INT NOT NULL PRIMARY KEY,
     post       VARCHAR(30),
     firstname  VARCHAR(30),
     lastname   VARCHAR(30),
     email      VARCHAR(30),
     dob        DATE,
     password   VARCHAR(30)
  );

CREATE TABLE u_contact
  (
     contact VARCHAR(30) NOT NULL UNIQUE,
     userid  INT REFERENCES users(userid)
  );

CREATE TABLE books
  (
     bookid        INT NOT NULL PRIMARY KEY,
     isbn          VARCHAR(30),
     title         VARCHAR(30),
     edition       INT,
     userid        INT REFERENCES users(userid),
     doi           DATE,
     dor           DATE,
     reissue_count INT,
     employeeid    INT REFERENCES employees(employeeid)
  );

CREATE TABLE b_author
  (
     bookid     INT REFERENCES books(bookid),
     authorname VARCHAR(50) UNIQUE
  ); 