

var boarddata;
var tcms = new TrelloCMS();

$(init);

function init() {
    $(document).foundation();
    
    //get api key: https://trello.com/app-key
    //https://trello.com/1/authorize?key=60bfcf8e3b89bae3d7a7b20e383506c9&scope=read&name=AndrewWalpolePortfolio&expiration=never&response_type=token
    tcms.quietAuth( "AndrewWalpolePortfolio", "2386a520a381119a18d977adb62c88e861ae76b43eb5de823f8f240dc6ab886e", { success:start } );


    // Initialize Firebase
    // var config = {
    //     apiKey: "AIzaSyDwGuxgxXZ4G4QvdyhR7RLaI2Av5c3H86E",
    //     authDomain: "andrewwalpole-portfolio.firebaseapp.com",
    //     databaseURL: "https://andrewwalpole-portfolio.firebaseio.com",
    //     storageBucket: "andrewwalpole-portfolio.appspot.com",
    // };
    // firebase.initializeApp(config);
    
    //var portfolioDB = firebase.database().ref();
    //var resume = portfolioDB.child("resume");
    // resume.child("work").push( {
    //     name:"",
    //     description:"",
    //     link:"",
    //     images: [
    //         ""
    //     ],
    //     tags:[""]
    // })
    //.set({ { resume:{} } });

}

function start() {
    
    //var req = "members/me";
    
    var req = "boards/568ff7ee46a5b4c266c51ec7?lists=open&cards=open&labels=all&card_checklists=all&card_attachments=true";
    
    Trello.get(req,
    function(r) { 
        console.log(r);
        boarddata = r;
        
        initPortfolioItems();
    },
    function(e) {
        console.log("error", e);
    });
}

function initPortfolioItems() {
    
    var container = $("#masonry-container");
    
    var cards = getCardsByLabel( "portfolio item" );
    
    console.log( cards );
    
    for( var i = 0; i < cards.length; i++ ) {
        container.append( createPortfolioItem( cards[i] ) );
    }

    //make the pretty grid
    //masonryLayout();
    
}

function createPortfolioItem( itemData ) {
    
    console.log( itemData );
    
    var item = $("<li>")
        .addClass("portfolio-item")
        .click( function() {
            loadPortfolioItemContent( itemData );
            $("#portfolio-modal").foundation("open");
        });
    
    $("<h4>").html( itemData.name ).appendTo(item);
    
    if( itemData.attachments.length > 0 ) {
        $("<img>")
            .attr("src", itemData.attachments[0].url)
            .appendTo(item);
    }

    item.imagesLoaded(function () {
        masonryLayout();
    });
    
    return item;
    
}

function masonryLayout() {
    $('#masonry-container').masonry({
        itemSelector: '#masonry-container li'
    });
}

function loadPortfolioItemContent( itemData ) {


    console.log( itemData );
    var $content = $("#portfolio-modal #portfolio-item-content").empty();

    
    

    $("<h2>").text( itemData.name ).appendTo($content);
    $("<div>")
        .addClass("portfolio-description")
        .html( marked(itemData.desc) )
        .appendTo($content);

    for( var i = 0; i < itemData.attachments.length; i++ ) {
        $("<img>")
        .attr("src", itemData.attachments[i].url)
        .appendTo($content);
    }

}




////////////////////
///////HELPERS//////
////////////////////

//return array of cards with specific label
function getCardsByLabel( labelName ) {
    
    var c = [];
    for( var i = 0; i < boarddata.cards.length; i++ ) {
        if( cardHasLabel( boarddata.cards[i], labelName ) ) {
            c.push(boarddata.cards[i]);
        }   
    }
    
    return c;
    
}

//return true if card has a specific label
function cardHasLabel( cardData, labelName ) {
    
    for( var i = 0; i < cardData.labels.length; i++ ) {
        if( cardData.labels[i].name.toLowerCase() === labelName.toLowerCase() ) {
            return true;
        }
    }
    
    return false;
}
