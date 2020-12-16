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



?><h1>Redigera användare</h1>

<?= $form ?>

<p>
    <a href="<?= $urlToView ?>">Gå tillbaka</a>
</p>
