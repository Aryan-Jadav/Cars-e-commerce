// Get the form containers
const formContainer = document.getElementById('form-container');
const signUpForm = document.querySelector('.form-wrapper.sign-up');
const signInForm = document.querySelector('.form-wrapper.sign-in');

// Show the sign in form by default
signInForm.style.display = 'block';

// Add event listeners to the sign up and sign in links
document.querySelectorAll('.sign-link a').forEach((link) => {
  link.addEventListener('click', (e) => {
    e.preventDefault();
    if (link.classList.contains('signUp-link')) {
      // Hide the sign in form and show the sign up form with animation
      signInForm.classList.add('animate-out');
      formContainer.classList.add('animate-signUp');
      setTimeout(() => {
        signInForm.style.display = 'none';
        signUpForm.style.display = 'block';
        signUpForm.classList.add('animate-in');
      }, 500);
    } else {
      // Hide the sign up form and show the sign in form with animation
      signUpForm.classList.add('animate-out');
      formContainer.classList.add('animate-signIn');
      setTimeout(() => {
        signUpForm.style.display = 'none';
        signInForm.style.display = 'block';
        signInForm.classList.add('animate-in');
      }, 500);
    }
  });
});

// Remove the animation classes when the animation is complete
formContainer.addEventListener('animationend', () => {
  formContainer.classList.remove('animate-signUp', 'animate-signIn');
});

signUpForm.addEventListener('animationend', () => {
  signUpForm.classList.remove('animate-out', 'animate-in');
});

signInForm.addEventListener('animationend', () => {
  signInForm.classList.remove('animate-out', 'animate-in');
});