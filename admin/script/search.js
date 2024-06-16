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
        $('#mnav-search-result').removeClass('hidden');
        $('#mnav-search-result').addClass('flex');
    }
});

// mobile search
$('#mnav-search-input').on('input', () => {
    let searchValue = $('#mnav-search-input').val();

    if (searchValue.length > 0) {
        $('#mnav-search-result').removeClass('hidden');
        $('#mnav-search-result').addClass('flex');
    } else {
        $('#mnav-search-result').removeClass('flex');
        $('#mnav-search-result').addClass('hidden');
    }

    $.ajax({
        url: 'includes/m-search.php',
        type: 'GET',
        data: { 
            keyword: searchValue 
        },
        success: (data) => {
            $('#mnav-search-result').html(data);
        }
    });
});

$('#mnav-search-btn').on('click', () => {
    $('#mnav-form-container').toggleClass('hidden flex');
    $('#mnav-search-input').focus();
});

$('#mnav-search-input').on('focusin', () => {
    let searchValue = $('#mnav-search-input').val();

    if (searchValue.length > 0) {
        $('#mnav-search-result').removeClass('flex');
        $('#mnav-search-result').addClass('hidden');
    }
});

$('#mnav-search-input').on('focusout', () => {
    setTimeout(() => {
        $('#mnav-form-container').removeClass('flex');
        $('#mnav-form-container').addClass('hidden');
    }, 200);
});

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        $('#mnav-form-container').removeClass('flex').addClass('hidden');
        $('#search-result-container').removeClass('flex').addClass('hidden');
    }
})