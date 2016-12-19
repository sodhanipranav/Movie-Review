<html lang="en">

<head><title>CS 143: Movie Review Website</title>
<link type='text/css' rel="stylesheet" href="style.css" />
<style type="text/css">
input[type=text], select {
    width: 100%;
    padding: 12px 10px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 10px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}
#sbar {
    margin-top: 20px;
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}
</style>
</head>

<body>
<ul>
<li><a href="index.php"><nav><b>Home</b></nav></a></li>
<li><a href="showactor.php"><nav><b>Actor Info</b></nav></a></li>
<li><a href="showmovie.php"><nav><b>Movie Info</b></nav></a></li>
<li><a href="addactor.php"><nav><b>Add Actor/Director</b></nav></a></li>
<li><a href="addmovie.php"><nav><b>Add Movie</b></nav></a></li>
<li><a href="addmovieactor.php"><navi><b>Add Movie-Actor</b></navi></a></li>
<li><a href="addmoviedirector.php"><nav><b>Add Movie-Director</b></nav></a></li>
<li><a href="addreview.php"><nav><b>Add Reviews</b></nav></a></li>
</ul>

<div id="wrapme">
<div class="part">
<div class="content">
<center><b>How do I enter the data?</b></br></center>
<p>
1. Enter the title of the movie (max 100 letters).<br><br>
2. Enter the first name of the actor. </br><br>
3. Enter the last name of the actor. </br><br>
4. Enter the role played by the actor.</br>
</p>
<p>
<b><center>Message</center></b><br>
<?php
$check=1;
$db_connection = mysqli_connect('localhost', 'cs143', '', 'CS143');
if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  if (empty($_GET["title"])) $check = 0;
if($check==1){
$title = mysqli_real_escape_string($db_connection, $_GET["title"]);
$first = mysqli_real_escape_string($db_connection, $_GET["first"]);
$last = mysqli_real_escape_string($db_connection, $_GET["last"]);
$role = mysqli_real_escape_string($db_connection, $_GET["role"]);

$mquery = "SELECT id FROM Movie WHERE title='$title'";
$mresult = mysqli_query($db_connection, $mquery);
$minfo = mysqli_fetch_row($mresult);
$mid = $minfo[0];

$aquery = "SELECT id FROM Actor WHERE first='$first' AND last='$last'";
$aresult = mysqli_query($db_connection, $aquery);
$ainfo = mysqli_fetch_row($aresult);
$aid = $ainfo[0];

$query = "INSERT INTO MovieActor VALUES('$mid', '$aid', '$role')";
        
if ($db_connection->query($query) === TRUE) {
    echo "Movie-Actor Added Successfully!";
    } 
else {
    echo "Error: " . $query . "<br>" . $db_connection->error;
}
}
$db_connection->close();
?> 
</p>
</div>

</div>

<div class="part">
<div id="sbar">
<form action="addmovieactor.php" method="GET">
            Movie Title: <input type="text" name="title" maxlength="100" placeholder="eg. Tomorrow Never Comes" required><br/>
            Actor First Name:  <input type="text" name="first" placeholder="eg. Pranav" required><br/>                     
            Actor Last Name:  <input type="text" name="last" placeholder="eg. Sodhani" required><br/>
            Role  <input type="text" name="role" maxlength="50" placeholder="eg. Villain" required><br/>
            <input type="submit" value="Add"/>
</form>

</div>
</div>
</div>

</body>
</html>