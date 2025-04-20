<?php
global $cast_post_id, $cast_ranking_no, $cast_date;
if (!isset($cast_date)) $cast_date = current_time('Ymd');
$post_id = empty($cast_post_id) ? $post->ID : $cast_post_id;
?>
<article class="col-lg-3 col-sm-4 col-6 mb-4">
    <div class="staff-card">
        <?php if ($cast_ranking_no > 0) : ?>
            <div class="ranking-badge">
                <i class="fa fa-trophy" aria-hidden="true"></i><span>No.<?php echo $cast_ranking_no;?></span>
            </div>
        <?php endif; ?>
        <div class="staff-card__img">
            <?php if (get_post_thumbnail_id($post_id)) : ?>
                <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post_id)); ?>" alt="<?php echo get_the_title($post_id); ?>">
            <?php elseif (get_option('cast_noimg_img')) : ?>
                <img src="<?php echo esc_attr(get_option('cast_noimg_img')); ?>" alt="<?php echo get_the_title($post_id); ?>">
            <?php else : ?>
                <div class="no-image">
                    <span>NO IMAGE</span>
                </div>
            <?php endif; ?>
            
            <?php if (get_post_meta($post_id, current_time('Ymd') . '_from', true) != '' && get_post_meta($post_id, current_time('Ymd') . '_to', true) != '') : ?>
                <div class="today-badge">本日出勤</div>
            <?php endif; ?>
        </div>
        
        <div class="staff-card__info">
            <h3 class="staff-card__name"><?php echo get_the_title($post_id); ?></h3>
            
            <div class="staff-card__details">
                <?php if (get_post_meta($post_id, 'age', true) != '') : ?>
                    <span class="age"><?php echo get_post_meta($post_id, 'age', true); ?>歳</span>
                <?php endif; ?>
                
                <?php if (get_post_meta($post_id, 'T', true) != '' || get_post_meta($post_id, 'B', true) != '' || get_post_meta($post_id, 'cup', true) != '' || get_post_meta($post_id, 'W', true) != '' || get_post_meta($post_id, 'H', true) != '') : ?>
                    <div class="size-info">
                        <?php if (get_post_meta($post_id, 'T', true) != '') echo 'T:' . get_post_meta($post_id, 'T', true) . ' '; ?><?php if (get_post_meta($post_id, 'B', true) != '') echo 'B:' . get_post_meta($post_id, 'B', true); ?><?php if (get_post_meta($post_id, 'cup', true) != '') echo '(' . get_post_meta($post_id, 'cup', true) . ')'; ?><?php if (get_post_meta($post_id, 'W', true) != '') echo ' W:' . get_post_meta($post_id, 'W', true); ?><?php if (get_post_meta($post_id, 'H', true) != '') echo ' H:' . get_post_meta($post_id, 'H', true); ?>
                    </div>
                <?php endif; ?>
                
                <?php
                if ($cast_ranking_no == 0) {
                    $tags = wp_get_post_terms($post_id, 'cast_tag', [
                        'order' => 'ASC',
                        'orderby' => 'slug',
                    ]);
                    if ($tags) : ?>
                        <div class="tag-list">
                            <?php foreach($tags as $tag) : ?>
                                <span class="tag-item"><?php echo $tag->name; ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif;
                }
                ?>
            </div>
            
            <div class="staff-card__schedule">
                <?php if (get_post_meta($post_id, $cast_date . '_from', true) != '' && get_post_meta($post_id, $cast_date . '_to', true) != '') : ?>
                    <?php if ($cast_date == current_time('Ymd')) : ?>
                        <span class="today-text">本日</span>
                    <?php endif; ?>
                    <span class="time"><?php echo conv_to_disp(get_post_meta($post_id, $cast_date . '_from', true)); ?> 〜 <?php echo conv_to_disp(get_post_meta($post_id, $cast_date . '_to', true)); ?></span>
                <?php else : ?>
                    <span class="off-day">お休み</span>
                <?php endif; ?>
            </div>
            
            <a href="<?php the_permalink($post_id); ?>" class="profile-link">プロフィール</a>
        </div>
    </div>
</article>
