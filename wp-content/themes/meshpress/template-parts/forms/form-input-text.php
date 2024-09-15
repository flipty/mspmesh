    <?php echo generate_tag('div', array('class'=>$data['classes'],'style'=>$data['style'])); ?>
		<label for="<?php echo $data['name']; ?>"><?php echo $data['label']; ?><?php if($data['required'] == true): ?><span>*</span><?php endif; ?></label>
		<input id="<?php echo $data['name']; ?>" name="<?php echo $data['name']; ?>" type="<?php echo $data['type'] ?>" value="">
	</div>