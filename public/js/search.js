window.addEventListener('load', (event) => {
    let searchParams = new URLSearchParams(window.location.search);
    
    // for each url search parameter
    for (const [key, value] of searchParams.entries()) {
        // if parameter is an advanced search param
        if (['or', 'oc', 'brewer', 'brand', 'fp', 'stock', 'sort'].indexOf(key) >= 0) {
            if (key !== 'sort' && value !== '') {
                toggleAdvancedSearch();
                return false;
            }

            if (key === 'sort' && value !== 'Most Popular (default)') {
                toggleAdvancedSearch();
                return false;
            }
        }
    }
});

function toggleAdvancedSearch() {
    asDiv = document.getElementById('advanced-search');
    asBtn = document.getElementById('advanced-search-toggle');

    if (asDiv.style.display === '' || asDiv.style.display === 'none') {
        asDiv.style.display = 'block';
        asBtn.textContent = 'Hide Advanced Search Options';
    } else {
        asDiv.style.display = 'none';
        asBtn.textContent = 'Advanced Search';
    }
}