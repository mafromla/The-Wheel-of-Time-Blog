// Sidebar Toggle
function openSidebar() {
    document.getElementById("mySidebar").style.display = "block";
}

function closeSidebar() {
    document.getElementById("mySidebar").style.display = "none";
}

// Wait until DOM is loaded
document.addEventListener("DOMContentLoaded", function() {

    // Slideshow
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");

        // Hide all slides
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }

        // Remove active class from all dots
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }

        // Show the current slide
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";

        // Change image every 3 seconds
        setTimeout(showSlides, 3000);
    }

    // Sorting Blog Posts
    let sortElement = document.getElementById("sort");
    if (sortElement) {
        sortElement.addEventListener("change", function() {
            let selected = this.value;
            let posts = document.querySelectorAll(".post-card");
            let postContainer = document.querySelector(".blog-feed");

            let sortedPosts = Array.from(posts).sort((a, b) => {
                if (selected === "top") {
                    return b.querySelector(".vote").innerText - a.querySelector(".vote").innerText;
                } else {
                    return new Date(b.querySelector(".post-date").innerText) - new Date(a.querySelector(".post-date").innerText);
                }
            });

            postContainer.innerHTML = "";
            sortedPosts.forEach(post => postContainer.appendChild(post));
        });
    }

    // Upvote/Downvote System
    document.querySelectorAll(".vote").forEach(button => {
        button.addEventListener("click", function() {
            let count = this.innerText.match(/\d+/)[0];
            count = parseInt(count) || 0;

            if (this.classList.contains("upvote")) {
                this.innerText = `⬆ ${count + 1}`;
            } else {
                this.innerText = `⬇ ${count - 1}`;
            }
        });
    });

    // Blog Post Preview
    let postContent = document.querySelector("#post-content");
    if (postContent) {
        postContent.addEventListener("input", function() {
            document.querySelector("#post-preview").innerText = this.value;
        });
    }

    // If you have login / user logic
    let user = localStorage.getItem("username");
    if (user && document.getElementById("profileIcon")) {
        document.getElementById("profileIcon").innerText = user.charAt(0).toUpperCase();
    }

    // Username display
    if (user && document.getElementById("usernameDisplay")) {
        document.getElementById("usernameDisplay").innerText = user;
    }

    // Logout function
    let logoutBtn = document.getElementById("logoutBtn");
    if (logoutBtn) {
        logoutBtn.addEventListener("click", function() {
            localStorage.removeItem("username");
            window.location.reload();
        });
    }

});
