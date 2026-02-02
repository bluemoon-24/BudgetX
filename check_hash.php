<?php
$h = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
if (password_verify('password', $h)) {
    echo "MATCH: password\n";
} else {
    echo "FAIL: password\n";
}
if (password_verify('password123', $h)) {
    echo "MATCH: password123\n";
} else {
    echo "FAIL: password123\n";
}

