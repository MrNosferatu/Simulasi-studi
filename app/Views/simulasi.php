<?php include 'layouts/header.php'; ?>
<?php include(APPPATH . 'views/layouts/public/navbar.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    #backButton {
        border-radius: 4px;
        padding: 8px;
        border: none;
        font-size: 16px;
        background-color: #2eacd1;
        color: white;
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }

    .invisible {
        display: none;
    }
</style>

<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
<div class="d-flex">
    <div class="flex-grow-1"  style="min-height: 90vh;">
        <div class="container p-5">
            <h1>Simulasi Studi</h1>
            <div class="row">
                <div class="col">
                    <form id="form">
                        <div id="matakuliahField"></div>
                        <div id="sksField" class="mb-3"></div>
                        <div id="gradesField" class="mb-3"></div>
                        <div id="ipkField" class="mb-3"></div>
                        <div class="d-grid gap-2">
                        <button id="start" class="btn btn-success btn-lg id" type="button" onclick="this.style.display = 'none';">Mulai</button>
                        </div>
                        <div class="d-grid gap-2" id="submit_btn"></div>

                    </form>
                </div>
            </div>
            <div class="row pt-5">
                <div class="col col-3" id="sksChartDiv">
                    <canvas id="sksChartContainer"></canvas>
                </div>
                <div class="col col-3" id="nilaiDChartDiv">
                    <canvas id="nilaiDChartContainer"></canvas>
                </div>
                <div class="col col-3" id="ipkChartDiv">
                    <canvas id="ipkChartContainer"></canvas>
                </div>
                <div class="col col-3">
                    <div id="nilaiEChart"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'layouts/footer.php'; ?>
<script>
    function createElements(data) {
        const container = document.createElement('div');
        container.classList.add('row');

        data.forEach(item => {
            const row = document.createElement('div');
            row.classList.add('row');
            container.appendChild(row);

            const kodeCell = document.createElement('div');
            kodeCell.classList.add('col', 'col-1', 'd-flex', 'justify-content-center');
            row.appendChild(kodeCell);

            const kodeCheckbox = document.createElement('input');
            kodeCheckbox.type = 'checkbox';
            kodeCheckbox.name = 'matakuliah[]';
            kodeCheckbox.value = item.kode_matakuliah;
            kodeCheckbox.id = item.kode_matakuliah;
            kodeCheckbox.dataset.sks = item.sks;
            kodeCell.appendChild(kodeCheckbox);

            const namaCell = document.createElement('div');
            namaCell.classList.add('col');
            namaCell.textContent = item.nama;
            row.appendChild(namaCell);

            const sksCell = document.createElement('div');
            sksCell.classList.add('col', 'col-1', 'd-flex', 'justify-content-center');
            sksCell.textContent = item.sks;
            row.appendChild(sksCell);

            const inputCell = document.createElement('div');
            inputCell.classList.add('col', 'col-1', 'd-flex', 'justify-content-center');
            row.appendChild(inputCell);

            const inputElement = document.createElement('select');
            inputElement.name = 'nilai[]';
            inputElement.className = 'form-control';
            inputCell.appendChild(inputElement);

            const grades = ['A', 'B', 'C', 'D', 'E'];

            grades.forEach(grade => {
                const option = document.createElement('option');
                option.value = grade;
                option.textContent = grade;
                inputElement.appendChild(option);
            });
        });

        return container;
    }
