<?= $this->tag->javascriptInclude('js/custom_plugins.js') ?>
<div class="container flex-grow-1">
    <?= $this->getContent() ?>
</div>
<script type="text/javascript">
	linkElement(".click-row");
</script>