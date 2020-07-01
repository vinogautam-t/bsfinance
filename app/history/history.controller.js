app.controller('historyController', function($scope, $rootScope, $state, $timeout, ApiService) {
	$scope.pageInfo={};

	$scope.years = [];

	for(i=2019;i<=new Date().getFullYear();i++){
		$scope.years.push(i);
	}

	$scope.transactions = [];

	$scope.get_transaction = function(){
		ApiService.bs_transaction_list($scope.pageInfo).then(function(res){
			$scope.transactions = res.data;
		});
	};

	$scope.get_transaction();
});