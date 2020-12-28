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

?>
<article class="article">
<h1>Alla foruminlägg</h1>

<?php if ($this->di->get("session")->get("user")) : ?>
<p class="link-create">
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
<div class="questions">
    <img src="<?php echo $item->gravatar($item->email) ?>" style="float:right;margin:10px 10px 0 0;border:2px solid #70665d">

<a href="<?= url("forum/question/{$item->questionid}"); ?>"><h3><?= $item->title ?></h3></a>
<p class="details">
    <?= $item->date ?> — skapat av <a href="<?= url("user/profile/{$item->userid}"); ?>"> <?= $item->username ?></a>
</p>

    <p><?= $filter->parse($item->text, ["markdown"])->text ?></p>

<p class="details">TAGGAR:
    <?php foreach ($q2t as $tag) {
        if ($tag->questionid == $item->questionid) {
            ?><a href="<?= url("tags/tag/{$tag->tagid}"); ?>"><?= $tag->tag ?></a> <?php
        }
    }?>
</p>

<p class="link-create">
    <a href="<?= url("forum/question/{$item->questionid}"); ?>">Se inlägg, svara och kommentera</a>
</p>
</div>

<?php endforeach; ?>
</article>
