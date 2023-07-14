const kode_prodi = document.getElementById('kode_prodi');
const matakuliahField = document.getElementById('matakuliahField');
const sksField = document.getElementById('sksField');

kode_prodi.addEventListener('change', () => {
  const value = kode_prodi.value;

  if (value) {
    // Remove the existing semesterField div from the DOM
    const semesterField = document.getElementById('semesterField');
    if (semesterField) {
      semesterField.remove();
    }

    // Create a new semesterField div
    const newSemesterField = document.createElement('div');
    newSemesterField.id = 'semesterField';
    matakuliahField.appendChild(newSemesterField);

    // fetch(`/get-prodi?kode_prodi=${value}`)
    //   .then(response => response.json())
    //   .then(prodiRes => {
    //     const prodi = prodiRes[0]; // Access the first (and only) object in the array
    //     const sksMinimal = prodi.sks_minimal;
    //     const nilaiDMaksimal = prodi.nilai_d_maksimal;
    //     const ipkMinimal = prodi.ipk_minimal;
    //     console.log(sksMinimal);
    //     console.log(nilaiDMaksimal);
    //     console.log(ipkMinimal);
    //   });

    fetch(`/get-matakuliah?kode_prodi=${value}`)
      .then(response => response.json())
      .then(data => {
        // Group the data by semester
        const groupedData = data.reduce((acc, item) => {
          if (item.semester <= 2) { // Only include semesters 1 and 2
            if (!acc[item.semester]) {
              acc[item.semester] = [];
            }
            acc[item.semester].push(item);
          }
          return acc;
        }, {});

        // Create a new container for each semester
        Object.entries(groupedData).forEach(([semester, items]) => {
          const separator = document.createElement('hr');
          newSemesterField.appendChild(separator);

          const heading = document.createElement('h3');
          heading.textContent = `Semester ${semester}`;
          newSemesterField.appendChild(heading);

          const container = document.createElement('div');
          container.classList.add('container');
          newSemesterField.appendChild(container);

          // Create a new row for the table header
          const headerRow = document.createElement('div');
          headerRow.classList.add('row');
          container.appendChild(headerRow);

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

          // Create a new column for each item in the semester
          items.forEach(item => {
            const row = document.createElement('div');
            row.classList.add('row');
            container.appendChild(row);

            const kodeCell = document.createElement('div');
            kodeCell.classList.add('col', 'col-1', 'd-flex', 'justify-content-center'); // Add the d-flex and justify-content-center classes to center the checkbox
            row.appendChild(kodeCell);

            const kodeCheckbox = document.createElement('input');
            kodeCheckbox.type = 'checkbox';
            kodeCheckbox.name = 'matakuliah[]';
            kodeCheckbox.value = item.kode_matakuliah;
            kodeCheckbox.id = item.kode_matakuliah;
            kodeCheckbox.dataset.sks = item.sks; // Add the SKS value as a data attribute
            kodeCell.appendChild(kodeCheckbox);

            const namaCell = document.createElement('div');
            namaCell.classList.add('col');
            namaCell.textContent = item.nama;
            row.appendChild(namaCell);

            const sksCell = document.createElement('div');
            sksCell.classList.add('col', 'col-1', 'd-flex', 'justify-content-center');
            sksCell.textContent = item.sks;
            row.appendChild(sksCell);

            //Beta Feature
            const inputCell = document.createElement('div');
            inputCell.classList.add('col', 'col-1', 'd-flex', 'justify-content-center'); // Add the col-3 class to make the input element take up 3 columns
            row.appendChild(inputCell);

            const inputElement = document.createElement('select');
            inputElement.name = 'nilai[]'; // Set the name of the input element to nilai[]
            inputElement.className = 'form-control'; // Add the form-control class to make the input element look like a Bootstrap form element
            inputCell.appendChild(inputElement);

            const grades = ['A', 'B', 'C', 'D', 'E']; // Define an array of grades

            grades.forEach(grade => {
              const option = document.createElement('option');
              option.value = grade;
              option.textContent = grade;
              inputElement.appendChild(option);
            });
          });
        });

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


        // Create the input option with values 1, 2, 3, and 4
        const inputOption = document.createElement('select');
        inputOption.name = 'Konsentrasi';
        inputOption.id = 'konsentrasi';
        inputOption.className = 'form-select';
        newPilihanKonsentrasi.appendChild(inputOption);

        const option1 = document.createElement('option');
        option1.value = '';
        option1.text = 'Pilih Konsentrasi';
        inputOption.appendChild(option1);

        const option2 = document.createElement('option');
        option2.value = 'Web Development';
        option2.text = 'Web Development';
        inputOption.appendChild(option2);

        const option3 = document.createElement('option');
        option3.value = 'Animasi 2D';
        option3.text = 'Animasi 2D';
        inputOption.appendChild(option3);

        const option4 = document.createElement('option');
        option4.value = 'Networking';
        option4.text = 'Networking';
        inputOption.appendChild(option4);

        // Add an event listener to the konsentrasi input option
        inputOption.addEventListener('change', () => {
          const konsentrasiValue = inputOption.value;

          if (konsentrasiValue) {
            // Remove the existing konsentrasiField div from the DOM
            const konsentrasiField = document.getElementById('konsentrasiField');
            if (konsentrasiField) {
              konsentrasiField.remove();
            }

            // Create a new konsentrasiField div
            const newKonsentrasiField = document.createElement('div');
            newKonsentrasiField.id = 'konsentrasiField';
            matakuliahField.appendChild(newKonsentrasiField);

            fetch(`/get-konsentrasi?kode_prodi=${value}&konsentrasi=${konsentrasiValue}`)
              .then(response => response.json())
              .then(data => {
                // Group the data by semester
                const groupedData = data.reduce((acc, item) => {
                  if (item.semester >= 3 && (item.nama_konsentrasi === null || item.nama_konsentrasi === inputOption.value)) { // Only include semesters 3 and above and matching konsentrasi or null
                    if (!acc[item.semester]) {
                      acc[item.semester] = [];
                    }
                    acc[item.semester].push(item);
                  }
                  return acc;
                }, {});

                // Create a new container for each semester
                Object.entries(groupedData).forEach(([semester, items]) => {
                  const separator = document.createElement('hr');
                  newKonsentrasiField.appendChild(separator);

                  const heading = document.createElement('h3');
                  heading.textContent = `Semester ${semester}`;
                  newKonsentrasiField.appendChild(heading);

                  const container = document.createElement('div');
                  container.classList.add('container');
                  newKonsentrasiField.appendChild(container);

                  // Create a new row for the table header
                  const headerRow = document.createElement('div');
                  headerRow.classList.add('row');
                  container.appendChild(headerRow);

                  const kodeHeader = document.createElement('div');
                  kodeHeader.classList.add('col', 'fw-bold', 'col-1', 'd-flex', 'justify-content-center'); // Add the fw-bold class to make the text bold
                  kodeHeader.textContent = 'Pilih';
                  headerRow.appendChild(kodeHeader);

                  const namaHeader = document.createElement('div');
                  namaHeader.classList.add('col', 'fw-bold'); // Add the fw-bold class to make the text bold
                  namaHeader.textContent = 'Nama';
                  headerRow.appendChild(namaHeader);

                  const sksHeader = document.createElement('div');
                  sksHeader.classList.add('col', 'fw-bold', 'd-flex', 'justify-content-center'); // Add the fw-bold class to make the text bold
                  sksHeader.textContent = 'SKS';
                  headerRow.appendChild(sksHeader);

                  // Create a new row for each item in the semester
                  items.forEach(item => {
                    const row = document.createElement('div');
                    row.classList.add('row');
                    container.appendChild(row);

                    const kodeCell = document.createElement('div');
                    kodeCell.classList.add('col', 'col-1', 'd-flex', 'justify-content-center'); // Add the d-flex and justify-content-center classes to center the checkbox
                    row.appendChild(kodeCell);

                    const kodeCheckbox = document.createElement('input');
                    kodeCheckbox.type = 'checkbox';
                    kodeCheckbox.name = 'matakuliah[]';
                    kodeCheckbox.value = item.kode_matakuliah;
                    kodeCheckbox.id = item.kode_matakuliah;
                    kodeCheckbox.dataset.sks = item.sks; // Add the SKS value as a data attribute
                    kodeCell.appendChild(kodeCheckbox);

                    const namaCell = document.createElement('div');
                    namaCell.classList.add('col');
                    namaCell.textContent = item.nama;
                    row.appendChild(namaCell);

                    const sksCell = document.createElement('div');
                    sksCell.classList.add('col', 'd-flex', 'justify-content-center');
                    sksCell.textContent = item.sks;
                    row.appendChild(sksCell);
                  });
                });
              })
              .catch(error => console.error(error));
          } else {
            // Remove the existing konsentrasiField div from the DOM
            const konsentrasiField = document.getElementById('konsentrasiField');
            if (konsentrasiField) {
              konsentrasiField.remove();
            }
          }
        });
      })
      .catch(error => console.error(error));
  } else {
    // Remove the existing semesterField div from the DOM
    const semesterField = document.getElementById('semesterField');
    if (semesterField) {
      semesterField.remove();
    }
  }
});

