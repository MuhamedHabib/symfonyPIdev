
/*----------------------------------------------------*/
/*  Plus de blog triggered
/*----------------------------------------------------*/
$('body').off('click.btn-load-blogs').on('click.btn-load-blogs', '#btn-load-blogs', function () {
    loadBlog()
});
$('body').off('change.search-field').on('change.search-field', '.search-field', function () {
    loadSearchedBlog($(this).val())
});

$(".fb-comments").attr("data-href", window.location.href);


$(window).load(function () {
    hidePlusButton();
    loadBlog();
});
/*----------------------------------------------------*/
function loadBlog(){
    let data = {};
    let loader = $('#blog-loader');
    let articlePlaceholder=$('#article-placeholder');
    let offset=$('#offset');
    data['offset']=offset.val();
    loader.fadeIn(500);
    $.ajax({
        url: '/show/blogs/article',
        type: 'GET',
        data: data,
        success: function (html) {
            if (html !== "") {
                showPlusButton();
                articlePlaceholder.append(html);
                countBlog();
            }else {
                hidePlusButton()
            }
            loader.fadeOut(500).hide();
        },
        error: function (error) {
        }
    });
}
/*----------------------------------------------------*/
function loadSearchedBlog(search){
    if(search === ''){
        let offset=$('#offset');
        offset.val(0);
        loadBlog();
    }else {
        let data = {};
        let loader = $('#blog-loader');
        let articlePlaceholder = $('#article-placeholder');
        loader.fadeIn(500);
        data['search'] = search;
        articlePlaceholder.empty();
        $.ajax({
            url: '/show/blogs/article/search',
            type: 'GET',
            data: data,
            success: function (html) {
                if (html !== "") {
                    articlePlaceholder.append(html);
                }else {
                    hidePlusButton()
                }
                loader.fadeOut(500).hide();
            },
            error: function (error) {
            }
        });
    }
}
/*----------------------------------------------------*/
/*  count articles and stock it in offset
/*----------------------------------------------------*/
function countBlog() {
    let offset=$('#offset');
    offset.val($('div.blog-post').length);
}

function hidePlusButton() {
    let btnPlus= $('#btn-load-blogs');
    btnPlus.hide();
}

function showPlusButton() {
    let btnPlus= $('#btn-load-blogs');
    btnPlus.show();
}

