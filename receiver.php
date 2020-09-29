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

$_SESSION["sender_id"] = -1;

if(isset($_POST['submit_sender']))
{
	$_SESSION["sender_id"] = $_POST['users'];
	$id_of_sender = $_POST['users'];
	$query = "select * from names where ID!='$id_of_sender'";
	$result = mysqli_query($link,$query);
	$i=0;
	while ($row=mysqli_fetch_row($result))
    	{
		$rec[$i]=$row[1];
		$rec_ids[$i]=$row[0];
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
input[type=radio] {
    margin-top:15px;
    border: 0px;
    width: 0.8em;
    height: 0.8em;
}
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
                      <a class="nav-item nav-link" href="All Transactions.php">View All Transactions</a>
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
	<font size=7>Select the Sender</font>
	<font size=6>
	<form name=rec_list method="post" action="credits.php">
<?php
	for($i=0;$i<count($rec);$i++)
	{
		



		echo "<div class='form-check'>
  			<input class='form-check-input' type='radio' name='receivers' id=$rec[$i] value=$rec_ids[$i] required>  &nbsp &nbsp
			<label class='form-check-label' for=$rec[$i]]>$rec[$i]</label>


			</div>";
		


	
	}
?>
	<input type='submit' name='submit_rec' value='submit' class='btn btn-primary'/>
	</form>
	</font>
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