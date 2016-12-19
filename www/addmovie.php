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
<li><a href="addmovie.php"><navi><b>Add Movie</b></navi></a></li>
<li><a href="addmovieactor.php"><nav><b>Add Movie-Actor</b></nav></a></li>
<li><a href="addmoviedirector.php"><nav><b>Add Movie-Director</b></nav></a></li>
<li><a href="addreview.php"><nav><b>Add Reviews</b></nav></a></li>
</ul>
<div id="wrapme">
<div class="part">
<div class="content">
<center><b>How do I enter the data?</b></br></center>
<p>
1. Enter the title of the movie (max 100 letters).<br><br>
2. Enter the year in which the movie was released (4 digits) </br><br>
3. Enter the rating received by the movie (MPAA Rating).</br><br>
4. Enter the name of the production company (max 50 characters).<br><br>
5. Choose the genres the movie belongs to.
</p>
<p>
<b><center>Message</center></b><br>
<?php
$check=0;
$db_connection = mysqli_connect('localhost', 'cs143', '', 'CS143');
if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  if (isset($_GET["title"]) and isset($_GET["year"]) and isset($_GET["rating"]) and isset($_GET["company"])) $check = 1;
if($check==1){
$title = mysqli_real_escape_string($db_connection, $_GET["title"]);
$year = mysqli_real_escape_string($db_connection, $_GET["year"]);
$rating = mysqli_real_escape_string($db_connection, $_GET["rating"]);
$company = mysqli_real_escape_string($db_connection, $_GET["company"]);
$genre = $_GET["genre"];
$maxidquery = "SELECT id FROM MaxMovieID";
$result = mysqli_query($db_connection, $maxidquery);
$fieldinfo = mysqli_fetch_row($result);
$pid = $fieldinfo[0] + 1;
$query = "INSERT INTO Movie VALUES('$pid', '$title', '$year', '$rating', '$company')";
            
if ($db_connection->query($query) === TRUE) {
    echo "Movie Added Successfully! <br>";
    $updatemaxID = "UPDATE MaxMovieID SET id = $pid";
    $db_connection->query($updatemaxID);
} else {
    echo "Error: " . $query . "<br>" . $db_connection->error;
}
foreach ($genre as $temp){
$gquery = "INSERT INTO MovieGenre VALUES($pid, '$temp')";
if ($db_connection->query($gquery) === TRUE) {
    echo "Genre Added Successfully! <br>";
} else {
    echo "Error: " . $gquery . "<br>" . $db_connection->error;
}}
}
$db_connection->close();
?> 
</p>
</div>
</div>
<div class="part">
<div id="sbar">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
            Title: <input type="text" name="title" maxlength="100" placeholder="eg. Batman Returns Whenever I wish to Study" required><br/>
            Year:  <input type="text" name="year" placeholder="eg. 2016" required><br/>                               
            Company:  <input type="text" name="company" maxlength="50" placeholder="eg. Disney" required><br/>
            MPAA Rating:
             <select   name="rating">
                        <option value="G">G</option>
                        <option value="NC-17">NC-17</option>
                        <option value="PG">PG</option>
                        <option value="PG-13">PG-13</option>
                        <option value="R">R</option>
                        <option value="surrendere">surrendere</option>
                    </select>      
            Genre:
            <input type="checkbox" name="genre[]" value="Action">Action</input>
                    <input type="checkbox" name="genre[]" value="Adult">Adult</input>
                    <input type="checkbox" name="genre[]" value="Adventure">Adventure</input>
                    <input type="checkbox" name="genre[]" value="Animation">Animation</input>
                    <input type="checkbox" name="genre[]" value="Comedy">Comedy</input>
                    <input type="checkbox" name="genre[]" value="Crime">Crime</input>
                    <input type="checkbox" name="genre[]" value="Documentary">Documentary</input>
                    <input type="checkbox" name="genre[]" value="Drama">Drama</input>
                    <input type="checkbox" name="genre[]" value="Family">Family</input>
                    <input type="checkbox" name="genre[]" value="Fantasy">Fantasy</input>
                    <input type="checkbox" name="genre[]" value="Horror">Horror</input>
                    <input type="checkbox" name="genre[]" value="Musical">Musical</input>
                    <input type="checkbox" name="genre[]" value="Mystery">Mystery</input>
                    <input type="checkbox" name="genre[]" value="Romance">Romance</input>
                    <input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi</input>
                    <input type="checkbox" name="genre[]" value="Short">Short</input>
                    <input type="checkbox" name="genre[]" value="Thriller">Thriller</input>
                    <input type="checkbox" name="genre[]" value="War">War</input>
                    <input type="checkbox" name="genre[]" value="Western">Western</input>
    
    
<br><br>
<input type="submit" value="Add"/><br/>

</form>
</div>
</div>
</div>
</body>
</html>