var app = angular.module('app', 
    ['ui.router'])
.value('APIURL', 'http://localhost/Karthi/bsfinance/api/wp-admin/admin-ajax.php?action=');
app
.config(routes);

function routes($stateProvider, $urlRouterProvider) {

    // default route
    $urlRouterProvider
        .when('', '/home');
    var states = [
        {
            name: 'home',
            label: 'Home',
            auth: false,
            restricted:false,
            url: '/home',
            templateUrl: 'app/home/index.html',
            controller: 'homeController'
        },
        {
            name: 'signup',
            label: 'Signup',
            auth: false,
            restricted:false,
            url: '/signup',
            templateUrl: 'app/signup/index.html',
            controller: 'signupController'
        },
        {
            name: 'signin',
            label: 'Signin',
            auth: false,
            restricted:false,
            url: '/signin',
            templateUrl: 'app/signin/index.html',
            controller: 'signinController'
        },
        {
            name: 'faq',
            label: 'FAQ',
            auth: false,
            restricted:false,
            url: '/faq',
            templateUrl: 'app/faq/index.html',
            controller: 'faqController'
        },
        {
            name: 'terms',
            label: 'Terms',
            auth: false,
            restricted:false,
            url: '/terms',
            templateUrl: 'app/terms/index.html',
            controller: 'termsController'
        },
        {
            name: 'news',
            label: 'NEWS',
            auth: false,
            restricted:false,
            url: '/news',
            templateUrl: 'app/news/index.html',
            controller: 'newsController'
        },
        {
            name: 'ratings',
            label: 'Ratings',
            auth: false,
            restricted:false,
            url: '/ratings',
            templateUrl: 'app/ratings/index.html',
            controller: 'ratingsController'
        },
        {
            name: 'contactus',
            label: 'Contact Us',
            auth: false,
            restricted:false,
            url: '/contactus',
            templateUrl: 'app/contactus/index.html',
            controller: 'contactusController'
        },
        {
            name: 'calc',
            label: 'Profit Calculator',
            auth: false,
            restricted:false,
            url: '/calc',
            templateUrl: 'app/calc/index.html',
            controller: 'calcController'
        },
        {
            name: 'start',
            label: 'Get Started',
            auth: false,
            restricted:false,
            url: '/start',
            templateUrl: 'app/start/index.html',
            controller: 'startController'
        },
        {
            name: 'account',
            label: 'Account',
            auth: false,
            restricted:false,
            url: '/account',
            templateUrl: 'app/account/index.html',
            controller: 'accountController'
        },
        {
            name: 'deposit',
            label: 'Deposit',
            auth: false,
            restricted:false,
            url: '/deposit',
            templateUrl: 'app/deposit/index.html',
            controller: 'depositController'
        },
        {
            name: 'withdraw',
            label: 'Withdraw',
            auth: false,
            restricted:false,
            url: '/withdraw',
            templateUrl: 'app/withdraw/index.html',
            controller: 'withdrawController'
        },
        {
            name: 'history',
            label: 'History',
            auth: false,
            restricted:false,
            url: '/history',
            templateUrl: 'app/history/index.html',
            controller: 'historyController'
        },
        {
            name: 'deposit_list',
            label: 'Deposit_list',
            auth: false,
            restricted:false,
            url: '/deposit_list',
            templateUrl: 'app/deposit_list/index.html',
            controller: 'deposit_listController'
        },
        {
            name: 'referals',
            label: 'Referals',
            auth: false,
            restricted:false,
            url: '/referals',
            templateUrl: 'app/referals/index.html',
            controller: 'referalsController'
        },
        {
            name: 'referallinks',
            label: 'Referallinks',
            auth: false,
            restricted:false,
            url: '/referallinks',
            templateUrl: 'app/referallinks/index.html',
            controller: 'referallinksController'
        },
        {
            name: 'editaccount',
            label: 'Editaccount',
            auth: false,
            restricted:false,
            url: '/editaccount',
            templateUrl: 'app/editaccount/index.html',
            controller: 'editaccountController'
        },
        {
            name: 'security',
            label: 'Security',
            auth: false,
            restricted:false,
            url: '/security',
            templateUrl: 'app/security/index.html',
            controller: 'securityController'
        },
        {
            name: 'top',
            label: 'Top',
            auth: false,
            restricted:false,
            url: '/top',
            templateUrl: 'app/top/index.html',
            controller: 'topController'
        },
        {
            name: 'last',
            label: 'Last',
            auth: false,
            restricted:false,
            url: '/last',
            templateUrl: 'app/last/index.html',
            controller: 'lastController'
        },
        {
            name: 'paidout',
            label: 'Paidout',
            auth: false,
            restricted:false,
            url: '/paidout',
            templateUrl: 'app/paidout/index.html',
            controller: 'paidoutController'
        },
        {
            name: 'rules',
            label: 'Rules',
            auth: false,
            restricted:false,
            url: '/rules',
            templateUrl: 'app/rules/index.html',
            controller: 'rulesController'
        },
        {
            name: 'privacy',
            label: 'Privacy',
            auth: false,
            restricted:false,
            url: '/privacy',
            templateUrl: 'app/privacy/index.html',
            controller: 'privacyController'
        },
    ]

    angular.forEach(states, function (state) {
        $stateProvider.state(state);
    });
};


