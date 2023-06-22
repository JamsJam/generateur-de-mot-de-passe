
/**
 * 
 * @param {Array} arrShow 
 * @param {Array} arrHide
 * @returns {void}
 * @description This function is used to toggle the visibility of the password card
 *             and the password reset card.
 *   
 */
function TogglePasswordCard(arrShow, arrHide){
    arrShow.forEach(element => {
        element.style.display="flex";
        element.setAttribute("access","true")
    });
    arrHide.forEach(element => {
        element.style.display="none";
        element.setAttribute("access","false")
    });
}

