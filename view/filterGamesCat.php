<h3>Find your game</h3>
<form action="index.php?action=searchResults" method="POST" id="filterForm">
    <input type="hidden" name="filterCat" value="filterCat" />
    <div id="filterFormContainer">
        <div class="leftSideForm">
            <p>Location:</p>
            <div class="placesContainer">
                <!-- <p>Location</p> -->
                <fieldset class="placesFieldset checkBoxStyle">
                    <legend class="placesLegend">
                        <input type="checkbox" name="location[]" value="indoor" id="indoor"
                            <?= isset($checks["indoor"]) ?  'checked' : ''; ?> />
                        <label for="indoor"><span></span>Indoor</label>
                    </legend>
                    <div class="placesCheckboxes">
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="location[]" value="bar" id="bar"
                                <?= isset($checks["bar"]) ?  'checked' : ''; ?> />
                            <label for="bar"><span></span> Bar</label>
                        </div>
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="location[]" value="house" id="house"
                                <?= isset($checks["house"]) ?  'checked' : ''; ?> />
                            <label for="house"><span></span>House</label>
                        </div>
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="location[]" value="school" id="school"
                                <?= isset($checks["school"]) ?  'checked' : ''; ?> />
                            <label for="school"><span></span>School</label>
                        </div>
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="location[]" value="office" id="office"
                                <?= isset($checks["office"]) ?  'checked' : ''; ?> />
                            <label for="office"><span></span>Office</label>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="placesFieldset checkBoxStyle">
                    <legend class="placesLegend">
                        <input type="checkbox" name="location[]" value="outdoor" id="outdoor"
                            <?= isset($checks["outdoor"]) ?  'checked' : ''; ?> />
                        <label for="outdoor"><span></span>Outdoor</label>
                    </legend>
                    <div class="placesCheckboxes">
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="location[]" value="beach" id="beach"
                                <?= isset($checks["beach"]) ? 'checked' : ''; ?> />
                            <label for="beach"><span></span>Beach</label>
                        </div>
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="location[]" value="car" id="car"
                                <?= isset($checks["car"]) ?  'checked' : ''; ?> />
                            <label for="car"><span></span>Car</label>
                        </div>
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="location[]" value="plane" id="plane"
                                <?= isset($checks["plane"]) ?  'checked' : ''; ?> />
                            <label for="plane"><span></span>Plane</label>
                        </div>
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="location[]" value="boat" id="boat"
                                <?= isset($checks["boat"]) ?  'checked' : ''; ?> />
                            <label for="boat"><span></span>Boat</label>
                        </div>
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="location[]" value="park" id="park"
                                <?= isset($checks["park"]) ?  'checked' : ''; ?> />
                            <label for="park"><span></span>Park</label>
                        </div>
                    </div>
                </fieldset>
            </div>
            <p>Social Setting:</p>
            <div class="settingContainer">
                <!-- <p>Social Setting:</p> -->
                <fieldset class="settingFieldset">
                    <legend class="settingLegend"></legend>
                    <div class="settingCheckboxes">
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="social[]" value="partyWork" id="partyWork"
                                <?= isset($checks["partyWork"]) ?  'checked' : ''; ?> />
                            <label for="partyWork"><span></span>Work Party</label>
                        </div>
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="social[]" value="partyFriends" id="partyFriends"
                                <?= isset($checks["partyFriends"]) ?  'checked' : ''; ?> />
                            <label for="partyFriends"><span></span>Friends Party</label>
                        </div>
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="social[]" value="family" id="family"
                                <?= isset($checks["family"]) ?  'checked' : ''; ?> />
                            <label for="family"><span></span>Family</label>
                        </div>
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="social[]" value="date" id="date"
                                <?= isset($checks["date"]) ?  'checked' : ''; ?> />
                            <label for="date"><span></span>Date</label>
                        </div>
                    </div>
                    <div class="settingCheckboxes">
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="social[]" value="camping" id="camping"
                                <?= isset($checks["camping"]) ?  'checked' : ''; ?> />
                            <label for="camping"><span></span>Camping</label>
                        </div>
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="social[]" value="icebreaker" id="icebreaker"
                                <?= isset($checks["icebreaker"]) ?  'checked' : ''; ?> />
                            <label for="icebreaker"><span></span>Icebreaker</label>
                        </div>
                        <div class="checkBoxStyle">
                            <input type="checkbox" name="social[]" value="classmates" id="classmates"
                                <?= isset($checks["classmates"]) ?  'checked' : ''; ?> />
                            <label for="classmates"><span></span>Classmates</label>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="rightSideForm">
            <div class="prepAmount">
                <p>Amount of preparation:</p>
                <div class="radioGroup">
                    <input type="radio" id="low" name="prepSelector" value="min"
                        <?= (isset($checks['prep']) and $checks['prep'] == "min") ? "checked" : ""; ?> />
                    <label for="low">Low</label>
                    <input type="radio" id="medium" name="prepSelector" value="med"
                        <?= (isset($checks['prep']) and $checks['prep'] == "med") ? "checked" : ""; ?> />
                    <label for="medium">Medium</label>
                    <input type="radio" id="max" name="prepSelector" value="max"
                        <?= (isset($checks['prep']) and $checks['prep'] == "max") ? "checked" : ""; ?> />
                    <label for="max">Max</label>
                </div>
            </div>
            <div class="isDrink">
                <p>Drinking game? </p>
                <div class="radioGroup">
                    <input type="radio" id="yes" name="drink" value="drink"
                        <?= (isset($checks['drink']) and $checks['drink'] == "drink") ? "checked" : ""; ?> /><label
                        for="yes">Yes</label>
                    <input type="radio" id="no" name="drink" value="nodrink"
                        <?= (isset($checks['drink']) and $checks['drink'] == "nodrink") ? "checked" : ""; ?> /><label
                        for="no">No</label>
                </div>
            </div>
            <div class="playerRangeContainer">
                <!-- <p>Number of players:</p> -->
                <div class="rangeSlider">
                    <span id="playerBullet" class="playerSliderLabel"><?php if (isset($checks['players']) and $checks['players'] != 'anyP') {
                                                                            echo $checks['players'];
                                                                        } else {
                                                                            echo '2';
                                                                        } ?></span>
                    <input id="playerRange" class="slider" name="playerRange" type="range" value=<?php if (isset($checks['players']) and $checks['players'] != "anyP") {
                                                                                                        echo $checks['players'];
                                                                                                    } else {
                                                                                                        echo "2";
                                                                                                    } ?> min="2"
                        max="20">
                </div>
                <div class="playerBoxMinmax">
                    <span>2</span>
                    <span>20+</span>
                </div>
                <div class="checkBoxStyle-THIS-IS-BREAKING-THE-CHECKBOX">
                    <input type="checkbox" name="anyP" id="anyP" value="1" <?php if (isset($checks['players']) and $checks['players'] == "anyP") {
                                                                                echo "checked";
                                                                            } else {
                                                                                echo "";
                                                                            } ?> />
                    <label><span></span>Any amount of players</label>
                </div>
            </div>
            <div class="timeRange">
                <!-- <p>Time:</p> -->
                <div id="timeSlider" class="range-slider ">
                    <span id="timeBullet" class="timeSliderLabel"><?php if (isset($time) and $time != 'anyT') {
                                                                        echo $time;
                                                                    } else {
                                                                        echo '5';
                                                                    } ?></span>
                    <input id="timeRange" type="range" min="5" max="60" value=<?php if (isset($checks['time']) and $checks['time'] != "anyT") {
                                                                                    echo $checks['time'];
                                                                                } else {
                                                                                    echo "5";
                                                                                } ?> class="slider" name="timeRange">
                </div>
                <div class=" timeBoxMinmax">
                    <span>5</span>
                    <span>60+</span>
                </div>
                <div>
                    <label><input type="checkbox" name="anyT" value="1" id="anyT" <?php if (isset($checks['time']) and $checks['time'] == "anyT") {
                                                                                        echo "checked";
                                                                                    } else {
                                                                                        echo "";
                                                                                    } ?>>Any amount of time
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="FromButton">
        <button type="submit" id="subscribe">Find!</button>
        <!-- <button type="reset" id="reset">Reset</button> -->
    </div>
</form>