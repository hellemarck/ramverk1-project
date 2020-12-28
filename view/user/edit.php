<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$user1 = isset($user) ? $user : null;

// Create urls for navigation
$urlToView = url("user");



?>
<article class="article">
<div class="questions">

<h1>Redigera användare</h1>

<?= $form ?>

    <p class="link-create"><a href="<?= $urlToView ?>">Gå tillbaka</a></p>

</div>
</article>
