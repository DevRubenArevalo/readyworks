// random color sets
function randomColors(number) {
    return randomColor({count: number});
}

const colorSet = randomColors(Math.floor(Math.random() * 100));

// Helper function
const arrayColumn = (array, column) => {
    return array.map(item => item[column]);
};

// API Sanity test
async function getApiTest() {
    return await axios.get('/api/v1/test');
}

async function getTopTenComputerModels() {
    let res = await axios.get('/api/v1/top-ten-computer-models');
    let computerModels = res.data;

    // console.log(computerModels);

    let computerModelNames = arrayColumn(computerModels, 'Computer Model');
    let computerModelCounts = arrayColumn(computerModels, 'Count');

    // console.log(computerModelNames);
    // console.log(computerModelCounts);

    const ctx1 = document.getElementById('PieChart1');
    const PieChart1 = new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: computerModelNames,
            datasets: [{
                backgroundColor: colorSet,
                data: computerModelCounts
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Top 10 Computer Models'
                },
                legend:{
                    display:true,
                    position:'right'
                }
            }
        },
    });
}

async function getOperatingSystemCounts() {
    let res = await axios.get('/api/v1/operating-system-counts');
    let operatingSystems = res.data;

    // console.log(operatingSystems);

    let operatingSystemNames = arrayColumn(operatingSystems, 'Operating System');
    let operatingSystemsCounts = arrayColumn(operatingSystems, 'Count');

    // console.log(operatingSystemNames);
    // console.log(operatingSystemsCounts);

    const ctx2 = document.getElementById('PieChart2');
    const PieChart2 = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: operatingSystemNames,
            datasets: [{
                label: "my first dataset",
                backgroundColor: colorSet,
                data: operatingSystemsCounts
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Computers by Operating System'
                },
                legend:{
                    display:true,
                    position:'right'
                }
            }
        },
    });
}

async function getLocationCounts() {
    let res = await axios.get('/api/v1/location-counts');
    let locations = res.data;

    // console.log(locations);

    let locationNames = arrayColumn(locations, 'Location');
    let locationCounts = arrayColumn(locations, 'Count');

    // console.log(locationNames);
    // console.log(locationCounts);

    const ctx3 = document.getElementById('BarChart1');
    const BarChart1 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: locationNames,
            datasets: [{
                backgroundColor: colorSet,
                data: locationCounts
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Computers by Location'
                },
                legend:{
                    display:false
                },

            }
        },
    });
}

async function initDatatable() {
    let res = await axios.get(`/api/v1/table`);
    let initialFormattedDatatableHtml = res.data;

    $('#DataTable').html(initialFormattedDatatableHtml);
}

getApiTest();
