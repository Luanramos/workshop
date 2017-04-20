MONKEY( 'Application', function(Application) {

    Application.init = function(container) {
        MONKEY.Helpers.create();
        MONKEY.factory.create( container );
    };

}, {} );
