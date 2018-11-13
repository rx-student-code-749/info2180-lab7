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

$default_response = "<div><h3>No Countries Found!</h3></div>";

if (array_key_exists('all', $_GET)) {
    if ($_GET['all'] == true) {
        $stmt = $conn->query("SELECT * FROM countries");

        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $html = '<ul>';
        foreach ($results as $row)
            $html .= '<li>' . $row['name'] . ' is ruled by ' . $row['head_of_state'] . '</li>';
        $html .= '</ul>';

        echo $html;
    } else echo $default_response;
} else if (array_key_exists('country', $_GET)) {
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%{$_GET['country']}%'");
//    $_GET['q'] = ucwords($_GET['q']);

    $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    $html = '<ul>';
    foreach ($results as $row) {
        $tmp = "<li>{$row['name']} is ruled by {$row['head_of_state']}</li>";
        $html .= preg_replace("/\w*?" . preg_quote($_GET['country']) . "\w*/i", "<strong>$0</strong>", $tmp);
    }
    $html .= '</ul>';
    echo $html;
} else echo $default_response;
