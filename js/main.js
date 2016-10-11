function masonryLayout() {
    $('#masonry-container').masonry({
        itemSelector: '#masonry-container li'
    });
}


var tcms = new TrelloCMS();

$(init);

function init() {
    $(document).foundation();

    //get api key: https://trello.com/app-key
    //https://trello.com/1/authorize?key=60bfcf8e3b89bae3d7a7b20e383506c9&scope=read&name=AndrewWalpolePortfolio&expiration=never&response_type=token
    tcms.quietAuth("AndrewWalpolePortfolio", "2386a520a381119a18d977adb62c88e861ae76b43eb5de823f8f240dc6ab886e", { success: start });

}



function start() {


    tcms.loadBoard("568ff7ee46a5b4c266c51ec7", initPortfolio);

}

function initPortfolio() {

    initPortfolioItems();
    initPortfolioFilters();

    //Handlers
    $("#work-filter-input").keyup(function(e) {
        var search = $(e.target).val();
        if (search === "") {
            removePortfolioFilter();
        } else {
            filterPortfolio(tcms.searchCards(search));
        }
    })

    $(".filter-tag").click(function(e) {

        $("#work-filter-input").val("");

        var f = $(e.target);

        if (f.hasClass("filter-on")) {

            f.removeClass("filter-on");
            removePortfolioFilter();

        } else {

            $(".filter-tag.filter-on").removeClass("filter-on");
            f.addClass("filter-on");
            filterPortfolio(tcms.getCardsByLabelName(f.attr("data-labelname")));
        }

    });
}

function initPortfolioItems() {

    var container = $("#masonry-container");
    var cards = tcms.getCardsByLabelName("portfolio item");

    for (var i = 0; i < cards.length; i++) {
        container.append(createPortfolioItem(cards[i]));
    }

}

function createPortfolioItem(itemData) {

    var item = $("<li>")
        .attr("id", "pi-" + itemData.id)
        .addClass("portfolio-item")
        .click(function() {
            loadPortfolioItemContent(itemData);
            $("#portfolio-modal").foundation("open");
        });

    $("<h4>").html(itemData.name).appendTo(item);

    if (itemData.attachments.length > 0) {
        $("<img>")
            .attr("src", itemData.attachments[0].url)
            .appendTo(item);
    }

    item.imagesLoaded(function() {
        masonryLayout();
    });

    return item;

}

function initPortfolioFilters() {

    var container = $("ul.filter-tags");
    container.empty();

    tcms.getBoardLabelNames("yellow").forEach(function(tag) {
        $("<li>")
            .addClass("filter-tag")
            .attr("data-labelname", tag)
            .html(tag)
            .appendTo(container);
    });
}



function loadPortfolioItemContent(itemData) {

    var $content = $("#portfolio-modal #portfolio-item-content").empty();

    $("<h2>").text(itemData.name).appendTo($content);
    $("<div>")
        .addClass("portfolio-description")
        .html(marked(itemData.desc))
        .appendTo($content);

    for (var i = 0; i < itemData.attachments.length; i++) {
        $("<img>")
            .attr("src", itemData.attachments[i].url)
            .appendTo($content);
    }
}


function filterPortfolio(cards) {

    $(".portfolio-item").addClass("hidden");

    cards.forEach(function(card) {
        $("#pi-" + card.id).removeClass("hidden");
    })

    masonryLayout();
}

function removePortfolioFilter() {
    $(".portfolio-item").removeClass("hidden");
    masonryLayout();
}