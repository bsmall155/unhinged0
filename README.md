# unhinged0
This project is was for my CS234 class.
The website is named unhinged and has the purpose of allowing users to create profiles with a username and password. If they choose they can also add multiple emails.
The home page will ask users to choose their preferences from a list, which will be saved in a table, and they can then view their results in the form of a character. 
The website has some user CRUD and full admin CRUD.

LOGIN PAGE :
![Screenshot 2023-11-28 164005](https://github.com/bsmall155/unhinged0/assets/126929520/9890fab7-54b3-45be-9c95-f00dfed8565c)
Using process.php and setup.php the login page will allow users to input a username and passsword that will be checked with the registration table, if found users will be relocated to the home page starting their session. Otherwise, users will be told whether their password is wrong or if the username simply doesn't exist.


REGISTER PAGE :
![Screenshot 2023-11-28 200336](https://github.com/bsmall155/unhinged0/assets/126929520/7fc45fe3-4c89-43a5-83ef-595e131d0c82)
Using register.php and setup.php the register page will allow users to insert a username, password, and by choice an email. The email gets inserted into a seperate table, which allows users to insert multiple emails if wanted. If the username doesn't already exist and the password meets requirements, the user will be relocated to the homepage; otherwise the user will be notified of whether the username is already taken or the password mot meeting requirements.


HOME PAGE :
![Screenshot 2023-11-28 200402](https://github.com/bsmall155/unhinged0/assets/126929520/5abc68aa-1503-407b-9a86-b3cfee2d626f)
On the Home page, users will be prompted with a survey where that can select the items they like on the page. The answers will be added to the likes table which will allow for previously selected items to be already checked upon return to the homepage. Once the answers are submitted, users will be relocated to the results page.


RESULTS PAGE (named testpage in files) :
![Screenshot 2023-11-28 200422](https://github.com/bsmall155/unhinged0/assets/126929520/cc09c0eb-fe55-4051-8a06-c9edebb9ec7f)
On the results page, data previously submitted into the likes table will be prcesssed and give you a character as response. 

PROFILE PAGE :
![Screenshot 2023-11-28 200439](https://github.com/bsmall155/unhinged0/assets/126929520/256a13fb-4ba1-48f2-9b3c-e59108325d9a)
On the Profile page, users will be shown their username and emails and will be allowed to add or delete emails and change their username or password. An error message will result at already taken usernames or passwords. 

ADMIN ONLY PAGES (named adminpg and adminchuser in files) :
![Screenshot 2023-11-28 200517](https://github.com/bsmall155/unhinged0/assets/126929520/fee5d58c-9c99-4455-b0bc-c0b04e9890a7)
![Screenshot 2023-11-28 200543](https://github.com/bsmall155/unhinged0/assets/126929520/55b4f8ff-1b05-479a-a8e4-885cc4311754)
On the admin pages, the admin will be allowed to select or delete users, and create new users. When a user is selected, the admin is then able to change their username and/or password, then also add or delete emails. Providing full CRUD functionality.


NOTICE:
The setup.php and processadmin.php will contain majority of the functions used for the website, most other php files are simply used to take inputs from forms and call the correct functions to complete operations. The setup.php is also used to initilize all tables and an admin. 





