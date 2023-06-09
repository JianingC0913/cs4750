<?php
require("connect-db.php");
// include("connect-db.php);

require("friend-db.php");

$friends = selectAllFriends();
//var_dump($friends);   //display the data

$friend_info_to_update = null;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
     if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Update"))
     {
      $friend_info_to_update = getFriendByName($_POST['friend_to_update']);
      var_dump($friend_info_to_update);

     }
     else if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Add friend"))
     {
         addFriend($_POST['name'], $_POST['major'], $_POST['year']);
         $friends = selectAllFriends();
     }

     else if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Delete"))
     {
         deleteFriend($_POST['friend_to_delete']);
         $friends = selectAllFriends();
     }

     if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Confirm update"))
     {
      updateFriend($_POST['name'], $_POST['major'], $_POST['year']);
      $friends = selectAllFriends();

     }
}
?>

<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 
  Bootstrap is designed to be responsive to mobile.
  Mobile-first styles are part of the core framework.
   
  width=device-width sets the width of the page to follow the screen-width
  initial-scale=1 sets the initial zoom level when the page is first loaded   
  -->
  
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  
    
  <title>Bootstrap example</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
  <!-- if you choose to download bootstrap and host it locally -->
  <!-- <link rel="stylesheet" href="path-to-your-file/bootstrap.min.css" /> --> 
  
  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  -->
       
</head>

<body>
<div class="container">
  <h1>Friend Book</h1>  
    <form name="mainForm" action="simpleform.php" method="post">   <!--method:what kind of instruction we going to use, action: where send the input to -->
        <div class="row mb-3 mx-3">
            Name:
            <input type="text" class="form-control" name="name" required 
                    value="<?php if ($friend_info_to_update!=null) echo $friend_info_to_update['name']; ?>"
            />        
        </div>  
        <div class="row mb-3 mx-3">
            Major:
            <input type="text" class="form-control" name="major" required 
            value="<?php if ($friend_info_to_update!=null) echo $friend_info_to_update['major']; ?>"
            />        
        </div> 
        <div class="row mb-3 mx-3">
            Year:
            <input type="text" class="form-control" name="year" required 
            value="<?php if ($friend_info_to_update!=null) echo $friend_info_to_update['year']; ?>"
            />        
        </div>  
        <div class="row mb-3 mx-3">
            <input type="submit" class="btn btn-primary" name="actionBtn" value="Add friend" title="click to insert friend" />
        </div>  
        <div class="row mb-3 mx-3">
            <input type="submit" class="btn btn-dark" name="actionBtn" value="Confirm update" title="click to confirm update" />
        </div>  
    </form>     


    <div class="row justify-content-center">  
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
          <thead>
          <tr style="background-color:#B0B0B0">
            <th>Name</th>
            <th>Major</th>
            <th>Year</th>
            <th>Update?</th>
            <th>Delete?</th>
          </tr>
          </thead>
        <?php foreach ($friends as $item): ?>
          <tr>
            <td><?php echo $item['name']; ?></td>
            <td><?php echo $item['major']; ?></td>        
            <td><?php echo $item['year']; ?></td>   
            <td>
              <form action="simpleform.php" method="post">
                <input type="submit" name="actionBtn" value="Update" class="btn btn-dark"/>
                <input type="hidden" name="friend_to_update" 
                       value="<?php echo $item['name']; ?>"
                       />
              <form>
            </td>

            <td>
              <form action="simpleform.php" method="post">
                <input type="submit" name="actionBtn" value="Delete" class="btn btn-dark"/>
                <input type="hidden" name="friend_to_delete" 
                       value="<?php echo $item['name']; ?>"
                       />
              <form>
            </td>

          </tr>
        <?php endforeach; ?>
        </table>
    </div>   

  <a href="simpleform.php">Click to open the next page</a>

  <!-- CDN for JS bootstrap -->
  <!-- you may also use JS bootstrap to make the page dynamic -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
  
  <!-- for local -->
  <!-- <script src="your-js-file.js"></script> -->  
  
</div>    
</body>
</html>