app.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 13) {
                scope.$apply(function () {
                    scope.$eval(attrs.ngEnter);
                });
                event.preventDefault();
            }
        });
    };
});

app.directive('ngEscape', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.key === "Escape") {
                scope.$apply(function () {
                    scope.$eval(attrs.ngEscape);
                });
                event.preventDefault();
            }
        });
    };
});

app.directive('ngUparrow', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 38) {
                scope.$apply(function () {
                    scope.$eval(attrs.ngUparrow);
                });
                event.preventDefault();
            }
        });
    };
});

app.directive('ngDownarrow', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 40) {
                scope.$apply(function () {
                    scope.$eval(attrs.ngDownarrow);
                });
                event.preventDefault();
            }
        });
    };
});

app.directive("repeatEnd", function(){
    return {
        restrict: "A",
        link: function (scope, element, attrs) {
            if (scope.$last) {
                scope.$eval(attrs.repeatEnd);
            }
        }
    };
});

app.directive("datePicker", function(){
    return {
        restrict: "A",
        link: function (scope, element, attrs) {
            $(element).datepicker({'format': 'yyyy-mm-dd', autoclose: true, startDate: new Date()});
        }
    };
});

app.directive("telInput", function($parse){
    return {
        restrict: "A",
        link: function (scope, element, attrs) {
            input = element.get(0);
            telInput = window.intlTelInput(input);
            var fn = $parse(attrs.countryChange);
            telInput.setCountry(attrs.country ? attrs.country : 'ca');
            input.addEventListener("countrychange", function() {
              fn(scope, {$event:event, data: telInput.getSelectedCountryData()});
            });
        }
    };
});

app.directive("cdatePicker", function(){
    return {
        restrict: "A",
        link: function (scope, element, attrs) {
            $(element).datepicker({'format': 'yyyy-mm-dd', autoclose: true});
        }
    };
});

app.directive('ngRightClick', function($parse) {
    return function(scope, element, attrs) {
        var fn = $parse(attrs.ngRightClick);
        element.bind('contextmenu', function(event) {
            scope.$apply(function() {
                event.preventDefault();
                fn(scope, {$event:event});
            });
        });
    };
});

app.directive('triggerUpload', function() {
  return {
    restrict: 'A',
    require: '?ngModel',
    link: function (scope, element, attrs, ngModel) {
        element.bind('click', function(event){
            $("#"+attrs['triggerUpload']).trigger('click');
        }); 
    }
  };
});

