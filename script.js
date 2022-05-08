function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}
const selectEl = document.getElementById('select');
const registrationImage = document.getElementById('doctor-img');

selectEl.addEventListener('change', function() {
    registrationImage.src = "./Assets/"+this.value+".png"; 
})

window.onclick = function(event) {
    if (!event.target.matches('.drop-btn')) {

        const dropdowns = document.getElementsByClassName("dropdown-content");
        let i;
        for (i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}