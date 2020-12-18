<?php

namespace Anax\View;

// var_dump($replies);
$urlToUser = url("user/profile");

?>

<article class="article" style="text-align:center; min-height:300px;">

<h2><?= $reply[0]->username ?> sa (<?= $reply[0]->date ?>):</h2>
<p><?= $reply[0]->text?></p>
<br><br>
<?= $commentFormReply ?>

</article>
