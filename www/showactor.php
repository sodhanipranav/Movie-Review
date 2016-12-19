<html lang="en">
<head><title>CS 143: Movie Review Website</title>

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
<li><a href="showactor.php"><navi><b>Actor Info</b></navi></a></li>
<li><a href="showmovie.php"><nav><b>Movie Info</b></nav></a></li>
<li><a href="addactor.php"><nav><b>Add Actor/Director</b></nav></a></li>
<li><a href="addmovie.php"><nav><b>Add Movie</b></nav></a></li>
<li><a href="addmovieactor.php"><nav><b>Add Movie-Actor</b></nav></a></li>
<li><a href="addmoviedirector.php"><nav><b>Add Movie-Director</b></nav></a></li>
<li><a href="addreview.php"><nav><b>Add Reviews</b></nav></a></li>
</ul>

<div id="sbar">
<form action="search.php" method="GET">
<input type="text" name = "search" placeholder="Search for actors..">
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

    if ($_GET['id']) $ID = $_GET['id'];
    else $ID = 15000;
    
    $actorquery = "SELECT first, last, sex, dob, dod FROM Actor WHERE id = $ID";
    $getactorinfo = mysqli_query($db_connection, $actorquery);

    $moviequery = "SELECT Movie.title, MovieActor.role, Movie.id, Movie.rating FROM MovieActor, Movie WHERE MovieActor.aid = $ID AND Movie.id = MovieActor.mid";
    $getmovieinfo = mysqli_query($db_connection, $moviequery);
    $count = mysqli_num_rows($getmovieinfo);
    if($count>1) $mov="movies";
    else $mov="movie";

    if ($getactorinfo && mysqli_num_rows($getactorinfo) >=1) 
    {
        $actor = mysqli_fetch_row($getactorinfo);
        echo "<h2>$actor[0] $actor[1]</h2>";
        if($actor[2]==='Male') 
            {
                $address = "He";
            }
        else 
            {
                $address = "She";
            }

        $dob = date("M d, Y", strtotime($actor[3]));
        echo "Born on $dob, $actor[0] has starred in $count $mov.";
        if ($actor[4])
        {
            $dod = date("M d, Y", strtotime($actor[4]));
            $dob = date("M d, Y", strtotime($actor[3]));
            $diff=date_diff($date1,$date2);
            $age=$diff->format("%Y years");
            echo " $address died on $dod at an age of: </b> $age<br/>";
        }
        else
        {
            $date1=date_create("$actor[3]");
            $pdate=date_create(date());
            $diff=date_diff($date1,$pdate);
            $age=$diff->format("%Y years");
            echo " $address is $age old.";
        }
    } 
    
    /* Displaying Role of Every Actor Here.*/

    
    if ($getmovieinfo && mysqli_num_rows($getmovieinfo) >=1) 
    {
        echo "<h3>Roles Played: <br></h3>";
        while ($movie = mysqli_fetch_row($getmovieinfo))
        {    
            echo "\"$movie[1]\" in the movie <a href = './showmovie.php?id=$movie[2]'> $movie[0]</a> </br>";
        }   
    } 

$db_connection->close();
?>
</p>
</div>

</body>
</html>