<?php

namespace Anax\View;
// $commentFormQuest["id"] = 0;
// var_dump($replies);
$urlToUser = url("user/profile");

?>

<article class="article" style="text-align:center; min-height:300px;">

<div style="background-color:#daf0e0;"><h1><?= $question->title ?></h1>
<p>Skrivet av <a href="<?= url("user/profile/{$user->userid}"); ?>"><?= $user->username ?></a></p>
<img src="<?php echo $user->gravatar($user->email) ?>" style="float:right;">
<p style="color:#ccc;font-style:italic;"><?= $question->date ?></p>
<p><?= $filter->parse($question->text, ["markdown"])->text ?></p>

<p>Taggar:
    <?php foreach($tags as $tag) : ?>
        <a href=""><?= $tag->tag ?></a>
    <?php endforeach; ?>
</div>

<?php
foreach ($qComments as $com) :
    ?><div style="background-color:#f7edf7;"<p>
        <a href="<?= $urlToUser . "/" . $com->userid ?>"><?= $com->username ?></a>
        sa (<?= $com->date ?>):
        <?= $filter->parse($com->text, ["markdown"])->text ?></p>

    </div>
<?php endforeach; ?>

<?= $replyForm ?>
<?= $commentFormQuest ?>

<br><br>
<?php
foreach ($replies as $reply) :
    ?><div style="background-color:#d0dff7;"<p>
        <a href="<?= $urlToUser . "/" . $reply->userid ?>"><?= $reply->username ?></a>
        sa (<?= $reply->date ?>):<br>
        <?= $filter->parse($reply->text, ["markdown"])->text ?></p>

        <a href="<?= url("forum/comment/{$reply->replyid}"); ?>" class="button">Kommentera svar</a><br><br>
        <?php if ($reply->comments) {
            foreach ($reply->comments as $comment) {
                ?><div style="background-color:#f7edf7;"><p>
                    <a href="<?= $urlToUser . "/" . $comment->userid ?>"><?= $comment->username ?></a>
                    sa (<?= $comment->date ?>):
                    <?= $filter->parse($comment->text, ["markdown"])->text ?></p>

                    </div><?php

            }
        }?>
        </div>
<?php endforeach; ?>


</article>
