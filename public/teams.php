<?php

// This is a first of series of exercises to illustrate how to relate the interface of a CRUD application with their corresponding SQL statements. You will write the queries for a small application to keep track of the results of MLB games.

require __DIR__ . '/../src/Input.php';

function pageController()
{
	$teams = Input::get('teams');
	$page = Input::get('page', 1);
	$sortQuery = Input::get('sort_by');
	$searchQuery = Input::get('team_or_stadium');
	$sql = "SELECT * FROM teams";

	if ($page < 1) {
		$page = 1;
	}
	
	$offset = ($page - 1) * 5;

	if (Input::has('team_or_stadium')) {
		$sql .= " WHERE name LIKE '%$searchQuery%' OR stadium LIKE '%$searchQuery%'";
	}

	if (Input::has('sort_by')) {
		$sql .= " ORDER BY $sortQuery ASC";
	}

	if (Input::has('page')) {
		$sql .= " LIMIT 5 OFFSET $offset";
	}

	// Copy the query and test it in SQL Pro
	var_dump($sql);

	return [
		'title' => 'Teams',
		'query' => $searchQuery,
	];
}
extract(pageController());
?>

<!DOCTYPE html>
<html>
<head>
	<?php include '../partials/head.phtml' ?>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<header class="page-header">
				<h1>Teams</h1>
			</header>
		</div>
		<div class="col-md-4" style="padding-top: 3.5em">
			<form class="form-inline" method="get">
				<div class="form-group">
					<input
						type="text"
						class="form-control"
						id="team"
						name="team_or_stadium"
						placeholder="Team or Stadium">
				</div>
				<button type="submit" class="btn btn-default">
					<span class="glyphicon glyphicon-search" aria-hidden="true">
					</span>
					Search
				</button>
			</form>
		</div>
	</div>
	<div class="row">
		<form method="post" action="delete-teams.php">
			<table class="table table-striped table-hover table-bordered">
				<thead>
				<tr>
					<th>Delete</th>
					<th>
						<a href="?sort_by=name">Team</a>
					</th>
					<th>
						<a href="?sort_by=stadium">Stadium</a>
					</th>
					<th>
						<a href="?sort_by=league">League</a>
					</th>
				</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<input type="checkbox" name="teams[]" value="1">
						</td>
						<td>
							<a href="team-details.php?team_id=1">Red Sox</a>
						</td>
						<td>Fenway Park</td>
						<td>American</td>
					</tr>
					<tr>
						<td>
							<input type="checkbox" name="teams[]" value="2">
						</td>
						<td>
							<a href="team-details.php?team_id=2">Texas Rangers</a>
						</td>
						<td>Global Life Park</td>
						<td>American</td>
					</tr>
					<tr>
						<td>
							<input type="checkbox" name="teams[]" value="3">
						</td>
						<td>
							<a href="team-details.php?team_id=3">New York Yankees</a>
						</td>
						<td>Yankee Stadium</td>
						<td>American</td>
					</tr>
					<tr>
						<td>
							<input type="checkbox" name="teams[]" value="4">
						</td>
						<td>
							<a href="team-details.php?team_id=4">Philadelphia Phillies</a>
						</td>
						<td>Citizens Bank Park</td>
						<td>National</td>
					</tr>
					<tr>
						<td>
							<input type="checkbox" name="teams[]" value="4">
						</td>
						<td>
							<a href="team-details.php?team_id=5">Chicago Cubs</a>
						</td>
						<td>Wrigley Field</td>
						<td>National</td>
					</tr>
					<tr>
						<td>
							<input type="checkbox" name="teams[]" value="4">
						</td>
						<td>
							<a href="team-details.php?team_id=6">Cincinnati Reds</a>
						</td>
						<td>Great American Ball Park</td>
						<td>National</td>
					</tr>
					<tr>
						<td>
							<input type="checkbox" name="teams[]" value="4">
						</td>
						<td>
							<a href="team-details.php?team_id=7">Los Angeles Dodgers</a>
						</td>
						<td>Dodger Stadium</td>
						<td>National</td>
					</tr>
					<tr>
						<td>
							<input type="checkbox" name="teams[]" value="4">
						</td>
						<td>
							<a href="team-details.php?team_id=8">St. Louis Cardinals</a>
						</td>
						<td>Busch Stadium</td>
						<td>National</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4">
						  <!-- The values in this pagination control indicate you're currently viewing page 2 -->
							<nav aria-label="Page navigation" class="text-center">
								<ul class="pagination">
									<li>
										<a href="?page=1" aria-label="Previous">
											<span aria-hidden="true">&laquo;</span>
										</a>
									</li>
									<li><a href="?page=1">1</a></li>
									<li><a href="?page=2">2</a></li>
									<li><a href="?page=3">3</a></li>
									<li><a href="?page=4">4</a></li>
									<li><a href="?page=5">5</a></li>
									<li>
										<a href="?page=3" aria-label="Next">
											<span aria-hidden="true">&raquo;</span>
										</a>
									</li>
								</ul>
							</nav>
						</td>
					</tr>
				</tfoot>
			</table>
			<button type="submit" class="btn btn-danger">
				<span class="glyphicon glyphicon-trash"></span>
				Delete
			</button>
			<a href="new-team.php" class="btn btn-primary">
				<span class="glyphicon glyphicon-plus"></span>
				Add a new team
			</a>
		</form>
	</div>
</div>
<?php include '../partials/scripts.phtml' ?>
</body>
</html>