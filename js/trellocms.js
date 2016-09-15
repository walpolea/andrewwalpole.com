//THIS SHOULD ONLY BE USED WITH VERY PUBLIC TRELLO CONTENT
//AS EVERYTHING IS EXPOSED ON THE CLIENT SIDE
var TrelloCMS = function() {

    var tcms = {};
    
    tcms.boarddata = {};
    
    tcms.quietAuth = function( n, t, options ) {
        
        //Quiet Auth works because you give it the app token ahead of time and it sets it in
        //localStorage where Trello's client.js looks for it when authenticating
        localStorage.setItem("tello_token", t);
        Trello.setToken( t );
        
        var default_opts = {
            name:n, 
            type:"redirect", 
            persist:true, 
            interactive:false, 
            scope:{ read: true, write: false, account: false }, 
            expiration:"never", 
            success: function() {
                console.log( "Trello Successfully Initialized" );   
            },
            error: function(e) {
                console.log("TrelloCMS ERROR: Something went wrong authenticating Trello", e);
            }
        };

        var opts = default_opts;
        if( options ) {
            for( var key in options ) {
                opts[key] = options[key];
            }
        }
        
        Trello.authorize(opts);
    }
    
    tcms.loadBoard = function( boardID, options ) {
        
        var opts = "?";
        
        if(!options) {
            opts = "?lists=open&cards=open&labels=all&card_checklists=all&card_attachments=true";
        } else {
            for( var key in options ) {
                opts += key + "=" + options[key] + "&";
            }
        }
        
        var req = "boards/"+boardID + opts;
    
        Trello.get(req,
            function(r) { 
                console.log(r);
                this.boarddata = r;
            },
            function(e) {
                console.log("error", e);
            }
        );
    }
    
    tcms.getCardsByLabelName = function( labelName ) {
    
        var c = [];
        for( var i = 0; i < this.boarddata.cards.length; i++ ) {
            if( cardHasLabel( this.boarddata.cards[i], labelName ) ) {
                c.push( this.boarddata.cards[i] );
            }   
        }
        
        return c;
        
    }
    
    tcms.cardHasLabel = function( cardData, labelName ) {
    
        for( var i = 0; i < cardData.labels.length; i++ ) {
            if( cardData.labels[i].name.toLowerCase() === labelName.toLowerCase() ) {
                return true;
            }
        }
        
        return false;
    }
    
    tcms.getCardById = function( id ) {
        //console.log( id );
        for( var i = 0; i < this.boarddata.cards.length; i++ ) {
            
            if( this.boarddata.cards[i].id == id ) {
                return this.boarddata.cards[i];
            }
        }
        //console.log("no card found");
        return undefined;
    }

    tcms.getCardByName = function( name ) {
        for( var i = 0; i < this.boarddata.cards.length; i++ ) {
            
            if( this.boarddata.cards[i].name.toUpperCase() == name.toUpperCase() ) {
                return this.boarddata.cards[i];
            }
        }
        return undefined;
    }
    
    tcms.getListById = function( id ) {
        for( var i = 0; i < this.boarddata.lists.length; i++ ) {
            
            if( this.boarddata.lists[i].id == id ) {
                return this.boarddata.lists[i];
            }
        }
        return undefined;
    }

    tcms.getListByName = function( name ) {
        for( var i = 0; i < this.boarddata.lists.length; i++ ) {
            
            if( this.boarddata.lists[i].name.toUpperCase() == name.toUpperCase() ) {
                return this.boarddata.lists[i];
            }
        }
        return undefined;
    }
    
    tcms.getChecklistByName = function( card, checklistName ) {
        
        card = evalCard(card);
        
        for( var i = 0; i < card.checklists.length; i++ ) {
            var cl = card.checklists[i];
            if( cl.name === clName ) {
                return cl;
            }
        }
        return undefined;
    }
    
    
    
    tcms.getValueByChecklistName = function( card, checklistName ) {
        
        card = evalCard(card);
        
        for( var i = 0; i < card.checklists.length; i++ ) {
            var cl = card.checklists[i];
            if( cl.name === name && cl.checkItems.length > 0 ) {
                return cl.checkItems[0].name;
            }
        }
        return undefined;
    }
    
    function evalCard( card ) {
        if( typeof(card) === "string" ) {
            return getCardById(card);
        }
        
        return card;
    }
    
    
    return tcms;
    
};