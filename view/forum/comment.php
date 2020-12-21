<?php

namespace Anax\View;

$urlToUser = url("user/profile");

?>

<article class="article" style="text-align:center; min-height:300px;">

<h2><?= $reply[0]->username ?> sa (<?= $reply[0]->date ?>):</h2>
<p><?= $filter->parse($reply[0]->text, ["markdown"])->text ?></p>
<br><br>
<?= $commentFormReply ?>

</article>
