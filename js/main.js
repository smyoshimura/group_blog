var app = angular.module("blogApp", ["ngRoute"]);

app.config(function ($routeProvider){
    $routeProvider
        .when('/login', {
            templateUrl: 'login.html',
            controller: 'loginCtrl'
        })
        .when('/register', {
            templateUrl: 'register.html',
            controller: 'registerCtrl'
        })
        .when('/blog', {
            templateUrl: 'blog.html',
            controller: 'blogCtrl'
        })
        .when('/blog-list', {
            templateUrl: 'blog-list.html',
            controller: 'blogListCtrl'
        })
        .when('/post', {
            templateUrl: 'post.html',
            controller: 'postCtrl'
        })
        .otherwise({
            redirectTo: '/'
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

app.controller('blogListCtrl', function (blogService) {

});

app.controller('postCtrl', function (blogService){

});