
<?php include 'DatabaseConnection.php';?>
<?php include 'Header.php';?>
<?php 

if (isset($_GET['id'])) {
    // MySQL query that selects the poll records by the GET request "id"
    $stmt = $db1->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([ $_GET['id'] ]);
    // Fetch the record
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the poll record exists with the id specified
    if ($poll) {
        // MySQL query that selects all the poll answers
        $stmt = $db1->prepare('SELECT * FROM poll_answers WHERE pollid = ?');
        $stmt->execute([ $_GET['id'] ]);
        // Fetch all the poll anwsers
        $poll_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // If the user clicked the "Vote" button...
        if (isset($_POST['poll_answer'])) {
            // Update and increase the vote for the answer the user voted for
            $stmt = $db1->prepare('UPDATE poll_answers SET votes = votes + 1 WHERE id = ?');
            $stmt->execute([ $_POST['poll_answer'] ]);
            // Redirect user to the result page
           header('Location: result.php?id=' . $_GET['id']);
            exit;
        }
    } else {
        exit('Poll with that ID does not exist.');
    }
} else {
    exit('No poll ID specified.');
}

?>
<br><br>
<html>
<head>
	 <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 
</head>
<body>

<div class="container">
	<h4 style="font-weight: bold"><?=$poll['title']?></h4><br>
	<p><?=$poll['description']?></p><br>
    <form action="vote.php?id=<?=$_GET['id']?>" method="post">
        <?php for ($i = 0; $i < count($poll_answers); $i++): ?>
        <label>
            <input type="radio" name="poll_answer" value="<?=$poll_answers[$i]['id']?>"<?=$i == 0 ? 'checked' : ''?>>
            <?=$poll_answers[$i]['title']?>
        </label>
        <?php endfor; ?>
        
        <br><br>
    <div class="button">
    	<div class="bg-light clearfix">   
        	<button type="submit" class="btn btn-success float-right ml-2" value="vote">Vote</button>
        	<button type="submit" class="btn btn-success float-right ml-2" value="View Result"><a href="result.php?id=<?=$poll['id']?>" style="text-decoration:none; color:white">View Result</a></button>
		</div>
    </div>    
       
    </form>
</div>
</body>
</html>
<br><br><br><br><br><br><br><br><br>
<?php include 'Footer.php';?>
