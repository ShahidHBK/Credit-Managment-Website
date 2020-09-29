<!DOCTYPE html>
<?php
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
.shahid {width: 29%;}
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
                    <a class="nav-item nav-link" href="transaction.php">New Transaction</a>
                   </div>
               </div>
             </div>
         </nav>
    </header>
<main role="main" class="container">

  <div class="row">
	<div class="col-md-8">



	<center><font size="15">WELCOME TO CREDIT MANAGEMENT</font></center>
	<center>We have a bunch of users that you can view the credits of along with other tasks that you can do. To get started click on one of the options below<center>
<br>
<button id="users" class="btn btn-primary btn-lg btn-block">View All Users</button> 
<button id="newt" class="btn btn-primary btn-lg btn-block">New Transaction</button> 
<button id="transaction" class="btn btn-primary btn-lg btn-block">View All Transactions</button>
<script type="text/javascript">
document. getElementById("users"). onclick = function () {
location. href = "All users.php";
};

document. getElementById("newt"). onclick = function () {
location. href = "transaction.php";
};

document. getElementById("transaction"). onclick = function () {
location. href = "All Transactions.php";
};
</script>

		
	</div>




<div class="col-md-4">

      <div class="content-section">

        <h3>Recent Activity</h3>

        <p class='text-muted'>Latest Transaction

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