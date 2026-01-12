document.addEventListener('DOMContentLoaded', function() {
    
    const radioUnJour = document.getElementById('CC');          
    const radioPlusieursJours = document.getElementById('CCB');
    
    const divDateFin = document.getElementById('divDateFin');  
    const inputDateFin = document.getElementById('dateFin');    


    if(!radioUnJour || !radioPlusieursJours || !divDateFin || !inputDateFin) {
        console.error("Erreur : Un des éléments HTML (ID) est introuvable pour la gestion des dates.");
        return;
    }

    function toggleDates() {
        if (radioPlusieursJours.checked) {
            // Cas : Plusieurs jours
            divDateFin.style.display = 'block';        
            inputDateFin.setAttribute('required', ''); 
        } else {
            divDateFin.style.display = 'none';         
            inputDateFin.removeAttribute('required');  
            inputDateFin.value = '';               
        }
    }

    
    radioUnJour.addEventListener('change', toggleDates);
    radioPlusieursJours.addEventListener('change', toggleDates);

    toggleDates();
});