window.onload = function() {
    var modalShown = sessionStorage.getItem("modalShown");
    if (!modalShown) {
        openModal();
        sessionStorage.setItem("modalShown", true);
    }
}

function openModal() {
    document.getElementById("myModal").style.display = "block";
}

function closeModal() {
    document.getElementById("myModal").style.display = "none";
}

window.onclick = function(event) {
    var modal = document.getElementById("myModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}