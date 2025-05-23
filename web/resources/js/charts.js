// Chart.js Implementation for Admin and User Dashboards

// Utility Functions
function showLoading(chartIds) {
    chartIds.forEach(id => {
        const canvas = document.getElementById(id);
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.font = '16px Arial';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('Loading data...', canvas.width / 2, canvas.height / 2);
    });
}

function showError(chartIds) {
    chartIds.forEach(id => {
        const canvas = document.getElementById(id);
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.font = '16px Arial';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillStyle = 'red';
        ctx.fillText('Error loading data', canvas.width / 2, canvas.height / 2);
    });
}

function updateChartDescription(elementId, description) {
    const element = document.getElementById(elementId);
    if (element) {
        element.innerHTML = description || 'No data available.';
    }
}

// Family Planning Chart Functions
function updateFpMethodsChart(data) {
    const ctx = document.getElementById('fpMethodsChart')?.getContext('2d');
    if (!ctx) return;

    // Handle empty data
    if (!data || !data.labels || !data.values || data.labels.length === 0) {
        showError(['fpMethodsChart']);
        updateChartDescription('fpMethodsDescription', 'No data available.');
        return;
    }

    // Destroy previous chart instance if it exists
    if (window.fpMethodsChart instanceof Chart) {
        window.fpMethodsChart.destroy();
    }

    // Create new chart
    window.fpMethodsChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data.labels,
            datasets: [{
                data: data.values,
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#6f42c1',
                    '#fd7e14', '#20c9a6', '#858796', '#5a5c69'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        generateLabels: function (chart) {
                            const datasets = chart.data.datasets;
                            return chart.data.labels.map(function (label, i) {
                                const meta = chart.getDatasetMeta(0);
                                const style = meta.controller.getStyle(i);

                                return {
                                    text: label,
                                    fillStyle: style.backgroundColor,
                                    strokeStyle: style.borderColor,
                                    lineWidth: style.borderWidth,
                                    hidden: isNaN(datasets[0].data[i]) || meta.data[i].hidden,
                                    index: i
                                };
                            });
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Make chart interactive
    const chart = window.fpMethodsChart;
    chart.canvas.onclick = function (evt) {
        const points = chart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, true);
        if (points.length) {
            const firstPoint = points[0];
            const label = chart.data.labels[firstPoint.index];
            const value = chart.data.datasets[0].data[firstPoint.index];
            console.log('Selected:', label, value);
            // You can add additional interactive features here
        }
    };
}

function updateFpCompletionChart(data) {
    const ctx = document.getElementById('fpCompletionChart')?.getContext('2d');
    if (!ctx) return;

    // Handle empty data
    if (!data || !data.labels || !data.values || data.labels.length === 0) {
        showError(['fpCompletionChart']);
        updateChartDescription('fpCompletionDescription', 'No data available.');
        return;
    }

    // Destroy previous chart instance if it exists
    if (window.fpCompletionChart instanceof Chart) {
        window.fpCompletionChart.destroy();
    }

    // Create new chart
    window.fpCompletionChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data.labels,
            datasets: [{
                data: data.values,
                backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right'
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
}

function updateWraChart(data) {
    const ctx = document.getElementById('wraChart')?.getContext('2d');
    if (!ctx) return;

    // Handle empty data
    if (!data || !data.labels || !data.values || data.labels.length === 0) {
        showError(['wraChart']);
        updateChartDescription('wraDescription', 'No data available.');
        return;
    }

    // Destroy previous chart instance if it exists
    if (window.wraChart instanceof Chart) {
        window.wraChart.destroy();
    }

    // Create new chart
    window.wraChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data.labels,
            datasets: [{
                data: data.values,
                backgroundColor: ['#4e73df', '#e74a3b']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right'
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
}

function updateMonthlyFpChart(data) {
    const ctx = document.getElementById('monthlyFpChart')?.getContext('2d');
    if (!ctx) return;

    // Handle empty data
    if (!data || !data.labels || !data.values || data.labels.length === 0) {
        showError(['monthlyFpChart']);
        updateChartDescription('monthlyFpDescription', 'No data available.');
        return;
    }

    // Destroy previous chart instance if it exists
    if (window.monthlyFpChart instanceof Chart) {
        window.monthlyFpChart.destroy();
    }

    // Create new chart
    window.monthlyFpChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Records',
                data: data.values,
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                tension: 0.1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
}

// Immunization Chart Functions
function updateVaccineTypesChart(data) {
    const ctx = document.getElementById('vaccineTypesChart')?.getContext('2d');
    if (!ctx) return;

    // Handle empty data
    if (!data || !data.labels || !data.values || data.labels.length === 0) {
        showError(['vaccineTypesChart']);
        updateChartDescription('vaccineTypesDescription', 'No data available.');
        return;
    }

    // Destroy previous chart instance if it exists
    if (window.vaccineTypesChart instanceof Chart) {
        window.vaccineTypesChart.destroy();
    }

    // Create new chart
    window.vaccineTypesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Doses Administered',
                data: data.values,
                backgroundColor: '#36b9cc',
                borderColor: '#2c9faf',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeOutQuad'
            }
        }
    });
}

function updateImmCompletionChart(data) {
    const ctx = document.getElementById('immCompletionChart')?.getContext('2d');
    if (!ctx) return;

    // Handle empty data
    if (!data || !data.labels || !data.values || data.labels.length === 0) {
        showError(['immCompletionChart']);
        updateChartDescription('immCompletionDescription', 'No data available.');
        return;
    }

    // Destroy previous chart instance if it exists
    if (window.immCompletionChart instanceof Chart) {
        window.immCompletionChart.destroy();
    }

    // Create new chart
    window.immCompletionChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data.labels,
            datasets: [{
                data: data.values,
                backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right'
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            animation: {
                animateRotate: true,
                animateScale: true
            }
        }
    });
}

function updateAgeGroupChart(data) {
    const ctx = document.getElementById('ageGroupChart')?.getContext('2d');
    if (!ctx) return;

    // Handle empty data
    if (!data || !data.labels || !data.values || data.labels.length === 0) {
        showError(['ageGroupChart']);
        updateChartDescription('ageGroupDescription', 'No data available.');
        return;
    }

    // Destroy previous chart instance if it exists
    if (window.ageGroupChart instanceof Chart) {
        window.ageGroupChart.destroy();
    }

    // Create new chart
    window.ageGroupChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Children',
                data: data.values,
                backgroundColor: '#4e73df',
                borderColor: '#2e59d9',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeOutBounce'
            }
        }
    });
}

