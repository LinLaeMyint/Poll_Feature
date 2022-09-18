<?php
include 'Header.php';
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 


<style>


.intro p{
text-align:center;
}
</style>

<br><br>
</head>
<body>
	<div class="intro">
		<p>Create your group polls to support decision making in your team!</p><br>
	</div>
	
	<div class="container bg-light">
        <div class="col-md-12 text-center">
            <a href="create.php"><button type="button" class="btn btn-success">Create Poll</button></a>
           <a href="pollshistory.php"><button type="button" class="btn btn-success">Poll History</button></a>
        </div>
       
    </div>
	
</body>
</html>
<br><br><br><br><br><br><br><br><br><br><br><br>
<?php include 'Footer.php';?>

