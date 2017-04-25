<?php
$this->renderView("take1/header", [
    "title" => $title . " | anaxlite"
]);
?>

<?php if ($this->regionHasContent("flash")) : ?>
<div class="flash-wrap">
    <?php $this->renderRegion("flash") ?>
</div>
<?php endif; ?>

<?php if ($this->regionHasContent("breadcrumb")) : ?>
<div class="breadcrumb-wrap">
    <?php $this->renderRegion("breadcrumb") ?>
</div>
<?php endif; ?>

<?php if ($this->regionHasContent("main")) : ?>
<div class="main-wrap">
    <div class="container">
        <div class="row">
            <?php if ($this->regionHasContent("sidebar")) : ?>
            <div class="sidebar-wrap">
                <?php $this->renderRegion("sidebar") ?>
            </div>
            <?php endif; ?>
            <?php $this->renderRegion("main") ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php $this->renderView("take1/footer");
