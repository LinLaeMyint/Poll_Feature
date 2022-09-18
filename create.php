
<?php include 'DatabaseConnection.php';?>
<?php include 'Header.php';?>
<?php $message='';?>
<?php 
if (!empty($_POST)) {
    
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $stmt = $db1->prepare('INSERT INTO polls (title, description) VALUES (?, ?)');
    $stmt->execute([ $title, $description ]);
    $pollid = $db1->lastInsertId();
    
    $answers = isset($_POST['answers']) ? explode(PHP_EOL, $_POST['answers']) : '';
    foreach($answers as $row) {
        
        if (empty($row)) continue;
        
        $stmt = $db1->prepare('INSERT INTO poll_answers (pollid, title) VALUES (?, ?)');
        $stmt->execute([ $pollid, $row ]);
    }
    
//     $message = 'Created Successfully!';
   header('Location: pollshistory.php');
}


?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 


<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<style>
.button{
margin: 20px;
}

</style>
<body>
<div class="container">
<form action="create.php" method="post">
	
    <div class="input-group flex-nowrap" style="padding-top:20px">
    <span class="input-group-text" id="title">Poll Title</span>
    <input name="title" id="title" type="text" class="form-control" placeholder="Shall we meet on Sunday?" aria-label="Title Name" aria-describedby="addon-wrapping" required>
    </div>
     <div class="input-group flex-nowrap" style="padding-top:20px">
    <span class="input-group-text" id="description">Description</span>
    <input name="description" id="description" type="text" class="form-control" placeholder="Write any description(Optional)" aria-label="Title Name" aria-describedby="addon-wrapping">
    </div>
    <div class="input-group" style="padding-top:20px">
  	<span class="input-group-text">Add Answers</span>
  	<textarea name="answers" id="answers" class="form-control" aria-label="answers" placeholder="Write Answers (per line)" required></textarea>
	</div>
	
	<div class="button">
    <div class="bg-light clearfix">   
        <button type="submit" class="btn btn-success float-right ml-2" value="create">Save</button>
        <a href="pollshistory.php">View Polls</a>
    </div>
	</div>
	
	 
	

	
</form>
</div>
<?php if ($message): ?>
    <p><?=$message?></p>
    <?php endif; ?>
</body>
</html>
<br><br><br><br><br><br><br>
<?php include 'Footer.php';?>
