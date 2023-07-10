<h1>BIENVENUE SUR LE FORUM</h1>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>
<?php
$now = new DateTime("now", new DateTimeZone("+0200"));
echo $now->format("Y-m-d H:i:s");
?>

<p>
    <a href="/security/login.html">Se connecter</a>
    <span>&nbsp;-&nbsp;</span>
    <a href="/security/register.html">S'inscrire</a>
</p>