<?php

function retrieveSongByName($title){
    global $db;
    $query = "select * from Song where title=:title";
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->execute();
    $result = $statement->fetchAll();
    //close cursor
    $statement->closeCursor();    
    return $result;

}

function retrieveSongByArtist($artistName){
    global $db;
    $query = "select * from Song natural join Artist where Artist.name=:artistName";
    $statement = $db->prepare($query);
    $statement->bindValue(':artistName', $artistName);
    $statement->execute();
    $result = $statement->fetchAll();
    //close cursor
    $statement->closeCursor();    
    return $result;

}
?>