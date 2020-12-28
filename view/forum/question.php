<?php

namespace Anax\View;

$urlToUser = url("user/profile");
$urlBack = url("forum");

?>

<article class="article">

<p class="link-create">
    <a href="<?= $urlBack ?>">Tillbaka</a>
</p>

<div class="questions">
<img src="<?php echo $user->gravatar($user->email) ?>" style="float:right;margin:10px 10px 0 0;border:2px solid #70665d">
    <h3><?= $question->title ?></h3>

<p class="details">
    <?= $question->date ?> — skapat av <a href="<?= url("user/profile/{$user->userid}"); ?>"> <?= $user->username ?></a>
</p>

<p><?= $filter->parse($question->text, ["markdown"])->text ?></p>

<p class="details">TAGGAR:
    <?php foreach ($tags as $tag) : ?>
        <a href="<?= url("tags/tag/{$tag->tagid}"); ?>"><?= $tag->tag ?></a>
    <?php endforeach; ?>
</p>
<br>
<div class="border"></div>
<br>
<!-- Comments to the question -->
<?php
foreach ($qComments as $com) :
    ?><div class="comment"><p><b>Kommentar: </b>
        <?= $com->date ?> — <a href="<?= $urlToUser . "/" . $com->userid ?>"><?= $com->username ?></a>:
        <?= $filter->parse($com->text, ["markdown"])->text ?></p>

    </div>
<?php endforeach; ?>

<!-- <div class="border"></div> -->

<!-- Replies to the question -->

<?php
foreach ($replies as $reply) :
    ?><div class="reply"><p><b>Svar: </b>
        <?= $reply->date ?> — <a href="<?= $urlToUser . "/" . $reply->userid ?>"><?= $reply->username ?></a>:<br>
        <?= $filter->parse($reply->text, ["markdown"])->text ?></p>

        <form action="<?= url("forum/comment/{$reply->replyid}"); ?>">
            <input type="submit" value="Kommentera svar" />
        </form>



        <!-- <p style="color:#5b8db3;font-size:1.1em"><a href="<?= url("forum/comment/{$reply->replyid}"); ?>" style="color:#5b8db3;font-size:1.1em">Kommentera svar</a></p> -->
        <?php if ($reply->comments) {
            foreach ($reply->comments as $comment) {
                ?><div class="comment"><p><b>Kommentar: </b>
                    <?= $comment->date ?> — <a href="<?= $urlToUser . "/" . $comment->userid ?>"><?= $comment->username ?></a>:
                    <?= $filter->parse($comment->text, ["markdown"])->text ?></p>

                    </div><?php
            }
        }?>

        </div>
<?php endforeach; ?>

<?= $replyForm ?>
<?= $commentFormQuest ?>
</div>
</article>
