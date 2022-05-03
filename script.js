const selectEl = document.getElementById('select');
const registrationImage = document.getElementById('doctor-img');

selectEl.addEventListener('change', function() {
    registrationImage.src = "./Assets/"+this.value+".png"; 
})