app.directive('fileUpload', function(ApiService, $rootScope, $timeout, $state, $q) {
  return {
    restrict: 'A',
    require: '?ngModel',
    link: function (scope, element, attrs, ngModel) {
        element.bind('change', function(event){
            var file = event.target.files[0];
            
            var ext = file.name.split('.').pop();
            var dataID = attrs['docid'];
            
            if(attrs['fileFolder'] && attrs['fileFolder'] == 'messenger' && attrs['limit'] && attrs['limit'] < file.size){
                ApiService.notification('Sorry, messenger attachments must be under 12MB. ', 'error');
                return;
            }
            
            if(attrs['fileFolder'] && attrs['fileFolder'] == 'messenger' && !!ngModel.$viewValue && !!ngModel.$viewValue.name){
                ApiService.notification('Only one attachment is allowed per message. Send your existing attachment or delete it.', 'warning');
                return;
            }
            
            if(attrs.id.indexOf('messengerAttachment') === 0){
                ngModel.$setViewValue({name: file.name, loading: 1});
            } else {
                ngModel.$setViewValue('assets/img/preloader.gif');
            }
            
            if((attrs['format'] == 'image' && (file.type == 'image/png' || file.type == 'image/jpeg' || file.type == 'image/jpg' || file.type == 'image/gif')) ){
               
               filename = new Date().getTime();
               
               ApiService.upload(attrs['fileUpload'], file, attrs['fileFolder'], ext, filename).then(function(data){
                    ngModel.$setViewValue(data.Location);
                    
                    if(attrs.afterUpload){
                        scope.$eval(attrs.afterUpload);
                    }
               }, function(err){
                   console.log(err);
               });
               
               new ImageCompressor(file, {
                    maxWidth: 100,
                    quality: 0.9,
                    success: function(result) {
                       ApiService.upload(attrs['fileUpload'], result, attrs['fileFolder'], ext, filename+'-icon').then(function(data){
                            
                       }, function(err){
                           console.log(err);
                       }); 
                    },
                    error: function(e) {
                      console.log(e.message);
                    },
                }); 
            } else if(attrs['format'] == '*'){
                
                var availExt = ['jpeg', 'jpg', 'gif', 'png', 'bmp' , 'zip', 'rar', 'tar', 'gzip', 'txt', 'mp4', 'webM',
                'mpeg4', '3gpp', 'mov', 'api', 'mpegps', 'wmv', 'flv', 'ogg', 'xls', 'xlsx', 'ppt', 'pptx', 'doc', 'docx',
                'xps', 'mp3', 'mpeg', 'wav', 'psd', 'ai', 'pdf', 'eps', 'ps', 'svg', 'tiff', 'ttf'];
                
                if($state.current.name != 'docs'){
                    if(availExt.indexOf(ext.toLowerCase()) === -1){
                        ApiService.notification('Invalid format.', 'warning');
                        return;
                    }
                    $rootScope.fileQueue[file.name] = 0;
                    ApiService.upload(attrs['fileUpload'], file, attrs['fileFolder'], ext).then(function(data){
                        var newData = {};
                        newData['size'] = file.size;
                        newData['name'] = file.name;
                        newData['url'] = data.Location;
                        var ff = file.name.split('.');
                        newData['type'] = ff.pop();
                        newData['parent'] = dataID;
                        try{
                            ngModel.$setViewValue(newData);
                            if(attrs.afterUpload){
                                scope.$eval(attrs.afterUpload);
                            }
                        } catch(e){
                            console.log(e);
                        }
                        
                   }, function(err){
                       delete $rootScope.fileQueue[file.name];
                       ApiService.notification('Error while upload document. Please try again', 'warning');
                   }, function(update) {
                       
                        $rootScope.fileQueue[file.name] = update;
                       
                        if(update == 100){
                           $timeout(function(){
                              delete $rootScope.fileQueue[file.name];
                           }, 1000); 
                        }
                        
                    }); 
                } else {
                    var totalGb = $rootScope.subscripionPlans[$rootScope.loggedInUserInfo.plan].max_storage_gb * 1073741824;
                    angular.forEach(event.target.files, function(file, k){
                       var ext = file.name.split('.').pop();
                        $rootScope.fileQueue[file.name] = 0;
		
                		if(parseInt($rootScope.docsize) + file.size > totalGb){
                		    $rootScope.fileQueue[file.name] = -1;
                		    $timeout(function(){
                              delete $rootScope.fileQueue[file.name];
                            }, 3000);	
                		} else if(availExt.indexOf(ext.toLowerCase()) === -1){
                            $rootScope.fileQueue[file.name] = -2;
                            $timeout(function(){
                              delete $rootScope.fileQueue[file.name];
                            }, 3000);
                        } else {
                           ApiService.upload(attrs['fileUpload'], file, attrs['fileFolder'], ext).then(function(data){
                                var newData = {};
                                newData['size'] = file.size;
                                newData['name'] = file.name;
                                newData['url'] = data.Location;
                                var ff = file.name.split('.');
                                newData['type'] = ff.pop();
                                newData['parent'] = dataID;
                                $rootScope.uploadFile(newData, scope.doc_files);
                                
                            }, function(err){
                                $rootScope.fileQueue[file.name] = -3;
                                $timeout(function(){
                                  delete $rootScope.fileQueue[file.name];
                                }, 3000);
                            }, function(update) {
                               
                                $rootScope.fileQueue[file.name] = update;
                               
                                if(update == 100){
                                   $timeout(function(){
                                      delete $rootScope.fileQueue[file.name];
                                   }, 3000); 
                                }
                                
                            });  
                        }
                        scope.$apply();
                    });
                    
                }
            } else {
                ApiService.notification('Invalid format. Please try valid '+attrs['format'], 'warning');
            }
        }); 
    }
  };
});

