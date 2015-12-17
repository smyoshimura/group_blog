var app = angular.module("blogApp", ["ngRoute"]);

app.config(function ($routeProvider) {
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
        .when('/update', {
            templateUrl: 'update.html',
            controller: 'updateCtrl'
        })
        .otherwise({
            redirectTo: '/login'
        })
});

app.service("blogService", function ($q, $http) {
    var selfServe = this;

    selfServe.serviceArray = [{
        title: "Test Title",
        author: "Test Author",
        time: "Posted on August 24, 2013 at 9:00 PM",
        content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. " +
        "Stuff stuff stuff. " +
        "Test test test test testing test test. So much more testing to be done!"
    },
        {
            title: "Title",
            author: "Test Author",
            time: "Posted on August 24, 2013 at 9:00 PM",
            content: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. " +
            "Stuff stuff stuff. " +
            "Test test test test testing test test. So much more testing to be done!"
        }
    ];

    selfServe.returnArray = function () {
        return selfServe.serviceArray;
    };

    selfServe.currentUser = {};

    selfServe.loginUser = function (user) {
        dataObj = $.param({
            email: user.email,
            password: user.password
        });

        console.log('Sending login request.');

        return $http({
            url: 's-apis.learningfuze.com/blog/login.json',
            method: 'POST',
            data: dataObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    };

    selfServe.postBlogEntry = function (entry) {
        selfServe.serviceArray.push(entry);
    }
});

app.controller('loginCtrl', function (blogService) {
    var selfLog = this;

    selfLog.requestLogIn = function () {
        blogService.loginUser(selfLog.user);
        selfLog.user = {};
    }
});

app.controller('registerCtrl', function (blogService) {

});

app.controller('blogCtrl', function (blogService) {
    var selfBlog = this;

    selfBlog.currentBlog = blogService.returnArray;

})
;

app.controller('updateCtrl', function (blogService) {
    var selfUpdate = this;

    selfUpdate.addEntry = function () {
        blogService.postBlogEntry(selfUpdate.newEntry);
        selfUpdate.newEntry = {};
    };
});