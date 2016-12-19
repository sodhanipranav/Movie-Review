<!doctype html>
<html lang="en">
<!--                                     START OF HEAD SECTION                                                        -->

<head>
	<title>Movie Review</title>

<!-- ALL FONTS HERE -->

<!-- <link href='http://fonts.googleapis.com/css?family=Cherry+Swash' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Stardos+Stencil:700' rel='stylesheet' type='text/css'>
-->

<!-- ALL CSS HERE -->

<link type='text/css' rel="stylesheet" href="style.css" />

<style type="text/css">

input[type=text], select {
    width: 100%;
    padding: 12px 10px;
    margin: 8px 0;
    display: inline-block;
    /*background-image: url('images/searchicon.png');
background-position: 2px 2px;
    background-repeat: no-repeat;
padding: 12px 20px 12px 40px;*/
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
<!--                                             END OF HEAD SECTION                                        -->

<body>
<ul>
<li><a href="index.php"><nav><b>Home</b></nav></a></li>
<li><a href="addreview.php"><nav><b>Add Reviews</b></nav></a></li>
<li><a href="addactor.php"><navi><b>Add Actor / Director</b></navi></a></li>
<li><a href="addmovie.php"><nav><per><b>Add Movie</b></per></nav></a></li>
<li><a href="addmovieactor.php"><nav><b>Add Movie/Actor Relation</b></nav></a></li>
<li><a href="addmoviedirector.php"><nav><b>Add Movie/Director Relation</b></nav></a></li>

</ul>

<div id="wrapme">
<div class="part">
<div class="content">
<center><b>How do I enter the data?</b></br></center>
<p>
0. Choose Actor or Director. <br><br>
1. Enter First Name of the Person (Include middle name, if any).<br><br>
2. Enter Last Name of the Person. </br><br>
3. Choose the gender - Male or Female.</br><br>
4. Enter date of birth in the format: yyyy-mm-dd.<br><br>
5. Enter date of death (if dead) in the format: yyyy-mm-dd else leave blank. <br><br>
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
  if (isset($_GET["identity"]) and isset($_GET["first"]) and isset($_GET["last"]) and isset($_GET["sex"]) and isset($_GET["dob"])) $check = 1;
if($check==1){
$identity = $_GET["identity"];
$first = mysqli_real_escape_string($db_connection, $_GET["first"]);
$last = mysqli_real_escape_string($db_connection, $_GET["last"]);
$sex = $_GET["sex"];
$dob = $_GET["dob"];
$dod = $_GET["dod"];
$maxidquery = "SELECT id FROM MaxPersonID";
	$result = mysqli_query($db_connection, $maxidquery);
	$fieldinfo = mysqli_fetch_row($result);
	$pid = $fieldinfo[0] + 1;
//echo $pid;

if($identity=="Actor")
{
	if(empty($_GET["dod"]))
		{
$query = "INSERT INTO Actor VALUES('$pid', '$last', '$first', '$sex', '$dob', NULL)";
		}
	else
	{
$query = "INSERT INTO Actor VALUES('$pid', '$last', '$first', '$sex', '$dob', '$dod')";
	}
}
else
{
	if(empty($_GET["dod"]))
		{
			$query = "INSERT INTO Director VALUES('$pid', '$last', '$first', '$dob', NULL)";
		}
		else
		{
			$query = "INSERT INTO Director VALUES('$pid', '$last', '$first', '$dob', '$dod')";
		}
}

if ($db_connection->query($query) === TRUE) {

    echo "$identity Added Successfully!";
    $updatemaxID = "UPDATE MaxPersonID SET id = $pid";
	$db_connection->query($updatemaxID);
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
<form action="addActor.php" method="GET">
			Identity:	<input type="radio" name="identity" value="Actor" checked="true">Actor
						<input type="radio" name="identity" value="Director">Director<br/>
			<br/>
			First Name:	<input type="text" name="first" maxlength="20" required><br/>
			Last Name:	<input type="text" name="last" maxlength="20" required><br/>
			Sex:		<input type="radio" name="sex" value="Male" checked="true">Male
						<input type="radio" name="sex" value="Female">Female<br/><br/>
						
			Date of Birth:	<input type="text" name="dob" required><br/>
			Date of Death:	<input type="text" name="dod"><br/>
			<input type="submit" value="Add"/>
		</form>

</div>
</div>

</div><!-- end of wrapme -->

</body>
</html>