# Le blog de Ludo
 Projet 3 - BLOG - PRFE DEV PHP OC
 
 
 
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/c3958ea5270544fdbd48aaf0b9ca5eff)](https://www.codacy.com/gh/ludodrapo/Le-Blog-De-Ludo/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=ludodrapo/Le-Blog-De-Ludo&amp;utm_campaign=Badge_Grade)

PHP Insights results :<br />
<img src="https://raw.github.com/ludodrapo/Le-Blog-de-Ludo/main/php_insights_results.png" alt="php insights results" width="700"/>

To try and test this blog site, you can download all the files on your server or of course clone this repository.

To install the blog database filled with some posts and comments, please import it using the blog_db.sql script.
Demo users are : admin, subscriber1 and subscriber2 with the same password : @My1rstBlog4U

You'll have to check the manager.php file and may have to modify the line 5 :
```
const ADMIN_EMAIL = "admin@ludodrapo.fr"; //change the email adress for yours if needed
```
and the line 9 :
```
 return new PDO('mysql:host=localhost;dbname=blog;charset=utf8mb4', 'root', 'root');
 // if needed also, change the host name for the one you gave, change the user name and password (here 'root' for both) and if it doesn't work on windows, just empty the password (last entry).
```
