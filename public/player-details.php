<?php
require __DIR__ . '/../src/Input.php';

function pageController()
{
    $teams = [];
    if (Input::has('league')) {
        $league = Input::get('league');
        $teamId = Input::get('team_id');
        // Filter teams based on league, only select the team's identifier
        // and its name
        $selectTeams = "SELECT * FROM games AS g JOIN teams AS ht ON g.local_team_id = ht.id JOIN teams AS at ON g.visitor_team_id = at.id WHERE (ht.league = '$league' OR at.league = '$league') OR (ht.name LIKE $teamId OR at.name = $teamId)";
        // Try your query in Sequel Pro
        var_dump($selectTeams);
        // Use the values from your query to populate your form
        // $teams = 
    }
    // The player's identifier should be in the query string
    $playerId = Input::get('player_id');
    $sql = "SELECT * FROM players WHERE id = $playerId";
    var_dump($sql);

    return [
        'title' => 'Chris Young'
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
                <div class="page-header"><h1>Chris Young</h1></div>
                <?php include '../partials/player-form.phtml' ?>
            </div>
        </div>
        <?php include '../partials/scripts.phtml' ?>
    </body>
</html>
