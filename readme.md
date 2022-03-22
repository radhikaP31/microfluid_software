# Template Admin
This code using SB Admin 2 Template. If you wanna try it, you can import the sql files "template_admin.sql" in your database. And setting application/config/database.php with your config

# Features : 
- Simple Auth (Login & Register)
- User Activation with e-mail verification when register account, you can edit your config in Controllers/Auth.php and the function name is _sendMail
- Menu Management
- User & Access Management
- Edit profile & Change Password with e-mail verification

I am going to add with some features and re-design the template. See You!



For any other env setup
1. paste this whole folder
2. Create DB and execute scripts (template-admin-master -- query_setup_ci.txt)
3. Change db name in application/config/database.php file
4. Change base_url in application/config/config.php file
5. Add user and give menu permission 
6. Add user mail credentials in auth.php function _sendEmail()


Bugs:
check for condition new menu not open

New Development:
user registration by admin only
