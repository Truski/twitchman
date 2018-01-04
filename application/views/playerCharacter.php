<style>
html, body {
	padding: 0px;
	margin: 0px;
}

.right {
	transform: scale(-1, 1);
}
</style>
<img id="char" class="<?=$side?>" src="/assets/chars/<?=$img?>.png" />

<script>

var source = new EventSource('/op/charUpdate/<?=$side?>');
source.addEventListener('message', function(e) {
  document.getElementById("char").src = "/assets/chars/" + e.data + ".png";
});

</script>