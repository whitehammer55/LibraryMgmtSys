import MySQLdb
import json

ddl_create = """
DROP TABLE IF EXISTS users ;
DROP TABLE IF EXISTS employees;
DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS u_contact;
DROP TABLE IF EXISTS b_author;
CREATE TABLE Users(UserID int NOT NULL PRIMARY KEY, Password varchar(30), Email varchar(30), DOB date, FirstName varchar(30), LastName varchar(30));
CREATE TABLE Employees(EmployeeID int NOT NULL PRIMARY KEY, Post varchar(30), FirstName varchar(30), LastName varchar(30), Email varchar(30), DOB date, Password varchar(30));
CREATE TABLE U_Contact(Contact varchar(30) NOT NULL UNIQUE, UserID int REFERENCES Users(UserID));
CREATE TABLE Books(BookID int NOT NULL PRIMARY KEY, ISBN varchar(30), Title varchar(100),Edition int, UserId int REFERENCES Users(UserID), DOI date, DOR date, reissue_count int, EmployeeID int REFERENCES Employees(EmployeeID));
CREATE TABLE B_Author(BookID int REFERENCES Books(BookID), AuthorName varchar(50) UNIQUE);
"""

# Connect
conn = MySQLdb.connect(host='localhost',
                        user='root', passwd='',
                        db='wdl')
cursor = conn.cursor()
# cursor.execute("show tables; ")
# data = cursor.fetchall()
# for row in data:
#     print(row)
# conn.close()

def c_table_books(filename):
    '''Insert in books table'''

    insert_fmt = \
    """INSERT INTO Books (BookID, ISBN, Title, Edition)
    VALUES ('{}', '{}', '{}', '{}');"""

    with open(filename) as f:
        for book in json.load(f):
            cmd  = insert_fmt.format(
                book['ID'],
                book['ISBN'], 
                book['Title'], 
                book['Edition'])
            print('Inserting: {:5d}: {:s}'.format(book['ID'], book['Title']))
            cursor.execute(cmd)

    print("COMMIT;")
    conn.commit()


def c_table_b_author(filename):
    '''Insert in b_author table'''

    insert_fmt = \
    """INSERT INTO B_Author(BookID, AuthorName)
    VALUES ('{}', '{}');"""

    with open(filename) as f:
        for book in json.load(f):
            for author in book['AuthorList']:
                cmd = insert_fmt.format(
                    book['ID'], author)

                print('Inserting: {:5d}: {:s}'.format(book['ID'], author))
                cursor.execute(cmd)

    print("COMMIT;")
    conn.commit()


def c_table_users(filename):
    '''Insert in users table'''

    insert_fmt = \
    """INSERT INTO Users(UserID, Password, Email, DOB, FirstName, LastName)
    VALUES ('{}', '{}', '{}', '{}', '{}', '{}');"""

    with open(filename) as f:
        for user in json.load(f):
            cmd = insert_fmt.format(
                user['UserID'], user['Password'],
                user['Email'], user['DOB'],
                user['FirstName'], user['LastName'])

            print('Inserting: {:5d}: {:s}'.format(user['UserID'], user['FirstName']))
            cursor.execute(cmd)

    print("COMMIT;")
    conn.commit()


def c_table_u_contact(filename):
    '''Insert in u_contact table'''

    insert_fmt = \
    """INSERT INTO U_Contact(UserID, Contact)
    VALUES ('{}', '{}');"""

    with open(filename) as f:
        for user in json.load(f):
            for contact in user['Contact']:
                cmd = insert_fmt.format(
                    user['UserID'], contact)

                print('Inserting: {:5d}: {:s}'.format(user['UserID'], contact))
                cursor.execute(cmd)

    print("COMMIT;")
    conn.commit()


def c_table_employees(filename):
    '''Insert in employees table'''

    insert_fmt = \
    """INSERT INTO Employees(EmployeeID, Password, Post, Email, DOB, FirstName, LastName)
    VALUES ('{}', '{}', '{}', '{}', '{}', '{}', '{}');"""

    with open(filename) as f:
        for emp in json.load(f):
            cmd = insert_fmt.format(
                emp['EmployeeID'], emp['Password'], emp['Post'],
                emp['Email'], emp['DOB'],
                emp['FirstName'], emp['LastName'])

            print('Inserting: {:5d}: {:s}'.format(emp['EmployeeID'], emp['FirstName']))
            cursor.execute(cmd)

    print("COMMIT;")
    conn.commit()


def main():
    
    # CREATE THE DATABASE
    for cs in ddl_create.split('\n')[1:-1]:
        # first and last part are empty, they give error

        # print(cs)
        cursor.execute(cs)

    print("Dropped and Created Tables!")
    print()

    # INSERT BOOKS
    print("INSERT BOOKS:")
    c_table_books('json/books.json')
    print()

    # INSERT B_AUTHOR
    print("INSERT B_AUTHOR:")
    c_table_b_author('json/books.json')
    print()

    # INSERT USERS
    print("INSERT USERS")
    c_table_users('json/users.json')
    print()

    # INSERT U_CONTACT
    print("INSERT U_CONTACT")
    c_table_u_contact('json/users.json')
    print()

    # INSERT EMPLOYEES
    print("INSERT EMPLOYEES")
    c_table_employees('json/employees.json')
    print()


if __name__ == '__main__':
    main()
    conn.close()