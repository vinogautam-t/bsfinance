app.controller('depositController', function($scope, $rootScope, $state, $timeout, ApiService, DATA) {
	$scope.pageInfo = {};
	$scope.deposit = {};
	$scope.plans = DATA.data;
	$scope.plans_arr = {};
	angular.forEach(DATA.data, function(v){
		$scope.plans_arr[v.id] = v;
	});

	$scope.doDeposit = function(){
		if($scope.spendform.$valid){
		ApiService.bs_deposit_request($scope.deposit).then(function(res){
			if(res.status == 'Success'){
				$state.go('deposit_list');
			} else {
				ApiService.notification('Invalid Amount', 'error');
			}
		});
	}
	};
});