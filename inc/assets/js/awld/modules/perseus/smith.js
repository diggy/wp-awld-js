// Module: Perseus: Smith's "Dictionary of Greek and Roman biography and mythology"

define(['jquery'], function($) {
    return {
        name: 'Perseus: References in Smith\'s "Greek and Roman biography and mythology"',
        type: 'person',
        dataType: 'xml',
        // data format determined through content negotiation
        corsEnabled: true,
        // get values from the returned XML
        parseData: function(xml) {
            var getText = awld.accessor(xml),
                names = getText('head persName');
            return {
                names: names,
                name: names.join(', or '),
                description: getText('p')
            };
        }
    };
});