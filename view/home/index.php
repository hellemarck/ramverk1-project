<?php

namespace Anax\View;

// var_dump($latestQuestions);

?>


<article class="article" style="text-align:center; min-height:300px;">
    <h1>Välkommen</h1>
    <h2>till ett diskussionsforum för kaffeälskare!</h2>

    <div class="intro"><p>Kaffe åt alla, i alla lägen, i alla former! Dela med er av tips och trix, recensera nya kaffesorter och bästa maskinerna.</p>
    </div>

    <h3>3 senaste inläggen</h3>

<?php foreach ($latestQuestions as $question) {
    ?> <li><a href="<?= url("forum/question/{$question->questionid}"); ?>"><?= $question->title ?></a></li> <?php
} ?>

    <h3>3 mest populära taggarna</h3>

<?php foreach ($popularTags as $tag) {
    ?> <li><a href="<?= url("tags/tag/{$tag->tagid}"); ?>"><?= $tag->tag ?></a></li> <?php
} ?>

    <h3>3 mest aktiva användarna</h3>
</article>
