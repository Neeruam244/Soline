/* Carrousel logo */


/* Carrousel nous soutenir*/
document.addEventListener("DOMContentLoaded", () => {
  const carousels = document.querySelectorAll(".slideshow-container");

  carousels.forEach(container => {
    let index = 0;
    const slides = container.querySelectorAll(".mySlides");
    const dots = container.querySelectorAll(".dot");
    const prev = container.querySelector(".prev");
    const next = container.querySelector(".next");

    function showSlide(n) {
      index = (n + slides.length) % slides.length;
      console.log("Affichage slide", index);

      slides.forEach(slide => slide.style.display = "none");
      dots.forEach(dot => dot.classList.remove("active"));

      slides[index].style.display = "block";
      dots[index]?.classList.add("active");
    }

    prev?.addEventListener("click", () => showSlide(index - 1));
    next?.addEventListener("click", () => showSlide(index + 1));
    dots.forEach((dot, i) => {
      dot.addEventListener("click", () => showSlide(i));
    });

    showSlide(index); 
  });
});




/* Confirmation d'envoie réussi formulaire */
//document.getElementById('myForm').addEventListener('submit', function(e) {
//    e.preventDefault();  // Empêche le rechargement

 //   const form = e.target;
   // const formData = new FormData(form);

  //  fetch(form.action, {
  //      method: 'POST',
  //      body: formData
 //   })
  //  .then(response => {
  //      if (!response.ok) {
  //          throw new Error('Erreur réseau');
  //      }
  //      return response.text();
 //   })
 //   .then(data => {
        // Ici, tu peux vérifier le contenu si besoin
 //       document.getElementById('confirmationMessage').style.display = 'block';
 //       form.reset();
//    })
 //   .catch(error => {
//        alert('Une erreur est survenue : ' + error.message);
//    });
//});