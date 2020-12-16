<?php

namespace Anax\View;

$edit = " <a href=" . url("user/edit/" . $user->userid) .">Redigera användare</a>";
$logOut = "<a href=" . url("user/logout") ."> Logga ut</a>";

?>

<article class="article" style="border:1px #ccc solid; padding: 20px; margin:auto; text-align:left; min-height:300px; width:600px;">
    <h1>Min sida</h1>

    <img src="<?php echo $user->gravatar($user->email) ?>" style="float:right;">
    <p><b>Användar-ID:</b> <?= $user->userid ?><br>
    <b>Användarnamn:</b> <?= $user->username ?><br>
    <b>E-post:</b> <?= $user->email ?? "Saknas" ?></p>

<p> <?= $edit ?> </p>
<p> <?= $logOut ?> </p>
</article>
