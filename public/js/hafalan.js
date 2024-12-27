function filterByDate(inputElement, tableId) {
    const searchDate = inputElement.value;
    const table = document.getElementById(tableId);
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const dateCell = rows[i].getElementsByTagName('td')[0];
        if (dateCell) {
            const dateText = dateCell.textContent || dateCell.innerText;
            rows[i].style.display = dateText.includes(searchDate) ? '' : 'none';
        }
    }
}

// Menangani pemilihan bacaan atau status
function handleButtonSelection(buttonClass, hiddenInputName) {
    const buttons = document.querySelectorAll(`.${buttonClass}`);
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            buttons.forEach(btn => btn.classList.remove('selected'));
            this.classList.add('selected');
            document.querySelector(`input[name="${hiddenInputName}"]`).value = this.textContent.trim();
        });
    });
}

// Menangani reset data pada modal
function resetModal(bacaanInputName, statusInputName, buttonClassBacaan, buttonClassStatus) {
    document.querySelector(`input[name="${bacaanInputName}"]`).value = '';
    document.querySelector(`input[name="${statusInputName}"]`).value = '';

    document.querySelectorAll(`.${buttonClassBacaan}`).forEach(btn => btn.classList.remove('selected'));
    document.querySelectorAll(`.${buttonClassStatus}`).forEach(btn => btn.classList.remove('selected'));
}

// Mengatur data untuk formulir edit
function setEditData(item) {
    const editTanggal = document.getElementById('editTanggal');
    if (editTanggal) {
        const formattedDate = new Date(item.tanggal).toISOString().split('T')[0];
        editTanggal.value = formattedDate;
    }

    const editFormFields = {
        editJuz: item.juz,
        editSurah: item.surah,
        editAyatAwal: item.ayat_awal,
        editAyatAkhir: item.ayat_akhir,
        editBacaan: item.bacaan,
        editStatus: item.status,
        editKeterangan: item.keterangan
    };

    for (const [id, value] of Object.entries(editFormFields)) {
        const field = document.getElementById(id);
        if (field) {
            field.value = value;
        } else {
            console.error(`Element with ID "${id}" not found.`);
        }
    }

    const editForm = document.getElementById('editHafalanForm');
    if (editForm) {
        editForm.action = `/hafalan/${item.id}`;
    } else {
        console.error('Element with ID "editHafalanForm" not found.');
    }

    updateAyatOptions(document.getElementById('editSurah'));
}

// Validasi formulir sebelum submit
function validateForm(formId, inputsToCheck) {
    document.getElementById(formId).addEventListener('submit', function (event) {
        let isValid = true;

        inputsToCheck.forEach(inputName => {
            const input = document.querySelector(`input[name="${inputName}"]`);
            if (!input || !input.value) {
                isValid = false;
            }
        });

        if (!isValid) {
            event.preventDefault();
            alert('Harap lengkapi semua data yang dibutuhkan!');
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const bacaanButtons = document.querySelectorAll('.button-bacaan');
    const statusButtons = document.querySelectorAll('.button-status');
    const closeButton = document.querySelector('.btn-cancel');

    bacaanButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Set selected class
            bacaanButtons.forEach(btn => btn.classList.remove('selected'));
            this.classList.add('selected');
    
            // Set hidden input value
            const value = this.textContent.trim();
            document.querySelector('input[name="bacaan"]').value = value;
    
            console.log('Bacaan dipilih:', value); // Debug log
        });
    });
    
    statusButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Set selected class
            statusButtons.forEach(btn => btn.classList.remove('selected'));
            this.classList.add('selected');
    
            // Set hidden input value
            const value = this.textContent.trim();
            document.querySelector('input[name="status"]').value = value;
    
            console.log('Status dipilih:', value); // Debug log
        });
    });

    closeButton.addEventListener('click', function() {
        bacaanButtons.forEach(btn => btn.classList.remove('selected'));
        statusButtons.forEach(btn => btn.classList.remove('selected'));
        document.querySelector('input[name="bacaan"]').value = '';
        document.querySelector('input[name="status"]').value = '';
    });
});

document.addEventListener('click', function(event) {
    if (event.target.classList.contains('button-bacaan')) {
        const value = event.target.textContent.trim();
        document.querySelector('input[name="bacaan"]').value = value;

        // Highlight selected button
        document.querySelectorAll('.button-bacaan').forEach(btn => btn.classList.remove('selected'));
        event.target.classList.add('selected');

        console.log('Bacaan dipilih:', value);
    }

    if (event.target.classList.contains('button-status')) {
        const value = event.target.textContent.trim();
        document.querySelector('input[name="status"]').value = value;

        // Highlight selected button
        document.querySelectorAll('.button-status').forEach(btn => btn.classList.remove('selected'));
        event.target.classList.add('selected');

        console.log('Status dipilih:', value);
    }
});

function filterByStatus() {
    const status = document.getElementById('statusFilter').value;
    const rows = document.querySelectorAll('#hafalanTable tbody tr');

    rows.forEach(row => {
        const rowStatus = row.querySelector('td:nth-child(7)').textContent.trim();
        if (status === "" || rowStatus === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}


