<!DOCTYPE html>
<html>
    <head>
        <title>Database object test</title>
    </head>
    <body>
        <div>
            <p>
                <?php
                    include_once 'Database.php';
                    $Database = new Database('localhost:3306', 'root', '', 'testDB', 'PDO');
                    echo $Database->status();
                ?>
            </p>
        </div>
    </body>
</html>