<?php

namespace Anax\View;

$urlToUser = url("user/profile");
?>

<article class="article">
<div class="questions">
    <h3>Kommentera svar</h3>

<img src="<?php echo $reply[0]->gravatar($reply[0]->email) ?>" style="float:right;margin:10px 10px 0 0;border:2px solid #70665d">
<p class="details">
    <?= $reply[0]->date ?> — svar av <a href="<?= url("user/profile/{$reply[0]->userid}"); ?>"> <?= $reply[0]->username ?></a>
</p><p><?= $filter->parse($reply[0]->text, ["markdown"])->text ?></p>

<?= $commentFormReply ?>
</div>
</article>