function updateMonthlyImmChart(data) {
    const ctx = document.getElementById('monthlyImmChart')?.getContext('2d');
    if (!ctx) return;

    // Handle empty data
    if (!data || !data.labels || !data.values || data.labels.length === 0) {
        showError(['monthlyImmChart']);
        updateChartDescription('monthlyImmDescription', 'No data available.');
        return;
    }

    // Destroy previous chart instance if it exists
    if (window.monthlyImmChart instanceof Chart) {
        window.monthlyImmChart.destroy();
    }

    // Create new chart
    window.monthlyImmChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Immunizations',
                data: data.values,
                borderColor: '#1cc88a',
                backgroundColor: 'rgba(28, 200, 138, 0.1)',
                tension: 0.1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
}

// Admin-only Chart Functions
function updateUserActivityChart(data) {
    const ctx = document.getElementById('userActivityChart')?.getContext('2d');
    if (!ctx) return;

    // Handle empty data
    if (!data || !data.labels || !data.values || data.labels.length === 0) {
        showError(['userActivityChart']);
        updateChartDescription('userActivityDescription', 'No data available.');
        return;
    }

    // Destroy previous chart instance if it exists
    if (window.userActivityChart instanceof Chart) {
        window.userActivityChart.destroy();
    }

    // Create new chart
    window.userActivityChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data.labels,
            datasets: [{
                data: data.values,
                backgroundColor: ['#1cc88a', '#e74a3b']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right'
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
}

function updateTopUsersChart(data) {
    const ctx = document.getElementById('topUsersChart')?.getContext('2d');
    if (!ctx) return;

    // Handle empty data
    if (!data || !data.labels || !data.values || data.labels.length === 0) {
        showError(['topUsersChart']);
        updateChartDescription('topUsersDescription', 'No data available.');
        return;
    }

    // Destroy previous chart instance if it exists
    if (window.topUsersChart instanceof Chart) {
        window.topUsersChart.destroy();
    }

    // Create new chart
    window.topUsersChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Activities',
                data: data.values,
                backgroundColor: '#4e73df'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            animation: {
                delay: function (context) {
                    return context.dataIndex * 100;
                }
            }
        }
    });
}

function updateLoginActivityChart(data) {
    const ctx = document.getElementById('loginActivityChart')?.getContext('2d');
    if (!ctx) return;

    // Handle empty data
    if (!data || !data.labels || !data.values || data.labels.length === 0) {
        showError(['loginActivityChart']);
        updateChartDescription('loginActivityDescription', 'No data available.');
        return;
    }

    // Destroy previous chart instance if it exists
    if (window.loginActivityChart instanceof Chart) {
        window.loginActivityChart.destroy();
    }

    // Create new chart
    window.loginActivityChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Logins',
                data: data.values,
                backgroundColor: '#36b9cc'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            animation: {
                duration: 1500,
                easing: 'easeInOutQuart'
            }
        }
    });
}

// Export functions to global scope
window.showLoading = showLoading;
window.showError = showError;
window.updateChartDescription = updateChartDescription;
window.updateFpMethodsChart = updateFpMethodsChart;
window.updateFpCompletionChart = updateFpCompletionChart;
window.updateWraChart = updateWraChart;
window.updateMonthlyFpChart = updateMonthlyFpChart;
window.updateVaccineTypesChart = updateVaccineTypesChart;
window.updateImmCompletionChart = updateImmCompletionChart;
window.updateAgeGroupChart = updateAgeGroupChart;
window.updateMonthlyImmChart = updateMonthlyImmChart;
window.updateUserActivityChart = updateUserActivityChart;
window.updateTopUsersChart = updateTopUsersChart;
window.updateLoginActivityChart = updateLoginActivityChart;

// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM Content Loaded');

    // Get the canvas element
    const ctx = document.getElementById('testChart');
    console.log('Canvas element:', ctx);

    if (ctx) {
        try {
            // Create a simple test chart
            const testChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow'],
                    datasets: [{
                        label: 'Test Dataset',
                        data: [12, 19, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
            console.log('Test chart created successfully');
        } catch (error) {
            console.error('Error creating test chart:', error);
        }
    } else {
        console.error('Canvas element not found');
    }
}); 