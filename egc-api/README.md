# egc-api

# 1. db-handler/config.php:-
Holds the configuration information of our application. Mainly, it will hold the database credentials.

# 2. lib/main.php:-
Used to bootstrap our application by including the necessary files.

# 3. modal/Database.php:- 
The database access layer which will be used to interact with the underlying MSSQL database.

# 4. modal/UserModel.php:-
The User model file which implements the necessary methods to interact with the users table in the MSSQL database.

# 7. controller/Api/BaseController.php:-
A base controller file which holds common utility methods.

# 8. controller/Api/UserController.php:-
The User controller file which holds the necessary application code to entertain REST API calls.

# 9 lib/ErrorMessage.php
All Error message are present here for use just we need to call ErrorMessage Class.

# 10 lib/Response.php
Message based on status code.

# 11 lib/utils
environment handling dev,test,production.

eGrow Connect API