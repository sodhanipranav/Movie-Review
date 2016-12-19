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
<li><a href="addmovieactor.php"><nav><b>Add Movie-Actor</b></nav></a></li>
<li><a href="addmoviedirector.php"><nav><b>Add Movie-Director</b></nav></a></li>
<li><a href="addreview.php"><navi><b>Add Reviews</b></navi></a></li>
</ul>

<div id="wrapme">
<div class="part">
<div class="content">
<center><b>How do I enter the data?</b></br></center>
<p>
1. Please enter your name (max 100 letters).<br><br>
2. Enter the title of the movie which is being reviewed.</br><br>
3. Enter how much would you rate the movie on a scale of 0-5.</br><br>
4. Enter comments, if any (max 500 characters).<br>
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
if (empty($_GET["name"])) $check = 0;
if($check==1){
$name = mysqli_real_escape_string($db_connection, $_GET["name"]);
$title = mysqli_real_escape_string($db_connection, $_GET["title"]);
$rating = mysqli_real_escape_string($db_connection, $_GET["rating"]);
$comment = mysqli_real_escape_string($db_connection, $_GET["comment"]);
$mquery = "SELECT id FROM Movie WHERE title='$title'";
$mresult = mysqli_query($db_connection, $mquery);
$minfo = mysqli_fetch_row($mresult);
$mid = $minfo[0];

$query = "INSERT INTO Review VALUES('$name', Now(), '$mid', '$rating', '$comment')";
        
if ($db_connection->query($query) === TRUE) {
    echo "Review Acknowledged.";
    
} else {
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
<form action="addreview.php" method="GET">
            Reviewer Name: <input type="text" name="name" maxlength="20" placeholder="eg. Pranav" required><br/>     
            Movie Title:  <input type="text" name="title" maxlength="100" placeholder="eg. The Dark Knight" required><br/>
            Rating:  <input type="text" name="rating" placeholder="eg. 5" required><br/>
            Comment:  <input type="text" name="comment" maxlength="500" height="100" placeholder="eg. Excellent Movie. Must Watch."><br/>
            <input type="submit" value="Add"/>
</form>

</div>
</div>
</div>

</body>
</html>