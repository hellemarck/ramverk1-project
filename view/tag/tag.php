<?php

namespace Anax\View;

// $urlBack = url("tags");
// var_dump($res);
// var_dump($tag);

// /htdocs/forum/question/8
?>

<article class="article" style="text-align:center; min-height:300px;">
    <h1>Inlägg med taggen "<?= $tag ?>" </h1>

<?php

if ($res) {
    foreach ($res as $post) {
        ?><li><a href="<?= url("forum/question/{$post->questionid}"); ?>"> <?= $post->question->title ?> </a></li><?php
    };
} else {
    ?><p>Inga inlägg med den taggen.</p><?php
}

?>

<br><br><a href="<?= url("tags") ?>">Tillbaka</a>

</article>
