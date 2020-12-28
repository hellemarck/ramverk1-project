<?php

namespace Anax\View;

?>

<div class="welcome">
    <img src="https://cdn.pixabay.com/photo/2019/10/31/07/15/coffee-4591168_1280.jpg">
    <br><p class="heading">Välkommen</p>
<p>till ett diskussionsforum <br>för kaffeälskare<p></div>

<article class="article" style="text-align:center; min-height:300px;">

    <div class="intro"><p>
        Vi förutsätter att du som hittat hit förespråkar kaffe, för alla, i alla lägen, i alla former, eller <i>åtminstone</i> är väldigt nyfiken och vill veta mer om detta mästerverk till dryck. Här är det fritt fram att dela med sig av tips, be om råd och rekommendationer, och hjälpas åt att navigera i marknadens djungel av kaffeutbud, -verktyg och -tillbehör. Hugg in!</p>
    </div>
    <br>

<div class="all-toplists">
    <div class="toplists">
    <h3>De 3 senaste inläggen</h3>

<?php foreach ($latestQuestions as $question) {
    ?> <li><a href="<?= url("forum/question/{$question->questionid}"); ?>"><?= $question->title ?></a></li> <?php
} ?>
</div>
<div class="toplists">
    <h3>De 3 mest populära taggarna</h3>

<?php foreach ($popularTags as $tag) {
    ?> <li><a href="<?= url("tags/tag/{$tag->tagid}"); ?>"><?= $tag->tag ?></a></li> <?php
} ?>
</div>
</div>
<br>
    <h3>De 3 mest aktiva användarna</h3>

<div class="all-users-toplists">
    <div class="users-toplists">
<h4>Inlägg</h4>
<?php foreach ($mostActiveQuestion as $user) {
    ?> <li><a href="<?= url("user/profile/{$user->userid}"); ?>"><?= $user->username ?></a></li> <?php
} ?>
</div>
<div class="users-toplists">
<h4>Svar</h4>
<?php foreach ($mostActiveReply as $user) {
    ?> <li><a href="<?= url("user/profile/{$user->userid}"); ?>"><?= $user->username ?></a></li> <?php
} ?>
</div>
<div class="users-toplists">
<h4>Kommentarer</h4>
<?php foreach ($mostActiveComment as $user) {
    ?> <li><a href="<?= url("user/profile/{$user->userid}"); ?>"><?= $user->username ?></a></li> <?php
} ?>
</div>
</div>
</article>
