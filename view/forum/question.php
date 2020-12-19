<?php

namespace Anax\View;
// $commentFormQuest["id"] = 0;
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
        <?php if ($reply->comments) {
            foreach ($reply->comments as $comment) {
                ?><div style="background-color:#f7edf7;"><p>
                    <a href="<?= $urlToUser . "/" . $comment->userid ?>"><?= $comment->username ?></a>
                    sa (<?= $comment->date ?>): <?= $comment->text ?></p></div><?php

            }
        }?>
        <a href="<?= url("forum/comment/{$reply->replyid}"); ?>" class="button">Kommentera detta svar</a><br><br></div>
<?php endforeach; ?>


</article>
