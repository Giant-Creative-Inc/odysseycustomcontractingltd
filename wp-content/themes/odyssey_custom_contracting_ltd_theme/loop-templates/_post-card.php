<?php
global $PostCard_args;

$cardClasses = (!empty($PostCard_args['card_classes'])) ? $PostCard_args['card_classes'] : ' horizontal mb-4';
$colClasses = (!empty($PostCard_args['col_classes'])) ? $PostCard_args['col_classes'] : '  col-md-5';
$titleClasses = (!empty($PostCard_args['title_classes'])) ? $PostCard_args['title_classes'] : ' h2 mb-3';
$showExcerpt = ($PostCard_args['show_excerpt'] === false) ? $PostCard_args['show_excerpt'] : true;

?>


	<div class="card border-0 post-card h-100 <?= $cardClasses; ?>  ">
		<div class="row h-100">
			<!-- Featured Image-->
			<?php if (has_post_thumbnail())
				echo '<div class="card-img card-img-left-md overflow-hidden  ' . $colClasses . ' "><a href="' . get_the_permalink() . '" aria-hidden="true" tabindex="-1" ><div class="post-thumbnail position-relative h-100">' . get_the_post_thumbnail(null, 'medium', array('class' => 'use-as-bg')) . '</div></a></div>';
			?>
			<div class="col d-flex align-content-center">
				<div class="card-body vert3-p-tb align-self-center">
					<!-- Title -->
					<h3 class="<?= $titleClasses; ?>">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h3>
					<!-- Meta -->
					<?php if ('post' === get_post_type()) : ?>
						<div class="text-muted mb-3 text-uppercase">
							<span>
							<?php
							understrap_posted_on();
							?>
							</span>
						</div>
					<?php endif; ?>
					<!-- Excerpt & Read more -->
					<div class="card-text text-black-50 mt-auto d-none <?= ($showExcerpt) ? ' d-sm-block ' : ''; ?>">
						<?php the_excerpt(); ?>
					</div>
					<div class="pt-3 d-sm-none ">
						<a class="read-more text-dark understrap-read-more-link" href="<?php the_permalink(); ?>">Read more <i class="fal fa-arrow-right ml-2"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
unset($PostCard_args);
