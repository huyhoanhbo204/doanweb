'use strict';

/**
 * Navbar toggle in mobile
 */
const navbar = document.querySelector("[data-navbar]");
const navToggleBtn = document.querySelector("[data-nav-toggle-btn]");
const searchContainer = document.querySelector("[data-search-wrapper]");
const searchBtn = document.querySelector("[data-search-btn]");

navToggleBtn.addEventListener("click", () => {
    if (navToggleBtn.classList.contains("active") && navbar.classList.contains("active")) {
        navbar.classList.toggle("active");
        navToggleBtn.classList.toggle("active");
    } else {
        closeAllPanels();
        closeAllBtn();
        navbar.classList.add("active");
        navToggleBtn.classList.add("active");
    }
});

/**
 * Search toggle
 */
searchBtn.addEventListener("click", () => {
    if (searchContainer.classList.contains("active")) {
        searchContainer.classList.toggle("active");
    } else {
        closeAllPanels();
        closeAllBtn();
        searchContainer.classList.add("active");
    }
});

/**
 * Wishlist, Cart and User toggle
 */
const panelBtns = document.querySelectorAll("[data-panel-btn]");
const sidePanels = document.querySelectorAll("[data-side-panel]");

panelBtns.forEach(panelBtn => {
    panelBtn.addEventListener("click", () => {
        const panelType = panelBtn.getAttribute("data-panel-btn");

        const sidePanel = document.querySelector(`[data-side-panel="${panelType}"]`);

        if (sidePanel.classList.contains("active")) {
            sidePanel.classList.toggle("active");
            panelBtn.classList.toggle("active");
        } else {
            closeAllPanels();
            closeAllBtn();
            sidePanel.classList.add("active");
            panelBtn.classList.add("active");
        }

    });
});

/**
 * Function to close all panels
 */

function closeAllPanels() {
    navbar.classList.remove("active");
    navToggleBtn.classList.remove("active");
    searchContainer.classList.remove("active");
    sidePanels.forEach(panel => {
        panel.classList.remove("active");
    });
}

function closeAllBtn() {
    panelBtns.forEach(panelBtn => {
        panelBtn.classList.remove("active");
    })
}


/**
 * header sticky and back to top btn
 */

const header = document.querySelector("[data-header]");

const backToTopBtn = document.querySelector("[data-back-top-btn]")

const navbarSlide = document.querySelector(".nav-wrapper");

window.addEventListener("scroll", () => {
    header.classList[window.scrollY > 240 ? "add" : "remove"]("active")
    navbarSlide.classList[window.scrollY > 240 ? "add" : "remove"]("active") 
    backToTopBtn.classList[window.scrollY > 240 ? "add" : "remove"]("active")
})


/**
 * Move cycle to scroll
 */

const deliveryBoy = document.querySelector("[data-delivery-boy]");

let deliveryBoyMove = 80;

let lastScrollPos = 0;

window.addEventListener("scroll", function () {

    let deliveryBoyTopPos = deliveryBoy.getBoundingClientRect().top;

    if (deliveryBoyTopPos < 500 && deliveryBoyTopPos > -250) {

        let activeScrollPos = window.scrollY;

        if (lastScrollPos < activeScrollPos) {
            
            deliveryBoyMove++;

        } else {

            deliveryBoyMove--;

        }

        lastScrollPos = activeScrollPos;

        deliveryBoy.style.transform = `translateX(${deliveryBoyMove}px)`

    }
})


/**
 * Payment Change Tab
 */

const tabBtn = document.querySelectorAll("button[data-tab-btn]");

const allTab = document.querySelectorAll("[data-payment-tab]");

tabBtn.forEach(activeBtn => {
    activeBtn.addEventListener("click" ,() => {
        tabBtn.forEach(button => {button.classList.remove("active")});
        allTab.forEach(tab => {tab.classList.remove("active")});
        activeBtn.classList.add("active");
        document.querySelector(`[data-payment-tab="${activeBtn.dataset.tabBtn}"]`).classList.add("active");

        const icon = activeBtn.querySelector("ion-icon[data-checkmark-circle]");
        if (icon) {
            icon.setAttribute("name", "checkmark-circle");
        }

        tabBtn.forEach(btn => {
            if (btn !== activeBtn) {
                const icon = btn.querySelector("ion-icon[data-checkmark-circle]");
                if (icon) {
                    icon.setAttribute("name", "checkmark-circle-outline");
                }
            }
        })
    })
})