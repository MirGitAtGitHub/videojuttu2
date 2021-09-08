<?php

    // Luodaan yhteys tietokantaan
    $link = mysqli_connect("localhost", "root", "", "video");
 
    // Tarkistetaan toimiiko yhteys
    if($link === false){
        die("ERROR: Co. " . mysqli_connect_error());
    }