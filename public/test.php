<?php
if (function_exists('putenv')) {
    echo 'putenv() is available';
    putenv('TEST_ENV=HelloWorld');
    echo '<br>TEST_ENV: ' . getenv('TEST_ENV');
} else {
    echo 'putenv() is not available';
}
?>
