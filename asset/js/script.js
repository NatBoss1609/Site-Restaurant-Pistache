document.addEventListener("DOMContentLoaded", function() {
    var reservationForm = document.getElementById("reservation-form");
    reservationForm.addEventListener("submit", function(event) {
        event.preventDefault();
        var nombrePersonnes = document.getElementById("nombre_personnes").value;
        var heureArrivee = document.getElementById("heure_arrivee").value;
        var intolerances = document.getElementById("intolerances").value;
        var message = "Nouvelle réservation :\n\n";
        message += "Nombre de personnes : " + nombrePersonnes + "\n";
        message += "Heure d'arrivée : " + heureArrivee + "\n";
        message += "Intolérances alimentaires : " + intolerances;
        alert(message);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.liens_menu');
    navLinks.forEach(link => {
        if (link.getAttribute('href').includes(currentPage)) {
            link.classList.add('active');
        }
    });
});