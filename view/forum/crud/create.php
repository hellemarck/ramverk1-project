<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToViewItems = url("forum");



?>
<article class="article">
<h1>Nytt inlägg</h1>

<?= $form ?>

<p class="link-create">
    <a href="<?= $urlToViewItems ?>">Visa alla</a>
</p>
</article>