</script>
<script>
    const startButton = document.getElementById('start');
    startButton.addEventListener('click', () => {
        fetch(`/get-matakuliah`)
            .then(response => response.json())
            .then(data => {
                // Group the data by semester
                const groupedData = data.reduce((acc, item) => {
                    if (!acc[item.semester]) {
                        acc[item.semester] = [];
                    }
                    acc[item.semester].push(item);
                    return acc;
                }, {});
                const matakuliahField = document.getElementById('matakuliahField');
                // Create a new container for each semester
                let i = 0;
                Object.entries(groupedData).forEach(([semester, items]) => {
                    if (i >= 2) {
                        return;
                    }
                    const semesterContainer = document.createElement('div');
                    semesterContainer.classList.add('semester-container');
                    matakuliahField.appendChild(semesterContainer);

                    const semesterHeader = document.createElement('h3');
                    semesterHeader.textContent = `Semester ${semester}`;
                    semesterContainer.appendChild(semesterHeader);

                    // Create a new row for the table header
                    const headerRow = document.createElement('div');
                    headerRow.classList.add('row');
                    semesterContainer.appendChild(headerRow);

                    const kodeHeader = document.createElement('div');
                    kodeHeader.classList.add('col', 'fw-bold', 'col-1', 'd-flex', 'justify-content-center'); // Add the fw-bold class to make the text bold
                    kodeHeader.textContent = 'Pilih';
                    headerRow.appendChild(kodeHeader);

                    const namaHeader = document.createElement('div');
                    namaHeader.classList.add('col', 'fw-bold'); // Add the fw-bold class to make the text bold
                    namaHeader.textContent = 'Nama';
                    headerRow.appendChild(namaHeader);

                    const sksHeader = document.createElement('div');
                    sksHeader.classList.add('col', 'col-1', 'fw-bold', 'd-flex', 'justify-content-center'); // Add the fw-bold class to make the text bold
                    sksHeader.textContent = 'SKS';
                    headerRow.appendChild(sksHeader);

                    const nilaiHeader = document.createElement('div');
                    nilaiHeader.classList.add('col', 'col-1', 'fw-bold', 'd-flex', 'justify-content-center'); // Add the fw-bold class to make the text bold
                    nilaiHeader.textContent = 'Nilai';
                    headerRow.appendChild(nilaiHeader);

                    const elements = createElements(items);
                    semesterContainer.appendChild(elements);
                    i++;
                });

                // Analisis Button
                const submit = document.getElementById('submit');
                if (!submit) {
                    const button = document.createElement('button');
                    button.className = 'btn btn-ungu-medium btn-lg id text-white';
                    button.id = 'submit';
                    button.textContent = 'Analisis'; // Add text to the button
                    submit_btn.appendChild(button);
                }

                // Fetch the konsentrasi data from the server using an AJAX request
                fetch(`/get-konsentrasi`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            const newPilihanKonsentrasi = document.createElement('div');
                            newPilihanKonsentrasi.id = 'PilihanKonsentrasi';
                            matakuliahField.appendChild(newPilihanKonsentrasi);
                            const heading = document.createElement('h3');
                            heading.className = 'text-center';
                            heading.textContent = `Pilihan Konsentrasi`;
                            newPilihanKonsentrasi.appendChild(heading);
                            // Create a new label element
                            const labelKonsentrasi = document.createElement('label');
                            labelKonsentrasi.htmlFor = 'konsentrasi';
                            labelKonsentrasi.className = 'form-label';
                            labelKonsentrasi.textContent = 'Pilih Konsentrasi:';
                            newPilihanKonsentrasi.appendChild(labelKonsentrasi);

                            // Create the input option with values retrieved from the server
                            const inputOption = document.createElement('select');
                            inputOption.name = 'Konsentrasi';
                            inputOption.id = 'konsentrasi';
                            inputOption.className = 'form-select';
                            newPilihanKonsentrasi.appendChild(inputOption);

                            const option1 = document.createElement('option');
                            option1.value = '';
                            option1.text = 'Pilih Konsentrasi';
                            inputOption.appendChild(option1);
                            // Create an option element for each konsentrasi
                            data.forEach(konsentrasi => {
                                const option = document.createElement('option');
                                option.value = konsentrasi.kode_konsentrasi;
                                option.text = konsentrasi.nama;
                                inputOption.appendChild(option);
                            });
                            // Add an event listener to the konsentrasi input option
                            inputOption.addEventListener('change', () => {
                                const konsentrasiValue = inputOption.value;

                                if (konsentrasiValue) {
                                    // Remove the existing konsentrasiField div from the DOM
                                    const konsentrasiField = document.getElementById('konsentrasiField');
                                    if (konsentrasiField) {
                                        konsentrasiField.remove();
                                    }
                                }
                                // Create a new konsentrasiField div
                                const newKonsentrasiField = document.createElement('div');
                                newKonsentrasiField.id = 'konsentrasiField';
                                matakuliahField.appendChild(newKonsentrasiField);
                                fetch(`/get-matakuliah`)
                                    .then(response => response.json())
                                    .then(data => {
                                        // Group the data by semester
                                        const groupedData = data.reduce((acc, item) => {
                                            // Only include semesters 3 and above and matching konsentrasi or null
                                            if ((item.kode_konsentrasi === inputOption.value || item.kode_konsentrasi == null) && item.semester >= 3) {
                                                if (!acc[item.semester]) {
                                                    acc[item.semester] = [];
                                                }
                                                acc[item.semester].push(item);
                                            }
                                            return acc;
                                        }, {});

                                        // Create a new container for each semester
                                        Object.entries(groupedData).forEach(([semester, items]) => {
                                            const semesterContainer = document.createElement('div');
                                            semesterContainer.classList.add('semester-container');
                                            newKonsentrasiField.appendChild(semesterContainer);

                                            const semesterHeader = document.createElement('h3');
                                            semesterHeader.textContent = `Semester ${semester}`;
                                            semesterContainer.appendChild(semesterHeader);

                                            // Create a new row for the table header
                                            const headerRow = document.createElement('div');
                                            headerRow.classList.add('row');
                                            semesterContainer.appendChild(headerRow);

                                            const kodeHeader = document.createElement('div');
                                            kodeHeader.classList.add('col', 'fw-bold', 'col-1', 'd-flex', 'justify-content-center'); // Add the fw-bold class to make the text bold
                                            kodeHeader.textContent = 'Pilih';
                                            headerRow.appendChild(kodeHeader);

                                            const namaHeader = document.createElement('div');
                                            namaHeader.classList.add('col', 'fw-bold'); // Add the fw-bold class to make the text bold
                                            namaHeader.textContent = 'Nama';
                                            headerRow.appendChild(namaHeader);

                                            const sksHeader = document.createElement('div');
                                            sksHeader.classList.add('col', 'col-1', 'fw-bold', 'd-flex', 'justify-content-center'); // Add the fw-bold class to make the text bold
                                            sksHeader.textContent = 'SKS';
                                            headerRow.appendChild(sksHeader);

                                            const nilaiHeader = document.createElement('div');
                                            nilaiHeader.classList.add('col', 'col-1', 'fw-bold', 'd-flex', 'justify-content-center'); // Add the fw-bold class to make the text bold
                                            nilaiHeader.textContent = 'Nilai';
                                            headerRow.appendChild(nilaiHeader);

                                            const elements = createElements(items);
                                            newKonsentrasiField.appendChild(elements);
                                            i++;
                                        });
                                    })
                                    .catch(error => console.error(error));
                            });
                        }
                    });
            });
    });
