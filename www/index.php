<html lang="en">

<head>
<title>CS 143: Movie Review Website</title>

<link type='text/css' rel="stylesheet" href="style.css" />

<!-- Additional CSS for this page -->
<style type="text/css">

input[type=text], select {
    width: 80%;
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
    width: 600px;
    position: fixed;
    top: 35%;
    left: 25%;
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    
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
<input type="text" name = "search" placeholder="Search for actors or movies..">
<input type="submit" value ="search">
</form>
</div>

<div class="footer1">
<b>&copy; 2016 | Site Designed by <a href="https://sites.google.com/site/sodhanipranav" target="_blank">Pranav Sodhani</a></b>
</div>
</body>
</html>

<!--
<div class="footer1">
<b>&copy; 2016 | Site Designed by <span class="rrect"><a href="https://sites.google.com/site/sodhanipranav" target="_blank"><font color="red">Pranav Sodhani</font></a></span></b>
</div>
</body>
</html>
-->