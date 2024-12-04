function gotoarticle(id) {
    window.location.href = "article.php?id=" + id;
}
//  úpravy našeptávání a vyhledávání (by Ondra)
function search_onInput(it) {
    const query = it.value.trim();
    if (query.length >= 2) {
        // AJAX požadavek na návrhy
        $.ajax({
            url: 'include/search_suggestions.php',
            method: 'GET',
            data: { query },
            success: function (data) {
                console.log('Načtené návrhy:', data); // Debug
                $('#suggestions').html(data).show();
            }
        });
    } else {
        $('#suggestions').hide();
    }
}

// Skrytí návrhů při kliknutí mimo vyhledávací pole
function document_onClick(e) {
    if (!$(e.target).closest('.search-container').length) {
        $('#suggestions').hide();
    }
}

// Odeslání formuláře
//function searchForm_onSubmit(e) {
//    const query = $('#search').val().trim();
//    if (!query) {
//        e.preventDefault(); 
//        flashError('#search');
//    }
//}

// Efekt probliknutí při prázdném vyhledávacím poli
function flashError(selector) {
    const element = $(selector);
    element.addClass('flash-error');
    setTimeout(() => element.removeClass('flash-error'), 500);
}
// end Ondra
// stylování rozhraní administrační aplikace (by TT)
    var style=-1;
    var styles={0:{
            "list-out":["col-sm-3"],
            "main-out":["col"],
            "messages-out":["col-sm-2","mx-3","border","rounded-3"]},
                1:{
            "list-out":["col"],
            "main-out":[],
            "messages-out":["col-sm-6","mx-3","border","rounded-3"]},
                2:{
            "list-out":["col-sm-3"],
            "main-out":["col-sm-6","bg-primary"],
            "messages-out":["overlayed","col-sm-4","mx-3","bg-dark","border-double","border-3","rounded-2"]},
                3:{
            "list-out":["col-sm-3"],
            "main-out":["col","bg-primary"],
            "messages-out":[]}};

function setLayout(mode) {
    if (style!=-1) {
        Object.keys(styles[style]).forEach(key => {
           styles[style][key].forEach(value => {
           $("#"+key).removeClass(value); 
           });
        });
    }
    style=mode;
    Object.keys(styles[style]).forEach(key => {
       $("#"+key).css("display",((styles[style][key].length==0)?"none":"block"));
       styles[style][key].forEach(value => {
       $("#"+key).addClass(value); 
       });
    });
}
function condLayout(cond,mode){
    if (style==cond) {setLayout(mode);return true;}
    }
//end TT