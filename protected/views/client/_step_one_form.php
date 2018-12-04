<label class="label label-primary">SELECT RESERVATION TYPE</label>
<br/><br/>
<?php foreach($vm->reservation_type as $data): ?>

		<div class="item col-sm-6 col-md-5">
			<button class="rt_btn card card-panel btn btn-block" ref="<?php echo $data->type_id ?>">
				<b><span class="fa fa-dot-circle-o"></span> <?php echo $data->description ?></b>
			</button>
		</div>

<?php endforeach; ?>

<script type="text/javascript">

$(".card").each(function() {
    var hue = 'rgb(' + (Math.floor((256-199)*Math.random()) + 200) + ',' + (Math.floor((256-199)*Math.random()) + 200) + ',' + (Math.floor((256-199)*Math.random()) + 200) + ')';
    $(this).css("background-color", hue);
});

</script>