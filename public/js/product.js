window.addEventListener('load', (event) => {
    console.log('Product loaded');
    pathArray = window.location.pathname.split('/');
    productId = pathArray[pathArray.length - 1];
    
    updateViewCount(productId);
    
});

function updateViewCount(productId) {
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log(token)
    fetch('/products/updateViewCount', {
        method: 'POST',
        headers: {
            'Accept': 'application/json, text/plain, */*',
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token
        },
        credentials: 'same-origin',
        body: JSON.stringify({
            productId: productId
        })
    }).then(function(res) {
        return res.json();
    }).catch(function(error) {
        console.log(error);
    });
}