app.filter('checkurl', function ($rootScope) {
  return function (item) {
    var res = (item || "").replace(
        /([^\S]|^)(((https?\:\/\/)|(www\.))(\S+))/gi,
        function(match, space, url){
          var hyperlink = url;
          if (!hyperlink.match('^https?:\/\/')) {
            hyperlink = 'http://' + hyperlink;
          }
          return space + '<a class="linkurl" target="_blank" href="' + hyperlink + '">' + url + '</a>';
        }
      );
     
    var tmpa = document.createElement("div");
    $(tmpa).html(res);
    
    var tagged_users = $(tmpa).text().split(' ').filter(function(re){
        return re.indexOf('@') === 0 && !!$rootScope.company_user_login_by_name[re.replace('@', '')];
    });
    
    angular.forEach(tagged_users, function(v, k) {
        res = res.replace(v, '<a class="linkurl" href="#!/profile/'+v.replace('@', '')+'">'+$rootScope.company_user_login_by_name[v.replace('@', '')]+'</a>');
    });
     
    return res;
  };
});

app.filter('notiName', function ($rootScope) {
  return function (item, id, ename) {
      if($rootScope.users_obj[id]){
            var res = (item || "").replace('[name]', '<strong>'+$rootScope.users_obj[id].user_login+'</strong>');
            res = res.replace('[event_name]', ename);
            return res;
      } else {
          return "";
      }
  };
});

app.filter('to_trusted', ['$sce', function($sce){
    return function(text) {
        return $sce.trustAsHtml(text);
    };
}]);

app.filter('secure_url', ['$sce', function($sce){
    return function(text) {
        return $sce.trustAsResourceUrl(text);
    };
}]);

app.filter('shortContent', function () {
    return function (item, maxLength) {
        if((item || "").length < maxLength){
            return item;
        } else {
            var trimmedString = (item || "").substr(0, maxLength);
            return trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")))+'...';
        }
    }
});

app.filter('youtubeurl', function () {
  return function (item) {
    var regex = /([^\S]|^)(((https?\:\/\/)|(www\.))(\S+))/gi;
    var found = (item || "").match(regex);
    
    var $youtubeurl= '';
    
    if(Array.isArray(found)){
        angular.forEach(found, function(v,k){
            var tmpv = [];
            if(v.indexOf('youtube.com/watch?v=') !== -1){
                tmpv = v.split('youtube.com/watch?v=');
            } else if(v.indexOf('youtu.be/') !== -1){
                tmpv = v.split('youtu.be/');
            }
            
            if(tmpv.length == 2 && tmpv[1].trim()){
                $youtubeurl += '<div class="youtube-video">'+
                    '<iframe width="470" height="315"src=" https://www.youtube.com/embed/'+ tmpv[1].trim() +'">'+
                    '</iframe>'+
                '</div>';
            }
        });
    }
    
    return $youtubeurl;
  };
});

Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};



app
    
    .filter('dformat', function($filter){
        return function(input){
            if(input){
                var dt = new Date(input).getTime();
                return $filter('date')(dt);
            } else{
                return '';
            }
        }
    })
    
    .filter('timeago', function() {
        return function(input, p_allowFuture) {
            var substitute = function (stringOrFunction, number, strings) {
                    var string = $.isFunction(stringOrFunction) ? stringOrFunction(number, dateDifference) : stringOrFunction;
                    var value = (strings.numbers && strings.numbers[number]) || number;
                    return string.replace(/%d/i, value);
                },
                nowTime = (new Date()).getTime(),
                date = (new Date(input)).getTime(),
                //refreshMillis= 6e4, //A minute
                allowFuture = p_allowFuture || false,
                strings= {
                    prefixAgo: null,
                    prefixFromNow: null,
                    suffixAgo: "ago",
                    suffixFromNow: "from now",
                    seconds: "few seconds",
                    minute: "a minute",
                    minutes: "%d minutes",
                    hour: "an hour",
                    hours: "%d hours",
                    day: "a day",
                    days: "%d days",
                    month: "a month",
                    months: "%d months",
                    year: "a year",
                    years: "%d years"
                },
                dateDifference = nowTime - date,
                words,
                seconds = Math.abs(dateDifference) / 1000,
                minutes = seconds / 60,
                hours = minutes / 60,
                days = hours / 24,
                years = days / 365,
                separator = strings.wordSeparator === undefined ?  " " : strings.wordSeparator,
            
                // var strings = this.settings.strings;
                prefix = strings.prefixAgo,
                suffix = strings.suffixAgo;
                
            if (allowFuture) {
                if (dateDifference < 0) {
                    prefix = strings.prefixFromNow;
                    suffix = strings.suffixFromNow;
                }
            }

            words = seconds < 45 && substitute(strings.seconds, Math.round(seconds), strings) ||
            seconds < 90 && substitute(strings.minute, 1, strings) ||
            minutes < 45 && substitute(strings.minutes, Math.round(minutes), strings) ||
            minutes < 90 && substitute(strings.hour, 1, strings) ||
            hours < 24 && substitute(strings.hours, Math.round(hours), strings) ||
            hours < 42 && substitute(strings.day, 1, strings) ||
            days < 30 && substitute(strings.days, Math.round(days), strings) ||
            days < 45 && substitute(strings.month, 1, strings) ||
            days < 365 && substitute(strings.months, Math.round(days / 30), strings) ||
            years < 1.5 && substitute(strings.year, 1, strings) ||
            substitute(strings.years, Math.round(years), strings);

            return $.trim([prefix, words, suffix].join(separator));
            // conditional based on optional argument
            // if (somethingElse) {
            //     out = out.toUpperCase();
            // }
            // return out;
        }
    })
    
