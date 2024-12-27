async function loadKelas() {
    try {
        const response = await fetch('/api/kelas');
        if (!response.ok) {
            throw new Error(`Failed to fetch class data, status: ${response.status}`);
        }

        const data = await response.json();
        const mtsList = document.getElementById('mts-list');
        const maList = document.getElementById('ma-list');
        const smkList = document.getElementById('smk-list');

        // Clear previous content
        mtsList.innerHTML = '';
        maList.innerHTML = '';
        smkList.innerHTML = '';

        // Populate list with classes
        data.forEach(kelas => {
            const listItem = document.createElement('li');
            const link = document.createElement('a');
            link.style.textDecoration = 'none';
            link.href = `/kelas/${kelas.id}`;
            link.textContent = `${kelas.kelas} ${kelas.gender_kelas} ${kelas.jenis_kelas}`;
            link.className = `block p-4 bg-ma-bg rounded-md text-center border border-black text-white no-underline`;

            listItem.appendChild(link);

            // Append to the correct list based on jenis_kelas
            if (kelas.jenis_kelas === 'MTS') {
                mtsList.appendChild(listItem);
            } else if (kelas.jenis_kelas === 'MA') {
                maList.appendChild(listItem);
            } else if (kelas.jenis_kelas === 'SMK') {
                smkList.appendChild(listItem);
            }
        });

    } catch (error) {
        console.error(error);
        const errorMessage = '<li class="text-red-500">Error: Unable to fetch class data.</li>';
        mtsList.innerHTML = errorMessage;
        maList.innerHTML = errorMessage;
        smkList.innerHTML = errorMessage;
    }
}

document.addEventListener('DOMContentLoaded', loadKelas);
