const form = document.getElementById("form");
const fullName = document.getElementById("name");
const email = document.getElementById("email");
const phoneNumber = document.getElementById("phone");
const genders = document.getElementsByName("gender");
const languages = document.forms["contact__form"]["langs[]"];
const cities = document.forms["contact__form"]["city"];
const subject = document.getElementById("subject");
const message = document.getElementById("message");
const successMsg = document.getElementById("success__msg");

form.addEventListener("submit", (e) => {
  validateForm(e);
});

function validateForm(e) {
  const nameInput = fullName.value.trim();
  const emailInput = email.value.trim();
  const phoneNumberInput = phoneNumber.value.trim();
  const citySelected = cities.value;
  const subjectInput = subject.value.trim();
  const messageInput = message.value.trim();
  let counter = 0;

  if (nameInput === "") {
    errorMessageFor(fullName, "Field can not be empty!");
  } else if (hasNumbers(nameInput)) {
    errorMessageFor(fullName, "Field should contain letters only!");
  } else if (nameInput.length < 3) {
    errorMessageFor(fullName, "Name should be greater than 3 letters!");
  } else {
    successMessageFor(fullName);
    counter++;
  }

  if (emailInput === "") {
    errorMessageFor(email, "Field can not be empty!");
  } else if (!isEmail(emailInput)) {
    errorMessageFor(email, "Invalid email format!");
  } else {
    successMessageFor(email);
    counter++;
  }

  if (phoneNumberInput === "") {
    errorMessageFor(phoneNumber, "Field can not be empty!");
  } else if (!phoneNumberRegex(phoneNumberInput)) {
    errorMessageFor(phoneNumber, "Invalid phone number...");
  } else {
    successMessageFor(phoneNumber);
    counter++;
  }

  // GENDER
  let genderSelected = "";
  for (let i = 0; i < genders.length; i++) {
    if (genders[i].checked) {
      console.log(genders[i].value);
      genderSelected = genders[i].value;
    }
  }

  if (genderSelected === "") {
    document.getElementById("gender__question").style.color = "#f83f86";
  } else {
    document.getElementById("gender__question").style.color = "#4cb944";
    counter++;
  }

  // PROGRAMMING
  let langsSelected = [];
  for (let i = 0; i < languages.length; i++) {
    if (languages[i].checked) {
      langsSelected.push(languages[i]);
    }
  }

  console.log(langsSelected);

  if (langsSelected.length === 0) {
    document.getElementById("language__question").style.color = "#f83f86";
  } else {
    document.getElementById("language__question").style.color = "#4cb944";
    counter++;
  }

  // CITIES
  if (citySelected === "choose") {
    document.getElementById("city__question").style.color = "#f83f86";
  } else {
    document.getElementById("city__question").style.color = "#4cb944";
    counter++;
  }

  if (subjectInput === "") {
    errorMessageFor(subject, "Field can not be empty!");
  } else {
    successMessageFor(subject);
    counter++;
  }

  if (messageInput === "") {
    errorMessageFor(message, "Field can not be empty!");
  } else {
    successMessageFor(message);
    counter++;
  }

  if (counter === 8) {
    successMsg.style.display = "block";
    successMsg.style.color = "#4cb944";
    successMsg.innerHTML = "Message sent Successfully!";
  } else {
    e.preventDefault();
    successMsg.style.display = "block";
    successMsg.innerHTML = "Opss! Something went wrong!";
  }
}

function errorMessageFor(input, message) {
  const formControl = input.parentElement;
  const small = formControl.querySelector(".small");
  const errorIcon = formControl.querySelector(".fa-exclamation-circle");
  const successIcon = formControl.querySelector(".fa-check-circle");

  input.style.border = "2px solid #f83f86";
  small.innerHTML = message;
  errorIcon.style.visibility = "visible";
  successIcon.style.visibility = "hidden";
}

function successMessageFor(input) {
  const formControl = input.parentElement;
  const small = formControl.querySelector(".small");
  const errorIcon = formControl.querySelector(".fa-exclamation-circle");
  const successIcon = formControl.querySelector(".fa-check-circle");

  input.style.border = "2px solid #4cb944";
  errorIcon.style.visibility = "hidden";
  successIcon.style.visibility = "visible";
  small.innerHTML = "";
}

function isEmail(email) {
  return /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/.test(
    email
  );
}

// function passwordRegex(password) {
//   return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{6,}$/.test(
//     password
//   );
// }

function phoneNumberRegex(phoneNumber) {
  return /^(\d{2}\-)?(\(\d{3}\))?\d{3}\-\d{3}$/.test(phoneNumber);
}

function hasNumbers(name) {
  let hasNumber = /\d/;
  return hasNumber.test(name);
}
