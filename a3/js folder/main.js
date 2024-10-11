// Navigation handling for the select dropdown
document.getElementById('nav-select').addEventListener('change', function() {
    var value = this.value;
    if (value) {
        window.location.href = value;
    }
});

// Image gallery hover effect for overlay
document.querySelectorAll('.gallery-item').forEach(function(item) {
    item.addEventListener('mouseover', function() {
        var overlay = this.querySelector('.overlay');
        if (overlay) {
            overlay.style.opacity = '1';
        }
    });
    item.addEventListener('mouseout', function() {
        var overlay = this.querySelector('.overlay');
        if (overlay) {
            overlay.style.opacity = '0';
        }
    });
});

// Form submission for add.php (this handles image uploads)
document.getElementById('add-pet-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from submitting the default way

    // Collect form data
    var formData = new FormData(this);

    // Send form data to the server using Fetch API
    fetch('process_add.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Pet added successfully!");
            window.location.href = "pets.php";
        } else {
            alert("Error adding pet: " + data.message);
        }
    })
    .catch((error) => {
        console.error('Error:', error);
        alert("An error occurred while adding the pet.");
    });
});

// Pet details navigation
document.querySelectorAll('.pet-table-container td a').forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        var petId = this.getAttribute('href').split('id=')[1];
        window.location.href = 'details.php?id=' + petId;
    });
});

// Bootstrap carousel auto-slide and manual slide handling
var myCarousel = document.querySelector('#carouselExampleControls');
var carousel = new bootstrap.Carousel(myCarousel, {
  interval: 3000, // Auto-slide every 3 seconds
  ride: 'carousel'
});

// Function to reset auto-slide after manual slide
function resetCarouselInterval() {
    clearTimeout(carouselTimeout); // Clear any existing timeout
    carousel.pause(); // Pause the auto-slide
    carouselTimeout = setTimeout(function() {
        carousel.cycle(); // Restart auto-slide after delay
    }, 5000); // Delay auto-slide restart by 5 seconds
}

// Manual slide control with reset
document.querySelector('.carousel-control-prev').addEventListener('click', function() {
    carousel.prev();
    resetCarouselInterval(); // Reset interval after manual slide
});

document.querySelector('.carousel-control-next').addEventListener('click', function() {
    carousel.next();
    resetCarouselInterval(); // Reset interval after manual slide
});

// Declare a timeout variable for carousel reset
var carouselTimeout = setTimeout(function() {
    carousel.cycle(); // Start the initial auto-slide
}, 3000);
