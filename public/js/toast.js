window.addEventListener('load', () => {
    // show toast message when update / add
    const toastMessage = document.querySelector('#toast-message');
    const toastContainer = document.querySelector('#toast-container');
    setTimeout(() => {
        toastMessage.classList.remove('show');
        toastContainer.setAttribute('style', 'z-index: -1');
    }, 3000);

    });