<?php

    $topic = $result["data"]['topic'];

    $posts = $result["data"]['post'];

    $users = $result["data"]['user'];

    $postsCount = $result["data"]['NbPosts']["NbPosts"];

    if (!empty($result["data"]['categories'])) {
        $categories = $result["data"]['categories'];
    }

    if (!empty($result["data"]['userConnectedRoleFromBdd'])) {
        $userConnectedRoleFromBdd = $result["data"]['userConnectedRoleFromBdd'];
    }

    
    //echo "<br><br>";
    //var_dump($userConnectedRoleFromBdd);
?>

<div class="topicDetailHeader">

        <div class="titleDiv">
            <h1 class="titleUnderline">Topic n°<?= $topic->getId()?></h1>
            
        </div>
        <br>
            <span class="topicDetailNbrPosts">N° of posts: <?= $postsCount ?>  
                <i class="fa-solid fa-comments"></i>
            </span>

        <?php

    foreach($users as $user){
        $userArray[] = $user;
    }
        //var_dump($userArray);
    if(isset($posts)) {
        foreach($posts as $post){?>
        <div class="postCard">
            <p class="postText"><?= $post->getText() ?></p>
            <div class="postCardBottomLine"></div>
                <?php
                foreach($userArray as $user) {
                    if($user->getId() == $post->getUserId()) {?>
                        <span class="postInfos">by 
                            <a class="<?= $authorPostClass ?>" href="index.php?ctrl=security&action=viewUserProfile&id=<?= $post->getUserId()?>">
                            <?= $user->getNickname()?>
                            </a>, at <?= $post->getCreationdate() ?>
                        </span>
            <?php   } ?>
        </div>

        <?php
            }
        }
    }
    else {?>
        <p class="postCard">No posts</p>
<?php   }?>
</div>








                