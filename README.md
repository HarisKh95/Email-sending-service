# EMS-TEAM-B
* Employee Management System
**************************
*Manages bio data of employees in mysql database as well as an admin user who can perform various operations upon employee's record.
* Five APIs have been exposed that comprehends add, delete, update, search, list_employee. 
* Four APIs exposed that encircles two for sign up and sign in each and 2 for forget password and set new password.

**************************
* Project has been divided into two major directories that includes config & public
* config > db > database.php contains database class that provides connection identifier / reference to rest of the files.
* config > ems.sql contain .sql file

**************************
* public > api > employee contains all api's pertinent to employee's operations
* public > api > user contains apis pertinent to admin user
* public > api_response contains response.php file that contains a general class that implements the logic of setting response parameters and then sending response.
* public > helpers > validators.php include a validator class used for validating data received from requests
* public > model > employee > employee.php contains employee's model that communicates with the DB and intimates the main api files for further processing. so basically   api files are sort of acting as controllers, that are receiving requests and upon requirement, requesting model class to talk to database on their behalf.
* public > model > user > user.php contains user's model and acts the same.

* some special helper methods such http_response_code($int), json_encode(), json_decode are frequently used. 
* header() method has been frequently used to set the header contents & other properties of response http bodies.

***************************
* mysql is used as database.
* apache as local server.
* postman as a helper tool to hit and test APIs.
