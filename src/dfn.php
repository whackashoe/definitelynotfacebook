<?php

require_once(__DIR__ . '/util/view.php');
require_once(__DIR__ . '/util/config.php');
require_once(__DIR__ . '/util/controller.php');

require_once(__DIR__ . '/structs/received_results.php');
require_once(__DIR__ . '/structs/sent_results.php');
require_once(__DIR__ . '/structs/view_results.php');

require_once(__DIR__ . '/models/basemodel.php');
require_once(__DIR__ . '/models/user.php');
require_once(__DIR__ . '/models/message.php');

(new Controller(new Config('root', '', 'definitelynotfacebook')))->router();
