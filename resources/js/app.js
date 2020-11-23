require('./bootstrap');

window.onload = () => {
    initYearSelector();
};

function initYearSelector() {
    const yearSelector = document.getElementById('year-selector');

    if (!yearSelector) {
        return;
    }

    yearSelector.addEventListener('change', () => {
        document.getElementById('year-selector-form').submit();
    });
}
