<?php
/**
 * Template Name: Board Members and Creative Team
 * The Board Members and Creative Team template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Logus
 */

get_header();
?>

<div class="main-container">
	<div class="main-grid">
		<main class="main-content">
			<section class="page-content primary" role="main">
				<section id="meet-the-team">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
					the_content();
					endwhile;

					else: ?>
					<p>Sorry, no posts matched your criteria.</p>
				<?php endif; ?>
				<div class="team" id="creative">
					<h2>Creative Team</h2>
					<?php

						$boardmembers_query = new WP_Query( array(
						'post_type' => 'boardmembers',
						'posts_per_page' => '-1',
						'order' => 'ASC',
						'orderby' => 'menu_order',
						'tax_query' => array(
						  array(
							 'taxonomy' => 'boardmembers_category',
							 'field' => 'slug',
							 'terms' => 'creative'
						  )
						)
						) );
						// Display the custom loop
						if ( $boardmembers_query->have_posts() ): ?>
							<?php while ( $boardmembers_query->have_posts() ) : $boardmembers_query->the_post();

							$name = get_field('name');
							$titles = get_sub_field('title');
							$image = get_field('avatar');
							$rows = get_field('titles-creative');

							$email = get_field('email');
							?>

								<article class="member">
									<div class="front-row">
									<?php
										if( !empty($image) ): ?>
											<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
									<?php endif; ?>
										<div class="title">
											<h3 class="name">
												<?php the_field('name') ?>
											</h3>
											<?php
 
												
												if($rows)
												{ 
													 echo '<ul>';

													 foreach($rows as $row)
													 {
														  echo '<li>' . $row['title'] . '</li>';
													 }

													 echo '</ul>';
												}
											?>
											
										</div>
									</div>
									<div class="copy">
										<?php
											the_field('bio');
											// check if the repeater field has rows of data
											if( have_rows('sm') ): ?>
											<ul class="social-media">
												<?php
												// loop through the rows of data
												while ( have_rows('sm') ) : the_row();
													$platform = get_sub_field('platform');
													$link = $platform['url'];
													$name = $platform['name'];
													$email = $platform['email'];
													if($email) :
												?>
												<li class="platform email">
													<a href="mailto:<?php echo $email; ?>">
													<span class="fa-stack fa-2x">
														<i class="fas fa-circle fa-stack-2x"></i>
														<i class="fas <?php echo $name ?> fa-stack-1x fa-inverse"></i>
													</span>
													<span><?php echo $email; ?></span>
													</a>
												</li>
												<?php else: ?>
												<li class="platform sm">
													<a href="<?php echo $link['url']; ?>" target="_blank">
													<span class="fa-stack fa-2x">
														<i class="fas fa-circle fa-stack-2x"></i>
														<i class="fab <?php echo $name ?> fa-stack-1x fa-inverse"></i>
													</span>
													</a>
												</li>
												<?php endif; endwhile; ?>
									</ul>
									<?php endif; ?>
									</div>
								</article>
						<?php endwhile; wp_reset_postdata(); ?>
						<!--// end .postlist -->
					<?php endif; ?>
				</div>
				<hr>
				<div id="board" class="team">
					<h2>Board of Directors</h2>
					<?php

						$boardmembers_query = new WP_Query( array(
						'post_type' => 'boardmembers',
						'posts_per_page' => '-1',
						'tax_query' => array(
						  array(
							 'taxonomy' => 'boardmembers_category',
							 'field' => 'slug',
							 'terms' => 'bod'
						  )
						)
						) );
						// Display the custom loop
						if ( $boardmembers_query->have_posts() ): ?>
							<?php while ( $boardmembers_query->have_posts() ) : $boardmembers_query->the_post();

							$name = get_field('name');
							$titles = get_sub_field('title');
							$image = get_field('avatar');
							?>

								<article class="member">
									<div class="front-row">
									<?php
										if( !empty($image) ): ?>
											<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
									<?php endif; ?>
										<div class="title">
											<h3 class="name">
												<?php the_field('name') ?>
												<br>
												<small>
													<?php

														$rows = get_field('titles-bod');
														if($rows)
														{
															 echo '<ul>';

															 foreach($rows as $row)
															 {
																  echo '<li>' . $row['title'] . '</li>';
															 }

															 echo '</ul>';
														}
													?>
												</small>
											</h3>
										</div>
									</div>
									<div class="copy">
										<?php the_field('bio') ?>
									</div>
								</article>

						<?php endwhile; wp_reset_postdata(); ?>
						<!--// end .postlist -->
					<?php endif; ?>
				</div>
				</section>
			</section>
		</main>
	</div>
</div>
<?php get_footer(); ?>
