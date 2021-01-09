<?php

namespace Anax\View;

/**
 * View to show user information
 */

// Gather incoming variables and use default values if not set
// $user1 = isset($user) ? $user : null;

// Create urls for navigation
$urlToView = url("forum");

?>
<article class="article">
<div class="questions" style="padding:40px;">
<h1>Användarprofil</h1>

<img src="<?php echo $user->gravatar($user->email) ?>" style="float:right;">
<p><b>Användar-ID:</b> <?= $user->userid ?><br>
<b>Användarnamn:</b> <?= $user->username ?><br>
<b>E-post:</b> <?= $user->email ?? "Saknas" ?></p>

<h3>Inlägg</h3>

<?php
if ($questions) {
    foreach ($questions as $question) : ?>
<a href="<?= url("forum/question/{$question->questionid}"); ?>"><li><?= $question->title ?></li></a>
    <?php endforeach;
} else {
    ?><p>Inga inlägg.</p><?php
}?>

<h3>Svar</h3>

<?php
if ($replies) {
    foreach ($replies as $reply) : ?>
<a href="<?= url("forum/question/{$reply->questionid}"); ?>"><li><?= $reply->text ?></li></a>
    <?php endforeach;
} else {
    ?><p>Inga svar.</p><?php
}?>

<h3>Kommentarer</h3>

<?php if ($comments) {
    foreach ($comments as $comment) : ?>
<a href="<?= url("forum/question/{$comment->questionid}"); ?>"><li><?= $comment->text ?></li></a>
    <?php endforeach;
} else {
    ?><p>Inga kommentarer.</p><?php
}?>
<br>
<p class="link-create">
    <a href="<?= $urlToView ?>">Till forum</a>
</p>
</div>
</article>
