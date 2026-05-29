const gold = '#C9A84C';

new Chart(document.getElementById('recordsChart'), {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        datasets: [{
            data: monthlyData,
            borderColor: gold,
            borderWidth: 2,
            pointBackgroundColor: gold,
            fill: true,
            backgroundColor: 'rgba(201,168,76,0.15)',
            tension: 0.4,
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { color: '#f0f0f0' } },
            y: { grid: { color: '#f0f0f0' }, ticks: { precision: 0 } }
        }
    }
});

new Chart(document.getElementById('typeChart'), {
    type: 'doughnut',
    data: {
        labels: Object.keys(typeData),
        datasets: [{
            data: Object.values(typeData),
            backgroundColor: [gold, '#6c757d', '#adb5bd', '#dee2e6', '#111111'],
            borderWidth: 0,
            hoverOffset: 6,
        }]
    },
    options: {
        cutout: '60%',
        plugins: { legend: { display: false } }
    }
});