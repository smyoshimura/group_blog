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

app.service("userService", function ($q, $http) {
    var selfUser = this;

    selfUser.currentUser = {};

    selfUser.registerUser = function (user) {
        var dataObj = $.param({
            email: user.email,
            display_name: user.display_name,
            password: user.password
        });

        console.log('Sending registration request.');

        return $http({
            url: 'http://54.213.120.176/group_blog/register_user.php',
            method: 'POST',
            data: dataObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    };

    selfUser.loginUser = function (user) {
        var dataObj = $.param({
            email: user.email,
            password: user.password
        });

        console.log('Sending login request.');

        return $http({
            url: 'http://54.213.120.176/group_blog/login_user.php',
            method: 'POST',
            data: dataObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    };
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
            title: "Other Title",
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

    selfServe.postBlogEntry = function (entry) {
        selfServe.serviceArray.splice(0, 0, entry);
    };

    selfServe.createBlogEntry = function (entry) {
        var dataObj = $.param({
            title: entry.title,
            text: entry.text,
            tags: entry.tags
        });

        console.log('Sending entry creation request.');

        return $http({
            url: 'http://54.213.120.176/group_blog/create_blog.php',
            method: 'POST',
            data: dataObj,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        });
    }
});

app.controller('loginCtrl', function (blogService, userService) {
    var selfLog = this;

    selfLog.currentToken = null;

    selfLog.requestLogIn = function () {
        userService.loginUser(selfLog.user)
            .then(function (response) {
                console.log('.then: ', (response));
                selfLog.currentToken = response.data.data.auth_token;
                selfLog.user = {};
                console.log('currentToken: ', selfLog.currentToken)
            }, function () {
                selfLog.user = {};
                console.log('Error')
            });
    }
});

app.controller('registerCtrl', function (blogService, userService) {
    var selfReg = this;

    selfReg.requestRegistration = function () {
        userService.registerUser(selfReg.newUser)
            .then(function (response) {
                console.log('.then: ', response);
                selfReg.newUser = {};
            }, function () {
                console.log('Error');
                selfReg.newUser = {};
            });
    };

});

app.controller('blogCtrl', function (blogService, userService) {
    var selfBlog = this;

    selfBlog.currentBlog = blogService.returnArray;

})
;

app.controller('updateCtrl', function (blogService, userService) {
    var selfUpdate = this;

    selfUpdate.addEntry = function () {
        blogService.postBlogEntry(selfUpdate.newEntry);
    };

    selfUpdate.requestAddEntry = function () {
        blogService.createBlogEntry(selfUpdate.newEntry)
            .then(function (response) {
                console.log('.then: ', response);
                selfUpdate.newEntry.id = response.data.data.id;
                blogService.postBlogEntry(selfUpdate.newEntry);
                selfUpdate.newEntry = {};
            }, function () {
                console.log('Error');
                selfUpdate.newEntry = {};
            });
    }
});