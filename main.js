// Accessing the form and adding an event listener for submission
const signupForm = document.getElementById("signup-form");
signupForm.addEventListener("submit", handleFormSubmit);

function handleFormSubmit(event) {
  event.preventDefault(); // Prevents the default form submission behavior
  // Retrieve form values
  const firstName = document.getElementById("first-name").value;
  const lastName = document.getElementById("last-name").value;
  const email = document.getElementById("email").value;
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;
  const subscription = document.getElementById("subscription").value;

  // Retrieve selected payment method
  const paymentMethodRadios = document.getElementsByName("payment");
  let selectedPaymentMethod;
  for (const radio of paymentMethodRadios) {
    if (radio.checked) {
      selectedPaymentMethod = radio.value;
      break;
    }
  }

  // Perform further actions with the form values
  // e.g., sending data to a server or validating the input

  // Reset the form
  signupForm.reset();
}
