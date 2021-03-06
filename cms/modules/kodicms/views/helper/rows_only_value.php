<?php 
if(empty($data))
	$data = array();

if(empty($container))
	$container = 'rows-container';

if(empty($field))
	$field = 'data';

$container = URL::title($container);
$field = URL::title($field, '_');
?>

<script type="text/javascript">
	var ROWS_DATA = <?php echo json_encode($data); ?>;
	
	$(function() {
		var $container = $('#<?php echo $container; ?>');

		$container.on('click', '.add-row', function(e) {
			clone_row($container);
			e.preventDefault();
		});
		
		$container.on('click', '.remove-row', function(e) {
			$(this).parent().parent().remove();
			e.preventDefault();
		});

		for(key in ROWS_DATA) {
			row = clone_row($container);
			row.find('.row-value').val(ROWS_DATA[key]);
		}
	});
	
	function clone_row($container) {
		return $('.row-helper.hidden', $container)
			.clone()
			.removeClass('hidden')
			.appendTo($('.rows-container', $container))
			.find(':input')
			.removeAttr('disabled')
			.end();
	}
</script>

<div class="control-group" id="<?php echo $container; ?>">
	<?php if(!empty($label)): ?><label class="control-label"><?php echo $label; ?></label><?php endif; ?>
	<div class="controls">
		<div class="row-helper hidden">
			<div class="input-append">
				<input type="text" name="<?php echo $field; ?>[]" disabled="disabled" class="input-xxlarge row-value" placeholder="<?php echo __('Value'); ?>">
				<button class="btn btn-warning remove-row"><?php echo UI::icon('trash-o'); ?></button>
				<br /><br />
			</div>
		</div>
		<div class="rows-container"></div>
		<button class="add-row btn" hotkeys="ctrl+a"><?php echo UI::icon('plus'); ?></button>
	</div>
</div>