<?php

namespace RVOLA\WPOMP;

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

require_once __DIR__ . '/class/UploadPath.php';

// The plugin never ran on a legacy ms-files network: its values there belong to core.
if (!UploadPath::isSupported()) {
    return;
}

if (!is_multisite()) {
    UploadPath::reset();

    return;
}

foreach (get_sites(['fields' => 'ids', 'number' => 0]) as $siteId) {
    switch_to_blog($siteId);
    UploadPath::reset();
    restore_current_blog();
}
