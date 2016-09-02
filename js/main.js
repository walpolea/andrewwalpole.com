function quietAuth( n, t, cb ) {
    localStorage.setItem("tello_token", t);
    Trello.setToken( t );
    
    var opts = {
        name:n,
        type:"redirect",
        persist:true,
        interactive:false,
        scope:{ read: true, write: true, account: true },
        expiration:"never",
        success: cb,
        error: function(e) {
            //console.log("error, something went wrong with quiet authentication", e);
        }
    };
    
    Trello.authorize(opts);
}

Foundation.set_namespace = function () {
  this.global.namespace = [];
};


var boarddata;


$(init);

function init() {
    $(document).foundation();
    //https://trello.com/1/authorize?key=60bfcf8e3b89bae3d7a7b20e383506c9&scope=read&name=AndrewWalpolePortfolio&expiration=never&response_type=token
    quietAuth( "AndrewWalpolePortfolio", "2386a520a381119a18d977adb62c88e861ae76b43eb5de823f8f240dc6ab886e", function() { start(); } );
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
    
    var container = $("#portfolio-items");
    
    var cards = getCardsByLabel( "portfolio item" );
    
    console.log( cards );
    
    for( var i = 0; i < cards.length; i++ ) {
        container.append( createPortfolioItem( cards[i] ) );
    }
    
}

function createPortfolioItem( itemData ) {
    
    console.log( itemData );
    
    var item = $("<li>").addClass("portfolio-item").addClass("column");
    var content = $("<div>").addClass("portfolio-item-content");
    
    var title = $("<h4>").html( itemData.name );
    content.append(title);
    
    if( itemData.attachments.length > 0 ) {
        var img = $("<img>").attr("src", itemData.attachments[0].url);
        content.append(img);
    }
    
    item.append(content);
    
    return item;
    
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