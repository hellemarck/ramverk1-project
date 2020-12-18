<?php
// var_dump($tags);
?>

<article class="article" style="text-align:center; min-height:300px;">

<div style="background-color:#daf0e0;"><h1><?= $question->title ?></h1>
<p style="color:#ccc;font-style:italic;"><?= $question->date ?></p>
<p><?= $question->text ?></p>
<p>Taggar:
    <?php foreach($tags as $tag) : ?>
        <a href=""><?= $tag->tag ?></a>
    <?php endforeach; ?>
</div>

<?php
foreach ($qComments as $com) :
    ?><div style="background-color:#f7edf7;"<p><?= $com->userid ?> sa (<?= $com->date ?>): <?= $com->text ?></p></div>
<?php endforeach; ?>

<br><br>
<?= $replyForm ?>
<?= $commentForm ?>


<p>visa taggar, svar och kommentarer
SKA KUNNA SVARA PÅ FRÅGAN
SKA KUNNA KOMMENTERA PÅ SVAR OCH FRÅGA</p>


<!-- <form action="reply" method="post">
<br>
<input id="replyField" name="reply"><br>
<input type="submit" value="Svara">
</form>


<form action="comment" method="post">
<br>
<input id="commentField" name="comment"><br>
<input type="submit" value="Kommentera">
</form> -->
</article>
