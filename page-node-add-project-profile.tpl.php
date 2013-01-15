<!--This is the rough template for step 2 template also going to be made for step 1 and thank you-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<!-- Optimized mobile viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php print $head ?>
<title><?php print $head_title ?></title>
  <?php print $styles ?>
  <?php print $scripts ?>
  <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	  <!--[if lt IE 7]>
     <?php print phptemplate_get_ie_styles(); ?>
  <![endif]-->
<script type="text/javascript">  
<!--
jQuery(function($)
			{
				var win = $(window);
				// Full body scroll
				var isResizing = false;
				win.bind(
					'resize',
					function()
					{
						if (!isResizing) {
							isResizing = true;
							var container = $('#full-page-container');
							// Temporarily make the container tiny so it doesn't influence the
							// calculation of the size of the document
							container.css(
								{
									'width': 1,
									'height': 1
								}
							);
							// Now make it the size of the window...
							container.css(
								{
									'width': win.width(),
									'height': win.height()
								}
							);
							isResizing = false;
							container.jScrollPane(
								{
									'showArrows': false
								}
							);
						}
					}
				).trigger('resize');

				// Workaround for known Opera issue which breaks demo (see
				// http://jscrollpane.kelvinluck.com/known_issues.html#opera-scrollbar )
				$('body').css('overflow', 'hidden');

				// IE calculates the width incorrectly first time round (it
				// doesn't count the space used by the native scrollbar) so
				// we re-trigger if necessary.
				if ($('.widget-upper').width() != win.width()) {
					win.trigger('resize');
				}
			});
//-->
</script>
</head>
<body class="<?php print $body_classes; ?>">
  <div id="full-page-container">
	<header>
    <div class="g1"><?php /* JK removed all this
          // Prepare da header
          $site_fields = array();
          if ($site_name) $site_fields[] = check_plain($site_name);
          $site_title = implode(' ', $site_fields);
          if ($site_fields) $site_fields[0] = '<span>'. $site_fields[0] .'</span>';
          $site_html = implode(' ', $site_fields);

          if ($logo || $site_title) {
            print '<h1><a href="'. check_url($front_page) .'" title="'. $site_title .'">';
            if ($logo) {
              print '<img src="'. check_url($logo) .'" alt="'. $site_title .'" id="logo" />';
            }
            print $site_html .'</a></h1>';
          }
       */ ?></div>
    <?php if ($site_slogan): ?><div class="g2"><h2 id="site_slogan"><?php print $site_slogan ?></h2></div>
    <?php endif; ?><?php if ($mission): ?><div id="mission" class="g2">
    <?php print $mission ?>
    </div>
    <?php endif; ?>
    <?php if ($upper_right): ?>
    <div class="g2">
    <?php print $upper_right ?>
    </div>
    <?php endif; ?>
  </header>
  <div class="cf"></div>
   <div id="content">
    <?php if ($col1): ?><div class="g1"><?php print $col1; ?></div><?php endif; ?>
    <?php if ($col2): ?><div class="g1"><?php print $col2; ?></div><?php endif; ?>
    <?php if ($col3): ?><div class="g1"><?php print $col3; ?></div><?php endif; ?>
    <?php if ($feature1): ?><div class="g2"><?php print $feature1; ?></div><?php endif; ?>
    <?php if ($feature2): ?><div class="g1"><?php print $feature2 ?></div><?php endif; ?>
    <?php if ($content_top): ?><div class="g3"><?php print $content_top ?></div><?php endif; ?>

<div class="g3">
     <div class="headwrap">
       	<div class="g1"><?php if ($title): print '<h2'. ($tabs ? ' class="with-tabs"' : '') .'>'. $title .'</h2>'; endif; ?></div>
      	<div class="g2">
      	<ol id="progress">
		<li class="details-step">
			<a href="#">
			<span>About you</span> 
			Your name and email.
			<span class="arrow"></span></a>
		</li>
		<li class="project-step current">
			<a href="#">
			<strong><span>Add the project</span> 
			Add the details.</strong>
				</a>
				</li>
				<li class="fin-step last">
			<a href="#">
			<span>Finished!</span> 
			All done!
			</a>
			</li>
				</ol>
				
		<img class="logos" alt="Transition Network and Nominet Logos" src="<?php print base_path() . path_to_theme(); ?>/images/tn_nominet_logo_pse.png" />

</div>
  <div class="cf"></div>    	
	  </div>	
      <?php if ($show_messages && $messages): print $messages; endif; ?>
      <?php print $help; ?>
      <div class="helper"><a class="tooltip" href="#">Need Help?<span class="pop"><strong>What should I write?</strong><br />This simple form is for you to add details of a project that you may be involved in, or maybe you know of a project locally. Fill in as much detail as you can to describe the project.</span></a></div>
      <div class="clear-block">
      	         <?php print $content ?>
      </div>
      <?php print $feed_icons ?>
    </div>
    <?php if ($content_bottom): ?><div class="g3"><?php print $content_bottom ?></div><?php endif; ?>
  </div>
  <?php if ($footer_message === TRUE): /* JK disabled this */ ?><footer class="g3 cf"><?php print $footer_message ?></footer></div><!--end of page full for scrollbars --><?php endif; ?>
  </body>
<?php print $closure ?>
</html>