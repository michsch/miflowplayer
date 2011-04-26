<?php
$this->config = $this->get('config');

//t3lib_div::debug($this->config);

srand(microtime()*1000000);
$id = 'player'.rand(1,999);

?>
<?= $this->createContainer($id); ?>

<?php if(!$this->controller->configurations->get('views.enableMultipleVideos')){ ?>
<script language="JavaScript"> 
flowplayer("<?= $id; ?>", {src: '<?= $this->createRelativePath($this->controller->pathToFlowplayer); ?>', wmode: '<?= $this->config['wmode']?>'}, {	
	<?= $this->createConfigString(); ?>
});
</script>
<?php } ?>