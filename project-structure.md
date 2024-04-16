To do:
Create a basic blog website, the website needs to implement the following functionalities:

- [] One user can have many posts, 1 post can have only one writer;
- [] One post can have many tags, and one tag can have many posts;
- [] The homepage needs to list all tags, created on the website, all posts ordered by latest added to the website
- [] In the back-end for each user the user can only see his posts
- [] If not logged in the all posts will be listed

## User Screens
- [] **/dashboard** lists all user articles - **GET**

- [] **/user/{username}** list all user posts 

- [] **/post/{id}** display single post - **GET**
- [] **/comment/{post_id}** add comment to a post - **POST**
- [] **/post/{id}/edit** is the post edit screen - **GET/POST**
    * The screen will be one form, Title, Content, Tags
- [] **/post/{id}/comments** here all post comments will be listed - **GET/POST** 
    * the user can remove some of them 

