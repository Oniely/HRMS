$('#search-input').on('input', () => {
    let searchValue = $('#search-input').val();

    if (searchValue.length > 0) {
        $('#search-result-container').removeClass('hidden');
        $('#search-result-container').addClass('flex');
    } else {
        $('#search-result-container').removeClass('flex');
        $('#search-result-container').addClass('hidden');
    }

    $.ajax({
        url: 'includes/search.php',
        type: 'GET',
        data: { 
            keyword: searchValue 
        },
        success: (data) => {
            $('#search-result-container').html(data);
        }
    });
});

$('#search-input').on('focusout', () => {
    setTimeout(() => {
        $('#search-result-container').removeClass('flex');
        $('#search-result-container').addClass('hidden');
    }, 200);
});


$('#search-input').on('focusin', () => {
    let searchValue = $('#search-input').val();

    if (searchValue.length > 0) {
        $('#search-result-container').removeClass('hidden');
        $('#search-result-container').addClass('flex');
    }
});