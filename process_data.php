<?php
require_once 'db.connection.php';

if(isset($_POST["submit"])){
$data = array();
$condition = preg_replace('/[^A-Za-z0-9\- ]/', '', $_POST["query"]);
$query = "SELECT progressNumber FROM crimes WHERE progressNumber LIKE '%".$condition."%' ORDER BY crimeId DESC LIMIT 10";
$result = $connector->query($query);
$replace_string = '<b>'.$condition.'</b>';
foreach($result as $row){
    $data[] = array(
        'progressNumber' => str_ireplace($condition, $replace_string, $row["progressNumber"])
    );
}
echo json_encode($data);
}

$connector->close();