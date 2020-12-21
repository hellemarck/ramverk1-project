<?php

namespace Anax\View;

$urlToTag = url("tag");

?>

<article class="article" style="text-align:center; min-height:300px;">
    <h1>Taggar</h1>
    <p>Tryck på en tagg för att se inlägg kopplade till den.</p>

<?php foreach ($tags as $tag) {
    ?><li><a href="<?= url("tags/tag/{$tag->tagid}"); ?>"><?= ucfirst($tag->tag) ?></a></li><?php
}  ?>
</article>