.filter('bytes', function() {
	return function(bytes, precision) {
		if (isNaN(parseFloat(bytes)) || !isFinite(bytes)) return '-';
		if (typeof precision === 'undefined') precision = 1;
		var units = ['bytes', 'kB', 'MB', 'GB', 'TB', 'PB'],
			number = Math.floor(Math.log(bytes) / Math.log(1024));
		return (bytes / Math.pow(1024, Math.floor(number))).toFixed(precision) +  ' ' + units[number];
	}
})

.filter('thumbicon', function() {
	return function(img) {
		if(!img) return '';
		if(img.indexOf('editedImage') !== -1){
		    return img;
		} else {
		    var fileurl = img.split(".");
    		var popExt = fileurl.pop();
    		var popUrl = fileurl.pop();
    		popUrl = popUrl+'-icon';
    		fileurl.push(popUrl);
    		fileurl.push(popExt);
    		return fileurl.join('.');
		}
	}
});

Object.equals = function( x, y ) {
  if ( x === y ) return true;
    // if both x and y are null or undefined and exactly the same

  if ( ! ( x instanceof Object ) || ! ( y instanceof Object ) ) return false;
    // if they are not strictly equal, they both need to be Objects

  if ( x.constructor !== y.constructor ) return false;
    // they must have the exact same prototype chain, the closest we can do is
    // test there constructor.

  for ( var p in x ) {

    if(p == 'collapsed') continue;

    if ( ! x.hasOwnProperty( p ) ) continue;
      // other properties were tested using x.constructor === y.constructor

    if ( ! y.hasOwnProperty( p ) ) return false;
      // allows to compare x[ p ] and y[ p ] when set to undefined

    if ( x[ p ] === y[ p ] ) continue;
      // if they have the same strict value or identity then they are equal

    if ( typeof( x[ p ] ) !== "object" ) return false;
      // Numbers, Strings, Functions, Booleans must be strictly equal

    if ( ! Object.equals( x[ p ],  y[ p ] ) ) return false;
      // Objects and Arrays must be tested recursively
  }

  for ( p in y ) {

    if(p == 'collapsed') continue;

    if ( y.hasOwnProperty( p ) && ! x.hasOwnProperty( p ) ) return false;
      // allows x[ p ] to be set to undefined
  }
  return true;
}

var compareTo = function() {
    return {
        require: "ngModel",
        scope: {
            otherModelValue: "=compareTo"
        },
        link: function(scope, element, attributes, ngModel) {
             
            ngModel.$validators.compareTo = function(modelValue) {
                return modelValue == scope.otherModelValue;
            };
 
            scope.$watch("otherModelValue", function() {
                ngModel.$validate();
            });
        }
    };
};
 
app.directive("compareTo", compareTo);

app.value('ISIONICAPP', 0)
.config(['$compileProvider',function( $compileProvider ){
    //$compileProvider.imgSrcSanitizationWhitelist(/^\s*(https?|file|blob|cdvfile):|data:image//);
}])
.factory('Camera', function($q) {
   return {
      getPicture: function(options) {
         var q = $q.defer();

         navigator.camera.getPicture(function(result) {
            q.resolve(result);
         }, function(err) {
            q.reject(err);
         }, options);

         return q.promise;
      }
   }
})