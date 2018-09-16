import MySQLdb

create_tables = """
DROP TABLE IF EXISTS users ;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS u_contact;
DROP TABLE IF EXISTS b_author;
CREATE TABLE Users(UserID int NOT NULL PRIMARY KEY, Password varchar(30), Email varchar(30), DOB date, FirstName varchar(30), LastName varchar(30));
CREATE TABLE Employees(EmployeeID int NOT NULL PRIMARY KEY, Post varchar(30), FirstName varchar(30), LastName varchar(30), Email varchar(30), DOB date, Password varchar(30));
CREATE TABLE U_Contact(Contact varchar(30) NOT NULL UNIQUE, UserID int REFERENCES Users(UserID));
CREATE TABLE Books(BookID int NOT NULL PRIMARY KEY, ISBN varchar(30), Title varchar(30),Edition int, UserId int REFERENCES Users(UserID), DOI date, DOR date, reissue_count int, EmployeeID int REFERENCES Employees(EmployeeID));
CREATE TABLE B_Author(BookID int REFERENCES Books(BookID), AuthorName varchar(50) UNIQUE);
"""




# Connect
db = MySQLdb.connect(host='localhost',
                        user='root', passwd='',
                        db='wdl')
cursor = db.cursor()
# cursor.execute("show tables; ")
# data = cursor.fetchall()
# for row in data:
#     print(row)
# db.close()

def main():
    
    # CREATE THE DATABASE
    for cs in create_tables.split('\n')[1:-1]:
        # first and last part are empty, they give error

        print(cs)
        cursor.execute(cs)

if __name__ == '__main__':
    main()
    db.close()