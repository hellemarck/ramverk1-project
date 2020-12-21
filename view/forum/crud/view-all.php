<?php

namespace Anax\View;

/**
 * View to display all posts.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
// $items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("forum/create");
// $urlToDelete = url("forum/delete");

// var_dump($q2u[0]);
// var_dump($q2t[0]);

?><h1>Alla foruminlägg</h1>

<?php if ($this->di->get("session")->get("user")) : ?>
<p>
    <a href="<?= $urlToCreate ?>">Nytt inlägg</a>
</p>
<?php endif; ?>

<?php if (!$q2u) : ?>
    <p>Inga trådar finns ännu.</p>
    <?php
    return;
endif;

?>

<?php foreach ($q2u as $item) : ?>
<div style="border:1px solid pink;margin:5px;padding:10px;">
<a href="<?= url("forum/question/{$item->questionid}"); ?>"><h3><?= $item->title ?></h3></a>
<p style="color:#ccc;">
    <?= $item->date ?> - Inlägg av <a href="<?= url("user/profile/{$item->userid}"); ?>"> <?= $item->username ?></a></p>
<!-- <?= var_dump($item->email) ?> -->
<img src="<?php echo $item->gravatar($item->email) ?>" style="float:right;">
    <p><?= $filter->parse($item->text, ["markdown"])->text ?></p>

<p>TAGGAR:
    <?php foreach ($q2t as $tag) {
        if ($tag->questionid == $item->questionid) {
            ?><a href="<?= url("tags/tag/{$tag->tagid}"); ?>"><?= $tag->tag ?></a> <?php
        }
    }?>
</p>
    <a href="<?= url("forum/question/{$item->questionid}"); ?>">Se inlägg, svara och kommentera</a>
</div>
<?php endforeach; ?>

<!-- </table> -->
