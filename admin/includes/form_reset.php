<?php

if(isset($_SESSION['last_visit_time'])) {
    $last_visit_time = $_SESSION['last_visit_time'];
    $current_time = time();
    $time_difference = $current_time - $last_visit_time;
    $time_threshold = 30 * 60;

    if($time_difference > $time_threshold) {
        ?>
        <script>
            const formInputs = document.querySelectorAll('input, select');

            formInputs.forEach(input => {
                localStorage.removeItem(input.id)
            })
        </script>
        <?php
    }
}

$_SESSION['last_visit_time'] = time();

?>