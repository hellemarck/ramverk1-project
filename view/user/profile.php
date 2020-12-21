<?php

namespace Anax\View;

/**
 * View to show user information
 */

// Gather incoming variables and use default values if not set
// $user1 = isset($user) ? $user : null;

// Create urls for navigation
$urlToView = url("forum");

?><h1>Användarprofil</h1>

<img src="<?php echo $user->gravatar($user->email) ?>" style="float:right;">
<p><b>Användar-ID:</b> <?= $user->userid ?><br>
<b>Användarnamn:</b> <?= $user->username ?><br>
<b>E-post:</b> <?= $user->email ?? "Saknas" ?></p>

<h2>Inlägg</h2>

<?php foreach ($questions as $question) : ?>

<a href="<?= url("forum/question/{$question->questionid}"); ?>"><li><?= $question->title ?></li></a>
<?php endforeach; ?>

<h2>Svar</h2>

<?php foreach ($replies as $reply) : ?>

<a href="<?= url("forum/question/{$reply->questionid}"); ?>"><li><?= $reply->text ?></li></a>
<?php endforeach; ?>

<h2>Kommentarer</h2>

<?php foreach ($comments as $comment) : ?>

<a href="<?= url("forum/question/{$comment->questionid}"); ?>"><li><?= $comment->text ?></li></a>
<?php endforeach; ?>

<p>
    <a href="<?= $urlToView ?>">Tillbaks till forum</a>
</p>
