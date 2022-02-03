# lbm2

<a>https://www.librarymirage.site/</a>

"Library Mirage" is a minimalistic library management application.

<h3>Current project features:</h3>
<ul>
    <li><b>MVC</b> (Model, View, Controller) architectural pattern</li>
    <li><b>CRUD</b> (Create, Read, Update, Delete) model for managing "author", "book" and "user" data</li>
    <li><b>OOP</b> (Object-Oriented Programming) code style</li>
    <li><b>MariaDB</b> (database) for storing data</li>
    <li><b>PDO</b> (PHP Data Objects) database access layer</li>
    <li><b>Twig</b> template for outputting HTML</li>
    <li>input <b>validation</b></li>
    <li>result <b>sorting</b></li>
    <li><b>search</b> "book or author" option</li>
    <li>user <b>registration</b> option, currently available for "readers". Registered
        readers can:
        <ul>
            <li><b>manage</b> their accounts(CRUD operations)</li>
            <li><b>borrow and return</b> books</li>
        </ul>
    </li>
    <li><b>login</b> available for both "librarians" and "readers"</li>
    <li><b>logged in</b> "librarians" have the following functionality:
        <ul>
            <li> <b>manage</b> authors and books data (CRUD operations)</li>
            <li><b>view users data:</b> name, surname, email, borrowed books, borrow and return dates</li>
        </ul>
    </li>
    <li><b>pagination</b></li>
</ul>
<br>
<h3>Upcoming features:</h3>
<ul>
    <li><b>"remember me"</b> option</li>
    <li>password <b>reset</b></li>
    <li>account <b>activation</b></li>
    <li>email <b>notification</b></li>
    <li>if I will come up with anything else, I will add it to the list &#128521</li>
</ul>

Database  Design           
:-------------------------:
![Database Design](https://user-images.githubusercontent.com/70884391/151834733-10f12f40-6b95-4132-aabb-cc431ad68e79.png) 
Sample Data           

Authors table            |  Books table
:-------------------------:|:-------------------------:
![Authors Table](https://user-images.githubusercontent.com/70884391/151835179-879c12d4-063a-49f9-96b3-e03061b14f2d.png)|![Books Table](https://user-images.githubusercontent.com/70884391/151837554-f14923c6-9ab1-4c1e-aeb3-eddb0fed75ff.png)


Users table            |  Borrows table
:-------------------------:|:-------------------------:
![Users Table](https://user-images.githubusercontent.com/70884391/151835824-b9aa51b6-8daf-48f2-9d65-ac473fd599a5.png)|![Borrows Table](https://user-images.githubusercontent.com/70884391/151837148-507ac06c-bdbb-4c10-9e2a-ae10b129ffff.png)

