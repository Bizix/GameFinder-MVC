<div id="elt_<?= $count; ?>" class="topFive" game-id="<?= $data['id']; ?>" modal="game">
    <div class="TopFiveIcon"><?php
                                $topPosition = $count + 1;
                                echo "#$topPosition";
                                ?></div>
    <p class="topFiveTitle"><?= $data['name']; ?></p>
    <p class="topFiveText">Click to see more.</p>
</div>