<?php
require __DIR__ . '/../src/Input.php';

function pageController()
{
    $team = Input::has('team');
    $team = Input::get('team');
    $sql = "SELECT(SELECT COUNT(*) FROM games WHERE (local_team_runs > visitor_team_runs AND local_team_id = $team)OR (visitor_team_runs > local_team_runs AND visitor_team_id = $team)) AS 'TOTAL WINS',(SELECT COUNT(*) FROM games WHERE (local_team_runs > visitor_team_runs AND visitor_team_id = $team) OR (visitor_team_runs > local_team_runs AND local_team_id = $team)) AS 'Total Losses', (SELECT COUNT(*) FROM games WHERE (local_team_runs < visitor_team_runs AND visitor_team_id = $team)) AS 'Away Wins', (SELECT COUNT(*) FROM games WHERE (local_team_runs > visitor_team_runs AND local_team_id = $team)) AS 'Home Wins' FROM teams t WHERE id = $team;";

    // Copy the generated query and verify that it retrieves the correct values
    // in SQL Pro
    var_dump($sql);

    return [
        'title' => 'Statistics Texas Rangers',
        'sql' => $sql
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
        <header class="page-header">
            <h1>Statistics</h1>
            <p><?=$sql?></p>
        </header>
    </div>
    <div class="row">
        <canvas id="stats-chart" width="400" height="400"></canvas>
    </div>
</div>
<?php include '../partials/scripts.phtml' ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.0/Chart.bundle.min.js">
</script>
<script>
    var ctx = $('#stats-chart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Won", "Lost", "Won as local", "Won as visitor"],
            datasets: [{
                label: 'Games',
                // These should be the values from our PHP query
                data: [12, 19, 3, 5],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
</body>
</html>