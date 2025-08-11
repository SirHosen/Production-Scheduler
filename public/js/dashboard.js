$(document).ready(function() {
    // Sidebar toggle
    $('#sidebarToggle, #sidebarToggleDesktop').on('click', function() {
        $('.sidebar').toggleClass('collapsed');
    });
    
    // Mobile sidebar toggle
    $('#sidebarToggle').on('click', function() {
        $('.sidebar').toggleClass('show');
    });
    
    // Close sidebar when clicking outside on mobile
    $(document).on('click', function(e) {
        if ($(window).width() < 992) {
            if (!$(e.target).closest('.sidebar').length && !$(e.target).closest('#sidebarToggle').length) {
                $('.sidebar').removeClass('show');
            }
        }
    });
    
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
    
    // Tooltip initialization
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
