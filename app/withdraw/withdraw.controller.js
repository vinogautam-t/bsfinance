app.controller('withdrawController', function($scope, $rootScope, $state, $timeout, ApiService, DATA) {
	$scope.withdraw = {};
	$scope.pageInfo = {data: DATA.data};
	

	$scope.doWithdraw = function(){
		if($scope.withdrawform.$valid){
		ApiService.bs_withdraw_request($scope.withdraw).then(function(res){
			if(res.status == 'Success'){
				$state.go('history');
			} else {
				ApiService.notification('Invalid Amount', 'error');
			}
		});
	}
	};

});