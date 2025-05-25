<?php

header('Content-Type: application/json');

// $mahasiswa = [
//     [
//     "nama" => "Frizy",
//     "nim" => "2217020078",
//     "email" => "frizyoktario2003@gmail.com"
//     ],
//     [
//     "nama" => "Endra",
//     "nim" => "2217020078",
//     "email" => "endra@gmail.com"
//     ],
// ];

$dbh = new PDO('mysql:host=localhost;dbname=pendaftaran_magang','root','');

$db = $dbh->prepare('SELECT * FROM users ');
$db->execute();
$mahasiswa = $db->fetchAll(PDO::FETCH_ASSOC);


$data = json_encode($mahasiswa);
echo $data;

?>