<?php

/**
 * @file
 * Theme template for a list of tweets.
 *
 * Available variables in the theme include:
 *
 * 1) An array of $tweets, where each tweet object has:
 *   $tweet->id
 *   $tweet->username
 *   $tweet->userphoto
 *   $tweet->text
 *   $tweet->timestamp
 *   $tweet->time_ago
 *
 * 2) $twitkey string containing initial keyword.
 *
 * 3) $title
 *
 */
?>
<?php if ($lazy_load): ?>
  <?php print $lazy_load; ?>
<?php else: ?>

<div id="twitterfeed" class="tweets-pulled-listing">

  <?php if (!empty($title)): ?>
    <h2><?php print $title; ?></h2>
  <?php endif; ?>

  <?php if (is_array($tweets)): ?>
    <?php $tweet_count = count($tweets); ?>
    
    <ul class="tweets-pulled-listing">
    <?php foreach ($tweets as $tweet_key => $tweet): ?>
    	<?php 
				$tweetsclass = "";
				if ($tweet_key == 0): $tweetsclass = "first"; endif; 
			?>
      <li class="<?php print $tweetsclass;?>">
        <span class="tweet-text"><?php print twitter_pull_add_links($tweet->text); ?></span>
        <div class="tweet-time"><?php print l($tweet->time_ago, 'http://twitter.com/' . $tweet->username . '/status/' . $tweet->id);?></div>

        <?php if ($tweet_key == 0): $tweetsclass = " first"; endif; ?>
        
      </li>
    <?php endforeach; ?>
    </ul>
    <div class="twitterfollow">Follow <?php print l('@'.$tweet->username, 'http://twitter.com/' . $tweet->username); ?></div>
  <?php endif; ?>
</div>

<?php endif; ?>
