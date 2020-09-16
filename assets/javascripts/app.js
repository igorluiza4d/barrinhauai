(function() {
    "use strict";
    var classNameWrapper = "js-btn-wrapper";
    var classNameBtnToggle = "js-btn-toggle";
    var classNameList = "js-btn-list";
    var classNameBtnClose = "js-btn-close";
    var classNameBtnOverlay = "js-btn-overlay";
    var classNameOpenningList = "uai-opening-list-fix";
    var classNameHiddenAll = "uai-hidde-all-btnfixed";
    var btnWrapper = document.getElementById(classNameWrapper);
    var btnToggleFixed = document.getElementById(classNameBtnToggle);
    var btnCloseFixedBtn = document.getElementById(classNameBtnClose);
    var btnOverlay = document.getElementById(classNameBtnOverlay);
    btnToggleFixed.addEventListener("click", toggleMenu);
    btnCloseFixedBtn.addEventListener("click", removeBtn);
    btnOverlay.addEventListener("click", disableList);
    function toggleMenu(e) {
        btnWrapper.classList.contains(classNameOpenningList) ? btnWrapper.classList.remove(classNameOpenningList) : btnWrapper.classList.add(classNameOpenningList);
        e.preventDefault();
    }
    function removeBtn(e) {
        btnWrapper.classList.add(classNameHiddenAll);
        btnWrapper.classList.remove(classNameOpenningList);
        e.preventDefault();
    }
    function disableList(e) {
        btnWrapper.classList.remove(classNameOpenningList);
        e.preventDefault();
    }
})();