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
        // MySQL Query that will get all the answers from the "poll_answers" table ordered by the number of votes (descending)
        $stmt = $db1->prepare('SELECT * FROM poll_answers WHERE pollid = ? ORDER BY votes DESC');
        $stmt->execute([ $_GET['id'] ]);
        // Fetch all poll answers
        $poll_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Total number of votes, will be used to calculate the percentage
        $total_votes = 0;
        foreach($poll_answers as $poll_answer) {
            // Every poll answers votes will be added to total votes
            $total_votes += $poll_answer['votes'];
        }
    } else {
        exit('Poll with that ID does not exist.');
    }
} else {
    exit('No poll ID specified.');
}

?>

<br>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 
 
    </head>
    <style>
    .result-bar{
    background-color: #25D366;
    }
    
    </style>
   
    
    <body>
    	<br>
    	<div class="container">
        	<h4 style="font-weight: bold"><?=$poll['title']?></h4>
        	<p><?=$poll['description']?></p>
            <div class="wrapper">
                <?php foreach ($poll_answers as $poll_answer): ?>
                <div class="poll-question">
                    <p><?=$poll_answer['title']?> <span>(<?=$poll_answer['votes']?> Votes)</span></p>
                    <div class="result-bar" style= "width:<?=@round(($poll_answer['votes']/$total_votes)*100)?>%">
                        <?=@round(($poll_answer['votes']/$total_votes)*100)?>%
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>
<br><br><br><br><br><br><br><br><br>
<?php include 'Footer.php';?>