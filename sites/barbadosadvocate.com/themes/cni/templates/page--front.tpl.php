<div id="page-top">
  <div class="page-inner <?php echo $grid_size ?>">

    <?php if ($page['user_menu']): ?>
      <nav id="user-menu" class="clearfix">
        <?php print render($page['user_menu']); ?>
        <?php print render($page['search_box']); ?>
        <div id="social">
          <ul class="social-links">
            <li><a class="rss" href="<?php print $base_path ?>rss.xml"></a></li>
            <li><a class="facebook" href="<?php echo $facebook ?>"></a></li>
          </ul>
        </div>
      </nav>
    <?php endif; ?>
    
    <div class="header-wrapper ">
      <div class="header-wrapper-inner ">
        <header>

          <?php if ($logo): ?>
            <div class="site-logo">
            <a href="<?php print check_url($front_page); ?>"><img
                src="<?php print $logo ?>"
                alt="<?php print $site_name; ?>"/></a>
            </div><?php print render($page['header']) ?>
          <?php endif; ?>
          
          <?php print render($page['headerad']) ?>

        </header>

      </div>
    </div>

  </div>
</div>

<?php if ($page['main_menu']): ?>
  <div class="main-menu-wrapper clearfix">
    <div class="main-menu-wrapper-inner">
      <nav id="main-menu">
        <?php print render($page['main_menu']); ?>
      </nav>
    </div>
  </div>
<?php endif; ?>

<?php if ($page['main_menu_second_level']): ?>
  <div class="main-menu-second-level-wrapper clearfix">
    <div class="main-menu-second-level-wrapper-inner">
      <nav id="main-menu-second-level">
        <?php print render($page['main_menu_second_level']); ?>
      </nav>
    </div>
  </div>
<?php endif; ?>

<div id="page">
  <div class="page-inner <?php echo $grid_size ?>">

    <!-- Main Content -->
    <div class="main-content-wrapper clearfix">
      <div class="main-content-wrapper-inner">
        <section id="main-content">

          <!-- Main 1 -->
          <div class="main clearfix">
            <div class="main-inner grid_8">

              <?php if ($page['slideshow']): ?>
                <div class="slideshow-wrapper clearfix">
                  <div class="slideshow-wrapper-inner">
                    <div id="slideshow">
                      <?php print render($page['slideshow']); ?>
                    </div>
                  </div>
                </div>
              <?php endif; ?>


              <?php if ($page['preface_1'] || $page['preface_2'] || $page['preface_3']): ?>
                <div class="preface-wrapper clearfix">
                  <div class="preface-wrapper-inner">
                    <div class="preface-wrapper-inner-inner">
                      <section id="preface">
                        <div><?php print render($page['preface_1']); ?></div>
                        <div><?php print render($page['preface_2']); ?></div>
                        <div><?php print render($page['preface_3']); ?></div>
                      </section>
                    </div>
                  </div>
                </div>
              <?php endif; ?>

            </div>

            <?php if ($page['sidebar_first']): ?>
              <aside class="sidebar first-sidebar grid_4 clearfix">
                <?php print render($page['sidebar_first']); ?>
              </aside>
            <?php endif; ?>

          </div>

        </section>
      </div>
    </div>

        <?php print render($page['content_bottom']); ?>

    <?php if ($page['postscript_1'] || $page['postscript_2'] || $page['postscript_3'] || $page['postscript_4']): ?>
      <div class="postscript-wrapper clearfix">
        <div class="postscript-wrapper-inner">
          <div class="postscript-wrapper-inner-inner">
            <section id="postscript">
              <div
                class="grid_3"><?php print render($page['postscript_1']); ?></div>
              <div
                class="grid_3"><?php print render($page['postscript_2']); ?></div>
              <div
                class="grid_3"><?php print render($page['postscript_3']); ?></div>
              <div
                class="grid_3"><?php print render($page['postscript_4']); ?></div>
            </section>
          </div>
        </div>
      </div>
    <?php endif; ?>

  </div>
</div><!-- page -->