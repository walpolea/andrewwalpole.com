var TrelloCMS = function() {
    
    
    var tcms = {};
    
    tcms.boarddata = {};
    
    tcms.quietAuth = function( n, t, cb ) {
        
        localStorage.setItem("tello_token", t);
        Trello.setToken( t );
        
        var opts = {
            name:n, type:"redirect", persist:true, interactive:false, scope:{ read: true, write: true, account: true }, expiration:"never", 
            success: cb,
            error: function(e) {
                console.log("TrelloCMS ERROR: Something went wrong authenticating Trello", e);
            }
        };
        
        Trello.authorize(opts);
    }
    
    tcms.loadBoard( boardID, options ) {
        
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
    
    tcms.getListById = function( id ) {
        for( var i = 0; i < this.boarddata.lists.length; i++ ) {
            
            if( this.boarddata.lists[i].id == id ) {
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
    
}();