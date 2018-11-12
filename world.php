<?php use RedBeanPHP\R;
if (!array_key_exists('C9_USER', $_ENV)) {
     require_once __DIR__ . "/app/inc.php";
     $conn = R::getPDO();
} else {
    $host = getenv('IP');
    $username = getenv('C9_USER');
    $password = '';
    $dbname = 'world';

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
}

$stmt = $conn->query("SELECT * FROM countries");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<ul>';
foreach ($results as $row) {
  echo '<li>' . $row['name'] . ' is ruled by ' . $row['head_of_state'] . '</li>';
}
echo '</ul>';
