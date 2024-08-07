
document.getElementById('nav-select').addEventListener('change', function() {
    var value = this.value;
    if (value) {
        window.location.href = value;
    }
});
