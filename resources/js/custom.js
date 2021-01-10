Echo.channel(`transaction`)
    .listen('TransactionCreated', (e) => {
        // if( confirm('There is new transaction created. Do you want to reload?')){
        //     location.reload();
        // }
    });

    Echo.private('App.Models.User.' + userId)
    .notification((notification) => {
        console.log(notification.type);
    });
