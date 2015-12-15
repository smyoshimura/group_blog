var app = angular.module("blogApp", ["ngRoute"]);

app.config(function ($routeProvider){
    $routeProvider
        .when('/login', {
            templateUrl: 'login.html',
            controller: 'loginCtrl'
        })
        .when('/register', {
            templateUrl: 'registration.html',
            controller: 'registerCtrl'
        })
        .when('/blog', {
            templateUrl: 'blog.html',
            controller: 'blogCtrl'
        })
        .when('/blog-list', {
            templateUrl: 'update.html',
            controller: 'updateCtrl'
        })
        .otherwise({
            redirectTo: '/login'
        })
});

app.service("blogService", function ($q) {

});

app.controller('loginCtrl', function (blogService) {

});

app.controller('registerCtrl', function (blogService) {

});

app.controller('blogCtrl', function (blogService) {

});

app.controller('updateCtrl', function (blogService) {

});