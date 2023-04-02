<?php

function addFriend($name, $major, $year)
{
     global $db;
    //  $query = "insert into friends values ($name, $major, $year)"
    //  $statement = $db->query($query);  //compile and execute

     $query = "insert into friends values (:name, :major, :year)";  // ":" is like a template, fill in the value
     $statement = $db->prepare($query);  //prepare the query and wait for input
     $statement->bindValue(':name', $name);  //bind the value of the first input(':xxxx') with the second input ($xxxx)
     $statement->bindValue(':major', $major);
     $statement->bindValue(':year', $year);
     $statement->execute();
     $statement->closeCursor();

}

function selectAllFriends()
{
          //db
          global $db;
          //query
          $query = "select * from friends";
          //prepare
          $statement = $db->prepare($query);
          //execute
          $statement->execute();
          //retrieve
          $results = $statement->fetchAll(); //fetch() will only retrieve the first row
          //close cursor
          $statement->closeCursor();
          //return result
          return $results;
}

function deleteFriend($friend_to_delete)
{
          //db
          global $db;
          //query
          $query = "delete from friends where name=:friend_to_delete";
          $statement = $db->prepare($query);
          $statement->bindValue(':friend_to_delete', $friend_to_delete);
          $statement->execute();
          //close cursor
          $statement->closeCursor();
}

function getFriendByName($name)
{
          global $db;
          //query
          $query = "select * from friends where name=:name";
          $statement = $db->prepare($query);
          $statement->bindValue(':name', $name);
          $statement->execute();
          $result = $statement->fetchAll();
          //close cursor
          $statement->closeCursor();    
          return $result;     

}

function updateFriend($name, $major, $year)
{
          global $db;
          //query
          $query = "update friends set major=:major, year=:year where name=:name";
          $statement = $db->prepare($query);
          $statement->bindValue(':name', $name);
          $statement->bindValue(':major', $major);
          $statement->bindValue(':year', $year);
          $statement->execute();
          //close cursor
          $statement->closeCursor();    

}
?>