// Module: Internet Archive
// @docs: http://archive.org/help/json.php

define(function() {
    return {
        name: 'Archive.org',
        dataType: 'jsonp',
        toDataUri: function(uri) {
            return uri + '&output=json&callback=parseData';
        },
        parseData: function(data) {
			var obj = data;
            return {
                name: obj.metadata.title,
                description: obj.metadata.description,
                imageURI: obj.misc.image,
            };
        }
    };
});