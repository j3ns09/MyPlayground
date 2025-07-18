<?php


include_once '../../assets/shared/icons/icons.php';

?>

<nav class="bg-dark text-white p-3" style="width: 280px; min-height: 100vh;">
    <h4>Admin Dashboard</h4>
    <ul id="sidebar-list" class="nav nav-pills flex-column">
        <li class="nav-item"><a class="nav-link text-white" href="dashboard" data-page="dashboard"><?= $houseFill ?> Dashboard</a></li>
        
        <li class="nav-item"><a class="nav-link text-white" href="users" data-page="users"><?= $personFill ?> Users</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="captchas" data-page="captchas"><?= $puzzleFill ?> Captchas</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="teams" data-page="teams"><?= $personFill ?> Teams</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="matches" data-page="matches"><?= $personFill ?> Match</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="tournaments" data-page="tournaments"><?= $trophyFill ?> Tournaments</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="avatars" data-page="avatars"><?= $brushFill ?> Avatars</a></li>

        <li class="nav-item"><a class="nav-link text-white" href="newsletter" data-page="newsletter"><?= $envelopeFill ?> Newsletter</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="subscribed" data-page="subscribed"><?= $personLineFill ?> Inscrits</a></li>
        
        <li class="nav-item"><a class="nav-link text-white" href="banned" data-page="banned"><?= $banFill ?> Bannis</a></li>

        <li class="nav-item"><a class="nav-link text-white" href="../home"><?= $personHeart ?> Espace Utilisateur</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="logs" data-page="logs"><?= $fileRuledFill ?> Logs</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="settings" data-page="settings"><?= $gearFill ?> Settings</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="disconnect" data-page="disconnect"><?= $openedDoorFill ?> Disconnect</a></li>
    </ul>
</nav>