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
  } else if (fatherLastName > 30) {
    alert('El Apellido paterno es muy largo');
    return false;
  } else if (motherLastName > 30) {
    alert('El apellido materno es muy largo');
    return false;
  } else if (phone > 50) {
    alert('El numero es muy largo');
    return false;
  } else if (email > 100) {
    alert('El correo es muy largo');
    return false;
  } else if (!email.test(emailExpression)) {
    alert('El correo no es valido');
    return false;
  } else if (password > 100) {
    alert('La contrasena es muy larga');
    return false;
  } else if (password !== confirm_password) {
    alert('Las contrasenas no coinciden');
    return false;
  }
}
