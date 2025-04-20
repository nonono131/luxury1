<?php

require_once(dirname(__FILE__) . '/functions/functions-common.php');
require_once(dirname(__FILE__) . '/functions/functions-widget.php');
require_once(dirname(__FILE__) . '/functions/functions-custom_post.php');
require_once(dirname(__FILE__) . '/functions/placeholder.php');
require_once(dirname(__FILE__) . '/functions/video-widget.php');
if (is_admin()) require_once('functions/functions-admin.php');
else require_once('functions/functions-web.php');
