<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>@yield('page.title', 'diplom')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        var searchPagesUrl = "{{ route('search.pages') }}";
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css\base.css') }}" >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
</head>
<body>
    @include('layouts.navbar')
    @yield('content')
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').on('input', function() {
                var query = $(this).val();
                if (query.length >= 3) {
                    $.ajax({
                        url: searchPagesUrl,
                        method: "GET",
                        dataType: "json",
                        success: function(data) {
                            var html = '';
                            $.each(data, function(index, value) {
                                if (value.title && value.title.toLowerCase().indexOf(query.toLowerCase()) !== -1 && !value.path.includes("destroy") && !value.path.includes("update") && !value.path.includes("edit") && !value.path.includes("show")) {
                                    html += '<li><a class="dropdown-item" href="' + value.path + '">' + value.title + '</a></li>';
                                }
                            });
                            $('#search-results').html(html);
                            $('#search-results').addClass('show');
                        }
                    });
                } else {
                    $('#search-results').html('');
                    $('#search-results').removeClass('show');
                }
            });
        
            $(document).on('click', '#search-results a', function(e) {
            e.preventDefault();
            var routeUrl = new URL($(this).attr('href'), window.location.origin).pathname;
            window.location.href = routeUrl;
            $('#search-input').val('');
            $('#search-results').removeClass('show');
            });
        
            $(document).click(function(e) {
                if (!$(e.target).closest('#search-results').length) {
                    $('#search-results').removeClass('show');
                }
            });
        });
        //
        document.addEventListener('DOMContentLoaded', function () {
            function initializePagination(containerId, buttonClass) {
                const pageButtons = document.querySelectorAll(`#${containerId} .${buttonClass}`);
                const cardGroups = document.querySelectorAll(`#${containerId} .card-group`);
                const dots = document.querySelector(`#${containerId} .dots`);
                const maxVisibleButtons = 5;
                let currentPage = 1;
            
                function updatePagination() {
                    const totalGroups = cardGroups.length;
                    const totalPages = Math.ceil(totalGroups / maxVisibleButtons);
                    const startPage = Math.max(currentPage - 2, 1);
                    const endPage = Math.min(startPage + maxVisibleButtons - 1, totalPages);
                
                    pageButtons.forEach(button => {
                        const page = parseInt(button.getAttribute('data-target'));
                        if (page >= startPage && page <= endPage) {
                            button.style.display = 'inline-block';
                        } else {
                            button.style.display = 'none';
                        }
                    });
                
                    if (dots) {
                        dots.style.display = (totalGroups > maxVisibleButtons) ? 'inline-block' : 'none';
                    }
                }
            
                pageButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const targetGroup = parseInt(this.getAttribute('data-target'));
                        currentPage = targetGroup;
                    
                        cardGroups.forEach(group => {
                            group.style.display = (parseInt(group.getAttribute('data-group')) === targetGroup) ? 'block' : 'none';
                        });
                    
                        updatePagination();
                    });
                });
            
                if (pageButtons.length > 0) {
                    pageButtons[0].classList.add('active');
                }
                updatePagination();
            }
        
            initializePagination('files-container', 'page-button');
        
            initializePagination('forum-container', 'page-button');
        });
    </script>
    @stack('scripts')
</body>
</html>