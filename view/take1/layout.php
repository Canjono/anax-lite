<?php
$this->renderView("take1/header", [
    "title" => $title
]);
?>

<?php if ($this->regionHasContent("flash")) : ?>
<div class="flash-wrap">
    <?php $this->renderRegion("flash") ?>
</div>
<?php endif; ?>

<?php if ($this->regionHasContent("main")) : ?>
<div class="main-wrap">
    <?php $this->renderRegion("main") ?>
</div>
<?php endif; ?>

<?php $this->renderView("take1/footer");
