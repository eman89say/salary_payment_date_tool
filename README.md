# salary_payment_date_tool

Salary Payment Date Tool - PHP Application

Created By Eman Sayma 
- 4th of June 2021

Description:
* Generate CSV for the Salary Payment Dates and Bonus payment Dates for a given year.
Solution for this assignment:
https://gist.github.com/DragonBe/10521ac163824e3cdc85e0d71527d118


How to Use the Application:
* Run composer install.
* Run the application from the command line and provide 2 arguments:
   1- Output file name as an argument.
   2- Year (optional).
   - Example: 
     php index.php payment_dates 2022
* You will see the created csv in outputCSV folder.

Tests Added:
- HelpersTest
To run the test using command line run this command:
  ./vendor/bin/phpunit 
