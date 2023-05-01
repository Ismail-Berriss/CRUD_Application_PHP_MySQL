<?php

$servername = 'localhost';
$username = 'root';
$password = "";
$database = "tp_php1";

/* Create connection */
$conn = new mysqli($servername, $username, $password, $database);

/* Check connection */
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//    echo "Connected successfully";

/* Create database */

//    $sql = "create database tp_php1";
//    if($conn->query($sql) === TRUE) {
//        echo "<br>Database created successfully";
//    } else {
//        echo "<br>Error creating database: " . $conn->error;
//    }

/* Create table */

//    $sql = "create table user (
//            id int auto_increment primary key,
//            nom varchar(30),
//            prenom varchar(30),
//            email varchar(100),
//            tel int
//            );";
//
//    if($conn->query($sql) === TRUE) {
//        echo "<br>Table user created successfully";
//    } else {
//        echo "<br>Error creating table: " .$conn->error;
//    }

/* Inserting data */

//    $sql = "insert into user (nom, prenom, email, tel) values ('BERRISS', 'Ismail', 'berriss.contact@gmail.com', '0657090441');";
//    $sql .= "insert into user (nom, prenom, email, tel) values ('CHHOU', 'Anass', 'anasschhou@gmail.com', '0607177214');";
//    $sql .= "insert into user (nom, prenom, email, tel) values ('STIOUI', 'Karam', 'karamstioui@gmail.com', '0669183295');";
//    $sql .= "insert into user (nom, prenom, email, tel) values ('HFOUD', 'Maryam', 'anasschhou@gmail.com', '0772244951');";
//
//    if ($conn->multi_query($sql) === TRUE) {
//        echo "<br>New records created successfully";
//    } else {
//        echo "<br>Error: " . $sql ."<br>" . $conn->error;
//    }

?>