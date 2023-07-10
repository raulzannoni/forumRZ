<?php

    $role = ($result["data"]["user"]->getRole() == "ROLE_ADMIN") ? "Admin" : "User";

    $idUser = $result["data"]["user"]->getId();

    $nickname = $result["data"]["user"]->getNickname();
?>
    <div class="titleDiv">
        <h1 class="titleUnderLine">Profile</h1> 
        <span>(User n° <?=$idUser?>)</span>
    </div>
    <p><strong>Nickname:</strong> <?= $nickname?></p>
    

    