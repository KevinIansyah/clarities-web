function validateInputNumber (id, max) {
  const element = document.getElementById(id);
  if(element){
      element.addEventListener('input', function() {
      let value = parseInt(element.value, 10);
      if (value < 0) {
        element.value = 0;
      } else if (value > max) {
        element.value = max;
      }
    });
    element.addEventListener('keydown', function(e) {
      if (e.key === 'e' || e.key === 'E' || e.key === '-' || e.key === '+' || e.key === '.' || e.key === ',') {
        e.preventDefault();
      }
    });
  }
  
}