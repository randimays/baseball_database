<?php
require __DIR__ . '/../src/Input.php';

function pageController()
{
    $teams = Input::get('teams');  // You'll get an array with team IDs

    $teamIdsString = implode(",", $teams);

    $delete = "DELETE FROM teams WHERE id IN ($teamIdsString);";
    var_dump($delete);

    // In a real scenario you would normally redirect to the list of teams.
    // header('Location: teams.php');
}
pageController();