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

function openNav() {
    document.getElementById("mySidepanel").style.width = "250px";
    document.getElementById("mySidepanel").style.display = "block";
}

function closeNav() {
    document.getElementById("mySidepanel").style.width = "0";
    document.getElementById("mySidepanel").style.visibility = "hidden;";
}
