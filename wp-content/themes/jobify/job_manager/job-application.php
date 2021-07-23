<?php
/**
 * Show job application when viewing a single job listing.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-application.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Astoundify
 * @package     Jobify
 * @category    Template
 * @version     1.31.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<?php if ( $apply = get_the_job_application_method() ) :
	wp_enqueue_script( 'wp-job-manager-job-application' );
	?>
	<div class="job_application application">
		<?php do_action( 'job_application_start', $apply ); ?>

		<?php if ( 'url' == $apply->type ) : // Use link for URL type. ?>

			<a href="<?php echo esc_url( $apply->url ); ?>" target="_blank" class="application_button_link button" rel="nofollow"><?php esc_html_e( 'Apply for job', 'jobify' ); ?></a>

		<?php else : // Open modal for other type. ?>

			<input type="button" class="application_button button" value="<?php esc_attr_e( 'Apply for job', 'jobify' ); ?>" />

			<div class="application_details">
				<?php
					/**
					 * job_manager_application_details_email or job_manager_application_details_url hook
					 */
					do_action( 'job_manager_application_details_' . $apply->type, $apply );
				?>
			</div>

		<?php endif; ?>

		<?php do_action( 'job_application_end', $apply ); ?>
	</div>
<?php endif; ?>
