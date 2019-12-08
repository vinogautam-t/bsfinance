app.factory('ApiService', function (httpService, $q, APIURL, $rootScope, $timeout) {
	var apiService = {};
    
    apiService.notification = function(msg, type){
        $('body').pgNotification({
            style: 'flip',
            message: msg,
            position: 'top-middle',
            timeout: 1000,
            type: type
        }).show();
    };
    
	apiService.login = function (data) {
    	return httpService
        .post(APIURL+'bs_login', data)
        .then(function (res) {
            return res['data'];
        });
    };

    apiService.forgotPassword = function (data) {
        return httpService
        .post(APIURL+'bs_forgot_password', data)
        .then(function (res) {
            return res['data'];
        });
    };

    apiService.resetPassword = function (data) {
        return httpService
        .post(APIURL+'bs_reset_password', data)
        .then(function (res) {
            return res['data'];
        });
    };
    
    apiService.bs_create_user = function (data) {
    	return httpService
        .post(APIURL+'bs_create_user', data)
        .then(function (res) {
            return res['data'];
        });
    };
    
    apiService.bs_user_exist = function (name) {
    	return httpService
        .post(APIURL+'bs_user_exist&username='+name)
        .then(function (res) {
            return res['data'];
        });
    };
    
    apiService.bs_email_exist = function (name) {
    	return httpService
        .post(APIURL+'bs_email_exist&email='+name)
        .then(function (res) {
            return res['data'];
        });
    };
    
    apiService.bs_delete_user = function (data) {
    	return httpService
        .post(APIURL+'bs_delete_user', data)
        .then(function (res) {
            return res['data'];
        });
    };
    
    
    return apiService;
});