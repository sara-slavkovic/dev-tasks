document.getElementById('registration-form').addEventListener('submit', function(e) {
    e.preventDefault();

    if (validateForm()) {
        sendData();
    }
});

function validateForm() {
    let isValid = true;

    const ime = document.getElementById('ime').value.trim();
    const slova = /^[\p{L}\s]+$/u;
    if (ime === '') {
        showError('ime', 'Ime je obavezno polje.');
        isValid = false;
    } else if (!slova.test(ime)) {
        showError('ime', 'Ime sme sadržati samo slova.');
        isValid = false;
    } else {
        clearError('ime');
    }

    const prezime = document.getElementById('prezime').value.trim();
    if (prezime === '') {
        showError('prezime', 'Prezime je obavezno polje.');
        isValid = false;
    } else if (!slova.test(prezime)) {
        showError('prezime', 'Prezime sme sadržati samo slova.');
        isValid = false;
    } else {
        clearError('prezime');
    }

    const polChecked = document.querySelectorAll('input[name="pol"]:checked');
    if (polChecked.length === 0) {
        showError('pol', 'Molimo izaberite pol.');
        isValid = false;
    } else if (polChecked.length > 1) {
        showError('pol', 'Molimo izaberite samo jedan pol.');
        isValid = false;
    } else {
        clearError('pol');
    }

    const godina = parseInt(document.getElementById('godina').value);
    const trenutnaGodina = new Date().getFullYear();
    if (!godina) {
        showError('godina', 'Godina rođenja je obavezna.');
        isValid = false;
    } else if (godina > trenutnaGodina) {
        showError('godina', 'Godina rođenja ne može biti veća od trenutne godine.');
        isValid = false;
    } else {
        clearError('godina');
    }

    const adresa = document.getElementById('adresa').value.trim();
    if (adresa === '') {
        showError('adresa', 'Adresa je obavezno polje.');
        isValid = false;
    } else {
        clearError('adresa');
    }

    const grad = document.getElementById('grad').value;
    if (grad === '') {
        showError('grad', 'Molimo izaberite grad.');
        isValid = false;
    } else {
        clearError('grad');
    }

    return isValid;
}

function showError(field, message) {
    const input = document.getElementById(field);
    const error = document.getElementById('error-' + field);
    if (input) input.classList.add('is-invalid');
    if (error) {
        error.textContent = message;
        error.style.display = 'block';
    }
}

function clearError(field) {
    const input = document.getElementById(field);
    const error = document.getElementById('error-' + field);
    if (input) input.classList.remove('is-invalid');
    if (error) {
        error.textContent = '';
        error.style.display = 'none';
    }
}

function sendData() {
    const polChecked = document.querySelector('input[name="pol"]:checked');
    const pol = polChecked ? polChecked.value : '';

    const podaci = {
        ime: document.getElementById('ime').value.trim(),
        prezime: document.getElementById('prezime').value.trim(),
        godina: document.getElementById('godina').value,
        adresa: document.getElementById('adresa').value.trim(),
        grad: document.getElementById('grad').value,
        pol: pol
    };

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'process.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                prikaziUspeh(podaci);
            } else {
                //alert('Greška: ' + response.message);
                const serverError = document.getElementById('server-error');
                serverError.textContent = response.message;
                serverError.style.display = 'block';
            }
        }
    };

    xhr.onerror = function() {
        alert('Greška pri slanju podataka.');
    };

    xhr.send(JSON.stringify(podaci));
}

function prikaziUspeh(podaci) {
    document.getElementById('form-wrapper').style.display = 'none';
    document.getElementById('success-box').style.display = 'block';

    document.getElementById('res-ime').textContent = podaci.ime;
    document.getElementById('res-prezime').textContent = podaci.prezime;
    document.getElementById('res-godina').textContent = podaci.godina;
    document.getElementById('res-adresa').textContent = podaci.adresa;
    document.getElementById('res-grad').textContent = podaci.grad;
    document.getElementById('res-pol').textContent = podaci.pol;
}

document.querySelectorAll('input[name="pol"]').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        document.querySelectorAll('input[name="pol"]').forEach(function(other) {
            if (other !== checkbox) {
                other.checked = false;
            }
        });
    });
});