</script>
<script>
    // Add an event listener to the form submit event to calculate the total SKS
    const form = document.getElementById('form');
    const gradesElement = document.createElement('div');
    form.appendChild(gradesElement);

    // Create chart variables
    let sksChart, nilaiDChart, ipkChart;

    // Function to reset the charts
    function resetCharts(totalSks, sksStillNeeded, SelisihNilaiD, totalSksDOrBelow, jumlahNilaiD, ipk, ipkSelisih, totalSksDOrBelow) {
        // Clear the existing charts
        if (sksChart) {
            sksChart.destroy();
        }
        if (nilaiDChart) {
            nilaiDChart.destroy();
        }
        if (ipkChart) {
            ipkChart.destroy();
        }

        // Create SKS chart
        const sksChartOptions = {
            type: 'doughnut',
            data: {
                labels: ['SKS Terpenuhi', 'SKS Belum Terpenuhi'],
                datasets: [{
                    data: [totalSks, sksStillNeeded],
                    backgroundColor: ['#8E44AD', '#dedede']
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'SKS Minimal'
                },
                legend: {
                    labels: {
                        fontFamily: 'calibri',
                        fontSize: 14,
                        generateLabels: function (chart) {
                            const data = chart.data;
                            if (data.labels.length && data.datasets.length) {
                                return data.labels.map(function (label, index) {
                                    const dataset = data.datasets[0];
                                    return {
                                        text: label + ': ' + dataset.data[index],
                                        fillStyle: dataset.backgroundColor[index],
                                        strokeStyle: dataset.backgroundColor[index],
                                        lineWidth: 1,
                                        hidden: isNaN(dataset.data[index]),

                                        // Extra data used for toggling the correct item
                                        index: index
                                    };
                                });
                            }
                            return [];
                        }
                    }
                },
            }
        };

        const sksChartContainer = document.getElementById('sksChartContainer');
        sksChart = new Chart(sksChartContainer, sksChartOptions);

        // Create Nilai D chart
        const nilaiDOptions = {
            type: 'doughnut',
            data: {
                labels: ['Nilai D Saat Ini', 'Nilai D Maksimum'],
                datasets: [{
                    data: [jumlahNilaiD, SelisihNilaiD],
                    backgroundColor: ['#8E44AD', '#dedede']
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Nilai D'
                },
                legend: {
                    labels: {
                        fontFamily: 'calibri',
                        fontSize: 14,
                        generateLabels: function (chart) {
                            const data = chart.data;
                            if (data.labels.length && data.datasets.length) {
                                return data.labels.map(function (label, index) {
                                    const dataset = data.datasets[0];
                                    return {
                                        text: label + ': ' + dataset.data[index],
                                        fillStyle: dataset.backgroundColor[index],
                                        strokeStyle: dataset.backgroundColor[index],
                                        lineWidth: 1,
                                        hidden: isNaN(dataset.data[index]),

                                        // Extra data used for toggling the correct item
                                        index: index
                                    };
                                });
                            }
                            return [];
                        }
                    }
                },
                plugins: {
                    datalabels: {
                        formatter: function (value, context) {
                            if (context.dataIndex === 0 && totalSks === 108) {
                                return 'SKS Terpenuhi';
                            } else {
                                return value;
                            }
                        },
                        color: '#fff',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                }
            }
        };


        const nilaiDChartContainer = document.getElementById('nilaiDChartContainer');
        nilaiDChart = new Chart(nilaiDChartContainer, nilaiDOptions);

        const ipkMax = 4;
        // Create IPK chart
        const ipkChartOptions = {
            type: 'doughnut',
            data: {
                labels: ['IPK Terakhir', 'IPK Minimal'],
                datasets: [{
                    data: [ipk, ipkSelisih],
                    backgroundColor: ['#8E44AD', '#dedede']
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'IPK'
                },
                legend: {
                    labels: {
                        fontFamily: 'calibri',
                        fontSize: 14,
                        generateLabels: function (chart) {
                            const data = chart.data;
                            if (data.labels.length && data.datasets.length) {
                                return data.labels.map(function (label, index) {
                                    const dataset = data.datasets[0];
                                    return {
                                        text: label + ': ' + dataset.data[index],
                                        fillStyle: dataset.backgroundColor[index],
                                        strokeStyle: dataset.backgroundColor[index],
                                        lineWidth: 1,
                                        hidden: isNaN(dataset.data[index]),

                                        // Extra data used for toggling the correct item
                                        index: index
                                    };
                                });
                            }
                            return [];
                        }
                    }
                }
            }
        };

        const ipkChartContainer = document.getElementById('ipkChartContainer');
        ipkChart = new Chart(ipkChartContainer, ipkChartOptions);
    }

    form.addEventListener('submit', event => {
        event.preventDefault();

        const checkboxes = document.querySelectorAll('input[name="matakuliah[]"]:checked');
        let totalSks = 0;
        let totalGradePoints = 0;
        let totalSksDOrBelow = 0; // New variable to keep track of total SKS for grades D or below
        const grades = { A: 0, B: 0, C: 0, D: 0, E: 0 };

        checkboxes.forEach(checkbox => {
            const sks = parseInt(checkbox.dataset.sks);
            if (!isNaN(sks)) {
                totalSks += sks;
            }
            const nilaiElement = checkbox.closest('.row').querySelector('select[name="nilai[]"]');
            const nilai = nilaiElement.value;

            switch (nilai) {
                case 'A':
                    totalGradePoints += 4 * sks;
                    break;
                case 'B':
                    totalGradePoints += 3 * sks;
                    break;
                case 'C':
                    totalGradePoints += 2 * sks;
                    break;
                case 'D':
                    totalGradePoints += 1 * sks;
                    break;
                case 'E':
                    totalGradePoints += 0 * sks;
                    break;
                default:
                    console.error(`Invalid nilai value: ${nilai}`);
            }

            grades[nilai]++;
        });



        if (sksField && gradesElement && ipkField) {
            const ipk = totalGradePoints / totalSks;
            const sksStillNeeded = 108 - totalSks;
            const dGradesSelected = grades['D'];
            const jumlahNilaiD = (grades['D'] + grades['E']);
            const SelisihNilaiD = 1 - jumlahNilaiD;
            const ipkSelisih = 4 - ipk;
            const NilaiE = grades['E'];
            // Reset the charts with the updated values
            resetCharts(totalSks, sksStillNeeded, SelisihNilaiD, totalSksDOrBelow, jumlahNilaiD, ipk, ipkSelisih, totalSksDOrBelow); // Pass the total SKS for grades D or below to the resetCharts function
            // Check if there is a grade of 'E'
            const nilaiEChart = document.getElementById('nilaiEChart');
            const existingAlert = document.getElementById('alertNilaiE');
            if (existingAlert) {
                existingAlert.remove();
            }

            if (NilaiE > 0) {
                const alertDiv = document.createElement('div');
                alertDiv.classList.add('alert', 'alert-danger');
                alertDiv.setAttribute('role', 'alert');
                alertDiv.textContent = 'Ada Nilai E!';
                alertDiv.id = 'alertNilaiE';
                nilaiEChart.appendChild(alertDiv);
            } else {
                const alertDiv = document.createElement('div');
                alertDiv.classList.add('alert', 'alert-success');
                alertDiv.setAttribute('role', 'alert');
                alertDiv.textContent = 'Tidak Ada Nilai E!';
                alertDiv.id = 'alertNilaiE';
                nilaiEChart.appendChild(alertDiv);
            }
        }
    });


</script>