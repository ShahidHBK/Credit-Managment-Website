<!DOCTYPE html>
<?php
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'grip');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else
{
	/*echo "awesome<br>";*/
}

$query = "select * from transaction WHERE ID=(SELECT max(ID) FROM transaction)";
$result = mysqli_query($link,$query);
$i=0;
while ($rows=mysqli_fetch_row($result))
{
	$last_sender[$i]=$rows[1];
	$last_receiver[$i]=$rows[2];
	$last_credit[$i]=$rows[3];
	$i=$i+1;
}

$senderid = $_SESSION["sender_id"];
if(isset($_POST['transfer']))
{	
	$rec_transferid = $_SESSION["rec_id"];
	$credits = $_POST['credits'];
	$query = "UPDATE names SET Credits=Credits + $credits WHERE ID='$rec_transferid'";
	mysqli_query($link,$query);
	$query = "UPDATE names SET Credits=Credits - $credits WHERE ID='$senderid'";
	mysqli_query($link,$query);
	$rec = $_SESSION["rec_id"];
	$query = "select * from names where ID='$senderid'";
	$result = mysqli_query($link,$query);
	$i=0;
	while ($rows=mysqli_fetch_row($result))
    	{
		$from[$i]=$rows[1];
		$i=$i+1;
    	}

	$query = "select * from names where ID='$rec'";
	$result = mysqli_query($link,$query);
	$i=0;
	while ($rows=mysqli_fetch_row($result))
    	{
		$to[$i]=$rows[1];
		$i=$i+1;
    	}
	
	$sender_name = $from[0];
	$receiver_name = $to[0];
	$query = "INSERT INTO transaction(Sender,Receiver,Amount) VALUES('$sender_name','$receiver_name',$credits)";
	mysqli_query($link,$query);
	echo "<script>
		alert('Transfer was successful');
		window.location.href='All Transactions.php';
		</script>";
}
if(isset($_POST['submit_rec']))
{
	$_SESSION["rec_id"] = $_POST['receivers'];
	$recid = $_POST['receivers'];
	$query = "select * from names where ID='$senderid'";
	$result = mysqli_query($link,$query);
	$i=0;
	while ($row=mysqli_fetch_row($result))
    	{
		$sends[$i]=$row[1];
		$i=$i+1;
    	}

	$query = "select * from names where ID='$recid'";
	$result = mysqli_query($link,$query);
	$i=0;
	while ($row=mysqli_fetch_row($result))
    	{
		$recs[$i]=$row[1];
		$i=$i+1;
    	}	


	



}





?>

<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"  crossorigin="anonymous">
 <link rel="stylesheet" href="main.css">
<style>

</style>
</head>
<body>
<header class="site-header">
         <nav class="navbar navbar-expand-md navbar-dark bg-steel fixed-top">
             <div class="container">
                  <a class="navbar-brand mr-4" href="index.php">Credit Management</a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
               <div class="collapse navbar-collapse" id="navbarToggle">
                  <div class="navbar-nav mr-auto">
                       <a class="nav-item nav-link" href="index.php">Home</a>
                      <a class="nav-item nav-link" href="All Transactions">View All Transactions</a>
                  </div>
                   <div class="navbar-nav">
                    <a class="nav-item nav-link" href="All users.php">View All Users</a>
                   
                   </div>
               </div>
             </div>
         </nav>
    </header>
<main role="main" class="container">

  <div class="row">
	<div class="col-md-8">
	<font size=7>Enter Credit Value</font>
	<br>
	<font size=6>
	Sender : <?php echo $sends[0];?><br>
	Recipient : <?php echo $recs[0];?><br>
	</font>
	<br>
	<form method="post" name="credit" action="#" class="form-inline">
		<font size=4>Enter No of credits to transfer</font>
		<div class="form-group mx-sm-2 mb-1">
			
			<label for="credits" class="sr-only">Password</label>


			<input type="number" class="form-control" id="credits" name="credits" min="10" max="50">

		</div>
		<input type="submit" name="transfer" value="Transfer" class="btn btn-primary mb-2">
		</form>

	</form>
	</div>




<div class="col-md-4">

      <div class="content-section">

        <h3>Our Sidebar</h3>

        <p class='text-muted'>You can put any information here you'd like.

          <ul class="list-group">

            <li class="list-group-item list-group-item-light">From : <?php echo $last_sender[0]; ?></li>

            <li class="list-group-item list-group-item-light">To : <?php echo $last_receiver[0]; ?></li>

            <li class="list-group-item list-group-item-light">Amount : <?php echo $last_credit[0]; ?></li>

          </ul>

        </p>

      </div>

    </div>
</div>
</main>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"  crossorigin="anonymous"></script>
</body>
</html>