<?php

namespace Anax\View;

// var_dump($replies);
$urlToUser = url("user/profile");

?>

<article class="article" style="text-align:center; min-height:300px;">

<div style="background-color:#daf0e0;"><h1><?= $question->title ?></h1>
<p style="color:#ccc;font-style:italic;"><?= $question->date ?></p>
<p><?= $question->text ?></p>
<p>Taggar:
    <?php foreach($tags as $tag) : ?>
        <a href=""><?= $tag->tag ?></a>
    <?php endforeach; ?>
</div>

<?php
foreach ($qComments as $com) :
    ?><div style="background-color:#f7edf7;"<p>
        <a href="<?= $urlToUser . "/" . $com->userid ?>"><?= $com->username ?></a>
        sa (<?= $com->date ?>): <?= $com->text ?></p></div>
<?php endforeach; ?>

<?= $commentFormQuest ?>
<?= $replyForm ?>

<br><br>
<?php
foreach ($replies as $reply) :
    ?><div style="background-color:#d0dff7;"<p>
        <a href="<?= $urlToUser . "/" . $reply->userid ?>"><?= $reply->username ?></a>
        sa (<?= $reply->date ?>):<br> <?= $reply->text ?></p>
        <a href="<?= url("forum/comment/{$reply->replyid}"); ?>" class="button right">Kommentera</a></div>
<?php endforeach; ?>


</article>
