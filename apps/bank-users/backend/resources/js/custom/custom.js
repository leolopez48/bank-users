window.onload = function () {




    // Toggle the side navigation
    var sidebarToggle = document.querySelectorAll("#sidebarToggle, #sidebarToggleTop");
    sidebarToggle.forEach(function (element) {
        element.addEventListener('click', function (e) {
            document.body.classList.toggle("sidebar-toggled");
            document.querySelector(".sidebar").classList.toggle("toggled");
            if (document.querySelector(".sidebar").classList.contains("toggled")) {
                document.querySelectorAll('.sidebar .collapse').forEach(function (collapse) {
                    collapse.classList.remove("show");
                });
            }
        });
    });

    // Close any open menu accordions when window is resized below 768px
    window.addEventListener('resize', function () {
        if (window.innerWidth < 768) {
            document.querySelectorAll('.sidebar .collapse').forEach(function (collapse) {
                collapse.classList.remove("show");
            });
        }

        // Toggle the side navigation when window is resized below 480px
        if (window.innerWidth < 480 && !document.querySelector(".sidebar").classList.contains("toggled")) {
            document.body.classList.add("sidebar-toggled");
            document.querySelector(".sidebar").classList.add("toggled");
            document.querySelectorAll('.sidebar .collapse').forEach(function (collapse) {
                collapse.classList.remove("show");
            });
        }
    });


    var sidebar = document.querySelector('body.fixed-nav .sidebar');

    sidebar.addEventListener("DOMMouseScroll", (event) => {
        if (window.innerWidth > 768) {
            e.preventDefault();
            sidebar.scrollTop += (e.detail > 0 ? 1 : -1) * 30;
        }
    });

    // Scroll to top button appear
    window.addEventListener('scroll', function () {
        var scrollDistance = document.documentElement.scrollTop || document.body.scrollTop;
        if (scrollDistance > 100) {
            document.querySelector('.scroll-to-top').style.display = 'block';
        } else {
            document.querySelector('.scroll-to-top').style.display = 'none';
        }
    });
}
