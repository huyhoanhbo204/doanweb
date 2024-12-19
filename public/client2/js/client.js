document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.querySelector(".main-content");
    const overlay = document.querySelector(".sidebar-overlay");
    const mobileSidebarToggle = document.getElementById("mobileSidebarToggle");
    const sidebarToggler = document.querySelector(".sidebar-toggler");

    // Function to check if we're on mobile
    const isMobile = () => window.innerWidth < 992;

    // Toggle sidebar function
    function toggleSidebar() {
        if (isMobile()) {
            sidebar.classList.toggle("show");
            overlay.classList.toggle("show");
            document.body.style.overflow = sidebar.classList.contains("show")
                ? "hidden"
                : "";
        } else {
            sidebar.classList.toggle("collapsed");
            // Update main content margin and width
            if (sidebar.classList.contains("collapsed")) {
                mainContent.style.marginLeft = "70px";
                mainContent.style.width = "calc(100% - 70px)";
            } else {
                mainContent.style.marginLeft = "";
                mainContent.style.width = "";
            }
        }
    }

    // Mobile sidebar toggle
    if (mobileSidebarToggle) {
        mobileSidebarToggle.addEventListener("click", function (e) {
            e.stopPropagation();
            if (isMobile()) {
                toggleSidebar();
            }
        });
    }

    // Desktop sidebar toggle
    if (sidebarToggler) {
        sidebarToggler.addEventListener("click", function (e) {
            e.stopPropagation();
            if (!isMobile()) {
                toggleSidebar();
                // Toggle icon direction
                const icon = this.querySelector("i");
                icon.classList.toggle("fa-angles-left");
                icon.classList.toggle("fa-angles-right");
            }
        });
    }

    // Close sidebar when clicking overlay
    if (overlay) {
        overlay.addEventListener("click", function () {
            if (sidebar.classList.contains("show")) {
                toggleSidebar();
            }
        });
    }

    // Handle window resize
    let resizeTimer;
    window.addEventListener("resize", function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            if (isMobile()) {
                // Reset desktop styles
                sidebar.classList.remove("collapsed");
                mainContent.style.marginLeft = "";
                mainContent.style.width = "";

                // Close mobile sidebar if open
                if (sidebar.classList.contains("show")) {
                    sidebar.classList.remove("show");
                    overlay.classList.remove("show");
                    document.body.style.overflow = "";
                }
            } else {
                // Reset mobile styles
                sidebar.classList.remove("show");
                overlay.classList.remove("show");
                document.body.style.overflow = "";
            }
        }, 250);
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener("click", function (e) {
        if (
            isMobile() &&
            sidebar.classList.contains("show") &&
            !sidebar.contains(e.target) &&
            !mobileSidebarToggle.contains(e.target)
        ) {
            toggleSidebar();
        }
    });

    // Handle active state for navigation links
    const currentPage =
        window.location.pathname.split("/").pop() || "index.html";
    document.querySelectorAll(".nav-link").forEach((link) => {
        const href = link.getAttribute("href");
        if (href === currentPage) {
            link.classList.add("active");
        }
    });
});
