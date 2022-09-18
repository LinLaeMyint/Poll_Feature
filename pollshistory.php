<?php include 'DatabaseConnection.php';?>
<?php include 'Header.php';?>
<?php $stmt = $db1->query('SELECT p.*, GROUP_CONCAT(pa.title ORDER BY pa.id) AS answers FROM polls p LEFT JOIN poll_answers pa ON pa.pollid = p.id GROUP BY p.id');
$polls = $stmt->fetchAll(PDO::FETCH_ASSOC);?>
<br><br>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 
</head>
<style>
.table tbody tr td.actions {
      padding: 8px;
      text-align: right;
}

.table tbody tr td.actions .view,table tbody tr td.actions .trash {
      display: inline-flex;
      text-align: right;
      text-decoration: none;
      color: black;
      padding: 10px 12px;
      border-radius: 5px;
}

.table tbody tr td.actions.trash {
      background-color: red;
}
.table tbody tr td.actions.trash:hover {
      background-color: green;
}

.table tbody tr td.actions.view {
      background-color: green;
}
.table tbody tr td.actions.view:hover {
      background-color: red;
}
</style>

<body>
<div class="container">

<form method="post" action="pollshistory.php">
	<table class= "table table-striped table-hover">
		<thead>
            <tr>
              <th scope="col" >No</th>
              <th scope="col" >Title</th>
              <th scope="col" >Answer</th>
            </tr>
  		</thead>
  		<tbody>
  				<?php foreach($polls as $poll): ?>
  				
            <tr>
                <td><?=$poll['id']?></td>            																		
                <td><?=$poll['title']?></td>
				<td><?=$poll['answers']?></td>
                <td class="actions">
					<a href="vote.php?id=<?=$poll['id']?>" class="view" title="View Poll"><i class="fas fa-eye fa-xs"></i></a>
                    <a href="delete.php?id=<?=$poll['id']?>" class="trash" title="Delete Poll"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
  		
  		</tbody>
	</table>
</form>
</div>
</body>
</html>
<br><br><br><br><br><br><br>
<?php include 'Footer.php';?>