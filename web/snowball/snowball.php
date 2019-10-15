<?php
$title = "Home";
$css = "snowball.css";
$javascript = "snowball.js";
include "header.php";
?>

<!-- Begin Page Content -->
<h2>BYU CS313</h2>
<div class="flexer">
    <div>
        <?php
        try
        {
            $dbUrl = getenv('DATABASE_URL');

            $dbOpts = parse_url($dbUrl);

            $dbHost = $dbOpts["host"];
            $dbPort = $dbOpts["port"];
            $dbUser = $dbOpts["user"];
            $dbPassword = $dbOpts["pass"];
            $dbName = ltrim($dbOpts["path"],'/');

            $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Successfully Connected!';

            foreach ($db->query('SELECT * FROM users') as $row)
            {
                echo 'user ID: ' . $row['user_id'];
                echo ' <br/> Name: ' . $row['first_name'] . ' ' . $row['last_name'];
                echo ' <br/> Additional Funds: $' . $row['addit_funds'];
                echo '<br/>';
            }
        }
        catch (PDOException $ex)
        {
            echo 'Error!: ' . $ex->getMessage();
            die();
        }
        ?>
    </div>
    <div>

    </div>

</div>
<!-- End Page Content -->

<?php
include "footer.php";
?>
