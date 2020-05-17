function formSignInValidations() {
  let name = document.getElementById('name').value;
  let fatherLastName = document.getElementById('fatherLastName').value;
  let motherLastName = document.getElementById('motherLastName').value;
  let phone = document.getElementById('phone').value;
  let email = document.getElementById('email').value;
  let password = document.getElementById('password').value;
  let confirm_password = document.getElementById('confirm_password').value;
  let emailExpression = /\w+@\w+\.+[a-z]/;

  if (
    name === '' ||
    fatherLastName === '' ||
    motherLastName === '' ||
    phone === '' ||
    email === '' ||
    password === '' ||
    confirm_password === ''
  ) {
    alert('Todos los datos son requeridos');
    return false;
  } else if (name.length > 30) {
    alert('El nombre es muy largo');
    return false;
  } else if (fatherLastName.length > 30) {
    alert('El Apellido paterno es muy largo');
    return false;
  } else if (motherLastName.length > 30) {
    alert('El apellido materno es muy largo');
    return false;
  } else if (phone.length > 50) {
    alert('El numero es muy largo');
    return false;
  } else if (email.length > 100) {
    alert('El correo es muy largo');
    return false;
  } else if (!email.test(emailExpression)) {
    alert('El correo no es valido');
    return false;
  } else if (password.length > 100) {
    alert('La contrasena es muy larga');
    return false;
  } else if (password.length !== confirm_password) {
    alert('Las contrasenas no coinciden');
    return false;
  }
}

function clientRegistryValidations() {
  let completeName = document.getElementById('completeName').value;
  let email = document.getElementById('email').value;
  let phone = document.getElementById('phone').value;
  let reasonForVisit = document.getElementById('reasonForVisit').value;
  let startTreatmentDate = document.getElementById('startTreatmentDate').value;
  let endTreatmentDate = document.getElementById('endTreatmentDate').value;
  let treatment = document.getElementById('treatment').value;
  let prescriptionDrugs = document.getElementById('prescriptionDrugs').value;
  let emailExpression = /\w+@\w+\.+[a-z]/;
  if (
    completeName === '' ||
    email === '' ||
    phone === '' ||
    reasonForVisit === '' ||
    startTreatmentDate === '' ||
    endTreatmentDate === '' ||
    treatment === '' ||
    prescriptionDrugs === ''
  ) {
    alert('Todos los datos son requeridos');
    return false;
  } else if (completeName.length > 90) {
    alert('El nombre es muy largo');
    return false;
  } else if (email.length > 100) {
    alert('El correo es muy largo');
    return false;
  } else if (!email.test(emailExpression)) {
    alert('El correo no es valido');
    return false;
  } else if (reasonForVisit.length > 90) {
    alert('La Razon de visita es muy larga');
    return false;
  } else if (startTreatmentDate > 30) {
    alert('El formato de fecha es muy largo');
    return false;
  } else if (endTreatmentDate > 30) {
    alert('El formato de fecha es muy largo');
    return false;
  } else if (treatment > 500) {
    alert('El tratamiento es muy largo');
    return false;
  } else if (prescriptionDrugs.length > 500) {
    alert('La receta es muy larga');
    return false;
  }
}

function clinicFunctionValidation() {
  let name = document.getElementById('name').value;
  let address = document.getElementById('address').value;
  let rfc = document.getElementById('rfc').value;
  let phone = document.getElementById('phone').value;
  let email = document.getElementById('email').value;
  let password = document.getElementById('password').value;
  let confirm_password = document.getElementById('confirm_password').value;
  let emailExpression = /\w+@\w+\.+[a-z]/;

  if (
    name === '' ||
    fatherLastName === '' ||
    motherLastName === '' ||
    phone === '' ||
    email === '' ||
    password === '' ||
    confirm_password === ''
  ) {
    alert('Todos los datos son requeridos');
    return false;
  } else if (name.length > 150) {
    alert('El nombre es muy largo');
    return false;
  } else if (address.length > 200) {
    alert('La Direccion es muy larga');
    return false;
  } else if (rfc.length > 50) {
    alert('El RFC es muy largo');
    return false;
  } else if (phone.length > 50) {
    alert('El numero es muy largo');
    return false;
  } else if (email.length > 100) {
    alert('El correo es muy largo');
    return false;
  } else if (!email.test(emailExpression)) {
    alert('El correo no es valido');
    return false;
  } else if (password.length > 100) {
    alert('La contrasena es muy larga');
    return false;
  } else if (password.length !== confirm_password) {
    alert('Las contrasenas no coinciden');
    return false;
  }
}
