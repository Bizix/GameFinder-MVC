/**
 * Initialization of the filtering sliders
 * 
 * @param {[HTMLElement]} sliders The array containing the elements
 * @return void
 */
function slidersInit(sliders) {
    if (sliders) {
        for (let i = 0; i < sliders.length; i++) {
            sliders[i].addEventListener("input", (e) => {
                let target = e.target;
                let input_any = target.parentElement.parentElement.querySelector("input[type=checkbox]");
                sliderValue(target, input_any);
            }, false);
        }
    }
}

/**
 * 
 * Set the consistency of the value in the range and the bullet
 * 
 * @param {HTMLElement} slider The slider Element
 * @param {HTMLElement} input_any The any amount input checkbox
 * @return void
 */
function sliderValue(slider, input_any) {
    let bulletRange = slider.previousElementSibling;
    bulletRange.innerHTML = slider.value;
    let min_value = slider.getAttribute("min");
    let bulletPosition = ((slider.value - min_value) / slider.max);
    bulletRange.style.left = (bulletPosition * 250) + "px";
    if (slider.value != min_value) {
        input_any.removeAttribute("checked");
    }
}

{
    let slidersToInit = [document.getElementById("playerRange"),
        document.getElementById("timeRange")
    ];

    slidersInit(slidersToInit);
}