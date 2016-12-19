<html lang="en">
<head>
	<title>CS 143: Movie Review Website</title>

<link type='text/css' rel="stylesheet" href="style.css" />
<style type="text/css">
input[type=text], select {
    width: 60%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    background-image: url('images/searchicon.png');
    background-position: 2px 2px;
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] 
{
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover 
{
    background-color: #45a049;
}

#sbar {
	width: 400px;
    position: relative;
    /*top: 30%;*/
    /*margin: -100px 0 0 -150px;*/
    margin-top: 80px;
    margin-bottom: -150px;
    margin-left:50px;
    border-radius: 5px;
    background-color: #ffffff;
    padding: 0px;
}

</style>
</head>

<body>
<ul>
<li><a href="index.php"><nav><b>Home</b></nav></a></li>
<li><a href="showactor.php"><nav><b>Actor Info</b></nav></a></li>
<li><a href="showmovie.php"><navi><b>Movie Info</b></navi></a></li>
<li><a href="addactor.php"><nav><b>Add Actor/Director</b></nav></a></li>
<li><a href="addmovie.php"><nav><b>Add Movie</b></nav></a></li>
<li><a href="addmovieactor.php"><nav><b>Add Movie-Actor</b></nav></a></li>
<li><a href="addmoviedirector.php"><nav><b>Add Movie-Director</b></nav></a></li>
<li><a href="addreview.php"><nav><b>Add Reviews</b></nav></a></li>
</ul>

<div id="sbar">
<form action="search.php" method="GET">
<input type="text" name = "search" placeholder="Search for movies..">
<input type="submit" value ="search">
</form>
</div>

<div class="content_main">
<center><h3>Search Results</h3></center>
<p>
<?php
$db_connection = mysqli_connect('localhost', 'cs143', '', 'CS143');
if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if ($_GET['id']) $movID = $_GET['id'];
    else $movID = 1950;
    
    $moviequery = "SELECT * FROM Movie WHERE id = $movID";
    $movieinfo = mysqli_query($db_connection, $moviequery);
    if ($movieinfo && mysqli_num_rows($movieinfo) > 0) 
    {
        $movie = mysqli_fetch_row($movieinfo);
        echo "<h2>$movie[1]</h2>";
        echo "Released in the year $movie[2], the movie titled ''<b>$movie[1]</b>'' recieved an MPAA rating of $movie[3].";
    }
    $mdquery = "SELECT Director.* FROM Director, MovieDirector WHERE MovieDirector.did = Director.id AND MovieDirector.mid = $movID";
    $mdinfo = mysqli_query( $db_connection, $mdquery);
    if ($mdinfo && mysqli_num_rows($mdinfo) > 0) {
        echo " It was directed by ";
        $count = 0;
        while ($director = mysqli_fetch_row($mdinfo)){
            if ($count >0) echo ", ";
            echo "<b>$director[2] $director[1]</b>";
            $dob = date("M d, Y", strtotime($director[3]));
            echo " (".$dob;
            if ($director[4])
            {
                $dod = date("M d, Y", strtotime($director[4]));
                echo "-$dod).";
            }
            else 
            {
                $date1=date_create("$director[3]");
                $date2=date_create(date());
                $diff=date_diff($date1,$date2);
                $age=$diff->format("%Y years");
                echo ", Age: ".$age.").";
            }
            $count = $count+1;
        }
    }
    $mgquery = "SELECT * FROM MovieGenre WHERE mid = $movID";
    $mginfo = mysqli_query($db_connection, $mgquery);
    if ($mginfo && mysqli_num_rows($mginfo) > 0) 
    {
        echo " It falls in the Genre - ";
        $count = 0;
        while ($genre = mysqli_fetch_row($mginfo))
        {
            if ($count >0) echo ", ";
            echo "<b>$genre[1] </b>";
            $count = $count+1;          
        }
    }
    $movieratingquery = "SELECT AVG(rating) as AvgRating FROM Review WHERE mid = $movID HAVING AvgRating>0";
    $movieratinginfo = mysqli_query($db_connection, $movieratingquery); 
    
    if ($movieratinginfo && mysqli_num_rows($movieratinginfo) > 0) 
    {
        $rating = mysqli_fetch_row($movieratinginfo);
        $ans = round($rating[0],2);
        echo "<br><br><b>Average Rating: </b> $ans (out of 5)";
    }
    else    echo "<br><br>The movie has not received any rating so far.";
    $maquery = "SELECT Actor.*, MovieActor.role FROM Actor, MovieActor WHERE mid = $movID AND aid = Actor.id ORDER BY first, last";
    $mainfo = mysqli_query($db_connection, $maquery);
    
    if ($mainfo && mysqli_num_rows($mainfo) > 0) 
    {
        echo "<br>";
        echo "<br><b>Actors in the Movie </b></br><br>";
        while ($actor = mysqli_fetch_row($mainfo))
        {
            echo "<a href = './showactor.php?id=$actor[0]'> $actor[2] $actor[1]</a>";
            echo " as \"$actor[6]\" </br>";
        }
    }
    
    $mrquery = "SELECT * FROM Review WHERE mid = $movID";
    $mrinfo = mysqli_query($db_connection, $mrquery);
    
    echo "<br><a href = './addreview.php?id=$movID'> <u>Would you like to add a review?</u></a>";
    echo "<br><br>";
    echo "<b>Movie Reviews</b><br><br>"    ;
    if ($mrinfo && mysqli_num_rows($mrinfo)>0)
    {
        while($review = mysqli_fetch_row($mrinfo))
        {
            echo "[$review[1]]: $review[0] rated this movie <b>$review[3] stars</b> out of 5.<br>";
            echo "Comment: $review[4]<br><br>"; 
        }
    } 
    else { 
        echo "No one has reviewed the movie so far."; 
    }
$db_connection->close();
?>
</div>

</body>
</html>