<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

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

<a href="<?= url("forum/{$question->questionid}"); ?>"><li><?= $question->title ?></li></a>
<?php endforeach; ?>

<h2>Svar och kommentarer</h2>
<p>in med det häääär</p>

<p>
    <a href="<?= $urlToView ?>">Tillbaka</a>
</p>
