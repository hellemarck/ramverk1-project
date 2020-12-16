<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("book/create");
$urlToDelete = url("book/delete");


?><article class="article" style="text-align:center; min-height:300px;">
<h1>Alla böcker</h1>

<p>
    <a href="<?= $urlToCreate ?>">Lägg till</a> |
    <a href="<?= $urlToDelete ?>">Radera</a>
</p>

<?php if (!$items) : ?>
    <p>Det finns inga böcker att visa.</p>
    <?php
    return;
endif;
?>

<table>
    <tr>
        <th>Id</th>
        <th>Titel</th>
        <th>Författare</th>
        <th>Handling</th>
        <th>Bild</th>
    </tr>
    <?php foreach ($items as $item) :?>
    <tr>
        <td>
            <a href="<?= url("book/update/{$item->id}"); ?>"><?= $item->id ?></a>
        </td>
        <td><?= $item->title ?></td>
        <td><?= $item->author ?></td>
        <td><?= $item->description ?></td>
        <td><img src="<?= $item->image ?? "Bild" ?>" width="120px"></td>
    </tr>
    <?php endforeach; ?>
</table>
</article>
