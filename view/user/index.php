<?php

namespace Anax\View;

$edit = " <a href=" . url("user/edit/" . $user->userid) .">Redigera användare</a>";
$logOut = "<a href=" . url("user/logout") ."> Logga ut</a>";

?>

<article class="article">
    <div class="questions">

    <h1>Min sida</h1>

    <img src="<?php echo $user->gravatar($user->email) ?>" style="float:right;margin:10px 10px 0 0;border:2px solid #70665d">

    <p><b>Användar-ID:</b> <?= $user->userid ?><br>
    <b>Användarnamn:</b> <?= $user->username ?><br>
    <b>E-post:</b> <?= $user->email ?? "Saknas" ?></p>
<br>
<p class="link-create"> <?= $edit ?> </p>
<p class="link-create"> <?= $logOut ?> </p>

</div>
</article>
