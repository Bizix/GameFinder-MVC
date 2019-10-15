<div class="container">
    <span style="display:none;"><?= $userRating; ?></span>
    <?php
        if (isset($_SESSION['id'])) {
            echo '
        <div class="rate">
            <div id="1" class="btn-1 rate-btn"></div>
            <div id="2" class="btn-2 rate-btn"></div>
            <div id="3" class="btn-3 rate-btn"></div>
            <div id="4" class="btn-4 rate-btn"></div>
            <div id="5" class="btn-5 rate-btn"></div>
        </div>';
        }
    ?>
    <br>
    <div class="box-result">
        <div class="result-container">
            <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
            <div class="rate-stars"></div>
        </div>
        <p style="margin:5px 0px; font-size:16px; text-align:center">Rated
            <strong><?php echo substr($rate_value, 0, 3); ?></strong> stars out of <?php echo $rate_times; ?>
            Votes(s)
        </p>
    </div>
</div>
