# Le blog de Ludo
 Projet 3 - BLOG - PRFE DEV PHP OC

To try and test this blog site, you can download all the files on your server or of course clone this repository.

To fully experience it, you'll have to change the email adress all the automatic and contact mails are send to, with yours obviously ...

To install the blog database with data, please import it using the blog_db.sql script.

You'll have to check the manager.php file and modify the line 7 :
```
$db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8mb4', 'root', 'root');
```
with your own data as usual :
```
$db = new PDO('mysql:host=your_host;dbname=blog;charset=utf8mb4', 'your_admin_name', 'your_password');
```
