document.addEventListener('DOMContentLoaded', function() {
    // Obtener elementos del DOM
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');
    const openLoginBtn = document.getElementById('openLoginModalBtn');
    const openRegisterFromLogin = document.getElementById('openRegisterFromLogin');
    const openLoginFromRegister = document.getElementById('openLoginFromRegister');
    const closeButtons = document.querySelectorAll('.close-modal, .close-modal-img');
    const registerForm = registerModal.querySelector('form'); // Seleccionar el formulario de registro
    
    // Validación del formulario de registro
    registerForm.onsubmit = function(e) {
        const email1 = document.getElementById('LogEmail1').value;
        const email2 = document.getElementsByName('Username2')[0].value;
        const pass1 = document.getElementById('LogPassword1').value;
        const pass2 = document.getElementsByName('password2')[0].value;
        
        // Validar que los correos coincidan
        if(email1 !== email2) {
            alert('Los correos electrónicos no coinciden');
            e.preventDefault();
            return false;
        }
        
        // Validar que las contraseñas coincidan
        if(pass1 !== pass2) {
            alert('Las contraseñas no coinciden');
            e.preventDefault();
            return false;
        }
        
        return true;
    };
    
    // Abrir modal de login
    openLoginBtn.onclick = function() {
      loginModal.style.display = 'block';
    }
    
    // Cambiar de login a registro
    openRegisterFromLogin.onclick = function(e) {
      e.preventDefault();
      loginModal.style.display = 'none';
      registerModal.style.display = 'block';
    }
    
    // Cambiar de registro a login
    openLoginFromRegister.onclick = function(e) {
      e.preventDefault();
      registerModal.style.display = 'none';
      loginModal.style.display = 'block';
    }
    
    // Cerrar modales
    closeButtons.forEach(function(button) {
      button.onclick = function() {
        loginModal.style.display = 'none';
        registerModal.style.display = 'none';
      }
    });
    
    // Cerrar al hacer clic fuera del modal
    window.onclick = function(event) {
      if (event.target == loginModal) {
        loginModal.style.display = 'none';
      }
      if (event.target == registerModal) {
        registerModal.style.display = 'none';
      }
    }
  });

  // JavaScript para el hover en los dropdowns
document.addEventListener('DOMContentLoaded', function() {
  const dropdowns = document.querySelectorAll('.nav-item.dropdown');
  
  dropdowns.forEach(dropdown => {
      const link = dropdown.querySelector('.dropdown-toggle');
      const menu = dropdown.querySelector('.dropdown-menu');
      
      // Mostrar al pasar el mouse
      dropdown.addEventListener('mouseenter', function() {
          const bsDropdown = bootstrap.Dropdown.getInstance(link);
          if (!bsDropdown) {
              new bootstrap.Dropdown(link).show();
          } else {
              bsDropdown.show();
          }
      });
      
      // Ocultar al salir del elemento (con retardo para mejor experiencia)
      dropdown.addEventListener('mouseleave', function(e) {
          // Verificar si el mouse se movió a otro elemento del dropdown
          if (!dropdown.contains(e.relatedTarget)) {
              setTimeout(() => {
                  const bsDropdown = bootstrap.Dropdown.getInstance(link);
                  if (bsDropdown) {
                      bsDropdown.hide();
                  }
              }, 800); // Pequeño retardo para evitar cierre accidental
          }
      });
      
      // Mantener abierto si el mouse está en el menú
      menu.addEventListener('mouseenter', function() {
          const bsDropdown = bootstrap.Dropdown.getInstance(link);
          if (bsDropdown) {
              bsDropdown.show();
          }
      });
      
      menu.addEventListener('mouseleave', function(e) {
          if (!menu.contains(e.relatedTarget)) {
              setTimeout(() => {
                  const bsDropdown = bootstrap.Dropdown.getInstance(link);
                  if (bsDropdown) {
                      bsDropdown.hide();
                  }
              }, 800);
          }
      });
  });
});
