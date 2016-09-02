// JavaScript Document
function WebsiteCtrl($scope, $http) {
	//console.log("init");
	
	$scope.current = 0;
	$scope.interval;
	
	$http.get('_portfolio/portfolio.json').success(function(data) {
		//console.log( data );
		$scope.portfolio = data.portfolio;
		
	});
	
	$scope.initSlider = function() {
		var e = document.getElementById( "portitem"+$scope.current );
		e.classList.remove( "hidden" );
		e.classList.add( "visible" );
		
		$scope.interval = setInterval( $scope.slide, 4000 );
	};
	
	$scope.slide = function() {
		
		//console.log( "sliding" );
		
		var e = document.getElementById( "portitem"+$scope.current );
		e.classList.remove( "visible" );
		e.classList.add( "hidden" );
		
		$scope.current++;
		e = document.getElementById( "portitem"+$scope.current );
		
		if( e ) {
			e.classList.remove( "hidden" );
			e.classList.add( "visible" );
		} else {
			$scope.current = 0;
			e = document.getElementById( "portitem"+$scope.current );
			e.classList.remove( "hidden" );
			e.classList.add( "visible" );
		}
	};
	
	$scope.stopSlider = function() {
		window.clearInterval($scope.interval);
	};
	
}

