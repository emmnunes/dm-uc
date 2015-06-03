					<div class="md-overlay"></div>

				</main>

			</div>
			<!-- /page wrapper -->

			<?php get_template_part('search'); ?>

		</div>

		<!-- footer -->
		<footer class="footer" role="contentinfo">
			
			<!-- copyright -->
<!-- 					<p class="copyright">
				&copy; <?php echo date('Y'); ?> Copyright <?php bloginfo('name'); ?>. <?php _e('Powered by', 'html5blank'); ?>
				<a href="//wordpress.org" title="WordPress">WordPress</a> &amp; <a href="//html5blank.com" title="HTML5 Blank">HTML5 Blank</a>.
			</p> -->
			<!-- /copyright -->

		</footer>
		<!-- /footer -->

		<div id="overlayToggle" class="md-overlay"></div>


		<?php wp_footer(); ?>

		<!-- analytics -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-63703840-1', 'auto');
			ga('send', 'pageview');
		</script>

		<!-- uservoice -->

		<script>
		// Include the UserVoice JavaScript SDK (only needed once on a page)
		UserVoice=window.UserVoice||[];(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/2PHFk0Lsfsduy6GSnTfa9A.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})();

		//
		// UserVoice Javascript SDK developer documentation:
		// https://www.uservoice.com/o/javascript-sdk
		//

		// Set colors
		UserVoice.push(['set', {
		  accent_color: '#808283',
		  trigger_color: 'white',
		  trigger_background_color: 'rgba(46, 49, 51, 0.6)'
		}]);

		// Identify the user and pass traits
		// To enable, replace sample data with actual user traits and uncomment the line
		UserVoice.push(['identify', {
		  //email:      'john.doe@example.com', // User’s email address
		  //name:       'John Doe', // User’s real name
		  //created_at: 1364406966, // Unix timestamp for the date the user signed up
		  //id:         123, // Optional: Unique id of the user (if set, this should not change)
		  //type:       'Owner', // Optional: segment your users by type
		  //account: {
		  //  id:           123, // Optional: associate multiple users with a single account
		  //  name:         'Acme, Co.', // Account name
		  //  created_at:   1364406966, // Unix timestamp for the date the account was created
		  //  monthly_rate: 9.99, // Decimal; monthly rate of the account
		  //  ltv:          1495.00, // Decimal; lifetime value of the account
		  //  plan:         'Enhanced' // Plan name for the account
		  //}
		}]);

		// Add default trigger to the bottom-right corner of the window:
		UserVoice.push(['addTrigger', { mode: 'contact', trigger_position: 'bottom-left' }]);

		// Or, use your own custom trigger:
		//UserVoice.push(['addTrigger', '#id', { mode: 'contact' }]);

		// Autoprompt for Satisfaction and SmartVote (only displayed under certain conditions)
		UserVoice.push(['autoprompt', {}]);
		</script>

	</body>
</html>
