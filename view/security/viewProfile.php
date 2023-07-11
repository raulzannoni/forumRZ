<?php

    $role = ($result["data"]["user"]->getPassword() == "ROLE_ADMIN") ? "Admin" : "User";

    $idUser = $result["data"]["user"]->getId();

    $nickname = $result["data"]["user"]->getNickname();

    $user = $result["data"]["user"];
?>
    <div class="titleDiv">
        <h1 class="titleUnderLine">Profile</h1> 
        <span>(User n° <?=$idUser?>)</span>
    </div>
    <p><strong>Nickname:</strong> <?= $nickname?></p>
    <p><strong>Date creation account:</strong> <?= $user->getCreationdate()->format("Y/m/d H:i:s")?></p>
    <p><strong>Role:</strong> <?= $role?></p>
    

    