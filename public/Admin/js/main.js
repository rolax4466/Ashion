document.addEventListener('DOMContentLoaded', function () {
    // Function to fade out and remove an element
    function fadeOut(el, duration) {
        el.style.opacity = 1;
        (function fade() {
            if ((el.style.opacity -= 0.1) < 0) {
                el.style.display = "none";
            } else {
                setTimeout(fade, duration / 10);
            }
        })();
    }

    // Select the alert elements
    var successAlert = document.getElementById('success-alert');
    var errorAlert = document.getElementById('error-alert');

    // If success alert exists, fade it out after 3 seconds
    if (successAlert) {
        setTimeout(function () {
            fadeOut(successAlert, 3000);
        }, 3000); // Wait 3 seconds before starting fade out
    }

    // If error alert exists, fade it out after 3 seconds
    if (errorAlert) {
        setTimeout(function () {
            fadeOut(errorAlert, 3000);
        }, 3000); // Wait 3 seconds before starting fade out
    }
});
