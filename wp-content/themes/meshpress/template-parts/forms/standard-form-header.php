	
    <div class="form-header">
        <?php if($form_heading = get_field('acf_form_heading')): ?>
        <h2 clsas="heading"><?php echo $form_heading ?></h2>
        <?php endif; ?>
        <?php if($form_subhead = get_field('acf_form_subhead')): ?>
        <p><?php echo $form_subhead ?></p>
        <?php endif; ?>
        <?php if($featured = get_post_thumbnail_id()): ?>
        <img src="<?php echo wp_get_attachment_url($featured); ?>" alt="Featured Image" />
        <?php endif; ?>    
    </div>
