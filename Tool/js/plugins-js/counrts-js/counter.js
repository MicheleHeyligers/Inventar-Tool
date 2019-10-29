$( function() {
		// default setup
		$( '#timer-countdown' ).countdown( {
            from: 2522269, // 3 minutes (3*60)
            to: 0, // stop at zero
            movingUnit: 1000, // 1000 for 1 second increment/decrements
            timerEnd: undefined,
            outputPattern: '$day Day $hour : $minute : $second',
            autostart: true
        } );
		// count up
		$( '#timer-countup' ).countdown( {
			from: 0,
			to: 252212	
		} );
        // count in-between
        $( '#timer-countinbetween' ).countdown( {
            from: 100200,
            to: 20 
        } );
        // counter callback
        $( '#timer-countercallback' ).countdown( {
            from: 25222698,
            to: 0,
            timerEnd: function() {
                this.animate( { 'opacity':.5 }, 500 ).css( { 'text-decoration':'line-through' } );
            } 
        } );
        // changed output patterns
        $( '#timer-outputpattern' ).countdown( {
            outputPattern: '$day Days $hour Hours $minute Miniuts $second Seconds',
            from: 2560 * 2598 * 25698 * 10
        } );
	} );