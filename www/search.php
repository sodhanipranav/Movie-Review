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

input[type=submit] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
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
<li><a href="index.php"><navi><b>Home</b></navi></a></li>
<li><a href="showactor.php"><nav><b>Actor Info</b></nav></a></li>
<li><a href="showmovie.php"><nav><b>Movie Info</b></nav></a></li>
<li><a href="addactor.php"><nav><b>Add Actor/Director</b></nav></a></li>
<li><a href="addmovie.php"><nav><b>Add Movie</b></nav></a></li>
<li><a href="addmovieactor.php"><nav><b>Add Movie-Actor</b></nav></a></li>
<li><a href="addmoviedirector.php"><nav><b>Add Movie-Director</b></nav></a></li>
<li><a href="addreview.php"><nav><b>Add Reviews</b></nav></a></li>
</ul>

<div id="sbar">
<form action="search.php" method="GET">
<input type="text" name = "search" placeholder="Search for actors or movies ..">
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
  
$check = 1;
if(empty($_GET["search"])) $check=0;
if ($check==1) {
    $search = mysqli_real_escape_string($db_connection, $_GET["search"]);    
    echo "<h4>Matching Actors Found:</h4>";
    $pieces = explode(" ", $search);
    $num = count($pieces);
    /*echo $num; */
    if($num == 2) {$actorquery = "SELECT id, first, last, dob FROM Actor WHERE (first like'%$pieces[0]%' AND last like '%$pieces[1]%') ORDER BY first, last";}
    else {$actorquery = "SELECT id, first, last, dob FROM Actor WHERE (first like '%$search%' OR last like '%$search%') ORDER BY first, last";}
    $getactor = mysqli_query($db_connection, $actorquery);
    if ($getactor && mysqli_num_rows($getactor)>=1)
    {
        echo mysqli_num_rows($getactor). " Matching Actors Found.<br><br>";
        while ($row = mysqli_fetch_row($getactor))
       {
            $dob = date("M d, Y", strtotime($row[3]));
            echo "<a href = './showactor.php?id=$row[0]'> $row[1] $row[2]</a> ($dob) <br/>";
       }
    }
    else if(mysqli_num_rows($getactor)<1)
    {
    $actorquery = "SELECT id, first, last, dob FROM Actor WHERE (first like'%$search%' OR last like'%$search%') ORDER BY first, last";
    $getactor = mysqli_query($db_connection, $actorquery);
    if ($getactor && mysqli_num_rows($getactor)>=1)
    {
        echo mysqli_num_rows($getactor). " Matching Actors Found.<br><br>";

       while ($row = mysqli_fetch_row($getactor))
       {
            $dob = date("M d, Y", strtotime($row[3]));
            echo "<a href = './showactor.php?id=$row[0]'> $row[1] $row[2]</a> ($dob) <br/>";
       }
    }
    else echo "No Matching Actors Found. <br/>";
    }

    echo "<h4>Matching Movies Found: </h4>";
    /*$search = ucwords($search); */
    $moviequery = "SELECT id, title, year FROM Movie WHERE title like '%$search%' ORDER BY title";
    $getmovie = mysqli_query($db_connection, $moviequery);
    if ($getmovie && mysqli_num_rows($getmovie)>=1)
    {
        echo mysqli_num_rows($getmovie). " Movies Found<br>";
        while ($row = mysqli_fetch_row($getmovie))
        {
            $year = date("M d, Y", strtotime($row[2]));
            echo "<a href = './showmovie.php?id=$row[0]'> $row[1]</a>  ($year) <br/>";
        }
    }
    else echo "No Movies Found";
}
$db_connection->close();
?>
</p>
</div>

</body>
</html>