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

$result = mysqli_query($link,"select * from transaction");
$i=0;
	while ($row=mysqli_fetch_row($result))
    	{
		$ids[$i]=$row[0];
		$from[$i]=$row[1];
		$to[$i] = $row[2];
		$amount[$i] = $row[3];
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
table, th, td {
    border: 1px solid black;
    margin-right:12px;
}
th, td {
  padding: 15px;
  padding-left: 55px;
  padding-right: 55px;
  
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
                       <a class="nav-item nav-link" href="index.html">Home</a>
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



		<table align="left"><tr> <th>ID</th> <th>FROM</th> <th>TO</th> <th>AMOUNT</th> </tr>
		<?php
			for($i=0;$i<count($ids);$i++)
			{
				echo "<tr> <td>".$ids[$i]."</td> <td>".$from[$i]." <td>".$to[$i]."</td> <td>".$amount[$i]."</td> </tr>";
			}
		?>
		</table><br>
		
		
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