// Add an event listener to the form submit event to calculate the total SKS
const form = document.getElementById('form');
const gradesElement = document.createElement('div');
form.appendChild(gradesElement);

form.addEventListener('submit', event => {
  event.preventDefault();

  const checkboxes = document.querySelectorAll('input[name="matakuliah[]"]:checked');
  let totalSks = 0;
  let totalGradePoints = 0;
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

  const sksField = document.getElementById('sksField');
  const gradesDisplay = document.createElement('div');
  const ipkField = document.getElementById('ipkField');
  
  if (sksField && gradesElement && ipkField) {
    sksField.textContent = `Total SKS: ${totalSks}`;
    gradesDisplay.textContent = `Grades: ${JSON.stringify(grades)}`;
    gradesElement.appendChild(gradesDisplay);
  
    const ipk = totalGradePoints / totalSks;
    ipkField.textContent = `IPK: ${ipk.toFixed(2)}`;
  
    const kode_prodi = document.getElementById('kode_prodi');
    const value = kode_prodi.value;
    // Calculate how many SKS are still needed
    fetch(`/get-prodi?kode_prodi=${value}`)
      .then(response => response.json())
      .then(prodiRes => {
        const prodi = prodiRes[0]; // Access the first (and only) object in the array
        const sksMinimal = prodi.sks_minimal;
        const nilaiDMaksimal = prodi.nilai_d_maksimal;
        const ipkMinimal = prodi.ipk_minimal;
        const sksStillNeeded = sksMinimal - totalSks;
        const sksDisplay = document.createElement('div');
        sksDisplay.textContent = `SKS still needed: ${sksStillNeeded}`;
        gradesElement.appendChild(sksDisplay);
  
        const dGradesSelected = grades['D'];
        const dGradesStillAllowed = ((nilaiDMaksimal / 100) * sksMinimal) - dGradesSelected;
        const dGradesDisplay = document.createElement('div');
        dGradesDisplay.textContent = `D grades still allowed: ${dGradesStillAllowed}`;
        gradesElement.appendChild(dGradesDisplay);
  
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
                generateLabels: function(chart) {
                  const data = chart.data;
                  if (data.labels.length && data.datasets.length) {
                    return data.labels.map(function(label, index) {
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
  
        
        // const sksChartContainer = document.createElement('canvas');
        // sksChartContainer.id = 'sksChartContainer';
        // gradesElement.appendChild(sksChartContainer);
        // new Chart(sksChartContainer, sksChartOptions);
  
        const sksChartContainer = document.getElementById('sksChartContainer');
        new Chart(sksChartContainer, sksChartOptions);

        // Create IPK chart
        const ipkSelisih = 4 - ipk ;
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
                generateLabels: function(chart) {
                  const data = chart.data;
                  if (data.labels.length && data.datasets.length) {
                    return data.labels.map(function(label, index) {
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
  
        // const ipkChartContainer = document.createElement('canvas');
        // ipkChartContainer.id = 'ipkChartContainer';
        // gradesElement.appendChild(ipkChartContainer);
        // new Chart(ipkChartContainer, ipkChartOptions);

        const ipkChartContainer = document.getElementById('ipkChartContainer');
        new Chart(ipkChartContainer, ipkChartOptions);
  
  
      })
      .catch(error => {
        console.error(error);
      });
  } else {
    console.error('sksField or gradesElement or ipkField is null');
  }
});