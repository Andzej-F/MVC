<?php
require_once 'Paginator.php';

// $conn       = new mysqli('127.0.0.1', 'root', 'root', 'world');
/* Host name of the MySQL server */
$host = 'localhost';

/* MySQL account username */
$user = 'root';

/* MySQL account password */
$passwd = '';

/* The schema you want to use */
$schema = 'lbm2';

/* The PDO object */
$pdo = NULL;

/* Connection string, or "data source name" */
$dsn = 'mysql:host=' . $host . ';dbname=' . $schema;

/* Connection inside a try/catch block */
try {
    /* PDO object creation */
    $conn = new PDO($dsn, $user,  $passwd);

    /* Enable exceptions on errors */
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    /* If there is an error an exception is thrown */
    echo 'Database connection failed.';
    exit();
}

$limit      = (isset($_GET['limit'])) ? $_GET['limit'] : 5;
$page       = (isset($_GET['page'])) ? $_GET['page'] : 1;
$links      = (isset($_GET['links'])) ? $_GET['links'] : 2;
$query      = 'SELECT * FROM `city` WHERE 1';

$Paginator  = new Paginator($conn, $query);

$results    = $Paginator->getData($limit, $page);
?>

<!DOCTYPE html>

<head>
    <title>PHP Pagination</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <h1>PHP Pagination</h1>
            <table class="table table-striped table-condensed table-bordered table-rounded">
                <thead>
                    <tr>
                        <th>City</th>
                        <th width="20%">Country</th>
                        <th width="20%">Continent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($results->data); $i++) : ?>
                        <tr>
                            <td><?php echo $results->data[$i]['Name']; ?></td>
                            <td><?php echo $results->data[$i]['CountryCode']; ?></td>
                            <td><?php echo $results->data[$i]['District']; ?></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
            <?php echo $Paginator->createLinks($links, 'pagination pagination-sm'); ?>
            </ul>
        </div>
    </div>
</body>

</html>